<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\Subscription;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ManageUsers extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public ?int $selectedSubscriptionId = null;

    public ?array $data = [];

    public function mount(): void
    {
        // Select first active subscription by default
        $firstSubscription = $this->getSubscriptions()->first();
        if ($firstSubscription) {
            $this->selectedSubscriptionId = $firstSubscription->id;
        }
        $this->form->fill();
    }

    public function getSubscriptions()
    {
        return Subscription::withoutGlobalScopes()
            ->where('user_id', Auth::id())
            ->where('stripe_status', 'active')
            ->with(['plan', 'members'])
            ->get();
    }

    public function getSelectedSubscription(): ?Subscription
    {
        if (! $this->selectedSubscriptionId) {
            return null;
        }

        return Subscription::withoutGlobalScopes()
            ->with(['plan', 'members'])
            ->find($this->selectedSubscriptionId);
    }

    public function selectSubscription(int $subscriptionId): void
    {
        $this->selectedSubscriptionId = $subscriptionId;
        $this->resetTable();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Add New User'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->unique('users', 'email')
                            ->required(),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required()
                            ->minLength(8),
                    ]),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->when(
                        $this->selectedSubscriptionId,
                        fn ($query) => $query->where('subscription_id', $this->selectedSubscriptionId),
                        fn ($query) => $query->whereNull('id'),
                    ),
            )
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                TextColumn::make('role')
                    ->label(__('Role')),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->dateTime(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('Edit'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required()
                            ->unique('users', 'email', ignoreRecord: true),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->minLength(8),
                        Select::make('role')
                            ->label(__('Role'))
                            ->options([
                                UserRole::Subscriber->value => __('Subscriber'),
                                UserRole::Manager->value => __('Manager'),
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public function createUser(): void
    {
        $subscription = $this->getSelectedSubscription();

        if (! $subscription) {
            Notification::make()
                ->title(__('Please select a subscription first'))
                ->danger()
                ->send();

            return;
        }

        if ($subscription->availableSeats() <= 0) {
            Notification::make()
                ->title(__('No available seats in this subscription'))
                ->body(__('Maximum users reached: :max', ['max' => $subscription->quantity]))
                ->danger()
                ->send();

            return;
        }

        $data = $this->form->getState();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription->id,
            'email_verified_at' => now(),
        ]);

        Notification::make()
            ->title(__('User created successfully'))
            ->success()
            ->send();

        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.manage-users', [
            'subscriptions' => $this->getSubscriptions(),
            'selectedSubscription' => $this->getSelectedSubscription(),
        ]);
    }
}
