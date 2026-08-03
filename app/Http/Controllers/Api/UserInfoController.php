<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\MissingUuidException;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * A központi identitás teljes állapota egyetlen válaszban.
 *
 * Szándékosan teljes állapot, nem delta: nincs mit sorrendbe rakni és nincs
 * mit elveszíteni. Minden hívás egyben reconcile is a fogyasztó appon.
 */
final class UserInfoController
{
    /**
     * @throws MissingUuidException when the authenticated user, or any team
     *                              they belong to, has not been backfilled
     *                              with a uuid yet. Never emit a null `sub`
     *                              or `orgs[].uuid` — downstream apps treat
     *                              those as stable primary keys.
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->uuid === null) {
            throw MissingUuidException::forUser($user->id);
        }

        return response()->json([
            'sub' => $user->uuid,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role?->value,
            'orgs' => $user->teams()
                ->get(['teams.id', 'teams.uuid', 'teams.name', 'teams.slug'])
                ->map(function (Team $team): array {
                    if ($team->uuid === null) {
                        throw MissingUuidException::forTeam($team->id);
                    }

                    return [
                        'uuid' => $team->uuid,
                        'name' => $team->name,
                        'slug' => $team->slug,
                    ];
                })
                ->values()
                ->all(),
            'apps' => $user->accessibleAppKeys(),
            'issued_at' => now()->timestamp,
            'claims_version' => config('identity.claims_version'),
        ]);
    }
}
