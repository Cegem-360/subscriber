<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;

class SubscriptionController extends Controller
{
    public function checkout(Request $request, Plan $plan): RedirectResponse|Checkout
    {
        $request->validate([
            'plan' => 'sometimes|exists:plans,id',
        ]);

        if (! $plan->is_active) {
            return redirect()->back()->with('error', 'Ez a csomag jelenleg nem elérhető.');
        }

        if (! $plan->stripe_price_id) {
            return redirect()->back()->with('error', 'A csomaghoz nem tartozik Stripe ár.');
        }

        $user = $request->user();

        // Check if user already has an active subscription to this plan
        if ($user->subscribed('default', $plan->stripe_price_id)) {
            return redirect()->back()->with('info', 'Már rendelkezel ezzel az előfizetéssel.');
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

        \Log::info('🎉 User returned from Stripe checkout', [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
        ]);

        // Get the latest subscription
        $subscription = $user->subscriptions()
            ->where('stripe_price', $plan->stripe_price_id)
            ->latest()
            ->first();

        if (! $subscription) {
            \Log::warning('⚠️ No subscription found in database, syncing from Stripe', [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'stripe_price_id' => $plan->stripe_price_id,
            ]);

            // Sync subscriptions from Stripe to local database
            try {
                $stripe = new \Stripe\StripeClient(config('cashier.secret'));

                // Get customer ID
                $stripeCustomer = $user->createOrGetStripeCustomer();

                // Get all subscriptions for this customer from Stripe
                $stripeSubscriptions = $stripe->subscriptions->all([
                    'customer' => $stripeCustomer->id,
                    'limit' => 10,
                ]);

                \Log::info('📥 Found subscriptions in Stripe', [
                    'count' => count($stripeSubscriptions->data),
                    'customer_id' => $stripeCustomer->id,
                ]);

                // Import each subscription to local database
                foreach ($stripeSubscriptions->data as $stripeSubscription) {
                    // Check if subscription already exists
                    $existingSubscription = $user->subscriptions()
                        ->where('stripe_id', $stripeSubscription->id)
                        ->first();

                    if (! $existingSubscription) {
                        // Create new subscription record
                        $user->subscriptions()->create([
                            'type' => 'default',
                            'stripe_id' => $stripeSubscription->id,
                            'stripe_status' => $stripeSubscription->status,
                            'stripe_price' => $stripeSubscription->items->data[0]->price->id ?? null,
                            'quantity' => $stripeSubscription->items->data[0]->quantity ?? 1,
                            'trial_ends_at' => $stripeSubscription->trial_end ? \Carbon\Carbon::createFromTimestamp($stripeSubscription->trial_end) : null,
                            'ends_at' => $stripeSubscription->ended_at ? \Carbon\Carbon::createFromTimestamp($stripeSubscription->ended_at) : null,
                        ]);

                        \Log::info('✅ Imported subscription', [
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
                    \Log::error('❌ Subscription still not found after Stripe sync');

                    return redirect()
                        ->route('filament.admin.pages.dashboard')
                        ->with('error', 'Hiba történt az előfizetés létrehozása során. Kérlek, vedd fel velünk a kapcsolatot.');
                }

                \Log::info('✅ Subscription synced successfully from Stripe', [
                    'subscription_id' => $subscription->id,
                    'stripe_id' => $subscription->stripe_id,
                ]);
            } catch (\Exception $e) {
                \Log::error('❌ Failed to sync subscription from Stripe', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return redirect()
                    ->route('filament.admin.pages.dashboard')
                    ->with('error', 'Hiba történt az előfizetés szinkronizálása során: ' . $e->getMessage());
            }
        }

        \Log::info('✅ Subscription found, linking to plan', [
            'subscription_id' => $subscription->id,
            'stripe_id' => $subscription->stripe_id,
            'plan_id' => $plan->id,
            'had_plan_before' => $subscription->plan_id !== null,
        ]);

        $subscription->plan_id = $plan->id;
        $subscription->save();

        // Trigger permission creation if webhook hasn't done it yet
        if ($subscription->permissions()->count() === 0) {
            \Log::info('🔄 No permissions found, triggering creation', [
                'subscription_id' => $subscription->id,
            ]);

            event(new \Laravel\Cashier\Events\WebhookReceived([
                'type' => 'manual.subscription.linked',
                'data' => [
                    'object' => [
                        'id' => $subscription->stripe_id,
                    ],
                ],
            ]));
        }

        return redirect()
            ->route('filament.admin.pages.dashboard')
            ->with('success', 'Előfizetésed sikeresen létrejött! Hamarosan aktiválódnak a jogosultságaid.');
    }

    public function cancel(): RedirectResponse
    {
        return redirect()
            ->route('filament.admin.pages.dashboard')
            ->with('info', 'Előfizetés lemondva.');
    }
}
