<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\RelationManagers;

use App\Enums\BillingPeriod;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlansRelationManager extends RelationManager
{
    protected static string $relationship = 'plans';

    protected static ?string $title = 'Csomagok';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Név')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Select::make('billing_period')
                    ->label('Számlázási időszak')
                    ->options(BillingPeriod::class)
                    ->required(),
                Grid::make(2)->schema([
                    TextInput::make('price')
                        ->label('Ár (HUF)')
                        ->numeric()
                        ->required()
                        ->suffix('Ft'),
                    TextInput::make('price_eur')
                        ->label('Ár (EUR)')
                        ->numeric()
                        ->suffix('EUR'),
                ]),
                Textarea::make('description')
                    ->label('Leírás')
                    ->columnSpanFull(),
                TagsInput::make('features')
                    ->label('Funkciók')
                    ->placeholder('Új funkció hozzáadása...')
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    TextInput::make('stripe_price_id')
                        ->label('Stripe Price ID')
                        ->maxLength(255),
                    TextInput::make('stripe_product_id')
                        ->label('Stripe Product ID')
                        ->maxLength(255),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('sort_order')
                        ->label('Sorrend')
                        ->numeric()
                        ->default(0),
                    Checkbox::make('is_active')
                        ->label('Aktív')
                        ->default(true),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('billing_period')
                    ->label('Időszak')
                    ->badge(),
                TextColumn::make('price')
                    ->label('HUF')
                    ->money('HUF', locale: 'hu')
                    ->sortable(),
                TextColumn::make('price_eur')
                    ->label('EUR')
                    ->money('EUR', locale: 'hu')
                    ->sortable()
                    ->placeholder('-'),
                IconColumn::make('is_active')
                    ->label('Aktív')
                    ->boolean(),
                TextColumn::make('stripe_price_id')
                    ->label('Stripe')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('billing_period')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
