<?php

declare(strict_types=1);

namespace Database\Factories\Plan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan\PlanCategory>
 */
class PlanCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(),
        ];
    }
}
