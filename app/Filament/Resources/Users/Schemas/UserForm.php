<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('role')
                            ->options(UserRole::class)
                            ->required()
                            ->default(UserRole::Subscriber),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state): ?string => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),

                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At'),
                    ]),

                Section::make('Billing Information')
                    ->schema([
                        TextInput::make('stripe_customer_id')
                            ->maxLength(255),

                        TextInput::make('billingo_partner_id')
                            ->numeric(),
                    ])
                    ->collapsed(),
            ]);
    }
}
