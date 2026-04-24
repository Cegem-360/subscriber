<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('subscriptions:backfill-teams {--dry-run : Preview changes without writing to the database}')]
#[Description('Assign team_id on subscriptions where NULL, using the subscribing user\'s first team.')]
final class BackfillSubscriptionTeamsCommand extends Command
{
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY-RUN mode — no changes will be persisted.');
        }

        $subscriptions = Subscription::query()
            ->withoutGlobalScopes()
            ->whereNull('team_id')
            ->with(['user.teams'])
            ->get();

        if ($subscriptions->isEmpty()) {
            $this->info('No subscriptions with NULL team_id. Nothing to do.');

            return self::SUCCESS;
        }

        $this->info(sprintf('Processing %d subscriptions with NULL team_id.', $subscriptions->count()));

        $updated = 0;
        $skippedNoUser = 0;
        $skippedNoTeam = 0;

        foreach ($subscriptions as $subscription) {
            $user = $subscription->user;

            if ($user === null) {
                $skippedNoUser++;
                $this->line(sprintf('  · Subscription #%d skipped (no user).', $subscription->id));

                continue;
            }

            $team = $user->teams->first();

            if ($team === null) {
                $skippedNoTeam++;
                $this->line(sprintf('  · Subscription #%d skipped (user %s has no team).', $subscription->id, $user->email));

                continue;
            }

            $this->line(sprintf('  + Subscription #%d (%s) → team #%d (%s)', $subscription->id, $user->email, $team->id, $team->name));

            if (! $dryRun) {
                $subscription->team_id = $team->id;
                $subscription->saveQuietly();
                $updated++;
            }
        }

        $this->newLine();
        $this->info(sprintf(
            'Done. Updated %d subscription(s). Skipped %d (no user) + %d (no team).',
            $updated,
            $skippedNoUser,
            $skippedNoTeam,
        ));

        return self::SUCCESS;
    }
}
