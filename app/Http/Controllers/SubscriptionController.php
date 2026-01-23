<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Checkout;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function checkout(Request $request, Plan $plan): RedirectResponse|Checkout
    {
        $request->validate([
            'plan' => ['sometimes', 'exists:plans,id'],
        ]);

        if (! $plan->is_active) {
            return back()->with('error', 'Ez a csomag jelenleg nem elérhető.');
        }

        if (! $plan->stripe_price_id) {
            return back()->with('error', 'A csomaghoz nem tartozik Stripe ár.');
        }

        $user = $request->user();

        // Check if user already has an active subscription to this plan
        if ($user->subscribed('default', $plan->stripe_price_id)) {
            return back()->with('info', 'Már rendelkezel ezzel az előfizetéssel.');
        }

        return $user->newSubscription('default', $plan->stripe_price_id)
            ->checkout([
                'success_url' => route('subscription.success', ['plan' => $plan->id]),
                'cancel_url' => route('subscription.cancel'),
                'metadata' => [
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                ],
            ]);
    }

    public function success(Request $request, Plan $plan): RedirectResponse
    {
        $user = $request->user();

        Log::info('🎉 User returned from Stripe checkout', [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
        ]);

        // First, check if webhook already created a subscription with this stripe_price
        /**
         * @var Subscription $webhookSubscription
         */
        $webhookSubscription = $user->subscriptions()
            ->where('stripe_price', $plan->stripe_price_id)
            ->whereNotNull('stripe_id')
            ->latest()
            ->first();

        if ($webhookSubscription) {
            // Webhook already created it - just add plan_id and clean up duplicates
            $webhookSubscription->update(
                ['plan_id' => $plan->id],
            );

            // Delete any orphaned local subscriptions (without stripe_id)
            $user->subscriptions()
                ->whereNull('stripe_id')
                ->delete();

            Log::info('✅ Linked webhook subscription to plan', [
                'subscription_id' => $webhookSubscription->id,
                'stripe_id' => $webhookSubscription->stripe_id,
                'plan_id' => $plan->id,
            ]);

            // Log CRM activation context
            $appKey = $plan->planCategory?->slug;
            Log::info('🔗 CRM activation context for webhook subscription', [
                'subscription_id' => $webhookSubscription->id,
                'user_email' => $user->email,
                'plan_category_slug' => $appKey,
                'will_trigger_crm' => $appKey !== null,
                'note' => 'CRM activation was triggered by SubscriptionObserver when subscription was created by webhook',
            ]);

            return to_route('modules')
                ->with('success', 'Előfizetésed sikeresen létrejött! Hamarosan aktiválódnak a jogosultságaid.');
        }

        // No webhook subscription found - need to sync from Stripe
        $subscription = $user->subscriptions()
            ->whereNull('stripe_id')
            ->latest()
            ->first();

        if (! $subscription) {
            Log::warning('⚠️ No subscription found in database, syncing from Stripe', [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'stripe_price_id' => $plan->stripe_price_id,
            ]);

            // Sync subscriptions from Stripe to local database
            try {
                $stripe = new StripeClient(config('cashier.secret'));

                // Get customer ID
                $stripeCustomer = $user->createOrGetStripeCustomer();

                // Get all subscriptions for this customer from Stripe
                $stripeSubscriptions = $stripe->subscriptions->all([
                    'customer' => $stripeCustomer->id,
                    'limit' => 10,
                ]);

                Log::info('📥 Found subscriptions in Stripe', [
                    'count' => count($stripeSubscriptions->data),
                    'customer_id' => $stripeCustomer->id,
                ]);

                // Import/update subscriptions from Stripe
                foreach ($stripeSubscriptions->data as $stripeSubscription) {
                    // Check if subscription already exists by stripe_id
                    $existingSubscription = $user->subscriptions()
                        ->where('stripe_id', $stripeSubscription->id)
                        ->first();

                    $stripeItem = $stripeSubscription->items->data[0] ?? null;
                    $subscriptionData = [
                        'type' => 'default',
                        'stripe_id' => $stripeSubscription->id,
                        'stripe_status' => $stripeSubscription->status,
                        'stripe_price' => $stripeItem?->price->id,
                        'quantity' => $stripeItem?->quantity ?? 1,
                        'trial_ends_at' => $stripeSubscription->trial_end ? Date::createFromTimestamp($stripeSubscription->trial_end) : null,
                        'ends_at' => $stripeSubscription->ended_at ? Date::createFromTimestamp($stripeSubscription->ended_at) : null,
                    ];

                    if ($existingSubscription) {
                        $existingSubscription->update($subscriptionData);
                        Log::info('✅ Updated existing subscription', [
                            'subscription_id' => $existingSubscription->id,
                            'stripe_id' => $stripeSubscription->id,
                        ]);
                    } elseif ($subscription && ! $subscription->stripe_id) {
                        // Update the local subscription that has no stripe_id
                        $subscription->update($subscriptionData);
                        Log::info('✅ Linked local subscription to Stripe', [
                            'subscription_id' => $subscription->id,
                            'stripe_id' => $stripeSubscription->id,
                        ]);

                        // Create subscription item
                        if ($stripeItem) {
                            $subscription->items()->updateOrCreate(
                                ['stripe_id' => $stripeItem->id],
                                [
                                    'stripe_product' => $stripeItem->price->product,
                                    'stripe_price' => $stripeItem->price->id,
                                    'quantity' => $stripeItem->quantity ?? 1,
                                ],
                            );
                        }
                        break; // We found and linked our subscription
                    } else {
                        // Create new subscription record
                        $newSub = $user->subscriptions()->create($subscriptionData);

                        // Create subscription item
                        if ($stripeItem) {
                            $newSub->items()->create([
                                'stripe_id' => $stripeItem->id,
                                'stripe_product' => $stripeItem->price->product,
                                'stripe_price' => $stripeItem->price->id,
                                'quantity' => $stripeItem->quantity ?? 1,
                            ]);
                        }

                        Log::info('✅ Imported new subscription', [
                            'stripe_id' => $stripeSubscription->id,
                            'status' => $stripeSubscription->status,
                        ]);
                    }
                }

                // Try to find the subscription again after sync
                $subscription = $user->subscriptions()
                    ->where('stripe_price', $plan->stripe_price_id)
                    ->latest()
                    ->first();

                if (! $subscription) {
                    Log::error('❌ Subscription still not found after Stripe sync');

                    return to_route('filament.admin.pages.dashboard')
                        ->with('error', 'Hiba történt az előfizetés létrehozása során. Kérlek, vedd fel velünk a kapcsolatot.');
                }

                Log::info('✅ Subscription synced successfully from Stripe', [
                    'subscription_id' => $subscription->id,
                    'stripe_id' => $subscription->stripe_id,
                ]);
            } catch (Exception $e) {
                Log::error('❌ Failed to sync subscription from Stripe', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return to_route('filament.admin.pages.dashboard')
                    ->with('error', 'Hiba történt az előfizetés szinkronizálása során: ' . $e->getMessage());
            }
        }

        Log::info('✅ Subscription found, linking to plan', [
            'subscription_id' => $subscription->id,
            'stripe_id' => $subscription->stripe_id,
            'plan_id' => $plan->id,
            'had_plan_before' => $subscription->plan_id !== null,
        ]);

        $subscription->plan_id = $plan->id;
        $subscription->save();

        // Log CRM activation context for manually synced subscription
        $appKey = $plan->planCategory?->slug;
        Log::info('🔗 CRM activation context for synced subscription', [
            'subscription_id' => $subscription->id,
            'user_email' => $user->email,
            'plan_category_slug' => $appKey,
            'will_trigger_crm' => $appKey !== null,
            'note' => 'CRM activation should have been triggered by SubscriptionObserver when subscription was created/updated',
        ]);

        return to_route('filament.admin.pages.dashboard')
            ->with('success', 'Előfizetésed sikeresen létrejött! Hamarosan aktiválódnak a jogosultságaid.');
    }

    public function cancel(): RedirectResponse
    {
        return to_route('filament.admin.pages.dashboard')
            ->with('info', 'Előfizetés lemondva.');
    }
}
