<?php

declare(strict_types=1);

use App\Enums\BillingPeriod;
use App\Livewire\Page\CreateModulePage;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->user = User::factory()->create(['email_verified_at' => now()]);

    $this->category = PlanCategory::factory()->create();

    $this->monthlyPlan = Plan::factory()->create([
        'plan_category_id' => $this->category->id,
        'billing_period' => BillingPeriod::Monthly,
        'stripe_price_id' => 'price_monthly_test',
    ]);

    $this->yearlyPlan = Plan::factory()->create([
        'plan_category_id' => $this->category->id,
        'billing_period' => BillingPeriod::Yearly,
        'stripe_price_id' => 'price_yearly_test',
    ]);
});

it('does not default the billing period', function (): void {
    actingAs($this->user);

    Livewire::test(CreateModulePage::class)
        ->assertSet('data.billing_period', null);
});

it('resets the selected plan when the billing period changes', function (): void {
    actingAs($this->user);

    Livewire::test(CreateModulePage::class)
        ->set('data.module', $this->category->id)
        ->set('data.billing_period', BillingPeriod::Monthly->value)
        ->set('data.plan_id', $this->monthlyPlan->id)
        ->call('selectBillingPeriod', BillingPeriod::Yearly->value)
        ->assertSet('data.billing_period', BillingPeriod::Yearly->value)
        ->assertSet('data.plan_id', null);
});

it('refuses to order a plan whose billing period does not match the chosen one', function (): void {
    actingAs($this->user);

    Livewire::test(CreateModulePage::class)
        ->set('data.module', $this->category->id)
        ->set('data.billing_period', BillingPeriod::Yearly->value)
        ->set('data.plan_id', $this->monthlyPlan->id)
        ->set('data.quantity', 1)
        ->call('create')
        ->assertNotified()
        ->assertNoRedirect();
});
