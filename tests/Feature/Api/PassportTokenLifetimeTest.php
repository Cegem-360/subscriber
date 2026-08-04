<?php

declare(strict_types=1);

use App\Models\OauthClient;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Madbox99\UserTeamSync\Models\SyncApp;

/**
 * Runs a real authorization_code grant through the HTTP layer — /oauth/authorize
 * then /oauth/token, exactly what a module app does — and returns the freshly
 * persisted DB rows for the access and refresh tokens it minted, bracketed by
 * the wall-clock instants right before and after the round trip.
 *
 * league/oauth2-server computes token expiry with `new DateTimeImmutable()`,
 * not Carbon::now(), so it ignores this suite's frozen test time (see
 * tests/Pest.php) — expires_at has to be checked against real wall-clock
 * bounds instead of a single frozen instant.
 *
 * @return array{access: object, refresh: object, before: DateTimeImmutable, after: DateTimeImmutable}
 */
function issueAuthorizationCodeTokens(): array
{
    $before = new DateTimeImmutable();

    $user = User::factory()->create();

    /** @var OauthClient $client */
    $client = app(ClientRepository::class)->createAuthorizationCodeGrantClient(
        'SSO Test Client',
        ['https://module-app.test/callback'],
    );

    // A first-party client only skips the consent screen once it is
    // registered against an active sync app — see OauthClient::skipsAuthorization().
    SyncApp::create([
        'name' => 'module-app',
        'url' => 'https://module-app.test',
        'api_key' => 'secret',
        'is_active' => true,
        'oauth_client_id' => $client->getKey(),
    ]);

    $authorizeResponse = test()->actingAs($user)->get('/oauth/authorize?' . http_build_query([
        'response_type' => 'code',
        'client_id' => $client->getKey(),
        'redirect_uri' => 'https://module-app.test/callback',
        'scope' => '',
        'state' => 'state-value',
    ]));

    $authorizeResponse->assertRedirect();
    parse_str((string) parse_url((string) $authorizeResponse->headers->get('Location'), PHP_URL_QUERY), $query);
    $code = $query['code'] ?? null;

    expect($code)->not->toBeNull();

    $tokenResponse = test()->postJson('/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => $client->getKey(),
        'client_secret' => $client->plainSecret,
        'redirect_uri' => 'https://module-app.test/callback',
        'code' => $code,
    ])->assertOk();

    expect($tokenResponse->json('access_token'))->not->toBeNull()
        ->and($tokenResponse->json('refresh_token'))->not->toBeNull();

    return [
        'access' => DB::table('oauth_access_tokens')->latest('id')->first(),
        'refresh' => DB::table('oauth_refresh_tokens')->latest('id')->first(),
        'before' => $before,
        'after' => new DateTimeImmutable(),
    ];
}

it('issues an access token that expires 15 days out, not Passport\'s default one year', function (): void {
    $tokens = issueAuthorizationCodeTokens();

    $expiresAt = Carbon::parse($tokens['access']->expires_at);

    // The DB column truncates to whole seconds (floor), so the lower bound
    // has to be floored the same way or a sub-second 'before' can put it
    // a hair above a legitimately in-range, truncated expires_at.
    expect($expiresAt->greaterThanOrEqualTo(Carbon::instance($tokens['before'])->addDays(15)->startOfSecond()))->toBeTrue()
        ->and($expiresAt->lessThanOrEqualTo(Carbon::instance($tokens['after'])->addDays(15)))->toBeTrue();
});

it('issues a refresh token that expires 30 days out, not Passport\'s default one year', function (): void {
    $tokens = issueAuthorizationCodeTokens();

    $expiresAt = Carbon::parse($tokens['refresh']->expires_at);

    expect($expiresAt->greaterThanOrEqualTo(Carbon::instance($tokens['before'])->addDays(30)->startOfSecond()))->toBeTrue()
        ->and($expiresAt->lessThanOrEqualTo(Carbon::instance($tokens['after'])->addDays(30)))->toBeTrue();
});

it('issues a personal access token that expires 6 months out, not Passport\'s default one year', function (): void {
    // Personal access tokens (used e.g. by the regression test in
    // UserInfoControllerTest) go through the personal_access grant, a
    // different code path from the authorization_code grant exercised
    // above, so it gets its own real-issuance assertion.
    $before = new DateTimeImmutable();

    $user = User::factory()->create();

    app(ClientRepository::class)->createPersonalAccessGrantClient('Personal Access Test Client');

    $user->createToken('lifetime-test-token');

    $after = new DateTimeImmutable();

    $accessToken = DB::table('oauth_access_tokens')->latest('id')->first();
    $expiresAt = Carbon::parse($accessToken->expires_at);

    expect($expiresAt->greaterThanOrEqualTo(Carbon::instance($before)->addMonths(6)->startOfSecond()))->toBeTrue()
        ->and($expiresAt->lessThanOrEqualTo(Carbon::instance($after)->addMonths(6)))->toBeTrue();
});
