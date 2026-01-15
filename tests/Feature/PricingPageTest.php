<?php

declare(strict_types=1);

use App\Enums\BillingPeriod;
use App\Livewire\PricingPage;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Services\CurrencyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $category = PlanCategory::factory()->create([
        'name' => 'Test Module',
        'slug' => 'test-module',
        'description' => 'Test description',
    ]);

    Plan::factory()->create([
        'plan_category_id' => $category->id,
        'billing_period' => BillingPeriod::Yearly,
        'price' => 360000,
        'price_eur' => 900,
        'is_active' => true,
        'features' => ['Feature 1', 'Feature 2'],
    ]);

    Plan::factory()->create([
        'plan_category_id' => $category->id,
        'billing_period' => BillingPeriod::Monthly,
        'price' => 36000,
        'price_eur' => 90,
        'is_active' => true,
        'features' => ['Feature 1', 'Feature 2'],
    ]);
});

describe('PricingPage', function (): void {
    it('renders the pricing page', function (): void {
        $response = $this->get('/arak');

        $response->assertOk();
        $response->assertSeeLivewire(PricingPage::class);
    });

    it('displays modules from database', function (): void {
        Livewire::test(PricingPage::class)
            ->assertSee('Test Module')
            ->assertSee('Ft');
    });

    it('toggles currency from HUF to EUR', function (): void {
        Livewire::test(PricingPage::class)
            ->assertSet('currency', CurrencyService::CURRENCY_HUF)
            ->call('toggleCurrency')
            ->assertSet('currency', CurrencyService::CURRENCY_EUR);
    });

    it('toggles currency from EUR back to HUF', function (): void {
        Livewire::test(PricingPage::class)
            ->call('toggleCurrency')
            ->assertSet('currency', CurrencyService::CURRENCY_EUR)
            ->call('toggleCurrency')
            ->assertSet('currency', CurrencyService::CURRENCY_HUF);
    });

    it('toggles billing cycle', function (): void {
        Livewire::test(PricingPage::class)
            ->assertSet('isYearly', true)
            ->call('toggleBillingCycle')
            ->assertSet('isYearly', false)
            ->call('toggleBillingCycle')
            ->assertSet('isYearly', true);
    });

    it('persists currency preference in session', function (): void {
        Livewire::test(PricingPage::class)
            ->call('toggleCurrency');

        expect(session('currency'))->toBe(CurrencyService::CURRENCY_EUR);
    });

    it('loads currency preference from session on mount', function (): void {
        session(['currency' => CurrencyService::CURRENCY_EUR]);

        Livewire::test(PricingPage::class)
            ->assertSet('currency', CurrencyService::CURRENCY_EUR);
    });
});
