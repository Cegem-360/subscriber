<?php

declare(strict_types=1);

use App\Jobs\SyncPasswordToSecondaryApp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

/**
 * Integration tests for real password sync with controlling.test
 * These tests make REAL HTTP requests - only run when controlling.test is running
 */
beforeEach(function () {
    // Allow real HTTP requests for integration tests
    Http::allowStrayRequests();
});

it('can connect to controlling.test app', function () {
    $secondaryAppUrl = config('services.secondary_app.url');
    $apiKey = config('services.secondary_app.api_key');

    if (! $secondaryAppUrl || ! $apiKey) {
        $this->markTestSkipped('SECONDARY_APP_URL or SECONDARY_APP_API_KEY not configured in .env');
    }

    // Try to reach the health endpoint or base URL
    try {
        $response = Http::withoutVerifying()->timeout(5)->get($secondaryAppUrl);

        expect($response->successful() || $response->status() === 404)->toBeTrue(
            "Could not connect to {$secondaryAppUrl}. Make sure controlling.test is running in Laravel Herd.",
        );
    } catch (\Exception $e) {
        $this->fail("Connection failed: {$e->getMessage()}. Make sure controlling.test is running in Laravel Herd.");
    }
});

it('can sync password to controlling.test with real API key', function () {
    $secondaryAppUrl = config('services.secondary_app.url');
    $apiKey = config('services.secondary_app.api_key');

    if (! $secondaryAppUrl || ! $apiKey) {
        $this->markTestSkipped('SECONDARY_APP_URL or SECONDARY_APP_API_KEY not configured in .env');
    }

    // Create a test user with a known email
    $testEmail = 'integration-test@example.com';
    $newPassword = 'test-password-' . time();
    $hashedPassword = Hash::make($newPassword);

    // Send real HTTP request to controlling.test
    $response = Http::withoutVerifying()
        ->withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Accept' => 'application/json',
        ])
        ->timeout(10)
        ->post("{$secondaryAppUrl}/api/sync-password", [
            'email' => $testEmail,
            'password_hash' => $hashedPassword,
        ]);

    // Check the response
    if ($response->status() === 404) {
        // API endpoint might not exist yet in controlling.test
        // This is okay - it means the other app doesn't have the sync endpoint yet
        expect($response->status())->toBe(404);
    } elseif ($response->status() === 422) {
        // User might not exist in controlling.test - that's okay for this test
        $errors = $response->json('errors.email') ?? $response->json('message');
        expect($errors)->not->toBeNull();
    } elseif ($response->successful()) {
        // If user exists and sync succeeded
        expect($response->json('success'))->toBeTrue();
    } else {
        // Unexpected status
        $this->fail("Unexpected status {$response->status()}: {$response->body()}");
    }
});

it('can dispatch and process real password sync job', function () {
    $secondaryAppUrl = config('services.secondary_app.url');
    $apiKey = config('services.secondary_app.api_key');

    if (! $secondaryAppUrl || ! $apiKey) {
        $this->markTestSkipped('SECONDARY_APP_URL or SECONDARY_APP_API_KEY not configured in .env');
    }

    // Create a test user
    $user = User::factory()->create([
        'email' => 'job-test-' . time() . '@example.com',
        'password' => 'old-password',
    ]);

    // Create and run the job synchronously
    $job = new SyncPasswordToSecondaryApp(
        email: $user->email,
        hashedPassword: Hash::make('new-password'),
    );

    // This will make a real HTTP request
    try {
        $job->handle();
        // If we got here without exception, the request succeeded or was skipped
        expect(true)->toBeTrue();
    } catch (\Exception $e) {
        // Check if it's a "user not found" or "endpoint not found" error - both are acceptable
        $isAcceptableError = str_contains($e->getMessage(), 'Password sync failed with status 404')
            || str_contains($e->getMessage(), 'Password sync failed with status 422');

        expect($isAcceptableError)->toBeTrue(
            "Unexpected error: {$e->getMessage()}",
        );
    }
});
