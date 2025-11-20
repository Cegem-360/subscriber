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
                'url' => 'https://controlling.cegem360.eu',
                'description' => 'Controlling plan category',
            ],
            [
                'name' => 'CRM',
                'slug' => 'crm',
                'url' => 'https://crm.cegem360.eu',
                'description' => 'CRM plan category',
            ],
            [
                'name' => 'CRM and Contacts',
                'slug' => 'crm-and-contacts',
                'url' => 'https://crm-contacts.cegem360.eu',
                'description' => 'CRM and Contacts plan category',
            ],
        ]);
    }
}
