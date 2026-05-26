<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApiToken;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApiToken>
 */
class ApiTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plainTextToken = ApiToken::generateToken();

        return [
            'name' => $this->faker->words(2, true) . ' Token',
            'token' => ApiToken::hashToken($plainTextToken),
            'abilities' => ['*'],
            'last_used_at' => $this->faker->optional(0.7)->dateTimeBetween('-30 days', 'now'),
            'expires_at' => $this->faker->optional(0.3)->dateTimeBetween('+30 days', '+365 days'),
        ];
    }
}
