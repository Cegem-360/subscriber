<?php

declare(strict_types=1);

use App\Services\OauthProxy\ProxyState;
use Illuminate\Support\Facades\Crypt;

beforeEach(function (): void {
    config()->set('oauth_proxy.allowed_tenants', [
        'marketinghub.test',
        'marketinghub.cegem360.eu',
    ]);
    config()->set('oauth_proxy.providers.google-ads.client_id', 'test-client-id');
});

describe('start endpoint', function (): void {
    it('redirects to the upstream OAuth provider with a wrapped state', function (): void {
        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
            'tenant' => 'https://marketinghub.test',
            'return_path' => '/google-ads/auth/callback',
            'state' => '42',
        ]));

        $response->assertStatus(302);
        $location = $response->headers->get('Location');

        expect($location)->toStartWith('https://accounts.google.com/o/oauth2/v2/auth?');

        parse_str(parse_url($location, PHP_URL_QUERY) ?: '', $query);

        expect($query)
            ->toHaveKey('client_id', 'test-client-id')
            ->toHaveKey('response_type', 'code')
            ->toHaveKey('scope', 'https://www.googleapis.com/auth/adwords')
            ->toHaveKey('access_type', 'offline')
            ->toHaveKey('prompt', 'consent')
            ->toHaveKey('redirect_uri', route('oauth.proxy.callback', ['provider' => 'google-ads']));

        $state = ProxyState::decrypt($query['state']);

        expect($state->tenant)->toBe('https://marketinghub.test')
            ->and($state->returnPath)->toBe('/google-ads/auth/callback')
            ->and($state->innerState)->toBe('42');
    });

    it('rejects unknown providers with 404', function (): void {
        $response = $this->get('/oauth/unknown-provider/start?tenant=https://marketinghub.test&return_path=/callback&state=1');

        $response->assertStatus(404);
    });

    it('rejects invalid parameters with 400', function (): void {
        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
        ]));

        $response->assertStatus(400);
    });

    it('rejects tenants outside the whitelist with 403', function (): void {
        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
            'tenant' => 'https://evil.example.com',
            'return_path' => '/google-ads/auth/callback',
            'state' => '42',
        ]));

        $response->assertStatus(403);
    });

    it('rejects http tenants that are not .test for local dev', function (): void {
        config()->set('oauth_proxy.allowed_tenants', ['marketinghub.cegem360.eu']);

        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
            'tenant' => 'http://marketinghub.cegem360.eu',
            'return_path' => '/google-ads/auth/callback',
            'state' => '42',
        ]));

        $response->assertStatus(403);
    });

    it('returns 503 when provider client_id is missing', function (): void {
        config()->set('oauth_proxy.providers.google-ads.client_id');

        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
            'tenant' => 'https://marketinghub.test',
            'return_path' => '/google-ads/auth/callback',
            'state' => '42',
        ]));

        $response->assertStatus(503);
    });

    it('rejects return_path values that do not begin with a slash', function (): void {
        $response = $this->get(route('oauth.proxy.start', [
            'provider' => 'google-ads',
            'tenant' => 'https://marketinghub.test',
            'return_path' => 'evil-path',
            'state' => '42',
        ]));

        $response->assertStatus(400);
    });
});

describe('callback endpoint', function (): void {
    it('forwards the authorization code and inner state to the originating tenant', function (): void {
        $state = ProxyState::issue(
            tenant: 'https://marketinghub.test',
            returnPath: '/google-ads/auth/callback',
            innerState: '42',
            ttlSeconds: 600,
        );

        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'code' => 'AUTH_CODE_123',
            'state' => $state->encrypt(),
        ]));

        $response->assertStatus(302);
        $location = $response->headers->get('Location');

        expect($location)->toStartWith('https://marketinghub.test/google-ads/auth/callback?');

        parse_str(parse_url($location, PHP_URL_QUERY) ?: '', $query);

        expect($query)
            ->toHaveKey('code', 'AUTH_CODE_123')
            ->toHaveKey('state', '42')
            ->not->toHaveKey('error');
    });

    it('forwards OAuth provider errors back to the tenant unchanged', function (): void {
        $state = ProxyState::issue(
            tenant: 'https://marketinghub.test',
            returnPath: '/google-ads/auth/callback',
            innerState: '42',
            ttlSeconds: 600,
        );

        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'error' => 'access_denied',
            'error_description' => 'User denied consent',
            'state' => $state->encrypt(),
        ]));

        $response->assertStatus(302);
        $location = $response->headers->get('Location');

        parse_str(parse_url($location, PHP_URL_QUERY) ?: '', $query);

        expect($query)
            ->toHaveKey('error', 'access_denied')
            ->toHaveKey('error_description', 'User denied consent')
            ->toHaveKey('state', '42')
            ->not->toHaveKey('code');
    });

    it('rejects callbacks with a missing state', function (): void {
        $response = $this->get(route('oauth.proxy.callback', ['provider' => 'google-ads', 'code' => 'X']));

        $response->assertStatus(400);
    });

    it('rejects callbacks with a malformed state', function (): void {
        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'code' => 'X',
            'state' => 'not-a-real-encrypted-payload',
        ]));

        $response->assertStatus(400);
    });

    it('rejects callbacks with an expired state', function (): void {
        $state = ProxyState::issue(
            tenant: 'https://marketinghub.test',
            returnPath: '/google-ads/auth/callback',
            innerState: '42',
            ttlSeconds: 60,
        );

        $this->travel(120)->seconds();

        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'code' => 'X',
            'state' => $state->encrypt(),
        ]));

        $response->assertStatus(400);
    });

    it('rejects callbacks whose state references a non-whitelisted tenant', function (): void {
        $state = ProxyState::issue(
            tenant: 'https://evil.example.com',
            returnPath: '/google-ads/auth/callback',
            innerState: '42',
            ttlSeconds: 600,
        );

        $encrypted = $state->encrypt();

        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'code' => 'X',
            'state' => $encrypted,
        ]));

        $response->assertStatus(403);
    });

    it('rejects callbacks for unknown providers with 404', function (): void {
        $response = $this->get('/oauth/unknown-provider/callback?state=anything');

        $response->assertStatus(404);
    });

    it('rejects state payloads that decrypt to non-array data', function (): void {
        $encrypted = Crypt::encrypt('just-a-string');

        $response = $this->get(route('oauth.proxy.callback', [
            'provider' => 'google-ads',
            'code' => 'X',
            'state' => $encrypted,
        ]));

        $response->assertStatus(400);
    });
});
