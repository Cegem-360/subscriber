<?php

declare(strict_types=1);

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a subscription with factory', function () {
    $subscription = Subscription::factory()->create();

    expect($subscription)->toBeInstanceOf(Subscription::class)
        ->and($subscription->id)->not->toBeNull();
});

it('creates an active subscription with factory', function () {
    $subscription = Subscription::factory()->active()->create();

    expect($subscription->stripe_status)->toBe(SubscriptionStatus::Active)
        ->and($subscription->trial_ends_at)->toBeNull()
        ->and($subscription->ends_at)->toBeNull();
});

it('creates a trialing subscription with factory', function () {
    $subscription = Subscription::factory()->trialing()->create();

    expect($subscription->stripe_status)->toBe(SubscriptionStatus::Trialing)
        ->and($subscription->trial_ends_at)->not->toBeNull()
        ->and($subscription->ends_at)->toBeNull();
});

it('creates a canceled subscription with factory', function () {
    $subscription = Subscription::factory()->canceled()->create();

    expect($subscription->stripe_status)->toBe(SubscriptionStatus::Canceled)
        ->and($subscription->ends_at)->not->toBeNull();
});
