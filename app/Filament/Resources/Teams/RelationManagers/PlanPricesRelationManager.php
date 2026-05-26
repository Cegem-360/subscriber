<?php

declare(strict_types=1);

namespace App\Filament\Resources\Teams\RelationManagers;

use Override;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlanPricesRelationManager extends RelationManager
{
    protected static string $relationship = 'planPrices';

    protected static ?string $title = 'Egyedi árak';

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('plan_id')
                    ->label('Csomag')
                    ->relationship('plan', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                Grid::make(2)->schema([
                    TextInput::make('price')
                        ->label('Ár (HUF)')
                        ->numeric()
                        ->step(0.01)
                        ->suffix('Ft'),
                    TextInput::make('price_eur')
                        ->label('Ár (EUR)')
                        ->numeric()
                        ->step(0.01)
                        ->suffix('EUR'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('stripe_price_id')
                        ->label('Stripe Price ID (HUF)')
                        ->maxLength(255),
                    TextInput::make('stripe_price_id_eur')
                        ->label('Stripe Price ID (EUR)')
                        ->maxLength(255),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('plan.name')
            ->columns([
                TextColumn::make('plan.name')
                    ->label('Csomag')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('HUF')
                    ->money('HUF', locale: 'hu')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('price_eur')
                    ->label('EUR')
                    ->money('EUR', locale: 'hu')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('stripe_price_id')
                    ->label('Stripe (HUF)')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stripe_price_id_eur')
                    ->label('Stripe (EUR)')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('plan.name')
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
