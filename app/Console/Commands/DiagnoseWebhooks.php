<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Listeners\CreateMicroservicePermissions;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use Laravel\Cashier\Events\WebhookReceived;

class DiagnoseWebhooks extends Command
{
    protected $signature = 'webhooks:diagnose';

    protected $description = 'Diagnose Stripe webhook configuration';

    public function handle(): int
    {
        $this->info('🔍 Stripe Webhook Diagnostics');
        $this->newLine();

        // Check webhook secret
        $this->checkWebhookSecret();
        $this->newLine();

        // Check listener registration
        $this->checkListenerRegistration();
        $this->newLine();

        // Check subscriptions
        $this->checkSubscriptions();
        $this->newLine();

        // Check recent logs
        $this->checkRecentLogs();
        $this->newLine();

        // Show webhook URL
        $this->showWebhookInfo();
        $this->newLine();

        $this->info('✅ Diagnosis complete!');
        $this->newLine();

        return self::SUCCESS;
    }

    protected function checkWebhookSecret(): void
    {
        $this->line('📝 Webhook Secret Configuration:');

        $secret = config('cashier.webhook.secret');

        if (empty($secret)) {
            $this->error('  ❌ STRIPE_WEBHOOK_SECRET not configured in .env');
            $this->warn('     Run: ./setup-stripe-webhook.sh');
        } else {
            $this->info('  ✅ Webhook secret configured');
            $this->line('     Secret: ' . substr($secret, 0, 15) . '...');
        }
    }

    protected function checkListenerRegistration(): void
    {
        $this->line('🎯 Event Listener Registration:');

        $listeners = Event::getRawListeners()[WebhookReceived::class] ?? [];

        if (empty($listeners)) {
            $this->error('  ❌ No listeners registered for WebhookReceived');
        } else {
            $this->info('  ✅ Listener registered: ' . CreateMicroservicePermissions::class);
        }
    }

    protected function checkSubscriptions(): void
    {
        $this->line('💳 Subscription Status:');

        $total = Subscription::count();
        $withPlans = Subscription::whereNotNull('plan_id')->count();
        $withoutPlans = Subscription::whereNull('plan_id')->count();
        $withPermissions = Subscription::has('permissions')->count();

        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Subscriptions', $total],
                ['With Plan Linked', $withPlans],
                ['Without Plan', $withoutPlans],
                ['With Permissions', $withPermissions],
            ],
        );

        if ($withoutPlans > 0) {
            $this->warn('  ⚠️  Some subscriptions have no plan_id set');
            $this->line('     This might indicate webhook processing issues');
        }

        if ($total > 0 && $withPermissions === 0) {
            $this->error('  ❌ No subscriptions have permissions');
            $this->line('     Webhooks may not be firing or processing correctly');
        }
    }

    protected function checkRecentLogs(): void
    {
        $this->line('📋 Recent Webhook Logs (last 10):');

        $logFile = storage_path('logs/laravel.log');

        if (! file_exists($logFile)) {
            $this->warn('  ⚠️  Log file not found');

            return;
        }

        $output = shell_exec("tail -100 {$logFile} | grep -E '🔔|webhook|checkout|subscription' | tail -10");

        if (empty($output)) {
            $this->warn('  ⚠️  No recent webhook-related logs found');
            $this->line('     Webhooks may not be reaching your application');
        } else {
            $lines = explode("\n", trim($output));
            foreach ($lines as $line) {
                $this->line('  ' . substr($line, 0, 100));
            }
        }
    }

    protected function showWebhookInfo(): void
    {
        $this->line('🌐 Webhook Information:');

        $webhookUrl = route('cashier.webhook');
        $this->info('  URL: ' . $webhookUrl);
        $this->newLine();

        $this->line('📝 Next Steps:');
        $this->line('  1. Ensure Stripe CLI is running:');
        $this->line('     ./setup-stripe-webhook.sh');
        $this->newLine();
        $this->line('  2. Test webhook manually:');
        $this->line('     stripe trigger customer.subscription.created');
        $this->newLine();
        $this->line('  3. Monitor logs:');
        $this->line('     tail -f storage/logs/laravel.log | grep -E "🔔|webhook"');
    }
}
