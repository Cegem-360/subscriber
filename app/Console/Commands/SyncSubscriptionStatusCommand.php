<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\SubscriptionStatus;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Madbox99\UserTeamSync\Publisher\PublisherService;

class SyncSubscriptionStatusCommand extends Command
{
    protected $signature = 'subscriptions:sync-status
                            {--dry-run : Show what would be changed without making changes}';

    protected $description = 'Sync is_active status to all receiver apps based on current subscription state';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->components->warn('DRY RUN - no changes will be made');
        }

        $appKeys = PlanCategory::query()->pluck('slug')->unique()->toArray();
        $apps = app(PublisherService::class)->getActiveApps();

        $this->components->info('Found ' . count($appKeys) . ' module categories, ' . count($apps) . ' active receiver apps');

        $users = User::all();
        $activated = 0;
        $deactivated = 0;

        foreach ($users as $user) {
            $activeSubscriptions = Subscription::query()
                ->withoutGlobalScopes()
                ->where('user_id', $user->id)
                ->where('stripe_status', SubscriptionStatus::Active)
                ->with('plan.planCategory')
                ->get();

            $activeAppKeys = $activeSubscriptions
                ->map(fn (Subscription $sub) => $sub->plan?->planCategory?->slug)
                ->filter()
                ->unique()
                ->toArray();

            foreach ($appKeys as $appKey) {
                $isActive = in_array($appKey, $activeAppKeys, true);
                $action = $isActive ? 'activate' : 'deactivate';

                if ($dryRun) {
                    $this->line("  {$user->email} → {$appKey}: {$action}");
                } else {
                    UserTeamSync::toggleUserActive(
                        userEmail: $user->email,
                        isActive: $isActive,
                        appKey: $appKey,
                    );
                }

                if ($isActive) {
                    $activated++;
                } else {
                    $deactivated++;
                }
            }
        }

        $this->components->info("Activated: {$activated}, Deactivated: {$deactivated}");

        return self::SUCCESS;
    }
}
