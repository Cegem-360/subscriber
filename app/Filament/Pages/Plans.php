<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class Plans extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $slug = 'subscription-plans';

    protected string $view = 'filament.pages.plans';

    protected static ?string $navigationLabel = 'Előfizetési csomagok';

    protected static ?string $title = 'Előfizetési csomagok';

    protected static ?int $navigationSort = 10;

    public Collection $plans;

    public function mount(): void
    {
        $this->plans = Plan::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();
    }

    public function hasActivePlan(Plan $plan): bool
    {
        return Auth::user()->subscribed('default', $plan->stripe_price_id);
    }

    protected function getHeaderActions(): array
    {
        if (! Auth::user()->isAdmin()) {
            return [];
        }

        return [
            Action::make('sync_stripe')
                ->label('Stripe szinkronizálás')
                ->icon(Heroicon::ArrowPath)
                ->color('primary')
                ->action(fn () => $this->syncWithStripe())
                ->requiresConfirmation()
                ->modalHeading('Stripe termékek szinkronizálása')
                ->modalDescription('Ez a művelet szinkronizálja a Stripe termékeket és árakat a helyi adatbázissal. Új termékek kerülnek hozzáadásra, meglévők frissülnek.')
                ->modalSubmitActionLabel('Szinkronizálás'),
        ];
    }

    protected function syncWithStripe(): void
    {
        try {
            $stripe = new StripeClient(config('cashier.secret'));

            // Fetch all products from Stripe
            $products = $stripe->products->all(['active' => true, 'limit' => 100]);

            $created = 0;
            $updated = 0;

            foreach ($products->data as $product) {
                // Fetch prices for this product
                $prices = $stripe->prices->all([
                    'product' => $product->id,
                    'active' => true,
                    'limit' => 10,
                ]);

                Log::info('Stripe Product Found', [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'prices_count' => count($prices->data),
                ]);

                foreach ($prices->data as $price) {
                    // Determine billing period
                    $billingPeriod = match ($price->recurring?->interval) {
                        'month' => BillingPeriod::Monthly,
                        'year' => BillingPeriod::Yearly,
                        default => BillingPeriod::Monthly,
                    };

                    // Convert amount from cents to main currency unit
                    // For zero-decimal currencies (like HUF in practice), don't divide
                    $zeroDecimalCurrencies = ['BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF'];
                    $currency = strtoupper($price->currency);
                    $amount = in_array($currency, $zeroDecimalCurrencies)
                        ? $price->unit_amount
                        : $price->unit_amount / 100;

                    // Create unique slug with billing period suffix
                    $billingPeriodSuffix = $price->recurring?->interval ?? 'monthly';
                    $baseSlug = Str::slug($product->name);
                    $uniqueSlug = "{$baseSlug}-{$billingPeriodSuffix}";

                    Log::info('Processing Price', [
                        'price_id' => $price->id,
                        'unit_amount_raw' => $price->unit_amount,
                        'currency' => $price->currency,
                        'amount_converted' => $amount,
                        'interval' => $price->recurring?->interval ?? 'one-time',
                        'slug' => $uniqueSlug,
                    ]);

                    // Check if plan exists by stripe_price_id or slug
                    $plan = Plan::query()->where('stripe_price_id', $price->id)
                        ->orWhere('slug', $uniqueSlug)
                        ->first();

                    Log::info('Plan Lookup Result', [
                        'found' => $plan ? 'yes' : 'no',
                        'plan_id' => $plan?->id,
                        'action' => $plan ? 'update' : 'create',
                    ]);

                    $data = [
                        'name' => $product->name,
                        'slug' => $uniqueSlug,
                        'description' => $product->description,
                        'price' => $amount,
                        'billing_period' => $billingPeriod,
                        'stripe_price_id' => $price->id,
                        'stripe_product_id' => $product->id,
                        'features' => $product->metadata->features ?? [],
                        'is_active' => $product->active && $price->active,
                    ];

                    if ($plan) {
                        $plan->update($data);
                        $updated++;
                    } else {
                        Plan::query()->create($data);
                        $created++;
                    }
                }
            }

            // Refresh the plans list
            $this->mount();

            Notification::make()
                ->success()
                ->title('Stripe szinkronizálás sikeres!')
                ->body("Létrehozva: {$created}, Frissítve: {$updated}")
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->danger()
                ->title('Hiba a szinkronizálás során')
                ->body($e->getMessage())
                ->send();
        }
    }
}
