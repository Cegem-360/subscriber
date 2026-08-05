<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Madbox99\UserTeamSync\Publisher\PublisherService;
use Throwable;

/**
 * Simulates, for every module app, what `IdentityProvisioner::provision()` would
 * do to that receiver's memberships on the first SSO login — without touching
 * anything. `sync()` there treats the login claim as complete state, so any
 * receiver team it cannot resolve back to this app is silently detached.
 *
 * This must be run before every SSO cutover. An unmeasured cutover already cost
 * one receiver ~49,000 records across twelve teams that fell out of tenant scope
 * on first login; nothing detected it, it was found by hand with ad-hoc scripts.
 *
 * Two provisioner behaviours drive the whole design and must stay mirrored
 * exactly — see `tests/Feature/Console/IdentityPreflightCommandTest.php`:
 *
 * - `resolveUser()` matches a receiver row by uuid first, then falls back to
 *   email. A receiver user with no uuid is NOT out of scope — it is exactly
 *   the pre-uuid cohort that gets adopted by email. Only a row that matches
 *   neither uuid nor email is genuinely untouched by any login. And a row
 *   found by email whose OWN uuid is non-empty and different from the
 *   logging-in user's is a hard conflict: `resolveUser()` throws, the login
 *   fails outright.
 * - `resolveTeam()` resolves EVERY one of the local user's orgs against the
 *   receiver's FULL team table (uuid match first, then an uuid-less slug
 *   match), not just against the teams the receiver user currently holds. A
 *   receiver team can lose a slug-adoption race to a *different* receiver
 *   team that already owns the matching org's uuid — so survival cannot be
 *   decided by looking at one membership row in isolation.
 */
#[Signature('identity:preflight {--app= : Limit the preflight run to a single app key}')]
#[Description('Simulate the SSO cutover against every module app and report memberships that IdentityProvisioner would detach.')]
final class IdentityPreflightCommand extends Command
{
    public function handle(PublisherService $publisher): int
    {
        $allApps = $publisher->getActiveApps();
        $apps = $allApps;

        if ($only = $this->option('app')) {
            if (! array_key_exists($only, $allApps)) {
                $this->error("Unknown or inactive app: {$only}");

                return self::FAILURE;
            }

            $apps = array_intersect_key($allApps, [$only => true]);
        }

        if ($apps === []) {
            $this->warn('No active apps configured. Nothing to check.');

            return self::SUCCESS;
        }

        $localUsers = User::query()
            ->with('teams:id,uuid,slug')
            ->get(['id', 'uuid', 'email']);

        /** @var Collection<string, User> $localUsersByUuid */
        $localUsersByUuid = $localUsers->filter(fn (User $user): bool => $this->presentUuid($user->uuid) !== null)->keyBy('uuid');

        /** @var Collection<string, User> $localUsersByEmail */
        $localUsersByEmail = $localUsers->keyBy('email');

        $hasErrors = false;
        $hasRecordsAtRisk = false;

        foreach ($apps as $appName => $app) {
            $this->newLine();
            $this->info("=== {$appName} ===");

            $remote = $this->fetch($publisher, $app);

            if ($remote === null) {
                $hasErrors = true;

                continue;
            }

            if (! $this->supportsUuid($remote)) {
                $this->error('  This app still runs a package version without uuid support in /api/identity-audit — upgrade before it can be preflighted.');
                $hasErrors = true;

                continue;
            }

            $result = $this->evaluateApp($remote, $localUsersByUuid, $localUsersByEmail);

            $this->renderResult($result);

            if ($result['conflicts'] > 0) {
                // A login that throws IdentityConflictException is not a pass —
                // it is a user who cannot sign in at all until resolved by hand.
                $hasErrors = true;
            }

            if ($result['at_risk_slugs'] === []) {
                $this->line('  No teams at risk of detachment — nothing to count.');

                continue;
            }

            $counted = $this->fetch($publisher, $app, $result['at_risk_slugs']);

            if ($counted === null || ! array_key_exists('record_counts', $counted)) {
                $this->error('  Could not retrieve record counts for the at-risk teams.');
                $hasErrors = true;

                continue;
            }

            /** @var array<string, int> $recordCounts */
            $recordCounts = $counted['record_counts'];

            $missingSlugs = array_diff($result['at_risk_slugs'], array_keys($recordCounts));

            if ($missingSlugs !== []) {
                // "Could not check" is not "safe": a slug the receiver could not
                // resolve to a team is an unverified risk, not a cleared one.
                foreach ($missingSlugs as $slug) {
                    $this->error("  ? {$slug}: record count unknown — the receiver could not resolve this team");
                }

                $hasErrors = true;
            }

            $this->renderRecordCounts($recordCounts);

            if (array_sum($recordCounts) > 0) {
                $hasRecordsAtRisk = true;
            }
        }

        $this->newLine();

        if ($hasRecordsAtRisk) {
            $this->error('Preflight FAILED: at-risk teams hold records that SSO would detach. Resolve them before cutting this app over.');

            return self::FAILURE;
        }

        if ($hasErrors) {
            $this->error('Preflight FAILED: one or more apps could not be fully checked, or would fail a login outright. "Could not check" is not "safe".');

            return self::FAILURE;
        }

        $this->info('Preflight PASSED: every at-risk team is empty (or nothing is at risk). Safe to proceed with the SSO cutover.');

        return self::SUCCESS;
    }

