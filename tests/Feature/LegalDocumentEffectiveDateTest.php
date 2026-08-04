<?php

declare(strict_types=1);

use App\Enums\LegalDocument;

test('the terms of service page shows the configured effective date', function (): void {
    $response = $this->get(route('legal.szolgaltatasi-feltetelek'));

    $response->assertSuccessful();
    $response->assertSee('Hatályos: 2026. 05. 27.');
    $response->assertSee('Budapest, 2026. 05. 27.');
    $response->assertSee('2026. május 27. napján hatályos');
    $response->assertDontSee('2025. 05. 27.');
    $response->assertDontSee('2025. május 27.');
});

test('the privacy notice page shows the configured effective date', function (): void {
    $response = $this->get(route('legal.adatvedelmi-tajekoztato'));

    $response->assertSuccessful();
    $response->assertSee('Hatályos: 2026. május 27-től');
    $response->assertSee('Hatályos: 2026. május 27.');
    $response->assertDontSee('2016. június 1');
});

test('the enum reads both effective dates from config', function (): void {
    expect(LegalDocument::TermsOfService->effectiveAt()->toDateString())->toBe('2026-05-27')
        ->and(LegalDocument::PrivacyPolicy->effectiveAt()->toDateString())->toBe('2026-05-27');
});
