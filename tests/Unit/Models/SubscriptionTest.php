<?php

declare(strict_types=1);

use App\Models\Subscription;
use App\Models\User;

test('admin can see all subscriptions', function () {
    $admin = User::factory()->admin()->create();
    $subscriber = User::factory()->create();

    $adminSubscription = Subscription::factory()->create(['user_id' => $admin->id]);
    $subscriberSubscription = Subscription::factory()->create(['user_id' => $subscriber->id]);

    $this->actingAs($admin);

    $subscriptions = Subscription::all();

    expect($subscriptions)->toHaveCount(2)
        ->and($subscriptions->pluck('id'))->toContain($adminSubscription->id, $subscriberSubscription->id);
});

test('subscriber can only see their own subscriptions', function () {
    $subscriber = User::factory()->create();
    $otherSubscriber = User::factory()->create();

    $subscriberSubscription = Subscription::factory()->create(['user_id' => $subscriber->id]);
    $otherSubscription = Subscription::factory()->create(['user_id' => $otherSubscriber->id]);

    $this->actingAs($subscriber);

    $subscriptions = Subscription::all();

    expect($subscriptions)->toHaveCount(1)
        ->and($subscriptions->first()->id)->toBe($subscriberSubscription->id);
});

test('guest can see all subscriptions', function () {
    $subscriber = User::factory()->create();

    Subscription::factory()->count(3)->create(['user_id' => $subscriber->id]);

    $subscriptions = Subscription::all();

    expect($subscriptions)->toHaveCount(3);
});
