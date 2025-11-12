<?php

declare(strict_types=1);

namespace App\Filament\Resources\MicroservicePermissions\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MicroservicePermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subscription.user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subscription.plan.name')
                    ->label('Plan')
                    ->badge()
                    ->color('info'),

                TextColumn::make('microservice_name')
                    ->searchable()
                    ->weight('bold'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->label('Active'),

                TextColumn::make('activated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Never')
                    ->color(fn ($record) => $record->isExpired() ? 'danger' : null),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),

                TernaryFilter::make('expired')
                    ->label('Expiration Status')
                    ->placeholder('All')
                    ->trueLabel('Expired only')
                    ->falseLabel('Active/Not expired')
                    ->queries(
                        true: fn ($query) => $query->where('expires_at', '<=', now()),
                        false: fn ($query) => $query->where(function ($q) {
                            $q->whereNull('expires_at')
                                ->orWhere('expires_at', '>', now());
                        }),
                    ),

                SelectFilter::make('microservice_slug')
                    ->label('Microservice')
                    ->options([
                        'service-a' => 'Service A',
                        'service-b' => 'Service B',
                        'service-c' => 'Service C',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('toggle_active')
                    ->label(fn ($record) => $record->is_active ? 'Deactivate' : 'Activate')
                    ->icon('heroicon-o-arrow-path')
                    ->color(fn ($record) => $record->is_active ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update(['is_active' => ! $record->is_active])),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
