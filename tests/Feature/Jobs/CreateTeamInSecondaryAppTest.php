<?php

declare(strict_types=1);

use App\Jobs\CreateTeamInSecondaryApp;
use App\Jobs\CreateUserInSecondaryApp;
use App\Services\SecondaryAppService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

it('generates slug from team name if not provided', function (): void {
    $job = new CreateTeamInSecondaryApp(
        teamName: 'Test Company Kft.',
        userEmail: 'test@example.com',
    );

    expect($job->slug)->toBe('test-company-kft');
});

it('uses provided slug if given', function (): void {
    $job = new CreateTeamInSecondaryApp(
        teamName: 'Test Company Kft.',
        userEmail: 'test@example.com',
        slug: 'custom-slug',
    );

    expect($job->slug)->toBe('custom-slug');
});

it('sends team creation request to secondary apps', function (): void {
    Http::fake([
        'https://controling.test/api/create-team' => Http::response([
            'message' => 'Team created successfully',
            'team_id' => 123,
        ], 201),
    ]);

    $job = new CreateTeamInSecondaryApp(
        teamName: 'Test Company Kft.',
        userEmail: 'test@example.com',
    );

    $job->handle(resolve(SecondaryAppService::class));

    Http::assertSent(fn ($request): bool => $request->url() === 'https://controling.test/api/create-team'
        && $request['name'] === 'Test Company Kft.'
        && $request['slug'] === 'test-company-kft'
        && $request['user_email'] === 'test@example.com');
});

it('logs successful team creation', function (): void {
    Http::fake([
        'https://controling.test/api/create-team' => Http::response([
            'message' => 'Team created successfully',
            'team_id' => 456,
        ], 201),
    ]);

    Log::shouldReceive('info')
        ->once()
        ->with('CreateTeamInSecondaryApp: Sending team creation request', Mockery::type('array'));

    Log::shouldReceive('info')
        ->once()
        ->with('Team creation successful for Test Company Kft. to https://controling.test', Mockery::type('array'));

    $job = new CreateTeamInSecondaryApp(
        teamName: 'Test Company Kft.',
        userEmail: 'test@example.com',
    );

    $job->handle(resolve(SecondaryAppService::class));
});

it('logs warning when team creation fails', function (): void {
    Http::fake([
        'https://controling.test/api/create-team' => Http::response([
            'message' => 'Validation failed',
            'errors' => ['slug' => ['The slug has already been taken.']],
        ], 422),
    ]);

    Log::shouldReceive('info')->once();
    Log::shouldReceive('warning')
        ->once()
        ->with(Mockery::pattern('/Team creation failed/'));

    $job = new CreateTeamInSecondaryApp(
        teamName: 'Test Company Kft.',
        userEmail: 'test@example.com',
    );

    $job->handle(resolve(SecondaryAppService::class));
});

it('is dispatched from Register page handleRegistration', function (): void {
    Bus::fake();

    $register = new \App\Filament\Pages\Auth\Register();

    // Set raw password via reflection (simulates beforeValidate hook)
    $rawPasswordProperty = new ReflectionProperty($register, 'rawPassword');
    $rawPasswordProperty->setValue($register, 'password123');

    // Use reflection to call protected method
    $method = new ReflectionMethod($register, 'handleRegistration');

    $method->invoke($register, [
        'name' => 'Test User',
        'email' => 'test-reg@example.com',
        'password' => 'password123',
        'company_name' => 'Test Company Kft.',
        'tax_number' => '12345678-1-23',
        'address' => 'Test Street 123',
        'city' => 'Budapest',
        'postal_code' => '1234',
        'country' => \App\Enums\Country::Hungary->value,
    ]);

    Bus::assertChained([
        fn (CreateUserInSecondaryApp $job): bool => $job->email === 'test-reg@example.com'
            && $job->name === 'Test User'
            && $job->password === 'password123',
        fn (CreateTeamInSecondaryApp $job): bool => $job->teamName === 'Test Company Kft.'
            && $job->userEmail === 'test-reg@example.com',
    ]);
});
