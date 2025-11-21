<?php

declare(strict_types=1);

use App\Jobs\SyncUserToSecondaryApp;
use App\Services\SecondaryAppService;
use Illuminate\Contracts\Queue\ShouldQueue;
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
        'https://primary.test/api/sync-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/sync-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/sync-user' => Http::response(['success' => true], 200),
    ]);

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['password_hash' => 'hashed_password'],
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSent(function ($request) {
        return $request->url() === 'https://primary.test/api/sync-user'
            && $request['email'] === 'test@example.com'
            && $request['password_hash'] === 'hashed_password'
            && $request->hasHeader('Authorization', 'Bearer test-api-key');
    });

    Http::assertSentCount(3);
});

it('sends to all active apps', function () {
    Http::fake();

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'admin'],
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSentCount(3);
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

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['new_email' => 'new@example.com'],
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertNotSent(function ($request) {
        return str_contains($request->url(), 'secondary.test');
    });

    Http::assertSentCount(2);
});

it('sends multiple changed fields', function () {
    Http::fake([
        '*' => Http::response(['success' => true], 200),
    ]);

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: [
            'new_email' => 'new@example.com',
            'password_hash' => 'new_hash',
            'role' => 'manager',
        ],
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSent(function ($request) {
        return $request['email'] === 'test@example.com'
            && $request['new_email'] === 'new@example.com'
            && $request['password_hash'] === 'new_hash'
            && $request['role'] === 'manager';
    });
});

it('logs success when user sync succeeds', function () {
    Http::fake([
        'https://primary.test/api/sync-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/sync-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/sync-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'user'],
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('info')
        ->times(3)
        ->withArgs(fn ($message) => str_contains($message, 'User sync successful'));
});

it('logs warning when user sync fails', function () {
    Http::fake([
        'https://primary.test/api/sync-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/sync-user' => Http::response(['error' => 'Failed'], 422),
        'https://tertiary.test/api/sync-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'user'],
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('warning')
        ->once()
        ->withArgs(fn ($message) => str_contains($message, 'User sync failed'));
});

it('logs error when exception occurs', function () {
    Http::fake(fn () => throw new Exception('Connection failed'));

    Log::spy();

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'user'],
    );

    $job->handle(app(SecondaryAppService::class));

    Log::shouldHaveReceived('error')
        ->withArgs(fn ($message) => str_contains($message, 'Exception during user sync'));
});

it('has correct retry configuration', function () {
    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'user'],
    );

    expect($job->tries)->toBe(3)
        ->and($job->backoff)->toBe(60);
});

it('implements ShouldQueue interface', function () {
    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'user'],
    );

    expect($job)->toBeInstanceOf(ShouldQueue::class);
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

    $job = new SyncUserToSecondaryApp(
        email: 'test@example.com',
        changedData: ['role' => 'admin'],
    );

    $job->handle(app(SecondaryAppService::class));

    Http::assertSent(function ($request) {
        return $request->hasHeader('Authorization', 'Bearer custom-app-key');
    });
});
