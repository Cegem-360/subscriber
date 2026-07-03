<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\RelationManagers;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Override;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    protected static ?string $title = 'Előfizetések';

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('stripe_id')
            ->columns([
                TextColumn::make('plan.planCategory.name')
                    ->label('Modul')
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('plan.name')
                    ->label('Csomag')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('stripe_status')
                    ->label('Állapot')
                    ->badge(),
                TextColumn::make('quantity')
                    ->label('Férőhelyek')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('effective_price')
                    ->label('Ár')
                    ->state(fn (Subscription $record): ?string => $record->effectivePrice())
                    ->money('HUF')
                    ->placeholder('-'),
                TextColumn::make('trial_ends_at')
                    ->label('Trial vége')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('ends_at')
                    ->label('Lemondás')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Kezdés')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('stripe_status')
                    ->label('Állapot')
                    ->options(SubscriptionStatus::class),
            ]);
    }
}
