<?php

declare(strict_types=1);

namespace App\Filament\Resources\Plans\Schemas;

use App\Enums\BillingPeriod;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                Select::make('plan_category_id')
                                    ->relationship('planCategory', 'name')
                                    ->preload(),
                            ]),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$')
                                    ->step(0.01),
                                TextInput::make('quantity')
                                    ->label(__('Seats'))
                                    ->required()
                                    ->numeric()
                                    ->default(1),
                                Select::make('billing_period')
                                    ->required()
                                    ->options(BillingPeriod::class)
                                    ->default(BillingPeriod::Monthly),

                                TextInput::make('sort_order')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                Section::make('Stripe Integration')
                    ->schema([
                        TextInput::make('stripe_price_id')
                            ->label('Stripe Price ID')
                            ->helperText('Get this from Stripe Dashboard after creating the price'),

                        TextInput::make('stripe_product_id')
                            ->label('Stripe Product ID')
                            ->helperText('Get this from Stripe Dashboard after creating the product'),
                    ])
                    ->collapsed(),

                Section::make('Features')
                    ->schema([
                        TagsInput::make('features')
                            ->helperText('Enter features and press Enter')
                            ->placeholder('Add a feature...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive plans cannot be subscribed to'),
                    ]),
            ]);
    }
}
