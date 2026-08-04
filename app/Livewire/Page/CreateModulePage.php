<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Actions\RecordLegalAcceptance;
use App\Concerns\RequiresEmailVerification;
use App\Enums\BillingPeriod;
use App\Enums\LegalDocument;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Team;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class CreateModulePage extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use RequiresEmailVerification;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Switch the billing period and clear any previously selected plan, so a
     * plan from the other period can never leak through into the order.
     */
    public function selectBillingPeriod(string $period): void
    {
        $this->data['billing_period'] = $period;
        $this->data['plan_id'] = null;
    }

    private function currentTeam(): ?Team
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user?->teams()->with('planPrices')->first();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->submitAction(new HtmlString(view('components.wizard-submit-button')->render()))
                    ->schema([
                        Step::make(__('Module'))
                            ->schema([
                                ViewField::make('module')
                                    ->view('components.category-card-selector')
                                    ->viewData([
                                        'categories' => PlanCategory::all(),
                                    ])
                                    ->required(),
                            ]),
                        Step::make(__('Package Type'))
                            ->schema([
                                ViewField::make('billing_period')
                                    ->view('components.subscription-billing-period-toggle')
                                    ->viewData([
                                        'types' => [
                                            BillingPeriod::Monthly,
                                            BillingPeriod::Yearly,
                                        ],
                                    ])
                                    ->required(),
                                ViewField::make('plan_id')
                                    ->view('components.plan-card-selector')
                                    ->viewData(fn (Get $get): array => [
                                        'plans' => Plan::wherePlanCategoryId($get('module'))
                                            ->whereBillingPeriod($get('billing_period'))
                                            ->active()
                                            ->orderBy('sort_order')
                                            ->get(),
                                        'team' => $this->currentTeam(),
                                    ])
                                    ->required(),
                            ]),
                        Step::make(__('Time Period'))
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('quantity')
                                            ->live()
                                            ->afterStateUpdated(function (CreateModulePage $livewire, ?int $state): void {
                                                if ($state < 1) {
                                                    $livewire->data['quantity'] = 1;
                                                }
                                            })
                                            ->label(__('Seats'))
                                            ->required()
                                            ->integer()
                                            ->minValue(1)
                                            ->default(1),
                                    ]),
                                Section::make()->schema([
                                    ViewField::make('summary')
                                        ->view('components.subscription-summary')
                                        ->viewData(function (Get $get): array {
                                            $plan = Plan::query()->find($get('plan_id'));

                                            return [
                                                'plan' => $plan,
                                                'team' => $this->currentTeam(),
                                                'billing_period' => filled($get('billing_period'))
                                                    ? BillingPeriod::tryFrom($get('billing_period'))
                                                    : null,
                                                'quantity' => $get('quantity'),
                                            ];
                                        }),
                                ]),
                                Section::make(__('Legal declarations'))->schema([
                                    Checkbox::make('accepts_terms')
                                        ->label($this->legalConsentLabel(LegalDocument::TermsOfService))
                                        ->accepted()
                                        ->required(),
                                    Checkbox::make('accepts_privacy')
                                        ->label($this->legalConsentLabel(LegalDocument::PrivacyPolicy))
                                        ->accepted()
                                        ->required(),
                                ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * Build a consent label whose document name links to the published
     * document, opened in a new tab so the half-filled wizard is not lost. The
     * whole sentence is one translation key, because the linked document name
     * has to carry the Hungarian accusative suffix.
     */
    private function legalConsentLabel(LegalDocument $document): HtmlString
    {
        $sentence = match ($document) {
            LegalDocument::TermsOfService => 'I have read and accept the <a href=":url" target="_blank" rel="noopener noreferrer" class="font-medium underline underline-offset-2">General Terms and Conditions</a>.',
            LegalDocument::PrivacyPolicy => 'I have read and accept the <a href=":url" target="_blank" rel="noopener noreferrer" class="font-medium underline underline-offset-2">Privacy notice</a>.',
        };

        return new HtmlString(__($sentence, ['url' => route($document->routeName())]));
    }

    /**
     * Persist the consent the moment the order is placed — it stands on its own
     * regardless of whether the Stripe payment later succeeds.
     */
    private function recordLegalConsent(): void
    {
        /** @var User $user */
        $user = Auth::user();

        app(RecordLegalAcceptance::class)->handle(
            user: $user,
            documents: [LegalDocument::TermsOfService, LegalDocument::PrivacyPolicy],
            context: 'module_order',
            ipAddress: request()->ip(),
            userAgent: request()->userAgent(),
        );
    }

    public function create(): void
    {
        if (! $this->guardWrite()) {
            return;
        }

        $data = $this->form->getState();
        $plan = Plan::query()->findOrFail($data['plan_id']);

        if ($plan->billing_period?->value !== ($data['billing_period'] ?? null)) {
            Notification::make()
                ->title('A kiválasztott csomag elszámolási időszaka nem egyezik.')
                ->body('Kérjük, válassza ki újra a havi vagy éves csomagot.')
                ->danger()
                ->send();

            return;
        }

        $quantity = (int) $data['quantity'];
        $team = $this->currentTeam();
        $stripePriceId = $plan->stripePriceIdForTeam($team);

        if (! $stripePriceId) {
            Notification::make()
                ->title('Ez a csomag még nincs szinkronizálva a Stripe-pal.')
                ->body('Kérjük, futtassa a `php artisan stripe:sync-prices` parancsot.')
                ->danger()
                ->send();

            return;
        }

        $this->recordLegalConsent();

        // Don't create local subscription - let webhook handle it
        // Just redirect to Stripe checkout with plan info in metadata
        $checkout = Auth::user()->newSubscription('default', $stripePriceId)
            ->quantity($quantity)
            ->checkout([
                'success_url' => route('subscription.success', ['plan' => $plan->id]),
                'cancel_url' => route('subscription.cancel'),
                'metadata' => [
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                    'team_id' => $team?->id,
                    'quantity' => $quantity,
                ],
            ]);

        $this->redirect($checkout->url, navigate: false);
    }

    public function render(): View
    {
        return view('livewire.create-module-page');
    }
}
