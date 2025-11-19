<?php

declare(strict_types=1);

namespace App\Filament\Resources\Plans\Tables;

use App\Enums\BillingPeriod;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('billing_period')
                    ->badge()
                    ->color(fn (BillingPeriod $state): string => match ($state) {
                        BillingPeriod::Monthly => 'info',
                        BillingPeriod::Yearly => 'success',
                    }),

                TextColumn::make('subscriptions_count')
                    ->counts('subscriptions')
                    ->label('Subscribers')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->label('Active'),

                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Plans')
                    ->placeholder('All plans')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),

                SelectFilter::make('billing_period')
                    ->options([
                        BillingPeriod::Monthly->value => 'Monthly',
                        BillingPeriod::Yearly->value => 'Yearly',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('toggle_status')
                    ->label(fn ($record): string => $record->is_active ? 'Deactivate' : 'Activate')
                    ->icon('heroicon-o-arrow-path')
                    ->color(fn ($record): string => $record->is_active ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update(['is_active' => ! $record->is_active])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}
