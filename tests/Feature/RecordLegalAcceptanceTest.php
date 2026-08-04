<?php

declare(strict_types=1);

use App\Actions\RecordLegalAcceptance;
use App\Enums\LegalDocument;
use App\Models\LegalAcceptance;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('records one auditable row per accepted document', function (): void {
    $user = User::factory()->create();

    app(RecordLegalAcceptance::class)->handle(
        user: $user,
        documents: [LegalDocument::TermsOfService, LegalDocument::PrivacyPolicy],
        context: 'module_order',
        ipAddress: '203.0.113.7',
        userAgent: 'PestBrowser/1.0',
    );

    expect($user->legalAcceptances()->count())->toBe(2);

    $terms = LegalAcceptance::whereDocument(LegalDocument::TermsOfService)->sole();

    expect($terms->user_id)->toBe($user->id)
        ->and($terms->context)->toBe('module_order')
        ->and($terms->ip_address)->toBe('203.0.113.7')
        ->and($terms->user_agent)->toBe('PestBrowser/1.0')
        ->and($terms->accepted_at)->not->toBeNull()
        ->and($terms->document_effective_at->toDateString())
        ->toBe(config('legal.terms.effective_at'));

    $privacy = LegalAcceptance::whereDocument(LegalDocument::PrivacyPolicy)->sole();

    expect($privacy->document_effective_at->toDateString())
        ->toBe(config('legal.privacy.effective_at'));
});

it('keeps every acceptance so a later document revision cannot overwrite the evidence', function (): void {
    $user = User::factory()->create();
    $action = app(RecordLegalAcceptance::class);

    $action->handle($user, [LegalDocument::TermsOfService], 'module_order');

    config()->set('legal.terms.effective_at', '2027-01-01');

    $action->handle($user, [LegalDocument::TermsOfService], 'module_order');

    expect($user->legalAcceptances()->count())->toBe(2)
        ->and($user->legalAcceptances()->get()->map(
            fn (LegalAcceptance $acceptance): string => $acceptance->document_effective_at->toDateString(),
        )->all())
        ->toBe(['2026-05-27', '2027-01-01']);
});

it('stores a null ip and user agent when they are unavailable', function (): void {
    $user = User::factory()->create();

    app(RecordLegalAcceptance::class)->handle($user, [LegalDocument::PrivacyPolicy], 'module_order');

    $acceptance = $user->legalAcceptances()->sole();

    expect($acceptance->ip_address)->toBeNull()
        ->and($acceptance->user_agent)->toBeNull();
});
