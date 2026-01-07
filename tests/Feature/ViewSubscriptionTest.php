<?php

declare(strict_types=1);

use App\Livewire\ViewSubscriptionPage;
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

    $this->plan = Plan::factory()->create([
        'name' => 'Basic',
        'plan_category_id' => $this->planCategory->id,
        'price' => 5000,
        'stripe_price_id' => 'price_basic_test',
    ]);

    $this->subscription = Subscription::factory()->create([
        'user_id' => $this->user->id,
        'plan_id' => $this->plan->id,
        'quantity' => 3,
        'stripe_status' => 'active',
        'stripe_id' => 'sub_test_123',
    ]);
});

it('can access view page for own subscription', function (): void {
    $this->actingAs($this->user)
        ->get(route('subscription.view', $this->subscription))
        ->assertOk()
        ->assertSee(__('Subscription Details'));
});

it('displays subscription details', function (): void {
    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee($this->plan->name)
        ->assertSee($this->planCategory->name)
        ->assertSee('3'); // quantity
});

it('shows plan and billing information', function (): void {
    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Plan Details'))
        ->assertSee(__('Billing Details'))
        ->assertSee(__('Seats & Usage'));
});

it('shows active status for active subscription', function (): void {
    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Active'));
});

it('shows update button for active subscription', function (): void {
    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Update'));
});

it('shows stripe details when subscription is linked', function (): void {
    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee('sub_test_123')
        ->assertSee(__('Technical Details'));
});

it('shows team members when present', function (): void {
    $member = User::factory()->create([
        'subscription_id' => $this->subscription->id,
    ]);

    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee($member->name)
        ->assertSee($member->email);
});
