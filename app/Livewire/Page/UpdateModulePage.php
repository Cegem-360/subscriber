<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Concerns\RequiresEmailVerification;
use App\Enums\BillingPeriod;
use App\Models\Plan;
use App\Models\Subscription;
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
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class UpdateModulePage extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use RequiresEmailVerification;

    public ?array $data = [];

    public Subscription $subscription;

    public function mount(Subscription $subscription): void
    {
        $this->subscription = $subscription;

        $this->form->fill([
            'billing_period' => $subscription->plan?->billing_period?->value,
            'plan_id' => $subscription->plan_id,
            'quantity' => $subscription->quantity ?? 1,
        ]);
    }

    /**
     * Switch the billing period and clear any previously selected plan, so a
     * plan from the other period can never leak through into the update.
     */
    public function selectBillingPeriod(string $period): void
    {
        $this->data['billing_period'] = $period;
        $this->data['plan_id'] = null;
    }

    public function form(Schema $schema): Schema
    {
        $categoryId = $this->subscription->plan?->plan_category_id;

        return $schema
            ->components([
                Wizard::make()
                    ->submitAction(new HtmlString(view('components.wizard-submit-button', ['label' => __('Update Subscription')])->render()))
                    ->schema([
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
                                        'plans' => Plan::wherePlanCategoryId($categoryId)
                                            ->whereBillingPeriod($get('billing_period'))
                                            ->active()
                                            ->orderBy('sort_order')
                                            ->get(),
                                        'currentPlanId' => $this->subscription->plan_id,
                                    ])
                                    ->required(),
                            ]),
                        Step::make(__('Seats'))
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('quantity')
                                            ->live()
                                            ->afterStateUpdated(function (UpdateModulePage $livewire, ?int $state): void {
                                                if ($state < 1) {
                                                    $livewire->data['quantity'] = 1;
                                                }
                                            })
                                            ->label(__('Seats'))
                                            ->required()
                                            ->integer()
                                            ->minValue(1),
                                    ]),
                                Section::make()->schema([
                                    ViewField::make('summary')
                                        ->view('components.subscription-update-summary')
                                        ->viewData(function (Get $get): array {
                                            $newPlan = Plan::query()->find($get('plan_id'));
                                            $currentPlan = $this->subscription->plan;

                                            return [
                                                'currentPlan' => $currentPlan,
                                                'newPlan' => $newPlan,
                                                'currentQuantity' => $this->subscription->quantity ?? 1,
                                                'newQuantity' => $get('quantity'),
                                                'billing_period' => filled($get('billing_period'))
                                                    ? BillingPeriod::tryFrom($get('billing_period'))
                                                    : null,
                                            ];
                                        }),
                                ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function update(): void
    {
        if (! $this->guardWrite()) {
            return;
        }

        $data = $this->form->getState();
        $newPlanId = $data['plan_id'];
        $newQuantity = (int) $data['quantity'];
        $currentPlanId = $this->subscription->plan_id;
        $currentQuantity = $this->subscription->quantity ?? 1;

        $newPlan = Plan::query()->findOrFail($newPlanId);

        if ($newPlan->billing_period?->value !== ($data['billing_period'] ?? null)) {
            Notification::make()
                ->title(__('The selected package billing period does not match.'))
                ->body(__('Please reselect the monthly or yearly package.'))
                ->danger()
                ->send();

            return;
        }

        // Check if subscription is linked to Stripe
        if (! $this->subscription->stripe_id) {
            Notification::make()
                ->title(__('This subscription is not linked to Stripe'))
                ->body(__('Please contact support to resolve this issue.'))
                ->danger()
                ->send();

            return;
        }

        // Check if plan changed
        if ($newPlanId !== $currentPlanId) {
            // Swap plan with proration
            $this->subscription->swapAndInvoice($newPlan->stripe_price_id);
            $this->subscription->update(['plan_id' => $newPlanId]);
        }

        // Check if quantity changed
        if ($newQuantity !== $currentQuantity) {
            $this->subscription->updateQuantity($newQuantity);
        }

        Notification::make()
            ->title(__('Subscription updated successfully'))
            ->success()
            ->send();

        $this->redirect(route('subscriptions'), navigate: false);
    }

    public function render(): View
    {
        return view('livewire.update-module-page');
    }
}
