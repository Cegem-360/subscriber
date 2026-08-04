<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\LegalDocument;
use App\Models\LegalAcceptance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LegalAcceptance>
 */
class LegalAcceptanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $document = $this->faker->randomElement(LegalDocument::cases());

        return [
            'user_id' => User::factory(),
            'document' => $document,
            'document_effective_at' => $document->effectiveAt(),
            'context' => 'module_order',
            'accepted_at' => now(),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }

    public function termsOfService(): self
    {
        return $this->state(fn (): array => [
            'document' => LegalDocument::TermsOfService,
            'document_effective_at' => LegalDocument::TermsOfService->effectiveAt(),
        ]);
    }

    public function privacyPolicy(): self
    {
        return $this->state(fn (): array => [
            'document' => LegalDocument::PrivacyPolicy,
            'document_effective_at' => LegalDocument::PrivacyPolicy->effectiveAt(),
        ]);
    }
}
