<?php

declare(strict_types=1);

use App\Jobs\CreateUserInSecondaryApp;
use App\Services\SecondaryAppService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    config([
        'microservices' => [
            'default_api_key' => 'test-api-key',
            'apps' => [
                'primary' => [
                    'url' => 'https://primary.test',
                    'api_key' => null,
                    'active' => true,
                ],
                'secondary' => [
                    'url' => 'https://secondary.test',
                    'api_key' => null,
                    'active' => true,
                ],
                'tertiary' => [
                    'url' => 'https://tertiary.test',
                    'api_key' => null,
                    'active' => true,
                ],
            ],
        ],
    ]);
});

it('sends user data to all active secondary apps', function () {
    Http::fake([
        '*/api/user-teams*' => Http::response(['teams' => [['id' => 1], ['id' => 2]]], 200),
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSent(function ($request) {
        return $request->url() === 'https://primary.test/api/create-user'
            && $request['email'] === 'test@example.com'
            && $request['name'] === 'Test User'
            && $request['password'] === 'secret123'
            && $request['role'] === 'user'
            && $request['team_ids'] === [1, 2]
            && $request->hasHeader('Authorization', 'Bearer test-api-key');
    });

    // 3 apps × 2 requests each (user-teams + create-user)
    Http::assertSentCount(6);
});

it('sends to all active apps', function () {
    Http::fake();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    // 3 apps × 2 requests each (user-teams + create-user)
    Http::assertSentCount(6);
});

it('skips inactive apps', function () {
    config([
        'microservices' => [
            'default_api_key' => 'test-api-key',
            'apps' => [
                'primary' => [
                    'url' => 'https://primary.test',
                    'api_key' => null,
                    'active' => true,
                ],
                'secondary' => [
                    'url' => 'https://secondary.test',
                    'api_key' => null,
                    'active' => false,
                ],
                'tertiary' => [
                    'url' => 'https://tertiary.test',
                    'api_key' => null,
                    'active' => true,
                ],
            ],
        ],
    ]);

    Http::fake();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertNotSent(function ($request) {
        return str_contains($request->url(), 'secondary.test');
    });

    Http::assertSent(function ($request) {
        return str_contains($request->url(), 'tertiary.test');
    });

    // 2 active apps × 2 requests each (user-teams + create-user)
    Http::assertSentCount(4);
});

it('logs success when user creation succeeds', function () {
    Http::fake([
        '*/api/user-teams*' => Http::response(['teams' => [['id' => 1]]], 200),
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('info')
        ->withArgs(fn ($message) => str_contains($message, 'User creation successful'));
});

it('logs warning when user creation fails', function () {
    Http::fake([
        '*/api/user-teams*' => Http::response(['teams' => [['id' => 1]]], 200),
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['error' => 'Failed'], 422),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('warning')
        ->withArgs(fn ($message) => str_contains($message, 'User creation failed'));
});

it('logs error when exception occurs', function () {
    Http::fake(fn () => throw new Exception('Connection failed'));

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('error')
        ->withArgs(fn ($message) => str_contains($message, 'Exception during user creation'));
});

it('has correct retry configuration', function () {
    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    expect($job->tries)->toBe(3)
        ->and($job->backoff)->toBe(60);
});

it('implements ShouldQueue interface', function () {
    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    expect($job)->toBeInstanceOf(Illuminate\Contracts\Queue\ShouldQueue::class);
});

it('uses app specific api key when set', function () {
    config([
        'microservices' => [
            'default_api_key' => 'default-key',
            'apps' => [
                'custom' => [
                    'url' => 'https://custom.test',
                    'api_key' => 'custom-app-key',
                    'active' => true,
                ],
            ],
        ],
    ]);

    Http::fake();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        password: 'secret123',
        role: 'user',
        ownerEmail: 'owner@example.com',
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSent(function ($request) {
        return $request->hasHeader('Authorization', 'Bearer custom-app-key');
    });
});
