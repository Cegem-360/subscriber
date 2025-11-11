<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MicroservicePermission>
 */
class MicroservicePermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $microservices = [
            ['name' => 'Service A', 'slug' => 'service-a'],
            ['name' => 'Service B', 'slug' => 'service-b'],
            ['name' => 'Service C', 'slug' => 'service-c'],
        ];

        $service = $this->faker->randomElement($microservices);
        $isActive = $this->faker->boolean(80);

        return [
            'microservice_name' => $service['name'],
            'microservice_slug' => $service['slug'],
            'is_active' => $isActive,
            'activated_at' => $isActive ? $this->faker->dateTimeBetween('-60 days', '-1 day') : null,
            'expires_at' => $this->faker->optional(0.3)->dateTimeBetween('-30 days', '+60 days'),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
            'activated_at' => $this->faker->dateTimeBetween('-60 days', '-1 day'),
            'expires_at' => $this->faker->dateTimeBetween('+1 day', '+60 days'),
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
            'activated_at' => $this->faker->dateTimeBetween('-90 days', '-31 day'),
            'expires_at' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
        ]);
    }
}
