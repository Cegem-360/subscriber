<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Subscription;
use App\Models\User;
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

final class AttachSubscriptionMember
{
    /**
     * Attach a user as a member of the subscription (occupying one seat there)
     * and propagate access to the sibling apps: ensure the account exists on
     * every receiver app and activate it on every app the main account (owner)
     * grants — so the member mirrors the main account's modules.
     *
     * Pass the raw password when the account was just created; otherwise the
     * already-hashed password on the model is forwarded (receiver apps accept
     * a hash).
     */
    public function handle(Subscription $subscription, User $user, ?string $rawPassword = null): void
    {
        $user->memberSubscriptions()->syncWithoutDetaching([$subscription->id]);

        UserTeamSync::createUser(
            email: $user->email,
            name: $user->name,
            password: $rawPassword ?? $user->password,
            role: $user->role->value,
            ownerEmail: $subscription->user?->email ?? '',
        );

        foreach ($subscription->ownerAppKeys() as $appKey) {
            dispatch(new ToggleUserActiveJob(userEmail: $user->email, isActive: true, appKey: $appKey))
                ->delay(now()->addSeconds(20));
        }
    }
}
