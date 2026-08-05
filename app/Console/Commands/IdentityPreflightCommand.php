<?php

declare(strict_types=1);

namespace App\Console\Commands;

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
 * The matching rules below MUST mirror `IdentityProvisioner::resolveTeam()`
 * exactly (uuid match, then uuid-less slug match, else detach) — see
 * `tests/Feature/Console/IdentityPreflightCommandTest.php` for the parity test
 * that exercises the real provisioner and would fail if the two drifted apart.
 */
#[Signature('identity:preflight {--app= : Limit the preflight run to a single app key}')]
#[Description('Simulate the SSO cutover against every module app and report memberships that IdentityProvisioner would detach.')]
final class IdentityPreflightCommand extends Command
{
    public function handle(PublisherService $publisher): int
    {
        $apps = $publisher->getActiveApps();

        if ($only = $this->option('app')) {
            $apps = array_intersect_key($apps, [$only => true]);
        }

        if ($apps === []) {
            $this->warn('No active apps configured. Nothing to check.');

            return self::SUCCESS;
        }

        /** @var Collection<string, User> $localUsersByUuid */
        $localUsersByUuid = User::query()
            ->whereNotNull('uuid')
            ->with('teams:id,uuid,slug')
            ->get(['id', 'uuid'])
            ->keyBy('uuid');

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

            $result = $this->evaluateApp($remote, $localUsersByUuid);

            $this->renderResult($result);

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
            $this->error('Preflight FAILED: one or more apps could not be checked. "Could not check" is not "safe".');

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

        return true;
    }

    /**
     * @param  array<string, mixed>  $remote
     * @param  Collection<string, User>  $localUsersByUuid
     * @return array{total: int, no_uuid: int, no_local_counterpart: int, unaffected: int, at_risk: int, zero_teams: int, at_risk_slugs: list<string>}
     */
    private function evaluateApp(array $remote, Collection $localUsersByUuid): array
    {
        $remoteUsers = collect($remote['users'] ?? []);
        $remoteMemberships = collect($remote['memberships'] ?? []);

        $noUuid = 0;
        $noLocalCounterpart = 0;
        $unaffected = 0;
        $atRisk = 0;
        $zeroTeams = 0;
        $atRiskSlugs = [];

        foreach ($remoteUsers as $remoteUser) {
            $uuid = $remoteUser['uuid'] ?? null;

            if ($uuid === null) {
                $noUuid++;

                continue;
            }

            $localUser = $localUsersByUuid->get($uuid);

            if (! $localUser instanceof User) {
                $noLocalCounterpart++;

                continue;
            }

            $localTeamUuids = $localUser->teams->pluck('uuid')->filter()->all();
            $localTeamSlugs = $localUser->teams->pluck('slug')->all();

            $memberships = $remoteMemberships->where('user_uuid', $uuid);
            $originalCount = $memberships->count();
            $detachedCount = 0;

            foreach ($memberships as $membership) {
                if ($this->survives($membership, $localTeamUuids, $localTeamSlugs)) {
                    continue;
                }

                $detachedCount++;
                $atRiskSlugs[] = $membership['team_slug'];
            }

            if ($detachedCount === 0) {
                $unaffected++;
            } else {
                $atRisk++;
            }

            if ($originalCount > 0 && $originalCount - $detachedCount === 0) {
                $zeroTeams++;
            }
        }

        return [
            'total' => $remoteUsers->count(),
            'no_uuid' => $noUuid,
            'no_local_counterpart' => $noLocalCounterpart,
            'unaffected' => $unaffected,
            'at_risk' => $atRisk,
            'zero_teams' => $zeroTeams,
            'at_risk_slugs' => array_values(array_unique($atRiskSlugs)),
        ];
    }

    /**
     * Mirrors `IdentityProvisioner::resolveTeam()`'s resolution order exactly:
     * a uuid match wins outright; only a receiver team with NO uuid at all can
     * be saved by an adoption-style slug match. Anything else is what `sync()`
     * would detach on first SSO login.
     *
     * @param  array{team_slug: string, team_uuid: ?string}  $membership
     * @param  list<string>  $localTeamUuids
     * @param  list<string>  $localTeamSlugs
     */
    private function survives(array $membership, array $localTeamUuids, array $localTeamSlugs): bool
    {
        if ($membership['team_uuid'] !== null) {
            return in_array($membership['team_uuid'], $localTeamUuids, true);
        }

        return in_array($membership['team_slug'], $localTeamSlugs, true);
    }

    /**
     * @param  array{total: int, no_uuid: int, no_local_counterpart: int, unaffected: int, at_risk: int, zero_teams: int, at_risk_slugs: list<string>}  $result
     */
    private function renderResult(array $result): void
    {
        $this->line("  Receiver users: {$result['total']}");
        $this->line("  Unaffected: {$result['unaffected']}");

        if ($result['no_uuid'] > 0) {
            $this->line("  No uuid — cannot sign in via SSO: {$result['no_uuid']}");
        }

        if ($result['no_local_counterpart'] > 0) {
            $this->warn("  No counterpart on this app: {$result['no_local_counterpart']}");
        }

        if ($result['at_risk'] > 0) {
            $this->warn("  Would lose at least one membership: {$result['at_risk']}");
        }

        if ($result['zero_teams'] > 0) {
            $this->error("  Would be left with ZERO teams — cannot use a Filament panel: {$result['zero_teams']}");
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
