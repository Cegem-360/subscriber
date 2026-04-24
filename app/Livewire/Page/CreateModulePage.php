<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Team;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
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

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function currentTeam(): ?Team
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
                                    ->default(BillingPeriod::Monthly->value)
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
                                                'billing_period' => BillingPeriod::tryFrom($get('billing_period')),
                                                'quantity' => $get('quantity'),
                                            ];
                                        }),
                                ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $plan = Plan::query()->findOrFail($data['plan_id']);
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
