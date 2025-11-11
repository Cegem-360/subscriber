<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(InvoiceStatus::cases());

        return [
            'stripe_invoice_id' => 'in_' . $this->faker->unique()->regexify('[a-zA-Z0-9]{24}'),
            'stripe_payment_intent_id' => $status === InvoiceStatus::Paid ? 'pi_' . $this->faker->regexify('[a-zA-Z0-9]{24}') : null,
            'billingo_invoice_id' => $status === InvoiceStatus::Paid ? $this->faker->unique()->numerify('########') : null,
            'invoice_number' => $this->faker->unique()->numerify('INV-####-####'),
            'amount' => $this->faker->randomFloat(2, 9.99, 199.99),
            'currency' => 'HUF',
            'status' => $status,
            'billingo_synced_at' => $status === InvoiceStatus::Paid ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
            'pdf_path' => null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Paid,
            'stripe_payment_intent_id' => 'pi_' . $this->faker->regexify('[a-zA-Z0-9]{24}'),
            'billingo_invoice_id' => $this->faker->unique()->numerify('########'),
            'billingo_synced_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Open,
            'stripe_payment_intent_id' => null,
            'billingo_invoice_id' => null,
            'billingo_synced_at' => null,
        ]);
    }
}
