<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Madbox99\UserTeamSync\Publisher\PublisherService;
use Throwable;

/**
 * Diffs this app's users/teams/memberships against every active module app.
 *
 * Run before the UUID backfill: the backfill pairs records by email and slug,
 * and that pairing is only correct once the divergences this command surfaces
 * have been resolved by hand.
 */
#[Signature('identity:audit {--app= : Limit the audit to a single app key}')]
#[Description('Compare users, teams and memberships against every module app and report divergences.')]
final class IdentityAuditCommand extends Command
{
    public function handle(PublisherService $publisher): int
    {
        $apps = $publisher->getActiveApps();

        if ($only = $this->option('app')) {
            $apps = array_intersect_key($apps, [$only => true]);
        }

        if ($apps === []) {
            $this->warn('No active apps configured. Nothing to audit.');

            return self::SUCCESS;
        }

        $localTeams = Team::query()->pluck('name', 'slug');
        $localUsers = User::query()->pluck('email')->all();
        $localMemberships = $this->localMemberships();

        $report = [];

        foreach ($apps as $appName => $app) {
            $this->newLine();
            $this->info("=== {$appName} ===");

            $remote = $this->fetch($publisher, $appName, $app);

            if ($remote === null) {
                $report[$appName] = ['error' => 'unreachable or /api/identity-audit not deployed'];

                continue;
            }

            $remoteTeamSlugs = collect($remote['teams'] ?? [])->pluck('slug')->all();
            $remoteUserEmails = collect($remote['users'] ?? [])->pluck('email')->all();
            $remoteMemberships = collect($remote['memberships'] ?? [])
                ->map(fn (array $row): string => $row['user_email'] . '|' . $row['team_slug'])
                ->all();

            $entry = [
                'missing_teams' => array_values(array_diff($localTeams->keys()->all(), $remoteTeamSlugs)),
                'orphan_teams' => array_values(array_diff($remoteTeamSlugs, $localTeams->keys()->all())),
                'missing_users' => array_values(array_diff($localUsers, $remoteUserEmails)),
                // Users that exist only on the receiver are the SSO-blocking case:
                // the identity provider does not know them, so after the cutover
                // they could not log in anywhere. They need a decision (migrate or
                // retire) before the UUID backfill pairs records by email.
                'orphan_users' => array_values(array_diff($remoteUserEmails, $localUsers)),
                'missing_memberships' => array_values(array_diff($localMemberships, $remoteMemberships)),
                'pending_attachments' => $remote['pending_team_attachments'] ?? [],
            ];

            $report[$appName] = $entry;

            $this->renderEntry($entry);
        }

        $path = storage_path('app/identity-audit-' . now()->format('Ymd-His') . '.json');
        $written = File::put($path, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->newLine();

        if ($written === false) {
            $this->error("Failed to write the full report to: {$path}");

            return self::FAILURE;
        }

        $this->info("Full report written to: {$path}");
        $this->warn('Resolve every divergence by hand BEFORE running identity:backfill-uuids.');

        return self::SUCCESS;
    }

    /**
     * @return array<int, string> "email|slug" pairs
     */
    private function localMemberships(): array
    {
        return User::query()
            ->with('teams:id,slug')
            ->get(['id', 'email'])
            ->flatMap(fn (User $user): array => $user->teams
                ->map(fn (Team $team): string => $user->email . '|' . $team->slug)
                ->all())
            ->sort()
            ->values()
            ->all();
    }

    /**
     * @param  array{url: string, api_key: ?string, active: bool}  $app
     * @return array<string, mixed>|null
     */
    private function fetch(PublisherService $publisher, string $appName, array $app): ?array
    {
        try {
            $response = $publisher->makeHttpClient($app)->get("{$app['url']}/api/identity-audit");
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
     * @param  array<string, mixed>  $entry
     */
    private function renderEntry(array $entry): void
    {
        $labels = [
            'missing_teams' => 'Teams missing on the receiver',
            'orphan_teams' => 'Teams that exist ONLY on the receiver',
            'missing_users' => 'Users missing on the receiver',
            'orphan_users' => 'Users that exist ONLY on the receiver',
            'missing_memberships' => 'Memberships missing on the receiver',
        ];

        foreach ($labels as $key => $label) {
            $values = $entry[$key];

            if ($values === []) {
                $this->line("  ✓ {$label}: none");

                continue;
            }

            $this->warn(sprintf('  ! %s: %d', $label, count($values)));

            foreach (array_slice($values, 0, 20) as $value) {
                $this->line("      - {$value}");
            }

            if (count($values) > 20) {
                $this->line(sprintf('      … and %d more (see the JSON report)', count($values) - 20));
            }
        }

        $pending = $entry['pending_attachments'];

        if ($pending !== []) {
            $this->warn(sprintf('  ! Stuck pending attachments: %d', count($pending)));

            foreach (array_slice($pending, 0, 20) as $row) {
                $this->line("      - {$row['user_email']} → {$row['team_slug']}");
            }
        }
    }
}
