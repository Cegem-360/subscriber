<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Enums\BillingPeriod;
use App\Models\Plan\PlanCategory;
use App\Services\CurrencyService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class PricingPage extends Component
{
    public string $currency = 'HUF';

    public bool $isYearly = true;

    public function mount(): void
    {
        $this->currency = app(CurrencyService::class)->getCurrentCurrency();
    }

    public function toggleCurrency(): void
    {
        $currencyService = app(CurrencyService::class);

        $newCurrency = $this->currency === CurrencyService::CURRENCY_HUF
            ? CurrencyService::CURRENCY_EUR
            : CurrencyService::CURRENCY_HUF;

        $currencyService->setCurrentCurrency($newCurrency);
        $this->currency = $newCurrency;
    }

    public function toggleBillingCycle(): void
    {
        $this->isYearly = ! $this->isYearly;
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function getModulesProperty(): Collection
    {
        return PlanCategory::query()
            ->with(['plans' => fn ($query) => $query->where('is_active', true)])
            ->get()
            ->map(function (PlanCategory $category) {
                $yearlyPlan = $category->plans
                    ->where('billing_period', BillingPeriod::Yearly)
                    ->first();

                $monthlyPlan = $category->plans
                    ->where('billing_period', BillingPeriod::Monthly)
                    ->first();

                return [
                    'id' => $category->slug,
                    'name' => $category->name,
                    'subtitle' => $category->description,
                    'description' => $category->description,
                    'yearlyPriceHUF' => $yearlyPlan ? (int) $yearlyPlan->price : 0,
                    'yearlyPriceEUR' => $yearlyPlan ? (int) ($yearlyPlan->price_eur ?? 0) : 0,
                    'monthlyPriceHUF' => $monthlyPlan ? (int) $monthlyPlan->price : 0,
                    'monthlyPriceEUR' => $monthlyPlan ? (int) ($monthlyPlan->price_eur ?? 0) : 0,
                    'color' => $category->color ?? '#6366F1',
                    'icon' => $category->icon ?? 'cube',
                    'features' => $yearlyPlan?->features ?? [],
                ];
            });
    }

    /**
     * @param  array<string, mixed>  $module
     */
    public function calculatePrice(array $module): string
    {
        $currencyService = app(CurrencyService::class);

        if ($this->isYearly) {
            $price = $this->currency === CurrencyService::CURRENCY_EUR
                ? $module['yearlyPriceEUR']
                : $module['yearlyPriceHUF'];
        } else {
            $price = $this->currency === CurrencyService::CURRENCY_EUR
                ? $module['monthlyPriceEUR']
                : $module['monthlyPriceHUF'];
        }

        return $currencyService->format((float) $price, $this->currency);
    }

    /**
     * @param  array<string, mixed>  $module
     */
    public function calculateYearlyPrice(array $module): string
    {
        $currencyService = app(CurrencyService::class);

        $price = $this->currency === CurrencyService::CURRENCY_EUR
            ? $module['yearlyPriceEUR']
            : $module['yearlyPriceHUF'];

        return $currencyService->format((float) $price, $this->currency);
    }

    public function getFaqsProperty(): array
    {
        return [
            [
                'question' => 'Kipróbálhatom a modulokat vásárlás előtt?',
                'answer' => 'Igen, minden modult 14 napig ingyenesen kipróbálhat, teljes funkcionalitással. A próbaidőszak végén dönthet az előfizetésről — nincs automatikus terhelés.',
            ],
            [
                'question' => 'Válthat-e havi és éves előfizetés között?',
                'answer' => 'Igen, bármikor válthat. Havi előfizetésről éves előfizetésre váltva a fennmaradó összeg jóváírásra kerül. Éves előfizetésről havira váltás az éves időszak lejártakor lehetséges.',
            ],
            [
                'question' => 'Mi történik, ha lemondja az előfizetést?',
                'answer' => 'Lemondás esetén a szolgáltatás a kifizetett időszak végéig elérhető marad. Éves előfizetés esetén nincs arányos visszatérítés, de adatait 30 napig megőrizzük exportálásra.',
            ],
            [
                'question' => 'Van felhasználói létszám korlát?',
                'answer' => 'Nem, minden modulhoz korlátlan számú felhasználót adhat hozzá külön díj nélkül. A felhasználók jogosultsági szintjeit a központi dashboardon állíthatja be.',
            ],
            [
                'question' => 'Kapok számlát az előfizetésről?',
                'answer' => 'Igen, minden előfizetésről magyar nyelvű, NAV-kompatibilis számlát állítunk ki. Magyar cégek esetén az ár ÁFÁ-t tartalmaz, EU-s cégek esetén fordított adózás érvényesül.',
            ],
            [
                'question' => 'Használhatok több modult egyszerre?',
                'answer' => 'Igen, a modulok teljesen integráltak, és egy közös felületen keresztül érhetők el. Az adatok átjárnak a modulok között, így például a CRM-ből közvetlenül indíthat értékesítési folyamatot.',
            ],
            [
                'question' => 'Biztonságban vannak az adataim?',
                'answer' => 'Igen. Titkosított kapcsolat (HTTPS), GDPR-kompatibilis adatkezelés, rendszeres biztonsági mentések. Az adatok EU-n belüli szervereken tárolódnak.',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.pricing-page');
    }
}
