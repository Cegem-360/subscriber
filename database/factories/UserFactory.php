<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => self::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => UserRole::Subscriber,
            'company_name' => fake()->company(),
            'tax_number' => fake()->numerify('########-#-##'),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::Admin,
        ]);
    }

    /**
     * Indicate that the user is a manager.
     */
    public function manager(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::Manager,
        ]);
    }

    /**
     * Indicate that the user is a manager.
     */
    public function subscriber(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::Subscriber,
        ]);
    }

    /**
     * Attach the created user as a member of the given subscription.
     */
    public function memberOf(Subscription $subscription): static
    {
        return $this->afterCreating(function (User $user) use ($subscription): void {
            $user->memberSubscriptions()->syncWithoutDetaching([$subscription->id]);
        });
    }
}
