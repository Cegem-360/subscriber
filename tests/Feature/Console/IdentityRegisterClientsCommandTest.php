<?php

declare(strict_types=1);

use Laravel\Passport\Client;
use Madbox99\UserTeamSync\Models\SyncApp;

use function Pest\Laravel\artisan;

beforeEach(function (): void {
    config()->set('user-team-sync.publisher.app_source', 'database');
});

it('creates one authorization code client per active app', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    $app = SyncApp::query()->where('name', 'crm')->first();

    expect($app->oauth_client_id)->not->toBeNull();

    $client = Client::query()->find($app->oauth_client_id);

    expect($client)->not->toBeNull()
        ->and($client->redirect_uris)->toBe(['https://crm.test/auth/callback']);
});

it('skips an app that already has a client', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);
    $first = SyncApp::query()->where('name', 'crm')->value('oauth_client_id');

    artisan('identity:register-clients')->assertExitCode(0);
    $second = SyncApp::query()->where('name', 'crm')->value('oauth_client_id');

    expect($second)->toBe($first)
        ->and(Client::query()->count())->toBe(1);
});

it('ignores inactive apps', function (): void {
    SyncApp::create([
        'name' => 'kikapcsolt',
        'url' => 'https://kikapcsolt.test',
        'api_key' => 'secret',
        'is_active' => false,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    expect(SyncApp::query()->where('name', 'kikapcsolt')->value('oauth_client_id'))->toBeNull()
        ->and(Client::query()->count())->toBe(0);
});

it('prints the client secret exactly once, because it cannot be read back later', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')
        ->expectsOutputToContain('crm')
        ->expectsOutputToContain('IDENTITY_CLIENT_SECRET')
        ->assertExitCode(0);
});

it('creates a confidential client, not a public one', function (): void {
    // Mind a 17 app szerver-oldali és first-party: a secret biztonságosan
    // tárolható, és a confidential kliens erősebb, mint a public.
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    $client = Client::query()->first();

    expect($client->secret)->not->toBeNull();
});
