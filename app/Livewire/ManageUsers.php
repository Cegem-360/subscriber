<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\AttachSubscriptionMember;
use App\Concerns\RequiresEmailVerification;
use App\Enums\SubscriptionStatus;
use App\Enums\UserRole;
use App\Models\Subscription;
use App\Models\User;
use Filament\Actions\Action;
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

class ManageUsers extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;
    use RequiresEmailVerification;

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
                        fn ($query) => $query->whereHas(
                            'memberSubscriptions',
                            fn ($subQuery) => $subQuery->whereKey($this->selectedSubscriptionId),
                        ),
                        fn ($query) => $query->whereNull('id'),
                    ),
            )
            ->headerActions([
                Action::make('attachExistingUser')
                    ->label(__('Attach Existing Account'))
                    ->icon('heroicon-o-link')
                    ->visible(fn (): bool => $this->userEmailVerified() && ($this->getSelectedSubscription()?->availableSeats() ?? 0) > 0)
                    ->schema([
                        Select::make('user_id')
                            ->label(__('Account'))
                            ->options(fn (): array => $this->getAttachableUsers())
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $this->attachExistingUser((int) $data['user_id']);
                    }),
            ])
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
                    ->visible(fn (): bool => $this->userEmailVerified())
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
        if (! $this->guardWrite()) {
            return;
        }

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

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($rawPassword),
            'role' => UserRole::Subscriber,
            'email_verified_at' => now(),
            'company_name' => $subscription->user?->company_name ?? '-',
        ]);

        resolve(AttachSubscriptionMember::class)->handle($subscription, $user, $rawPassword);

        Notification::make()
            ->title(__('User created successfully'))
            ->success()
            ->send();

        $this->form->fill();
    }

    /**
     * @return array<int, string>
     */
    public function getAttachableUsers(): array
    {
        $subscription = $this->getSelectedSubscription();

        if (! $subscription instanceof Subscription) {
            return [];
        }

        // Only accounts within the owner's organization (shared team) may be
        // attached, so a manager cannot pull in users from another organization.
        return User::query()
            ->whereKeyNot($subscription->user_id)
            ->whereDoesntHave(
                'memberSubscriptions',
                fn ($query) => $query->whereKey($subscription->id),
            )
            ->inOrganizationOf($subscription->user)
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn (User $user): array => [
                $user->id => "{$user->name} ({$user->email})",
            ])
            ->all();
    }

    public function attachExistingUser(int $userId): void
    {
        if (! $this->guardWrite()) {
            return;
        }

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

        $user = User::query()->find($userId);

        if (! $user instanceof User) {
            Notification::make()
                ->title(__('Account not found'))
                ->danger()
                ->send();

            return;
        }

        $isInOrganization = User::query()
            ->whereKey($user->id)
            ->inOrganizationOf($subscription->user)
            ->exists();

        if (! $isInOrganization) {
            Notification::make()
                ->title(__('This account is not in your organization'))
                ->danger()
                ->send();

            return;
        }

        if ($subscription->members()->whereKey($user->id)->exists()) {
            Notification::make()
                ->title(__('This account is already attached to the subscription'))
                ->danger()
                ->send();

            return;
        }

        resolve(AttachSubscriptionMember::class)->handle($subscription, $user);

        $this->resetTable();

        Notification::make()
            ->title(__('Account attached successfully'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.manage-users', [
            'subscriptions' => $this->getSubscriptions(),
            'selectedSubscription' => $this->getSelectedSubscription(),
        ]);
    }
}
