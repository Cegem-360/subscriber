<?php

declare(strict_types=1);

namespace App\Filament\Resources\Invoices\Tables;

use App\Enums\InvoiceStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->placeholder('Pending'),

                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(InvoiceStatus::class),

                IconColumn::make('billingo_synced_at')
                    ->label('Billingo Synced')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->getStateUsing(fn ($record) => ! is_null($record->billingo_invoice_id)),

                TextColumn::make('billingo_synced_at')
                    ->label('Synced At')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Not synced')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(InvoiceStatus::class),

                SelectFilter::make('billingo_synced')
                    ->label('Billingo Sync Status')
                    ->options([
                        'synced' => 'Synced',
                        'not_synced' => 'Not Synced',
                    ])
                    ->query(function ($query, $state) {
                        if ($state['value'] === 'synced') {
                            return $query->whereNotNull('billingo_invoice_id');
                        }
                        if ($state['value'] === 'not_synced') {
                            return $query->whereNull('billingo_invoice_id');
                        }

                        return $query;
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('sync_to_billingo')
                    ->label('Sync to Billingo')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->visible(fn ($record) => is_null($record->billingo_invoice_id))
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        // TODO: Implement Billingo sync logic
                        Notification::make()
                            ->title('Billingo sync queued')
                            ->body('Invoice will be synced to Billingo shortly')
                            ->success()
                            ->send();
                    }),
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn ($record) => ! is_null($record->pdf_path))
                    ->url(fn ($record) => storage_path('app/' . $record->pdf_path))
                    ->openUrlInNewTab(),
                Action::make('mark_as_paid')
                    ->label('Mark as Paid')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== InvoiceStatus::Paid)
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->markAsPaid()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
