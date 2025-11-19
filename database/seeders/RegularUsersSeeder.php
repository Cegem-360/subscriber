<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Invoice;
use App\Models\MicroservicePermission;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Cashier\Subscription as CashierSubscription;

class RegularUsersSeeder extends Seeder
{
    public function run(): void
    {
        $plans = Plan::all();

        if ($plans->isEmpty()) {
            $this->command->warn('No plans found. Skipping regular users.');

            return;
        }

        $this->command->info('Creating 30 regular users with subscriptions...');

        User::factory()
            ->count(30)
            ->create()
            ->each(function (User $user) use ($plans): void {
                // Each user has 1-3 subscriptions (current and/or historical)
                $subscriptionCount = fake()->numberBetween(1, 3);

                for ($i = 0; $i < $subscriptionCount; $i++) {
                    // Mix of active, trialing, and canceled subscriptions
                    $subscriptionState = fake()->randomElement(['active', 'trialing', 'canceled', 'active']);

                    $randomPlan = $plans->random();

                    $subscription = Subscription::factory()
                        ->{$subscriptionState}()
                        ->for($user)
                        ->create([
                            'plan_id' => $randomPlan->id,
                        ]);

                    // Create microservice permissions based on plan
                    $this->createMicroservicePermissions($subscription, $randomPlan);

                    // Create invoices for this subscription
                    $this->createInvoices($user, $subscription);
                }

                // Some users have API tokens
                if (fake()->boolean(40)) {
                    ApiToken::factory()
                        ->for($user)
                        ->create();
                }
            });

        $this->command->info('✅ 30 regular users created');
        $this->command->info('   - ' . Subscription::count() . ' subscriptions');
        $this->command->info('   - ' . MicroservicePermission::count() . ' permissions');
        $this->command->info('   - ' . Invoice::count() . ' invoices');
    }

    protected function createMicroservicePermissions(CashierSubscription $subscription, Plan $plan): void
    {
        $planMicroservices = $plan->microservices ?? [];

        foreach ($planMicroservices as $microserviceSlug) {
            $microserviceName = match ($microserviceSlug) {
                'service-a' => 'Service A',
                'service-b' => 'Service B',
                'service-c' => 'Service C',
                default => 'Unknown Service',
            };

            // Mix of active and expired permissions
            $permissionState = fake()->randomElement(['active', 'active', 'active', 'expired']);

            MicroservicePermission::factory()
                ->{$permissionState}()
                ->for($subscription)
                ->create([
                    'microservice_name' => $microserviceName,
                    'microservice_slug' => $microserviceSlug,
                ]);
        }
    }

    protected function createInvoices(User $user, CashierSubscription $subscription): void
    {
        // Active subscriptions have more invoices
        $invoiceCount = $subscription->stripe_status === 'active'
            ? fake()->numberBetween(3, 10)
            : fake()->numberBetween(1, 3);

        Invoice::factory()
            ->count($invoiceCount)
            ->for($user)
            ->for($subscription)
            ->create();
    }
}
