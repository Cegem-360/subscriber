<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Subscription>
     */
    protected $model = \App\Models\Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'default',
            'stripe_id' => 'sub_' . $this->faker->unique()->regexify('[a-zA-Z0-9]{24}'),
            'stripe_status' => $this->faker->randomElement(SubscriptionStatus::cases()),
            'stripe_price' => 'price_' . $this->faker->regexify('[a-zA-Z0-9]{24}'),
            'quantity' => 1,
            'trial_ends_at' => null,
            'ends_at' => null,
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'stripe_status' => SubscriptionStatus::Active,
            'trial_ends_at' => null,
            'ends_at' => null,
        ]);
    }

    public function trialing(): static
    {
        return $this->state(fn (array $attributes) => [
            'stripe_status' => SubscriptionStatus::Trialing,
            'trial_ends_at' => $this->faker->dateTimeBetween('+1 day', '+14 days'),
            'ends_at' => null,
        ]);
    }

    public function canceled(): static
    {
        return $this->state(fn (array $attributes) => [
            'stripe_status' => SubscriptionStatus::Canceled,
            'trial_ends_at' => null,
            'ends_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}
