<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Madbox99\UserTeamSync\Facades\UserTeamSync;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        Log::info('🔔 SubscriptionObserver: Subscription created event fired', [
            'subscription_id' => $subscription->id,
            'stripe_id' => $subscription->stripe_id,
            'stripe_status' => $subscription->stripe_status,
            'plan_id' => $subscription->plan_id,
            'user_id' => $subscription->user_id,
            'auth_check' => Auth::check(),
        ]);

        if (Auth::check()) {
            $subscription->update(['user_id' => Auth::id()]);

            $user = Auth::user();
            $appKey = $subscription->plan?->planCategory?->slug;

            Log::info('🔍 SubscriptionObserver: Checking CRM activation requirements', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'plan_id' => $subscription->plan_id,
                'plan_name' => $subscription->plan?->name,
                'plan_category_id' => $subscription->plan?->plan_category_id,
                'plan_category_slug' => $appKey,
            ]);

            if ($appKey) {
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
            } else {
                Log::warning('⚠️ SubscriptionObserver: No appKey found, CRM activation skipped', [
                    'subscription_id' => $subscription->id,
                    'plan_id' => $subscription->plan_id,
                    'plan_has_category' => $subscription->plan?->planCategory !== null,
                ]);
            }
        } else {
            Log::warning('⚠️ SubscriptionObserver: No authenticated user, CRM activation skipped', [
                'subscription_id' => $subscription->id,
            ]);
        }
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        if (! $subscription->wasChanged('stripe_status')) {
            return;
        }

        $user = $subscription->user;
        $appKey = $subscription->plan?->planCategory?->slug;

        if (! $user || ! $appKey) {
            return;
        }

        $isActive = $subscription->stripe_status === SubscriptionStatus::Active
            || $subscription->stripe_status === SubscriptionStatus::Trialing;

        Log::info('SubscriptionObserver: Status changed', [
            'user_email' => $user->email,
            'app_key' => $appKey,
            'old_status' => $subscription->getOriginal('stripe_status'),
            'new_status' => $subscription->stripe_status->value,
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
