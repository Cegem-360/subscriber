<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\BillingPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        $slug = \Illuminate\Support\Str::slug($name) . '-' . $this->faker->unique()->randomNumber(5);

        return [
            'name' => \Illuminate\Support\Str::title($name) . ' Plan',
            'slug' => $slug,
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 9.99, 199.99),
            'billing_period' => $this->faker->randomElement(BillingPeriod::cases()),
            'stripe_price_id' => 'price_' . $this->faker->unique()->regexify('[a-zA-Z0-9]{24}'),
            'stripe_product_id' => 'prod_' . $this->faker->unique()->regexify('[a-zA-Z0-9]{14}'),
            'features' => [
                'API Access',
                'Email Support',
                'Community Support',
            ],
            'microservices' => $this->faker->randomElements(['service-a', 'service-b', 'service-c'], $this->faker->numberBetween(1, 3)),
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Create a Basic plan.
     */
    public function basic(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Basic Plan',
            'slug' => 'basic',
            'price' => 9.99,
            'features' => [
                'API Access',
                'Email Support',
                'Community Support',
            ],
            'microservices' => ['service-a'],
            'sort_order' => 1,
        ]);
    }

    /**
     * Create a Pro plan.
     */
    public function pro(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Pro Plan',
            'slug' => 'pro',
            'price' => 29.99,
            'features' => [
                'API Access',
                'Email Support',
                'Priority Support',
            ],
            'microservices' => ['service-a', 'service-b'],
            'sort_order' => 2,
        ]);
    }

    /**
     * Create an Enterprise plan.
     */
    public function enterprise(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Enterprise Plan',
            'slug' => 'enterprise',
            'price' => 99.99,
            'features' => [
                'API Access',
                'Email Support',
                'Dedicated Account Manager',
                'Custom Integrations',
            ],
            'microservices' => ['service-a', 'service-b', 'service-c'],
            'sort_order' => 3,
        ]);
    }
}
