<?php

declare(strict_types=1);

namespace App\Filament\Resources\Subscriptions\RelationManagers;

use App\Actions\AttachSubscriptionMember;
use App\Actions\DetachSubscriptionMember;
use App\Enums\UserRole;
use App\Models\Subscription;
use App\Models\User;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Override;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    #[Override]
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Members');
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->required()
                    ->unique('users', 'email', ignoreRecord: true),
                TextInput::make('password')
                    ->label(__('Password'))
                    ->password()
                    ->minLength(8)
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
                Select::make('role')
                    ->label(__('Role'))
                    ->options([
                        UserRole::Subscriber->value => __('Subscriber'),
                        UserRole::Manager->value => __('Manager'),
                    ])
                    ->default(UserRole::Subscriber->value)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(__('Create User'))
                    ->visible(fn (): bool => $this->subscription()->availableSeats() > 0)
                    ->using(function (array $data): User {
                        $rawPassword = $data['password'];

                        $subscription = $this->subscription();

                        $user = User::query()->create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => Hash::make($rawPassword),
                            'role' => $data['role'],
                            'email_verified_at' => now(),
                            'company_name' => $subscription->user?->company_name ?? '-',
                        ]);

                        app(AttachSubscriptionMember::class)->handle($subscription, $user, $rawPassword);

                        return $user;
                    }),
                AttachAction::make()
                    ->label(__('Attach Existing Account'))
                    ->recordSelectOptionsQuery(fn (Builder $query): Builder => $query
                        ->whereKeyNot($this->subscription()->user_id)
                        ->whereHas('teams', fn (Builder $teams): Builder => $teams->whereIn(
                            'teams.id',
                            $this->subscription()->user?->teams()->pluck('teams.id')->all() ?? [],
                        )))
                    ->visible(fn (): bool => $this->subscription()->availableSeats() > 0)
                    ->after(function (array $data): void {
                        $user = User::query()->find($data['recordId'] ?? null);

                        if ($user instanceof User) {
                            app(AttachSubscriptionMember::class)->handle($this->subscription(), $user);
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->using(function (User $record, array $data): User {
                        if (filled($data['password'] ?? null)) {
                            $data['password'] = Hash::make($data['password']);
                        }

                        $record->update($data);

                        return $record;
                    }),
                DetachAction::make()
                    ->after(function (User $record): void {
                        app(DetachSubscriptionMember::class)->handle($this->subscription(), $record);
                    }),
            ]);
    }

    private function subscription(): Subscription
    {
        /** @var Subscription $subscription */
        $subscription = $this->getOwnerRecord();

        return $subscription;
    }
}
