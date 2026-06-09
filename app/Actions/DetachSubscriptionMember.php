<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Subscription;
use App\Models\User;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

final class DetachSubscriptionMember
{
    /**
     * Detach a user from the subscription and deactivate the account on every
     * app the detached main account granted but the user can no longer reach.
     *
     * Order-independent: it does not rely on a pre-detach snapshot (Filament's
     * DetachAction already removes the pivot before this runs), but compares the
     * detached owner's app set against the user's remaining accessible apps.
     */
    public function handle(Subscription $subscription, User $user): void
    {
        $user->memberSubscriptions()->detach($subscription->id);

        $lostAppKeys = array_diff($subscription->ownerAppKeys(), $user->accessibleAppKeys());

        foreach ($lostAppKeys as $appKey) {
            dispatch(new ToggleUserActiveJob(userEmail: $user->email, isActive: false, appKey: $appKey))
                ->delay(now()->addSeconds(20));
        }
    }
}
