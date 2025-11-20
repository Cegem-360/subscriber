<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Plan\PlanCategory;
use Illuminate\Database\Seeder;

class PlanCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanCategory::factory()->createMany([
            [
                'name' => 'Controlling',
                'slug' => 'controlling',
                'description' => 'Controlling plan category',
            ],
            [
                'name' => 'CRM',
                'slug' => 'crm',
                'description' => 'CRM plan category',
            ],
            [
                'name' => 'CRM and Contacts',
                'slug' => 'crm-and-contacts',
                'description' => 'CRM and Contacts plan category',
            ],
        ]);
    }
}
