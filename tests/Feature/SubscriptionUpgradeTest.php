<?php

declare(strict_types=1);

use App\Livewire\Page\UpdateModulePage;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->user = User::factory()->create();

    $this->planCategory = PlanCategory::factory()->create([
        'name' => 'Controlling',
        'slug' => 'controlling',
    ]);

    $this->basicPlan = Plan::factory()->create([
        'name' => 'Basic',
        'plan_category_id' => $this->planCategory->id,
        'price' => 1000,
        'stripe_price_id' => 'price_basic_test',
    ]);

    $this->proPlan = Plan::factory()->create([
        'name' => 'Pro',
        'plan_category_id' => $this->planCategory->id,
        'price' => 2000,
        'stripe_price_id' => 'price_pro_test',
    ]);

    $this->subscription = Subscription::factory()->create([
        'user_id' => $this->user->id,
        'plan_id' => $this->basicPlan->id,
        'quantity' => 1,
        'stripe_status' => 'active',
    ]);
});

it('can access update page for own subscription', function (): void {
    $this->actingAs($this->user)
        ->get(route('subscription.update', $this->subscription))
        ->assertOk()
        ->assertSee(__('Update Subscription'));
});

it('displays current subscription data', function (): void {
    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $this->subscription])
        ->assertSet('data.plan_id', $this->basicPlan->id)
        ->assertSet('data.quantity', 1);
});

it('shows current plan badge', function (): void {
    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Current'));
});

it('can change quantity', function (): void {
    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $this->subscription])
        ->set('data.quantity', 5)
        ->assertSet('data.quantity', 5);
});

it('prevents quantity below 1', function (): void {
    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $this->subscription])
        ->set('data.quantity', 0)
        ->assertSet('data.quantity', 1);
});

it('can select different plan', function (): void {
    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $this->subscription])
        ->set('data.plan_id', $this->proPlan->id)
        ->assertSet('data.plan_id', $this->proPlan->id);
});

it('shows error when subscription is not linked to stripe', function (): void {
    // Subscription without stripe_id (local only)
    $localSubscription = Subscription::factory()->create([
        'user_id' => $this->user->id,
        'plan_id' => $this->basicPlan->id,
        'stripe_id' => null,
        'quantity' => 1,
        'stripe_status' => 'active',
    ]);

    Livewire::actingAs($this->user)
        ->test(UpdateModulePage::class, ['subscription' => $localSubscription])
        ->set('data.quantity', 3)
        ->call('update')
        ->assertNotified(__('This subscription is not linked to Stripe'));
});
