<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\MicroservicePermission;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()
            ->admin()
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        // Create test user
        User::factory()
            ->create([
                'name' => 'User User',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        // Get enterprise plan for admin
        $enterprisePlan = Plan::where('slug', 'enterprise')->first();

        if (! $enterprisePlan) {
            $this->command->warn('Enterprise plan not found. Skipping admin subscription.');

            return;
        }

        // Create admin's active subscription
        $adminSubscription = Subscription::factory()
            ->active()
            ->for($admin)
            ->create([
                'plan_id' => $enterprisePlan->id,
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

        $this->command->info('✅ Admin user created: admin@admin.com / password');
        $this->command->info('✅ Test user created: user@user.com / password');
    }
}
