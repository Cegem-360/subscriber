<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerUserSeeder extends Seeder
{
    public function run(): void
    {
        // Get a plan for managers
        $plan = Plan::first();

        if (! $plan) {
            $this->command->warn('No plans found. Skipping manager seeding.');

            return;
        }

        // Create manager 1 with subscription
        $manager1 = User::factory()
            ->manager()
            ->create([
                'name' => 'Manager One',
                'email' => 'manager1@manager.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        $subscription1 = Subscription::factory()
            ->active()
            ->for($manager1)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        // Create manager 2 with subscription
        $manager2 = User::factory()
            ->manager()
            ->create([
                'name' => 'Manager Two',
                'email' => 'manager2@manager.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        $subscription2 = Subscription::factory()
            ->active()
            ->for($manager2)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 3,
            ]);

        // Create users for subscription 1
        $usersForSub1 = User::factory()
            ->count(3)
            ->create([
                'role' => UserRole::Subscriber,
                'subscription_id' => $subscription1->id,
            ]);

        // Create users for subscription 2
        $usersForSub2 = User::factory()
            ->count(2)
            ->create([
                'role' => UserRole::Subscriber,
                'subscription_id' => $subscription2->id,
            ]);

        $this->command->info('✅ Manager 1 created: manager1@manager.com / password');
        $this->command->info("   - Subscription: quantity 5 (owner + {$usersForSub1->count()} members, 1 seat available)");
        $this->command->info('✅ Manager 2 created: manager2@manager.com / password');
        $this->command->info("   - Subscription: quantity 3 (owner + {$usersForSub2->count()} members, full)");
    }
}
