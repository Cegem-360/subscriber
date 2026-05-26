<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use Exception;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Stripe\Price;
use Stripe\Product;
use Stripe\StripeClient;

#[Description('Sync plans to Stripe by creating products and prices (HUF and EUR)')]
#[Signature('stripe:sync-prices
                            {--force : Recreate prices even if they already exist}
                            {--dry-run : Show what would be created without making changes}')]
class SyncStripePricesCommand extends Command
{
    public function handle(): int
    {
        $stripe = new StripeClient(config('cashier.secret'));

        $plans = Plan::with('planCategory')->get();

        if ($plans->isEmpty()) {
            $this->error('No plans found. Run db:seed first.');

            return self::FAILURE;
        }

        $this->info('Syncing ' . $plans->count() . ' plans to Stripe (HUF + EUR)...');
        $this->newLine();

        $dryRun = $this->option('dry-run');
        $force = $this->option('force');

        $createdProducts = 0;
        $createdPricesHuf = 0;
        $createdPricesEur = 0;
        $skipped = 0;

        foreach ($plans as $plan) {
            $this->line("Processing: <info>{$plan->name}</info>");

            if (! $plan->planCategory) {
                $this->warn('  ↳ Skipped: Plan has no category assigned');
                $skipped++;

                continue;
            }

            // Check if already synced
            $hufSynced = $this->isPriceValid($stripe, $plan->stripe_price_id);
            $eurSynced = $this->isPriceValid($stripe, $plan->stripe_price_id_eur);

            if ($hufSynced && $eurSynced && ! $force) {
                $this->line("  ↳ Already synced (HUF: {$plan->stripe_price_id}, EUR: {$plan->stripe_price_id_eur})");
                $skipped++;

                continue;
            }

            if ($dryRun) {
                $this->line('  ↳ Would create product and prices (dry-run)');

                continue;
            }

            // Create or retrieve Stripe product
            $product = $this->getOrCreateProduct($stripe, $plan);
            if ($product->wasCreated ?? false) {
                $createdProducts++;
            }

            $updateData = ['stripe_product_id' => $product->id];

            // Create HUF price if needed
            if (! $hufSynced || $force) {
                $priceHuf = $this->createPrice($stripe, $plan, $product, 'huf', (int) $plan->price);
                $updateData['stripe_price_id'] = $priceHuf->id;
                $createdPricesHuf++;
                $this->info("  ↳ HUF: {$priceHuf->id}");
            }

            // Create EUR price if needed
            if ((! $eurSynced || $force) && $plan->price_eur) {
                $priceEur = $this->createPrice($stripe, $plan, $product, 'eur', (int) $plan->price_eur);
                $updateData['stripe_price_id_eur'] = $priceEur->id;
                $createdPricesEur++;
                $this->info("  ↳ EUR: {$priceEur->id}");
            }

            // Update plan with Stripe IDs
            $plan->update($updateData);
        }

        $this->newLine();
        $this->table(
            ['Action', 'Count'],
            [
                ['Products created', $createdProducts],
                ['HUF prices created', $createdPricesHuf],
                ['EUR prices created', $createdPricesEur],
                ['Skipped (already synced)', $skipped],
            ],
        );

        $this->newLine();
        $this->info('Stripe sync completed!');

        return self::SUCCESS;
    }

    private function isPriceValid(StripeClient $stripe, ?string $priceId): bool
    {
        if (! $priceId) {
            return false;
        }

        try {
            $stripe->prices->retrieve($priceId);

            return true;
        } catch (Exception) {
            return false;
        }
    }

    private function getOrCreateProduct(StripeClient $stripe, Plan $plan): Product
    {
        $category = $plan->planCategory;
        $productName = $category->name;

        // Check if product already exists for this plan
        if ($plan->stripe_product_id) {
            try {
                return $stripe->products->retrieve($plan->stripe_product_id);
            } catch (Exception) {
                // Product doesn't exist, create new one
            }
        }

        // Search for existing product by name
        $existingProducts = $stripe->products->search([
            'query' => "name:'{$productName}' AND active:'true'",
        ]);

        if ($existingProducts->data) {
            return $existingProducts->data[0];
        }

        // Create new product
        $product = $stripe->products->create([
            'name' => $productName,
            'description' => $category->description,
            'metadata' => [
                'plan_category_id' => $category->id,
                'slug' => $category->slug,
            ],
        ]);

        $product->wasCreated = true;

        return $product;
    }

    private function createPrice(StripeClient $stripe, Plan $plan, Product $product, string $currency, int $amount): Price
    {
        $interval = $plan->billing_period === BillingPeriod::Monthly ? 'month' : 'year';

        // Price in smallest currency unit (fillér for HUF, cent for EUR)
        $unitAmount = $amount * 100;

        return $stripe->prices->create([
            'product' => $product->id,
            'currency' => $currency,
            'unit_amount' => $unitAmount,
            'recurring' => [
                'interval' => $interval,
            ],
            'nickname' => $plan->name . ' (' . strtoupper($currency) . ')',
            'metadata' => [
                'plan_id' => $plan->id,
                'billing_period' => $plan->billing_period->value,
                'currency' => $currency,
            ],
        ]);
    }
}
