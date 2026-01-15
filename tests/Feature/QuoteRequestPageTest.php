<?php

declare(strict_types=1);

use App\Livewire\QuoteRequestPage;
use Livewire\Livewire;

describe('QuoteRequestPage', function (): void {
    it('renders the quote request page', function (): void {
        $response = $this->get('/ajanlatkeres');

        $response->assertOk();
        $response->assertSeeLivewire(QuoteRequestPage::class);
    });

    it('displays the form fields', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->assertSee('Név')
            ->assertSee('Email')
            ->assertSee('Üzenet')
            ->assertSee('Ajánlatkérés elküldése');
    });

    it('validates required fields', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'message']);
    });

    it('validates email format', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->set('name', 'Test User')
            ->set('email', 'invalid-email')
            ->set('message', 'This is a test message for quote request.')
            ->call('submit')
            ->assertHasErrors(['email']);
    });

    it('validates minimum message length', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('message', 'Short')
            ->call('submit')
            ->assertHasErrors(['message']);
    });

    it('submits form successfully with valid data', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('message', 'This is a test message for quote request.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertSee('Köszönjük megkeresését!');
    });

    it('resets form fields after successful submission', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('message', 'This is a test message for quote request.')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('email', '')
            ->assertSet('message', '');
    });

    it('displays enterprise features', function (): void {
        Livewire::test(QuoteRequestPage::class)
            ->assertSee('Dedikált szerver környezet')
            ->assertSee('SLA garancia')
            ->assertSee('Személyes account manager');
    });
});
