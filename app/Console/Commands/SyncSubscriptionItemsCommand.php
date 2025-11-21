<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Subscription;
use Exception;
use Illuminate\Console\Command;
use Laravel\Cashier\SubscriptionItem;
use Stripe\StripeClient;

class SyncSubscriptionItemsCommand extends Command
{
    protected $signature = 'subscriptions:sync-items {--subscription= : Specific subscription ID to sync}';

    protected $description = 'Sync subscription items from Stripe to local database';

    public function handle(): int
    {
        $stripe = new StripeClient(config('cashier.secret'));

        $query = Subscription::query();

        if ($subscriptionId = $this->option('subscription')) {
            $query->where('id', $subscriptionId);
        }

        $subscriptions = $query->get();

        if ($subscriptions->isEmpty()) {
            $this->error('No subscriptions found');

            return self::FAILURE;
        }

        $this->info("Found {$subscriptions->count()} subscription(s) to sync");

        $synced = 0;
        $errors = 0;

        foreach ($subscriptions as $subscription) {
            try {
                $this->line("Processing subscription {$subscription->id} ({$subscription->stripe_id})...");

                // Fetch fresh subscription data from Stripe
                $stripeSubscription = $stripe->subscriptions->retrieve($subscription->stripe_id);

                // Get all items from Stripe
                $stripeItems = $stripeSubscription->items->data;
                $itemCount = count($stripeItems);

                $this->line("  Found {$itemCount} item(s) in Stripe");

                foreach ($stripeItems as $stripeItem) {
                    // Check if item already exists
                    $existingItem = SubscriptionItem::query()->where('stripe_id', $stripeItem->id)->first();

                    if ($existingItem) {
                        // Update existing item
                        $existingItem->update([
                            'stripe_product' => $stripeItem->price->product ?? null,
                            'stripe_price' => $stripeItem->price->id,
                            'quantity' => $stripeItem->quantity,
                        ]);

                        $this->line("  ✅ Updated item {$stripeItem->id}");
                    } else {
                        // Create new item
                        SubscriptionItem::query()->create([
                            'subscription_id' => $subscription->id,
                            'stripe_id' => $stripeItem->id,
                            'stripe_product' => $stripeItem->price->product ?? null,
                            'stripe_price' => $stripeItem->price->id,
                            'quantity' => $stripeItem->quantity,
                        ]);

                        $this->line("  ✅ Created item {$stripeItem->id}");
                    }

                    $synced++;
                }
            } catch (Exception $e) {
                $this->error("  ❌ Error syncing subscription {$subscription->id}: {$e->getMessage()}");
                $errors++;
            }
        }

        $this->newLine();
        $this->info("✅ Sync complete: {$synced} items synced, {$errors} errors");

        return self::SUCCESS;
    }
}
