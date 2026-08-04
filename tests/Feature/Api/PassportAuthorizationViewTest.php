<?php

declare(strict_types=1);

use App\Models\OauthClient;
use App\Models\User;
use Laravel\Passport\Client;
use Laravel\Passport\Contracts\AuthorizationViewResponse;
use Laravel\Passport\Passport;
use Madbox99\UserTeamSync\Models\SyncApp;

it('registers OauthClient as the passport client model', function (): void {
    expect(Passport::clientModel())->toBe(OauthClient::class);
});

it('resolves the authorization view response binding without throwing', function (): void {
    // This is the actual production 500: Passport\Http\Controllers\
    // AuthorizationController::authorize() type-hints this contract as a
    // constructor-less method parameter, so the container must be able to
    // resolve it on every hit to oauth/authorize.
    expect(app(AuthorizationViewResponse::class))->toBeInstanceOf(AuthorizationViewResponse::class);
});

it('skips authorization for a client registered against an active sync app', function (): void {
    $syncApp = SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    /** @var OauthClient $client */
    $client = OauthClient::query()->create([
        'name' => 'crm',
        'redirect_uris' => ['https://crm.test/auth/callback'],
        'grant_types' => ['authorization_code', 'refresh_token'],
        'revoked' => false,
    ]);

    $syncApp->forceFill(['oauth_client_id' => $client->getKey()])->save();

    $user = User::factory()->create();

    expect($client->skipsAuthorization($user, []))->toBeTrue();
});

it('does not skip authorization for a client that is not registered in sync_apps, safe by default', function (): void {
    /** @var OauthClient $client */
    $client = OauthClient::query()->create([
        'name' => 'third-party',
        'redirect_uris' => ['https://third-party.test/auth/callback'],
        'grant_types' => ['authorization_code', 'refresh_token'],
        'revoked' => false,
    ]);

    $user = User::factory()->create();

    expect($client->skipsAuthorization($user, []))->toBeFalse();
});

it('uses OauthClient as the underlying model for oauth_clients rows', function (): void {
    $client = OauthClient::query()->create([
        'name' => 'crm',
        'redirect_uris' => ['https://crm.test/auth/callback'],
        'grant_types' => ['authorization_code', 'refresh_token'],
        'revoked' => false,
    ]);

    expect(Client::query()->find($client->getKey()))->not->toBeNull();
});
