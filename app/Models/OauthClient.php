<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\Client;
use Laravel\Passport\Scope;
use Madbox99\UserTeamSync\Models\SyncApp;
use Override;

/**
 * Passport client model for this app's identity-provider role.
 *
 * All sixteen sibling apps are first-party and owned by the same company,
 * so their clients skip the consent screen entirely. "First-party" is
 * defined narrowly here: the client's key must be registered against a
 * sync app via `identity:register-clients` (sync_apps.oauth_client_id).
 * A client created by hand with `php artisan passport:client` is never
 * written there, so it keeps the consent screen — safe by default.
 */
final class OauthClient extends Client
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @param  Scope[]  $scopes
     */
    #[Override]
    public function skipsAuthorization(Authenticatable $user, array $scopes): bool
    {
        return SyncApp::query()
            ->where('oauth_client_id', $this->getKey())
            ->exists();
    }
}
