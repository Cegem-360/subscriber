<?php

declare(strict_types=1);

namespace App\Filament\Resources\Subscriptions\Tables;

use App\Enums\SubscriptionStatus;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('plan.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('stripe_status')
                    ->badge()
                    ->color(SubscriptionStatus::class),

                TextColumn::make('stripe_price')
                    ->label('Price')
                    ->money('USD'),

                TextColumn::make('trial_ends_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('ends_at')
                    ->label('Ends At')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Active')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Started')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('stripe_status')
                    ->options(SubscriptionStatus::class),

                SelectFilter::make('plan_id')
                    ->relationship('plan', 'name')
                    ->label('Plan'),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->active())
                    ->action(fn ($record) => $record->cancel()),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
