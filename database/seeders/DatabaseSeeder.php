<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Invoice;
use App\Models\MicroservicePermission;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed plans first
        $this->call([
            PlanSeeder::class,
        ]);

        // Get all plans for later use
        $plans = Plan::all();

        // Create admin user
        $admin = User::factory()
            ->admin()
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        // Create admin's active subscription with microservice permissions
        $adminSubscription = Subscription::factory()
            ->active()
            ->for($admin)
            ->create([
                'plan_id' => $plans->where('slug', 'enterprise')->first()->id,
            ]);

        // Create microservice permissions for admin
        MicroservicePermission::factory()
            ->count(3)
            ->active()
            ->for($adminSubscription)
            ->sequence(
                ['microservice_name' => 'Service A', 'microservice_slug' => 'service-a'],
                ['microservice_name' => 'Service B', 'microservice_slug' => 'service-b'],
                ['microservice_name' => 'Service C', 'microservice_slug' => 'service-c'],
            )
            ->create();

        // Create invoices for admin
        Invoice::factory()
            ->count(5)
            ->paid()
            ->for($admin)
            ->for($adminSubscription)
            ->create();

        // Create 30 regular users with subscriptions, invoices, and permissions
        User::factory()
            ->count(30)
            ->create()
            ->each(function (User $user) use ($plans) {
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
                    $planMicroservices = $randomPlan->microservices ?? [];

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

                    // Create invoices for this subscription
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

                // Some users have API tokens
                if (fake()->boolean(40)) {
                    ApiToken::factory()
                        ->for($user)
                        ->create();
                }
            });

        $this->command->info('Database seeded successfully!');
        $this->command->info('Created:');
        $this->command->info('- 1 Admin user (admin@admin.com / password)');
        $this->command->info('- 30 Regular users');
        $this->command->info('- ' . Subscription::count() . ' Subscriptions');
        $this->command->info('- ' . MicroservicePermission::count() . ' Microservice permissions');
        $this->command->info('- ' . Invoice::count() . ' Invoices');
    }
}
