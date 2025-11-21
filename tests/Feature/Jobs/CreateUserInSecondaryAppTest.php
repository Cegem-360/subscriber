<?php

declare(strict_types=1);

use App\Jobs\CreateUserInSecondaryApp;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    config([
        'services-app-urls' => [
            'app_api_key' => 'test-api-key',
            'primary' => [
                'url' => 'https://primary.test',
                'active' => true,
            ],
            'secondary' => [
                'url' => 'https://secondary.test',
                'active' => true,
            ],
            'tertiary' => [
                'url' => 'https://tertiary.test',
                'active' => true,
            ],
        ],
    ]);
});

it('sends user data to all active secondary apps', function () {
    Http::fake([
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://primary.test/api/create-user'
            && $request['email'] === 'test@example.com'
            && $request['name'] === 'Test User'
            && $request['password_hash'] === 'hashed_password'
            && $request['role'] === 'user'
            && $request->hasHeader('Authorization', 'Bearer test-api-key');
    });

    Http::assertSentCount(3);
});

it('skips the first app in the configuration', function () {
    Http::fake();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Http::assertNotSent(function ($request) {
        return str_contains($request->url(), 'primary.test');
    });
});

it('skips inactive apps', function () {
    config([
        'services-app-urls' => [
            'app_api_key' => 'test-api-key',
            'primary' => [
                'url' => 'https://primary.test',
                'active' => true,
            ],
            'secondary' => [
                'url' => 'https://secondary.test',
                'active' => false,
            ],
            'tertiary' => [
                'url' => 'https://tertiary.test',
                'active' => true,
            ],
        ],
    ]);

    Http::fake();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Http::assertNotSent(function ($request) {
        return str_contains($request->url(), 'secondary.test');
    });

    Http::assertSent(function ($request) {
        return str_contains($request->url(), 'tertiary.test');
    });

    Http::assertSentCount(2);
});

it('logs success when user creation succeeds', function () {
    Http::fake([
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Log::shouldHaveReceived('info')
        ->times(3)
        ->withArgs(fn ($message) => str_contains($message, 'User creation successful'));
});

it('logs warning when user creation fails', function () {
    Http::fake([
        'https://primary.test/api/create-user' => Http::response(['success' => true], 200),
        'https://secondary.test/api/create-user' => Http::response(['error' => 'Failed'], 422),
        'https://tertiary.test/api/create-user' => Http::response(['success' => true], 200),
    ]);

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Log::shouldHaveReceived('warning')
        ->once()
        ->withArgs(fn ($message) => str_contains($message, 'User creation failed'));
});

it('logs error when exception occurs', function () {
    Http::fake(fn () => throw new Exception('Connection failed'));

    Log::spy();

    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    $job->handle();

    Log::shouldHaveReceived('error')
        ->withArgs(fn ($message) => str_contains($message, 'Exception during user creation'));
});

it('has correct retry configuration', function () {
    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    expect($job->tries)->toBe(3)
        ->and($job->backoff)->toBe(60);
});

it('implements ShouldQueue interface', function () {
    $job = new CreateUserInSecondaryApp(
        email: 'test@example.com',
        name: 'Test User',
        passwordHash: 'hashed_password',
        role: 'user',
    );

    expect($job)->toBeInstanceOf(Illuminate\Contracts\Queue\ShouldQueue::class);
});
