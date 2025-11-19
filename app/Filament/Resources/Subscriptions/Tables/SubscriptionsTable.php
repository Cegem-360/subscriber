<?php

declare(strict_types=1);

namespace App\Filament\Resources\Subscriptions\Tables;

use App\Enums\SubscriptionStatus;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => Auth::user()?->isAdmin() ?? false)
                    ->weight('bold'),

                TextColumn::make('plan.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('stripe_status')
                    ->badge(),
                TextColumn::make('stripe_price')
                    ->label('Price')
                    ->money('HUF'),

                TextColumn::make('trial_ends_at')
                    ->label('Trial Ends')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-')
                    ->description(fn ($record) => $record->trial_ends_at
                        ? ($record->trial_ends_at->isFuture()
                            ? 'Ends in ' . $record->trial_ends_at->diffForHumans(['parts' => 1])
                            : 'Trial ended')
                        : null)
                    ->toggleable(),

                TextColumn::make('ends_at')
                    ->label('Cancellation')
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state): string => $state ? 'danger' : 'success')
                    ->formatStateUsing(fn ($state): string => match (true) {
                        $state && $state->isPast() => 'Expired',
                        $state && $state->isFuture() => 'Ends ' . $state->diffForHumans(['parts' => 1]),
                        default => 'Active',
                    })
                    ->description(fn ($state) => $state?->format('M d, Y'))
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
