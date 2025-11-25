<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $categories = PlanCategory::all();

        $categories->each(function (PlanCategory $category) {
            Plan::factory()
                ->count(1)
                ->state([
                    'name' => 'Alapcsomag éves',
                    'is_active' => true,
                    'price' => 360000,
                    'stripe_price_id' => 'price_1SXLUJBYPJeO85cYVHKKrGqH',
                    'billing_period' => BillingPeriod::Yearly,
                ])
                ->category($category->id)
                ->create();
            Plan::factory()
                ->count(1)
                ->state([
                    'name' => 'Alapcsomag havi',
                    'is_active' => true,
                    'price' => 30000,
                    'stripe_price_id' => 'price_1SXLUJBYPJeO85cYjyFiEMS9',
                    'billing_period' => BillingPeriod::Monthly,
                ])
                ->category($category->id)
                ->create();
        });
    }
}
