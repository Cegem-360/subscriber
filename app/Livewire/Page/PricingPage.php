<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Enums\BillingPeriod;
use App\Mail\ContactInquiryMail;
use App\Models\Plan\PlanCategory;
use App\Services\CurrencyService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.app')]
final class PricingPage extends Component
{
    public string $currency = 'HUF';

    public bool $isYearly = true;

    public string $firstName = '';

    public string $lastName = '';

    public string $email = '';

    public string $phone = '';

    public string $company = '';

    /** @var array<int, string> */
    public array $interestedModules = [];

    public string $message = '';

    public bool $privacyAccepted = false;

    public bool $submitted = false;

    public function mount(): void
    {
        $this->currency = resolve(CurrencyService::class)->getCurrentCurrency();
    }

    /**
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'interestedModules' => 'nullable|array',
            'message' => 'required|string|min:20',
            'privacyAccepted' => 'accepted',
        ];
    }

    public function submitQuote(): void
    {
        $this->validate();

        try {
            Mail::to('tamas@cegem360.hu')->send(new ContactInquiryMail(
                source: 'pricing',
                data: [
                    'firstName' => $this->firstName,
                    'lastName' => $this->lastName,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'company' => $this->company,
                    'interestedModules' => $this->interestedModules,
                    'message' => $this->message,
                    'privacyAccepted' => $this->privacyAccepted,
                ],
            ));
        } catch (Throwable $exception) {
            Log::error('Pricing quote request mail failed to send', [
                'error' => $exception->getMessage(),
                'email' => $this->email,
            ]);
        }

        $this->submitted = true;
    }

    public function toggleCurrency(): void
    {
        $currencyService = resolve(CurrencyService::class);

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
            ->map(function (PlanCategory $category): array {
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
        $currencyService = resolve(CurrencyService::class);

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
        $currencyService = resolve(CurrencyService::class);

        $price = $this->currency === CurrencyService::CURRENCY_EUR
            ? $module['yearlyPriceEUR']
            : $module['yearlyPriceHUF'];

        return $currencyService->format((float) $price, $this->currency);
    }

    /**
     * @return array<int, array{question: string, answer: string}>
     */
    public function getFaqsProperty(): array
    {
        return [
            [
                'question' => __('Can I try the modules before purchase?'),
                'answer' => __('Yes, you can try each module free for 14 days with full functionality. At the end of the trial period you can decide on your subscription — no automatic charge.'),
            ],
            [
                'question' => __('Can I switch between monthly and yearly subscriptions?'),
                'answer' => __('Yes, you can switch anytime. When switching from monthly to yearly subscription, the remaining amount is credited. Switching from yearly to monthly is possible at the end of the yearly period.'),
            ],
            [
                'question' => __('What happens if I cancel my subscription?'),
                'answer' => __('If cancelled, the service remains available until the end of the paid period. For yearly subscriptions there is no pro-rata refund, but we keep your data for 30 days for export.'),
            ],
            [
                'question' => __('Is there a user limit?'),
                'answer' => __('No, you can add unlimited users to each module at no extra cost. You can set user permission levels on the central dashboard.'),
            ],
            [
                'question' => __('Do I get an invoice for my subscription?'),
                'answer' => __('Yes, we issue a Hungarian-language, NAV-compatible invoice for every subscription. For Hungarian companies, the price includes VAT; for EU companies, reverse charge applies.'),
            ],
            [
                'question' => __('Can I use multiple modules at once?'),
                'answer' => __('Yes, the modules are fully integrated and accessible through a single interface. Data flows between modules, so for example you can start a sales process directly from CRM.'),
            ],
            [
                'question' => __('Is my data secure?'),
                'answer' => __('Yes. Encrypted connection (HTTPS), GDPR-compliant data handling, regular backups. Data is stored on servers within the EU.'),
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.pricing-page');
    }
}
