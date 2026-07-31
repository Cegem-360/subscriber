<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Madbox99\UserTeamSync\Publisher\PublisherService;
use Throwable;

/**
 * Pushes this app's UUID mapping to every active module app, so pre-existing
 * rows there gain the same global identifier.
 *
 * Records the receiver could not match (missing) are informational — they were
 * already surfaced by identity:audit. Records where the receiver holds a
 * DIFFERENT uuid (conflicting) are a hard error: the two sides disagree about
 * identity and a human must resolve it before the SSO rollout.
 */
#[Signature('identity:push-uuids {--app= : Limit the push to a single app key}')]
#[Description('Send the user and team UUID mapping to every module app.')]
final class PushIdentityUuidsCommand extends Command
{
    public function handle(PublisherService $publisher): int
    {
        $apps = $publisher->getActiveApps();

        if ($only = $this->option('app')) {
            $apps = array_intersect_key($apps, [$only => true]);
        }

        if ($apps === []) {
            $this->warn('No active apps configured. Nothing to push.');

            return self::SUCCESS;
        }

        $users = User::query()
            ->whereNotNull('uuid')
            ->orderBy('id')
            ->get(['email', 'uuid'])
            ->map(fn (User $user): array => ['email' => $user->email, 'uuid' => $user->uuid])
            ->values()
            ->all();

        $teams = Team::query()
            ->whereNotNull('uuid')
            ->orderBy('id')
            ->get(['slug', 'uuid'])
            ->map(fn (Team $team): array => ['slug' => $team->slug, 'uuid' => $team->uuid])
            ->values()
            ->all();

        $this->info(sprintf('Pushing %d user(s) and %d team(s) to %d app(s).', count($users), count($teams), count($apps)));

        $hasConflict = false;

        foreach ($apps as $appName => $app) {
            $this->newLine();
            $this->info("=== {$appName} ===");

            try {
                $response = $publisher->makeHttpClient($app)
                    ->post("{$app['url']}/api/identity-uuids", ['users' => $users, 'teams' => $teams]);
            } catch (Throwable $throwable) {
                $this->error("  Unreachable: {$throwable->getMessage()}");
                $hasConflict = true;

                continue;
            }

            if (! $response->successful()) {
                $this->error("  HTTP {$response->status()}: {$response->body()}");
                $hasConflict = true;

                continue;
            }

            $body = $response->json();

            $this->line(sprintf('  Updated %d user(s), %d team(s).', $body['users_updated'], $body['teams_updated']));

            foreach (['users' => 'user', 'teams' => 'team'] as $group => $label) {
                $missing = $body["{$group}_missing"];

                if ($missing !== []) {
                    $this->warn(sprintf('  %d %s(s) not found on this app (see identity:audit).', count($missing), $label));
                }

                $conflicting = $body["{$group}_conflicting"];

                if ($conflicting !== []) {
                    $hasConflict = true;
                    $this->error(sprintf('  %d %s uuid conflict(s) — resolve by hand:', count($conflicting), $label));

                    foreach ($conflicting as $value) {
                        $this->line("      - {$value}");
                    }
                }
            }
        }

        $this->newLine();

        if ($hasConflict) {
            $this->error('Finished with conflicts or unreachable apps. Do NOT proceed to phase 2 until these are resolved.');

            return self::FAILURE;
        }

        $this->info('All apps updated cleanly.');

        return self::SUCCESS;
    }
}