    /**
     * @param  array{url: string, api_key: ?string, active: bool}  $app
     * @param  list<string>|null  $countSlugs  When given, opts into the receiver's record_counts for these slugs.
     * @return array<string, mixed>|null
     */
    private function fetch(PublisherService $publisher, array $app, ?array $countSlugs = null): ?array
    {
        $query = $countSlugs === null ? [] : ['count_teams' => implode(',', $countSlugs)];

        try {
            $response = $publisher->makeHttpClient($app)->get("{$app['url']}/api/identity-audit", $query);
        } catch (Throwable $throwable) {
            $this->error("  Unreachable: {$throwable->getMessage()}");

            return null;
        }

        if ($response->status() === 404) {
            $this->error('  /api/identity-audit missing — this app still runs an older package version.');

            return null;
        }

        if (! $response->successful()) {
            $this->error("  HTTP {$response->status()} from /api/identity-audit");

            return null;
        }

        return $response->json();
    }

    /**
     * Detects a receiver still on a package version that predates uuid claims
     * in /api/identity-audit. Distinguished from a user/membership that
     * genuinely has no uuid yet: that case still carries the `uuid` key, just
     * with a null value.
     *
     * @param  array<string, mixed>  $remote
     */
    private function supportsUuid(array $remote): bool
    {
        $users = $remote['users'] ?? [];

        if ($users !== []) {
            return array_key_exists('uuid', $users[0]);
        }

        $memberships = $remote['memberships'] ?? [];

        if ($memberships !== []) {
            return array_key_exists('user_uuid', $memberships[0]);
        }

        $teams = $remote['teams'] ?? [];

        if ($teams !== []) {
            return array_key_exists('uuid', $teams[0]);
        }

        return true;
    }

