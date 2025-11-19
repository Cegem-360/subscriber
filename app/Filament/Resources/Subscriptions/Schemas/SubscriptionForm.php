<?php

declare(strict_types=1);

namespace App\Filament\Resources\Subscriptions\Schemas;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->visible(fn (): bool => Auth::user()?->isAdmin())
                ->required()
                ->preload()
                ->searchable(),
            Select::make('plan_id')
                ->relationship('plan', 'name')
                ->preload()
                ->required(),
            Select::make('type')
                ->options(SubscriptionType::class)
                ->enum(SubscriptionType::class)
                ->default(SubscriptionType::Monthly)
                ->required(),
            TextInput::make('stripe_id')
                ->unique(ignoreRecord: true)
                ->required(),
            Select::make('stripe_status')
                ->required()
                ->options(SubscriptionStatus::class),
            TextInput::make('stripe_price'),
            TextInput::make('quantity')
                ->numeric(),
            DateTimePicker::make('trial_ends_at'),
            DateTimePicker::make('ends_at'),
        ]);
    }
}
