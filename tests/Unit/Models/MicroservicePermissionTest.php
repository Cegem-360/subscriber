<?php

declare(strict_types=1);

use App\Models\MicroservicePermission;
use App\Models\Subscription;
use App\Models\User;

test('admin can see all microservice permissions', function (): void {
    $admin = User::factory()->admin()->create();
    $subscriber = User::factory()->create();

    $adminSubscription = Subscription::factory()->create(['user_id' => $admin->id]);
    $subscriberSubscription = Subscription::factory()->create(['user_id' => $subscriber->id]);

    $adminPermission = MicroservicePermission::factory()->create(['subscription_id' => $adminSubscription->id]);
    $subscriberPermission = MicroservicePermission::factory()->create(['subscription_id' => $subscriberSubscription->id]);

    $this->actingAs($admin);

    $permissions = MicroservicePermission::all();

    expect($permissions)->toHaveCount(2)
        ->and($permissions->pluck('id'))->toContain($adminPermission->id, $subscriberPermission->id);
});

test('subscriber can only see their own microservice permissions', function (): void {
    $subscriber = User::factory()->create();
    $otherSubscriber = User::factory()->create();

    $subscriberSubscription = Subscription::factory()->create(['user_id' => $subscriber->id]);
    $otherSubscription = Subscription::factory()->create(['user_id' => $otherSubscriber->id]);

    $subscriberPermission = MicroservicePermission::factory()->create(['subscription_id' => $subscriberSubscription->id]);
    $otherPermission = MicroservicePermission::factory()->create(['subscription_id' => $otherSubscription->id]);

    $this->actingAs($subscriber);

    $permissions = MicroservicePermission::all();

    expect($permissions)->toHaveCount(1)
        ->and($permissions->first()->id)->toBe($subscriberPermission->id);
});

test('guest cannot see any microservice permissions', function (): void {
    $subscriber = User::factory()->create();
    $subscription = Subscription::factory()->create(['user_id' => $subscriber->id]);

    MicroservicePermission::factory()->count(3)->create(['subscription_id' => $subscription->id]);

    $permissions = MicroservicePermission::all();

    expect($permissions)->toHaveCount(3);
});
