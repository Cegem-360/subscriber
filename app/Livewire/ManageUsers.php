<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\SubscriptionStatus;
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
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

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
        return Subscription::query()->withoutGlobalScopes()
            ->where('user_id', Auth::id())
            ->where('stripe_status', SubscriptionStatus::Active)
            ->get();
    }

    public function getSelectedSubscription(): ?Subscription
    {
        if (! $this->selectedSubscriptionId) {
            return null;
        }

        return Subscription::query()->withoutGlobalScopes()
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
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->minLength(8),
                        Select::make('role')
                            ->label(__('Role'))
                            ->options([
                                UserRole::Subscriber->value => __('Subscriber'),
                                UserRole::Manager->value => __('Manager'),
                            ])
                            ->required(),
                    ])
                    ->using(function (User $record, array $data): User {
                        $rawPassword = $data['password'] ?? null;

                        if (filled($rawPassword)) {
                            $data['password'] = Hash::make($rawPassword);
                        }

                        $record->update($data);

                        if (filled($rawPassword)) {
                            UserTeamSync::syncPassword($record->email, $rawPassword);
                        }

                        return $record;
                    }),
            ]);
    }

    public function createUser(): void
    {
        $subscription = $this->getSelectedSubscription();

        if (! $subscription instanceof Subscription) {
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
        $rawPassword = $data['password'];

        User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($rawPassword),
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription->id,
            'email_verified_at' => now(),
            'company_name' => $subscription->user?->company_name ?? '-',
        ]);

        UserTeamSync::createUser(
            email: $data['email'],
            name: $data['name'],
            password: $rawPassword,
            role: UserRole::Subscriber->value,
            ownerEmail: $subscription->user?->email ?? '',
        );

        $appKey = $subscription->plan?->planCategory?->slug;

        if ($appKey !== null && $appKey !== '') {
            ToggleUserActiveJob::dispatch(
                userEmail: $data['email'],
                isActive: true,
                appKey: $appKey,
            )->delay(now()->addSeconds(20));
        }

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