    /**
     * @param  array<string, mixed>  $remote
     * @param  Collection<string, User>  $localUsersByUuid
     * @param  Collection<string, User>  $localUsersByEmail
     * @return array{total: int, unaffected: int, at_risk: int, zero_teams: int, conflicts: int, no_counterpart: int, at_risk_slugs: list<string>}
     */
    private function evaluateApp(array $remote, Collection $localUsersByUuid, Collection $localUsersByEmail): array
    {
        $remoteUsers = collect($remote['users'] ?? []);
        $remoteTeams = collect($remote['teams'] ?? []);

        // Grouped once, not queried per user, to avoid an O(users × memberships)
        // scan per app. Grouping by email (not user_uuid) is deliberate: every
        // uuid-less receiver user groups under the SAME null key, which would
        // silently merge different people's memberships together.
        $remoteMembershipsByEmail = collect($remote['memberships'] ?? [])->groupBy('user_email');

        /** @var Collection<string, array<string, mixed>> $remoteTeamsByUuid */
        $remoteTeamsByUuid = $remoteTeams->filter(fn (array $team): bool => $team['uuid'] !== null)->keyBy('uuid');

        /** @var Collection<string, array<string, mixed>> $remoteTeamsByNullSlug */
        $remoteTeamsByNullSlug = $remoteTeams->filter(fn (array $team): bool => $team['uuid'] === null)->keyBy('slug');

        // ALL receiver teams by slug (regardless of uuid), used only to
        // translate a MEMBERSHIP row's own team_slug back to that team's row
        // id — never to decide whether an org may adopt it.
        /** @var Collection<string, array<string, mixed>> $remoteTeamsBySlug */
        $remoteTeamsBySlug = $remoteTeams->keyBy('slug');

        $unaffected = 0;
        $atRisk = 0;
        $zeroTeams = 0;
        $conflicts = 0;
        $noCounterpart = 0;
        $atRiskSlugs = [];

        foreach ($remoteUsers as $remoteUser) {
            $match = $this->matchLocalUser($remoteUser, $localUsersByUuid, $localUsersByEmail);

            if ($match['type'] === 'conflict') {
                $conflicts++;

                continue;
            }

            if ($match['type'] === 'none') {
                $noCounterpart++;

                continue;
            }

            /** @var User $localUser */
            $localUser = $match['user'];

            // Drive "left with zero teams" from the LOCAL user's own team
            // count, not from how many of the receiver's memberships detach:
            // after sync() the receiver ends up with exactly the resolved set
            // of the local user's orgs, regardless of what it held before.
            if ($localUser->teams->isEmpty()) {
                $zeroTeams++;
            }

            $resolvedTeamIds = $localUser->teams
                ->map(fn (Team $team): int|string|null => $this->resolveReceiverTeamId(
                    ['uuid' => $team->uuid, 'slug' => $team->slug],
                    $remoteTeamsByUuid,
                    $remoteTeamsByNullSlug,
                ))
                ->filter(fn (int|string|null $id): bool => $id !== null)
                ->unique();

            $memberships = $remoteMembershipsByEmail->get($remoteUser['email'] ?? null, collect());
            $detached = false;

            foreach ($memberships as $membership) {
                $teamId = $this->membershipTeamId($membership, $remoteTeamsByUuid, $remoteTeamsBySlug);

                if ($teamId !== null && $resolvedTeamIds->contains($teamId)) {
                    continue;
                }

                $detached = true;
                $atRiskSlugs[] = $membership['team_slug'];
            }

            if ($detached) {
                $atRisk++;
            } else {
                $unaffected++;
            }
        }

        return [
            'total' => $remoteUsers->count(),
            'unaffected' => $unaffected,
            'at_risk' => $atRisk,
            'zero_teams' => $zeroTeams,
            'conflicts' => $conflicts,
            'no_counterpart' => $noCounterpart,
            'at_risk_slugs' => array_values(array_unique($atRiskSlugs)),
        ];
    }

    /**
     * Mirrors `IdentityProvisioner::resolveUser()`'s matching order exactly:
     * uuid first, then email. A receiver row found only by email is adopted
     * when its OWN uuid is empty (treating '' like NULL, as `resolveUser()`
     * does via `trim(...) !== ''`) — that is the pre-uuid cohort, not an
     * out-of-scope one. If that row's own uuid is non-empty and therefore
     * different from the login's uuid, `resolveUser()` throws instead.
     *
     * Known gap: this loops over RECEIVER rows, one uuid match per row. A
     * receiver row already matched by uuid to local user L1 whose email
     * happens to equal a DIFFERENT local user L2's is never re-checked
     * against L2 — so it cannot see that L2's own login would hit this same
     * row by email, find a non-empty foreign uuid, and throw. That requires
     * uuid drift (L1's receiver row no longer matches L1 by email) plus an
     * email reassignment between L1 and L2 on the publisher side, so it is
     * narrow, but it means a conflict can go unreported. Widening this to
     * cross-check every local user's email against every receiver row would
     * close it, at the cost of an O(local users × receiver users) pass.
     *
     * @param  array<string, mixed>  $remoteUser
     * @param  Collection<string, User>  $localUsersByUuid
     * @param  Collection<string, User>  $localUsersByEmail
     * @return array{type: 'uuid'|'email'|'conflict'|'none', user: ?User}
     */
    private function matchLocalUser(array $remoteUser, Collection $localUsersByUuid, Collection $localUsersByEmail): array
    {
        $uuid = $this->presentUuid($remoteUser['uuid'] ?? null);

        if ($uuid !== null) {
            $matched = $localUsersByUuid->get($uuid);

            if ($matched instanceof User) {
                return ['type' => 'uuid', 'user' => $matched];
            }
        }

        $matchedByEmail = $localUsersByEmail->get($remoteUser['email'] ?? null);

        if (! $matchedByEmail instanceof User) {
            return ['type' => 'none', 'user' => null];
        }

        if ($uuid !== null) {
            return ['type' => 'conflict', 'user' => $matchedByEmail];
        }

        return ['type' => 'email', 'user' => $matchedByEmail];
    }

