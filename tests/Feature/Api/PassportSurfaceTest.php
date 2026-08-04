<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

/**
 * @return array<int, string>
 */
function registeredUris(): array
{
    return collect(Route::getRoutes()->getRoutes())
        ->map(fn ($route): string => $route->uri())
        ->all();
}

it('does not expose the device code grant', function (): void {
    // The module apps are server-side and use authorization_code, so the
    // device flow is dead surface — including an unbranded vendor page at a
    // public URL on the identity domain.
    expect(Passport::$deviceCodeGrantEnabled)->toBeFalse();

    expect(registeredUris())
        ->not->toContain('oauth/device')
        ->not->toContain('oauth/device/code')
        ->not->toContain('oauth/device/authorize');
});

it('still exposes the authorization code endpoints the module apps need', function (): void {
    // Guards the fix above: disabling the device grant must not take the
    // endpoints phase 3 depends on with it.
    expect(registeredUris())
        ->toContain('oauth/authorize')
        ->toContain('oauth/token')
        ->toContain('oauth/token/refresh');
});

it('does not register passport client management routes', function (): void {
    // Passport::$registersJsonApiRoutes defaults to false. If that ever flips,
    // every authenticated user could mint and list OAuth clients on the
    // identity provider.
    expect(registeredUris())
        ->not->toContain('oauth/clients')
        ->not->toContain('oauth/tokens')
        ->not->toContain('oauth/personal-access-tokens');
});
