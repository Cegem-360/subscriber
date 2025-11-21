<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');
        $this->command->newLine();

        // Seed plans first (if needed)
        if (app()->environment('local')) {
            $this->call([
                PlanCategorySeeder::class,
                PlanSeeder::class,
            ]);
        }

        // Seed admin user with subscription, permissions, and invoices
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Seed regular users with subscriptions, permissions, invoices, and API tokens
        $this->call([
            RegularUsersSeeder::class,
        ]);

        // Seed manager users and assign subscribers to them
        $this->call([
            ManagerUserSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('🎉 Database seeded successfully!');
    }
}