    /**
     * Treats an empty string the same as NULL, matching the trim() check
     * `IdentityProvisioner::resolveUser()` applies to a user's uuid.
     */
    private function presentUuid(mixed $uuid): ?string
    {
        if (! is_string($uuid)) {
            return null;
        }

        return trim($uuid) !== '' ? $uuid : null;
    }

    /**
     * Mirrors `IdentityProvisioner::resolveTeam()` for a single org: a
     * receiver team is matched by uuid first; only when NO receiver team
     * carries that uuid does an uuid-less receiver team with the same slug
     * get adopted. Returns the matched receiver team's own row id — not a
     * derived uuid/slug string — because identity in `sync()` is the pivot's
     * team_id: the SAME row can be adopted (its uuid rewritten) and still
     * keep an existing membership attached, which only row-id matching
     * predicts correctly. Returns null when the org would create a
     * brand-new receiver team — irrelevant to detachment, since only
     * pre-existing receiver teams can be lost.
     *
     * @param  array{uuid: string, slug: string}  $org
     * @param  Collection<string, array<string, mixed>>  $remoteTeamsByUuid
     * @param  Collection<string, array<string, mixed>>  $remoteTeamsByNullSlug
     */
    private function resolveReceiverTeamId(array $org, Collection $remoteTeamsByUuid, Collection $remoteTeamsByNullSlug): int|string|null
    {
        $matched = $remoteTeamsByUuid->get($org['uuid']) ?? $remoteTeamsByNullSlug->get($org['slug']);

        return $matched['id'] ?? null;
    }

    /**
     * Resolves a membership row back to the receiver team's own row id, the
     * same way resolveReceiverTeamId() does, so the two are comparable on
     * equal footing. Prefers the uuid lookup (authoritative once a team has
     * one) and falls back to the FULL slug roster — not the uuid-less-only
     * one resolveReceiverTeamId() uses for adoption — because a membership's
     * own team is always a real, already-existing receiver row.
     *
     * @param  array{team_slug: string, team_uuid: ?string}  $membership
     * @param  Collection<string, array<string, mixed>>  $remoteTeamsByUuid
     * @param  Collection<string, array<string, mixed>>  $remoteTeamsBySlug
     */
    private function membershipTeamId(array $membership, Collection $remoteTeamsByUuid, Collection $remoteTeamsBySlug): int|string|null
    {
        if ($membership['team_uuid'] !== null) {
            $team = $remoteTeamsByUuid->get($membership['team_uuid']);

            if ($team !== null) {
                return $team['id'];
            }
        }

        $team = $remoteTeamsBySlug->get($membership['team_slug']);

        return $team['id'] ?? null;
    }

    /**
     * @param  array{total: int, unaffected: int, at_risk: int, zero_teams: int, conflicts: int, no_counterpart: int, at_risk_slugs: list<string>}  $result
     */
    private function renderResult(array $result): void
    {
        $this->line("  Receiver users: {$result['total']}");
        $this->line("  Unaffected: {$result['unaffected']}");

        if ($result['at_risk'] > 0) {
            $this->warn("  Would lose at least one membership: {$result['at_risk']}");
        }

        if ($result['zero_teams'] > 0) {
            $this->error("  Would be left with ZERO teams — cannot use a Filament panel: {$result['zero_teams']}");
        }

        if ($result['conflicts'] > 0) {
            $this->error("  Identity conflicts — login would fail outright: {$result['conflicts']}");
        }

        if ($result['no_counterpart'] > 0) {
            $this->warn("  No counterpart on this app, by uuid or email: {$result['no_counterpart']}");
        }
    }

    /**
     * @param  array<string, int>  $recordCounts
     */
    private function renderRecordCounts(array $recordCounts): void
    {
        foreach ($recordCounts as $slug => $count) {
            if ($count > 0) {
                $this->error(sprintf('  ! %s: %d record(s) at risk', $slug, $count));
            } else {
                $this->line("  ✓ {$slug}: empty, safe to detach");
            }
        }
    }
}
