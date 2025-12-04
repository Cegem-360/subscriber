<?php

declare(strict_types=1);

use App\Jobs\ToggleUserActiveInSecondaryApp;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SecondaryAppService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config(['microservices.apps' => [
        'controling' => [
            'url' => 'https://controling.test',
            'api_key' => 'test-api-key',
            'active' => true,
        ],
    ]]);
    config(['microservices.default_api_key' => 'default-key']);
});

it('sends activate request to specific app', function (): void {
    Http::fake([
        'https://controling.test/api/toggle-user-active' => Http::response([
            'message' => 'User activated successfully',
        ], 200),
    ]);

    $job = new ToggleUserActiveInSecondaryApp(
        userEmail: 'test@example.com',
        isActive: true,
        appKey: 'controling',
    );

    $job->handle(resolve(SecondaryAppService::class));

    Http::assertSent(fn ($request): bool => $request->url() === 'https://controling.test/api/toggle-user-active'
        && $request['email'] === 'test@example.com'
        && $request['is_active'] === true);
});

it('sends deactivate request to specific app', function (): void {
    Http::fake([
        'https://controling.test/api/toggle-user-active' => Http::response([
            'message' => 'User deactivated successfully',
        ], 200),
    ]);

    $job = new ToggleUserActiveInSecondaryApp(
        userEmail: 'test@example.com',
        isActive: false,
        appKey: 'controling',
    );

    $job->handle(resolve(SecondaryAppService::class));

    Http::assertSent(fn ($request): bool => $request->url() === 'https://controling.test/api/toggle-user-active'
        && $request['email'] === 'test@example.com'
        && $request['is_active'] === false);
});

it('logs successful activation', function (): void {
    Http::fake([
        'https://controling.test/api/toggle-user-active' => Http::response([
            'message' => 'User activated successfully',
        ], 200),
    ]);

    Log::shouldReceive('info')
        ->once()
        ->with('ToggleUserActiveInSecondaryApp: Sending activate request', Mockery::type('array'));

    Log::shouldReceive('info')
        ->once()
        ->with('User activate successful for test@example.com to https://controling.test');

    $job = new ToggleUserActiveInSecondaryApp(
        userEmail: 'test@example.com',
        isActive: true,
        appKey: 'controling',
    );

    $job->handle(resolve(SecondaryAppService::class));
});

it('is dispatched when subscription is created with plan category', function (): void {
    Queue::fake();

    $user = User::factory()->create([
        'company_name' => 'Test Company Kft.',
        'email' => 'owner@example.com',
    ]);

    $planCategory = \App\Models\Plan\PlanCategory::factory()->create([
        'slug' => 'controling',
    ]);

    $plan = \App\Models\Plan::factory()->create([
        'plan_category_id' => $planCategory->id,
    ]);

    $this->actingAs($user);

    Subscription::factory()->create([
        'plan_id' => $plan->id,
    ]);

    Queue::assertPushed(ToggleUserActiveInSecondaryApp::class, fn ($job): bool => $job->userEmail === 'owner@example.com'
        && $job->isActive === true
        && $job->appKey === 'controling');
});

it('is not dispatched when subscription has no plan category', function (): void {
    Queue::fake();

    $user = User::factory()->create([
        'company_name' => 'Test Company Kft.',
        'email' => 'owner@example.com',
    ]);

    $this->actingAs($user);

    Subscription::factory()->create();

    Queue::assertNotPushed(ToggleUserActiveInSecondaryApp::class);
});
