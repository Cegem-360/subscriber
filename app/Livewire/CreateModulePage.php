<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\SubscriptionType;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateModulePage extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->schema([
                        Step::make(__('Module'))
                            ->schema([
                                Select::make('module')
                                    ->live()
                                    ->label(__('Module'))
                                    ->options(PlanCategory::all()->pluck('name', 'id')->toArray())
                                    ->required(),
                            ]),
                        Step::make(__('Package Type'))
                            ->schema([
                                ViewField::make('plan_id')
                                    ->view('components.plan-card-selector')
                                    ->viewData(function (Get $get) {
                                        return [
                                            'plans' => Plan::wherePlanCategoryId($get('module'))
                                                ->active()
                                                ->orderBy('sort_order')
                                                ->get(),
                                        ];
                                    })
                                    ->required(),
                            ]),
                        Step::make(__('Time Period'))
                            ->schema([
                                Select::make('type')
                                    ->label(__('Time Period'))
                                    ->options(SubscriptionType::class)
                                    ->enum(SubscriptionType::class)
                                    ->required(),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        unset($data['module']);
        $data['quantity'] = 1;
        $record = Subscription::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->title(__('Subscription created successfully'))
            ->success()
            ->send();
        if (! Auth::check()) {
            Auth::loginUsingId(User::find(1)->id);
        }
        $this->redirectRoute('subscriptions');
    }

    public function render(): View
    {
        return view('livewire.create-module-page');
    }
}
