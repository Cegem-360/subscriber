<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Auth;

class RecentInvoicesWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $query = Invoice::query()->latest()->limit(10);

        if (Auth::user()?->isSubscriber()) {
            $query->where('user_id', Auth::id());
        }

        return $table
            ->query($query)
            ->columns([
                TextColumn::make('invoice_number')
                    ->label('Invoice #')
                    ->searchable(),

                TextColumn::make('amount')
                    ->money('currency')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(InvoiceStatus::class),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
