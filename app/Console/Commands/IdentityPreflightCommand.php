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
 * The run FAILS on exactly four things, and nothing else is load-bearing:
 *
 * - an at-risk team that still holds records (the original incident);
 * - a user who can use a receiver panel today and would be left with ZERO
 *   teams — `sync([])` detaches their last membership and the Filament panel
 *   is tenant-scoped, so that is a total loss of access even when every team
 *   involved is empty;
 * - an identity conflict, i.e. a login that would throw rather than sign in;
 * - anything that could not be checked at all (unreachable app, missing or
 *   too-old endpoint, a slug the receiver could not resolve). "Could not
 *   check" is not "safe".
 *
 * Everything else printed is informational and deliberately does NOT gate the
 * exit code — in particular a user who ends at zero teams but ALREADY holds no
 * receiver membership, for whom the cutover changes nothing. Three fleet apps
 * carry such idle accounts; failing on them would make the command cry wolf and
 * get ignored, which is precisely how the zero-teams number went unread while a
 * real lockout hid inside it.
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
        $hasLockouts = false;

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

            if ($result['lockouts'] !== []) {
                // Losing every membership is a total loss of panel access, and
                // it is invisible to the record-count gate below: the teams
                // involved are routinely empty, which is exactly the case that
                // used to report PASSED.
                $hasLockouts = true;
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

        // Each reason is reported on its own, rather than the first one
        // short-circuiting the rest: they are independent failures with
        // independent remedies, and an operator who fixes only the one that
        // happened to print first would re-run straight into the next.
        $failed = $hasLockouts || $hasRecordsAtRisk || $hasErrors;

        if ($hasLockouts) {
            $this->error('Preflight FAILED: users who can use a panel today would be left with ZERO teams and lose all access. Give them a team on the publisher before cutting this app over.');
        }

        if ($hasRecordsAtRisk) {
            $this->error('Preflight FAILED: at-risk teams hold records that SSO would detach. Resolve them before cutting this app over.');
        }

        if ($hasErrors) {
            $this->error('Preflight FAILED: one or more apps could not be fully checked, or would fail a login outright. "Could not check" is not "safe".');
        }

        if ($failed) {
            return self::FAILURE;
        }

        $this->info('Preflight PASSED: every at-risk team is empty (or nothing is at risk) and nobody with panel access today would be left without a team. Safe to proceed with the SSO cutover.');

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
     * @return array{total: int, unaffected: int, at_risk: int, zero_teams: int, lockouts: list<array{user: string, memberships: int}>, already_zero: list<string>, conflicts: int, no_counterpart: int, at_risk_slugs: list<string>}
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

        // Match every receiver row first, so duplicate-mapping detection (see
        // below) can see the whole picture before any row is bucketed.
        $matches = $remoteUsers->map(fn (array $remoteUser): array => [
            'remoteUser' => $remoteUser,
            'match' => $this->matchLocalUser($remoteUser, $localUsersByUuid, $localUsersByEmail),
        ]);

        // Two different receiver rows resolving to the SAME local user is a
        // conflict resolveUser() cannot survive: whichever row it finds first
        // (uuid match wins, else the email-adopted row) gets that local
        // user's email force-filled onto it, and if a DIFFERENT receiver row
        // already holds that exact email, the save() hits the receiver's own
        // unique index — the "likelier collision" resolveUser()'s own
        // comment describes — and throws IdentityConflictException. A single
        // email change on the publisher is enough to create this pairing; no
        // uuid drift or second local user is required, so every matched row
        // is checked unconditionally.
        $localUserIdsWithMultipleRows = $matches
            ->filter(fn (array $entry): bool => in_array($entry['match']['type'], ['uuid', 'email'], true))
            ->groupBy(fn (array $entry): int|string => $entry['match']['user']->getKey())
            ->filter(fn (Collection $entries): bool => $entries->count() > 1)
            ->keys();

        $unaffected = 0;
        $atRisk = 0;
        $lockouts = [];
        $alreadyZero = [];
        $conflicts = 0;
        $noCounterpart = 0;
        $atRiskSlugs = [];

        foreach ($matches as $entry) {
            $remoteUser = $entry['remoteUser'];
            $match = $entry['match'];

            $isDuplicateMapping = in_array($match['type'], ['uuid', 'email'], true)
                && $localUserIdsWithMultipleRows->contains($match['user']->getKey());

            if ($match['type'] === 'conflict' || $isDuplicateMapping) {
                $conflicts++;

                continue;
            }

            if ($match['type'] === 'none') {
                $noCounterpart++;

                continue;
            }

            /** @var User $localUser */
            $localUser = $match['user'];

            $memberships = $remoteMembershipsByEmail->get($remoteUser['email'] ?? null, collect());

            // Drive "left with zero teams" from the LOCAL user's own team
            // count, not from how many of the receiver's memberships detach:
            // after sync() the receiver ends up with exactly the resolved set
            // of the local user's orgs, regardless of what it held before.
            //
            // Ending at zero is two different situations, though, and merging
            // them into one number is what let a real lockout hide. What the
            // user HOLDS ON THE RECEIVER RIGHT NOW decides which it is:
            // holding at least one membership means the cutover takes away
            // access they have today; holding none means it takes away
            // nothing. Only the former is a failure.
            if ($localUser->teams->isEmpty()) {
                if ($memberships->isNotEmpty()) {
                    $lockouts[] = ['user' => $this->describeUser($remoteUser), 'memberships' => $memberships->count()];
                } else {
                    $alreadyZero[] = $this->describeUser($remoteUser);
                }
            }

            $resolvedTeamIds = $localUser->teams
                ->map(fn (Team $team): int|string|null => $this->resolveReceiverTeamId(
                    ['uuid' => $team->uuid, 'slug' => $team->slug],
                    $remoteTeamsByUuid,
                    $remoteTeamsByNullSlug,
                ))
                ->filter(fn (int|string|null $id): bool => $id !== null)
                ->unique();

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
            'zero_teams' => count($lockouts) + count($alreadyZero),
            'lockouts' => $lockouts,
            'already_zero' => $alreadyZero,
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
     * This method classifies a single receiver row in isolation; it cannot
     * see whether some OTHER receiver row would also resolve to the same
     * local user. `evaluateApp()` covers that by grouping the results of
     * this method across ALL of an app's receiver rows and flagging a local
     * user id that more than one row maps to — the common shape of the
     * failure, needing only a single email change on the publisher.
     *
     * Residual gap: a receiver row already matched by uuid to local user L1
     * can carry a residual email that happens to equal a DIFFERENT local
     * user L2's email, purely coincidentally. If L2 has no receiver row of
     * their own on this app yet, L2 never appears in the rows this method is
     * called on, so nothing here or in evaluateApp() cross-checks L2's email
     * against it — yet L2's own future login would find that row by email,
     * see L1's non-empty uuid on it, and throw. Closing this needs matching
     * every LOCAL user's email against every receiver row, not just the
     * receiver rows that already matched something, at O(local users ×
     * receiver users).
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
     * A label an operator can act on without re-running the hand query that
     * found this gap in the first place: email when the receiver has one,
     * else the uuid, else the receiver's own row id. Never fabricates a
     * plausible-looking identifier — an unlabelled row says so.
     *
     * @param  array<string, mixed>  $remoteUser
     */
    private function describeUser(array $remoteUser): string
    {
        $email = $remoteUser['email'] ?? null;

        if (is_string($email) && trim($email) !== '') {
            return $email;
        }

        $uuid = $this->presentUuid($remoteUser['uuid'] ?? null);

        if ($uuid !== null) {
            return $uuid;
        }

        return 'receiver user #' . ($remoteUser['id'] ?? '?');
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
     * @param  array{total: int, unaffected: int, at_risk: int, zero_teams: int, lockouts: list<array{user: string, memberships: int}>, already_zero: list<string>, conflicts: int, no_counterpart: int, at_risk_slugs: list<string>}  $result
     */
    private function renderResult(array $result): void
    {
        $this->line("  Receiver users: {$result['total']}");
        $this->line("  Unaffected: {$result['unaffected']}");

        if ($result['at_risk'] > 0) {
            $this->warn("  Would lose at least one membership: {$result['at_risk']}");
        }

        // Warn, not error: the total mixes real casualties with idle accounts,
        // so it is a number to read, not a verdict. The subset below is the
        // verdict, and it is the only part rendered as an error.
        if ($result['zero_teams'] > 0) {
            $this->warn("  Would be left with ZERO teams — cannot use a Filament panel: {$result['zero_teams']}");
        }

        if ($result['lockouts'] !== []) {
            $this->error(sprintf('  Of those, would LOSE panel access they have today: %d', count($result['lockouts'])));

            foreach ($result['lockouts'] as $lockout) {
                $this->error(sprintf(
                    '  ! %s: holds %d receiver membership%s today, would be left with none',
                    $lockout['user'],
                    $lockout['memberships'],
                    $lockout['memberships'] === 1 ? '' : 's',
                ));
            }
        }

        foreach ($result['already_zero'] as $user) {
            $this->line("  ✓ {$user}: already has no teams on this receiver — the cutover changes nothing");
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
