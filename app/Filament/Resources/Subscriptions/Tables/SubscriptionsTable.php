<?php

declare(strict_types=1);

namespace App\Filament\Resources\Subscriptions\Tables;

use App\Enums\SubscriptionStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\SubscriptionItem;
use Stripe\StripeClient;

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
                TextColumn::make('plan.planCategory.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('plan.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('stripe_status')
                    ->badge(),
                TextColumn::make('plan.price')
                    ->label('Price')
                    ->money('HUF')
                    ->sortable()
                    ->placeholder('-'),

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
                Action::make('sync_items')
                    ->visible(fn (): bool => Auth::user()->isAdmin())
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->label('Sync Items')
                    ->requiresConfirmation()
                    ->modalHeading('Sync Subscription Items')
                    ->modalDescription('This will fetch the latest subscription items from Stripe and update the local database.')
                    ->modalSubmitActionLabel('Sync Now')
                    ->action(function ($record): void {
                        $stripe = new StripeClient(config('cashier.secret'));
                        $stripeSubscription = $stripe->subscriptions->retrieve($record->stripe_id);
                        $stripeItems = $stripeSubscription->items->data;

                        $synced = 0;

                        foreach ($stripeItems as $stripeItem) {
                            $existingItem = SubscriptionItem::query()->where('stripe_id', $stripeItem->id)->first();

                            if ($existingItem) {
                                $existingItem->update([
                                    'stripe_product' => $stripeItem->price->product ?? null,
                                    'stripe_price' => $stripeItem->price->id,
                                    'quantity' => $stripeItem->quantity,
                                ]);
                            } else {
                                SubscriptionItem::query()->create([
                                    'subscription_id' => $record->id,
                                    'stripe_id' => $stripeItem->id,
                                    'stripe_product' => $stripeItem->price->product ?? null,
                                    'stripe_price' => $stripeItem->price->id,
                                    'quantity' => $stripeItem->quantity,
                                ]);
                            }

                            $synced++;
                        }

                        Log::info('✅ Subscription items synced', [
                            'subscription_id' => $record->id,
                            'items_synced' => $synced,
                        ]);
                    })
                    ->successNotificationTitle('Items Synced')
                    ->after(function (): void {
                        Notification::make()
                            ->success()
                            ->title('Subscription items synced successfully')
                            ->body('The latest items have been fetched from Stripe.')
                            ->send();
                    }),
                Action::make('resume')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Előfizetés újraaktiválása')
                    ->modalDescription('Az előfizetés lemondása visszavonásra kerül, és a számlázás a jelenlegi ciklus végén folytatódik.')
                    ->modalSubmitActionLabel('Újraaktiválás')
                    ->visible(fn ($record) => $record->onGracePeriod())
                    ->action(function ($record): void {
                        // Resume subscription in Stripe
                        $record->resume();

                        // Clear the ends_at field in local database
                        $record->ends_at = null;
                        $record->save();

                        Log::info('✅ Subscription resumed', [
                            'subscription_id' => $record->id,
                            'stripe_id' => $record->stripe_id,
                        ]);
                    })
                    ->successNotificationTitle('Előfizetés újraaktivált')
                    ->successRedirectUrl(route('filament.admin.resources.subscriptions.index'))
                    ->after(function (): void {
                        Notification::make()
                            ->success()
                            ->title('Az előfizetés sikeresen újraaktiválva')
                            ->body('Az előfizetés folytatódik a jelenlegi számlázási ciklus végén.')
                            ->send();
                    }),
                Action::make('cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Előfizetés lemondása')
                    ->modalDescription(function ($record): string {
                        $stripeSubscription = $record->asStripeSubscription();
                        $periodEnd = $stripeSubscription->current_period_end ?? null;

                        if ($periodEnd) {
                            $endsAt = Date::createFromTimestamp($periodEnd);

                            return 'Az előfizetés a jelenlegi számlázási időszak végéig aktív marad. Lejárat: ' . $endsAt->format('Y. m. d.');
                        }

                        return 'Az előfizetés lemondásra kerül.';
                    })
                    ->modalSubmitActionLabel('Előfizetés lemondása')
                    ->visible(fn ($record): bool => $record->active() && ! $record->onGracePeriod())
                    ->action(function ($record): void {
                        // Cancel in Stripe
                        $record->cancel();

                        // Fetch fresh subscription data from Stripe API
                        $stripe = new StripeClient(config('cashier.secret'));
                        $stripeSubscription = $stripe->subscriptions->retrieve($record->stripe_id);

                        Log::info('📝 Subscription canceled in Stripe', [
                            'subscription_id' => $record->id,
                            'stripe_id' => $record->stripe_id,
                            'cancel_at_period_end' => $stripeSubscription->cancel_at_period_end,
                            'cancel_at' => $stripeSubscription->cancel_at,
                        ]);

                        // Update local database with the cancellation date
                        if ($stripeSubscription->cancel_at) {
                            $record->ends_at = Date::createFromTimestamp($stripeSubscription->cancel_at);
                            $record->save();

                            Log::info('✅ Local subscription updated with ends_at', [
                                'subscription_id' => $record->id,
                                'ends_at' => $record->ends_at,
                            ]);
                        }
                    })
                    ->successNotificationTitle('Előfizetés lemondva')
                    ->successRedirectUrl(route('filament.admin.resources.subscriptions.index'))
                    ->after(function ($record): void {
                        // Refresh the record to get the latest data
                        $record->refresh();

                        $endsAt = $record->ends_at;

                        if ($endsAt) {
                            Notification::make()
                                ->success()
                                ->title('Az előfizetés sikeresen lemondva')
                                ->body('Az előfizetés aktív marad eddig: ' . $endsAt->format('Y. m. d.'))
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
