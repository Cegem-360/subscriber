<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Madbox99\UserTeamSync\Facades\UserTeamSync;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        $user = $subscription->user;
        $appKey = $subscription->plan?->planCategory?->slug;

        Log::info('🔔 SubscriptionObserver: Subscription created event fired', [
            'subscription_id' => $subscription->id,
            'stripe_id' => $subscription->stripe_id,
            'stripe_status' => $subscription->stripe_status,
            'plan_id' => $subscription->plan_id,
            'user_id' => $subscription->user_id,
        ]);

        if (! $user) {
            Log::warning('⚠️ SubscriptionObserver: Subscription has no user, CRM activation skipped', [
                'subscription_id' => $subscription->id,
            ]);

            return;
        }

        if (! $appKey) {
            Log::warning('⚠️ SubscriptionObserver: No appKey found, CRM activation skipped', [
                'subscription_id' => $subscription->id,
                'plan_id' => $subscription->plan_id,
                'plan_has_category' => $subscription->plan?->planCategory !== null,
            ]);

            return;
        }

        Log::info('📤 SubscriptionObserver: Dispatching ToggleUserActiveInSecondaryApp job', [
            'user_email' => $user->email,
            'is_active' => true,
            'app_key' => $appKey,
        ]);

        UserTeamSync::toggleUserActive(
            userEmail: $user->email,
            isActive: true,
            appKey: $appKey,
        );

        Log::info('✅ SubscriptionObserver: CRM activation job dispatched successfully', [
            'user_email' => $user->email,
            'app_key' => $appKey,
        ]);
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        // A subscription imported from Stripe is created without a plan_id, so the
        // "created" handler cannot resolve an appKey. The plan is linked in a
        // follow-up save, which we must treat as an activation trigger too —
        // otherwise CRM activation is silently skipped.
        $statusChanged = $subscription->wasChanged('stripe_status');
        $planLinked = $subscription->wasChanged('plan_id') && $subscription->plan_id !== null;

        if (! $statusChanged && ! $planLinked) {
            return;
        }

        // The plan relationship may have been resolved (and cached as null) during
        // the "created" event, before the plan was linked. Reload it so the appKey
        // reflects the freshly linked plan.
        if ($planLinked) {
            $subscription->load('plan.planCategory');
        }

        $user = $subscription->user;
        $appKey = $subscription->plan?->planCategory?->slug;

        if (! $user || ! $appKey) {
            return;
        }

        $isActive = $subscription->stripe_status === SubscriptionStatus::Active
            || $subscription->stripe_status === SubscriptionStatus::Trialing;

        Log::info('SubscriptionObserver: Subscription updated, syncing CRM activation', [
            'user_email' => $user->email,
            'app_key' => $appKey,
            'status_changed' => $statusChanged,
            'plan_linked' => $planLinked,
            'stripe_status' => $subscription->stripe_status->value,
            'is_active' => $isActive,
        ]);

        UserTeamSync::toggleUserActive(
            userEmail: $user->email,
            isActive: $isActive,
            appKey: $appKey,
        );
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        $user = $subscription->user;
        $appKey = $subscription->plan?->planCategory?->slug;

        if (! $user || ! $appKey) {
            return;
        }

        Log::info('SubscriptionObserver: Subscription deleted, deactivating user', [
            'user_email' => $user->email,
            'app_key' => $appKey,
        ]);

        UserTeamSync::toggleUserActive(
            userEmail: $user->email,
            isActive: false,
            appKey: $appKey,
        );
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
