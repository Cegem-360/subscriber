<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

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
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return response()->json([
            'sub' => $user->uuid,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role?->value,
            'orgs' => $user->teams()
                ->get(['teams.id', 'teams.uuid', 'teams.name', 'teams.slug'])
                ->map(fn (Team $team): array => [
                    'uuid' => $team->uuid,
                    'name' => $team->name,
                    'slug' => $team->slug,
                ])
                ->values()
                ->all(),
            'apps' => $user->accessibleAppKeys(),
            'issued_at' => now()->timestamp,
        ]);
    }
}
