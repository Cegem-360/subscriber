<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\MicroservicePermission;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class CreateMicroservicePermissions
{
    public function __construct()
    {
        //
    }

    public function handle(WebhookReceived $event): void
    {
        Log::info('🔔 Stripe webhook received', [
            'type' => $event->payload['type'],
            'id' => $event->payload['id'] ?? 'unknown',
        ]);

        if ($event->payload['type'] === 'checkout.session.completed') {
            Log::info('✅ Processing checkout.session.completed');
            $this->handleCheckoutCompleted($event->payload['data']['object']);
        }

        if ($event->payload['type'] === 'customer.subscription.created') {
            Log::info('✅ Processing customer.subscription.created');
            $this->handleSubscriptionCreated($event->payload['data']['object']);
        }

        if ($event->payload['type'] === 'customer.subscription.updated') {
            Log::info('✅ Processing customer.subscription.updated');
            $this->handleSubscriptionUpdated($event->payload['data']['object']);
        }

        if ($event->payload['type'] === 'manual.subscription.linked') {
            Log::info('✅ Processing manual.subscription.linked');
            $this->handleManualSubscriptionLinked($event->payload['data']['object']);
        }
    }

    protected function handleCheckoutCompleted(array $session): void
    {
        $subscriptionId = $session['subscription'] ?? null;

        if (! $subscriptionId) {
            Log::warning('⚠️ No subscription ID in checkout session');

            return;
        }

        $subscription = Subscription::where('stripe_id', $subscriptionId)->first();

        if (! $subscription) {
            Log::warning('⚠️ Subscription not found in database', [
                'stripe_id' => $subscriptionId,
            ]);

            return;
        }

        // Try to set plan_id from metadata if not already set
        if (! $subscription->plan_id && isset($session['metadata']['plan_id'])) {
            $subscription->plan_id = $session['metadata']['plan_id'];
            $subscription->save();

            Log::info('📝 Set plan_id from checkout metadata', [
                'subscription_id' => $subscription->id,
                'plan_id' => $subscription->plan_id,
            ]);
        }

        if (! $subscription->plan) {
            Log::warning('⚠️ Subscription has no plan yet, will retry when user returns', [
                'subscription_id' => $subscription->id,
            ]);

            return;
        }

        $this->createPermissionsForSubscription($subscription);
    }

    protected function handleSubscriptionCreated(array $stripeSubscription): void
    {
        $subscription = Subscription::where('stripe_id', $stripeSubscription['id'])->first();

        if (! $subscription) {
            Log::warning('⚠️ Subscription not found in database', [
                'stripe_id' => $stripeSubscription['id'],
            ]);

            return;
        }

        // Try to set plan_id from metadata if not already set
        if (! $subscription->plan_id && isset($stripeSubscription['metadata']['plan_id'])) {
            $subscription->plan_id = $stripeSubscription['metadata']['plan_id'];
            $subscription->save();

            Log::info('📝 Set plan_id from subscription metadata', [
                'subscription_id' => $subscription->id,
                'plan_id' => $subscription->plan_id,
            ]);
        }

        if (! $subscription->plan) {
            Log::warning('⚠️ Subscription has no plan yet, will retry when user returns', [
                'subscription_id' => $subscription->id,
            ]);

            return;
        }

        $this->createPermissionsForSubscription($subscription);
    }

    protected function handleSubscriptionUpdated(array $stripeSubscription): void
    {
        $subscription = Subscription::where('stripe_id', $stripeSubscription['id'])->first();

        if (! $subscription || ! $subscription->plan) {
            return;
        }

        // If subscription is no longer active, deactivate permissions
        if ($stripeSubscription['status'] !== 'active') {
            $subscription->permissions()->update([
                'is_active' => false,
            ]);

            return;
        }

        // Reactivate permissions if subscription becomes active again
        $subscription->permissions()->update([
            'is_active' => true,
        ]);

        // Create any missing permissions
        $this->createPermissionsForSubscription($subscription);
    }

    protected function handleManualSubscriptionLinked(array $data): void
    {
        $subscriptionId = $data['id'] ?? null;

        if (! $subscriptionId) {
            Log::warning('⚠️ No subscription ID in manual event');

            return;
        }

        $subscription = Subscription::where('stripe_id', $subscriptionId)->first();

        if (! $subscription) {
            Log::warning('⚠️ Subscription not found for manual linking', [
                'stripe_id' => $subscriptionId,
            ]);

            return;
        }

        if (! $subscription->plan) {
            Log::error('❌ Manual linking failed: subscription still has no plan', [
                'subscription_id' => $subscription->id,
            ]);

            return;
        }

        Log::info('🔄 Manual permission creation triggered', [
            'subscription_id' => $subscription->id,
            'plan_id' => $subscription->plan_id,
        ]);

        $this->createPermissionsForSubscription($subscription);
    }

    protected function createPermissionsForSubscription(Subscription $subscription): void
    {
        if (! $subscription->plan || ! $subscription->plan->microservices) {
            Log::warning('Subscription has no plan or microservices', [
                'subscription_id' => $subscription->id,
                'plan_id' => $subscription->plan_id,
            ]);

            return;
        }

        foreach ($subscription->plan->microservices as $microservice) {
            // Check if permission already exists
            $exists = $subscription->permissions()
                ->where('microservice_slug', $microservice)
                ->exists();

            if ($exists) {
                continue;
            }

            MicroservicePermission::create([
                'subscription_id' => $subscription->id,
                'microservice_name' => $this->getMicroserviceName($microservice),
                'microservice_slug' => $microservice,
                'url' => $this->getMicroserviceUrl($microservice),
                'is_active' => true,
                'activated_at' => now(),
                'expires_at' => $subscription->ends_at,
            ]);
        }

        Log::info('Microservice permissions created for subscription', [
            'subscription_id' => $subscription->id,
            'plan_id' => $subscription->plan_id,
            'microservices_count' => count($subscription->plan->microservices),
        ]);
    }

    protected function getMicroserviceName(string $slug): string
    {
        // You can customize this to get the actual microservice name
        // For example, from a config file or database
        return ucwords(str_replace('-', ' ', $slug));
    }

    protected function getMicroserviceUrl(string $slug): string
    {
        // You can customize this to get the actual microservice URL
        // For example, from a config file
        $urls = config('services.microservices', []);

        return $urls[$slug] ?? '';
    }
}
