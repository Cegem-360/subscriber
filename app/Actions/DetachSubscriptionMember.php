<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Subscription;
use App\Models\User;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

final class DetachSubscriptionMember
{
    /**
     * Detach a user from the subscription and deactivate the account on the
     * subscription's app — but only when the user has no other subscription
     * pointing at the same app, otherwise we would lock them out of access
     * they still legitimately have.
     */
    public function handle(Subscription $subscription, User $user): void
    {
        $user->memberSubscriptions()->detach($subscription->id);

        $appKey = $subscription->plan?->planCategory?->slug;

        if ($appKey === null || $appKey === '') {
            return;
        }

        $stillHasAccess = $user->memberSubscriptions()
            ->withoutGlobalScopes()
            ->whereHas('plan.planCategory', fn ($query) => $query->where('slug', $appKey))
            ->exists();

        if ($stillHasAccess) {
            return;
        }

        dispatch(new ToggleUserActiveJob(userEmail: $user->email, isActive: false, appKey: $appKey))
            ->delay(now()->addSeconds(20));
    }
}
