<?php

declare(strict_types=1);

namespace App\Http\Controllers\OauthProxy;

use App\Http\Controllers\Controller;
use App\Services\OauthProxy\ProxyState;
use App\Services\OauthProxy\TenantGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Psr\Log\LoggerInterface;
use Throwable;

class ProxyController extends Controller
{
    public function start(Request $request, string $provider): RedirectResponse|Response
    {
        $providerConfig = $this->resolveProvider($provider);

        if ($providerConfig === null) {
            return $this->errorResponse('Unknown OAuth provider.', 404);
        }

        $validator = Validator::make($request->query(), [
            'tenant' => ['required', 'string', 'url:https,http', 'max:255'],
            'return_path' => ['required', 'string', 'starts_with:/', 'max:255'],
            'state' => ['required', 'string', 'max:512'],
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid OAuth proxy parameters.', 400);
        }

        $validated = $validator->validated();
        $guard = $this->tenantGuard();

        if (! $guard->isAllowed($validated['tenant'])) {
            $this->log()->warning('OAuth proxy: tenant rejected at start', [
                'tenant' => $validated['tenant'],
                'provider' => $provider,
            ]);

            return $this->errorResponse('Tenant is not allowed to use this proxy.', 403);
        }

        if (empty($providerConfig['client_id'])) {
            $this->log()->error('OAuth proxy: provider not configured', ['provider' => $provider]);

            return $this->errorResponse('OAuth provider is not configured.', 503);
        }

        $state = ProxyState::issue(
            tenant: $validated['tenant'],
            returnPath: $validated['return_path'],
            innerState: $validated['state'],
            ttlSeconds: (int) config('oauth_proxy.state_ttl_seconds'),
        );

        $params = array_merge($providerConfig['extra_params'] ?? [], [
            'client_id' => $providerConfig['client_id'],
            'redirect_uri' => route('oauth.proxy.callback', ['provider' => $provider]),
            'response_type' => 'code',
            'scope' => $providerConfig['scope'],
            'state' => $state->encrypt(),
        ]);

        return redirect()->away($providerConfig['auth_url'] . '?' . http_build_query($params));
    }

    public function callback(Request $request, string $provider): RedirectResponse|Response
    {
        if ($this->resolveProvider($provider) === null) {
            return $this->errorResponse('Unknown OAuth provider.', 404);
        }

        $encryptedState = (string) $request->query('state', '');

        if ($encryptedState === '') {
            return $this->errorResponse('Missing state parameter.', 400);
        }

        try {
            $state = ProxyState::decrypt($encryptedState);
        } catch (Throwable $e) {
            $this->log()->warning('OAuth proxy: state decryption failed', [
                'provider' => $provider,
                'error' => $e->getMessage(),
            ]);

            return $this->errorResponse('Invalid state parameter.', 400);
        }

        if ($state->isExpired()) {
            return $this->errorResponse('OAuth state has expired. Please try again.', 400);
        }

        $guard = $this->tenantGuard();

        if (! $guard->isAllowed($state->tenant)) {
            $this->log()->warning('OAuth proxy: tenant rejected at callback', [
                'tenant' => $state->tenant,
                'provider' => $provider,
            ]);

            return $this->errorResponse('Tenant is not allowed to use this proxy.', 403);
        }

        $forwarded = array_filter(
            $request->only(['code', 'error', 'error_description', 'scope']),
            fn ($value): bool => $value !== null && $value !== '',
        );
        $forwarded['state'] = $state->innerState;

        return redirect()->away($guard->buildReturnUrl(
            $state->tenant,
            $state->returnPath,
            $forwarded,
        ));
    }

    /**
     * @return array<string, mixed>|null
     */
    private function resolveProvider(string $provider): ?array
    {
        $providers = (array) config('oauth_proxy.providers');

        return $providers[$provider] ?? null;
    }

    private function tenantGuard(): TenantGuard
    {
        return new TenantGuard((array) config('oauth_proxy.allowed_tenants'));
    }

    private function errorResponse(string $message, int $status): Response
    {
        return response($message, $status, ['Content-Type' => 'text/plain; charset=utf-8']);
    }

    private function log(): LoggerInterface
    {
        return Log::channel(config('logging.channels.oauth_proxy') !== null ? 'oauth_proxy' : 'stack');
    }
}
