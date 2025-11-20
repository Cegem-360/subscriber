<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $categories = PlanCategory::all();

        $categories->each(function (PlanCategory $category) {
            $category->plans()->saveMany(
                Plan::factory()
                    ->count(3)
                    ->category($category->id)
                    ->create(),
            );
        });
    }
}
