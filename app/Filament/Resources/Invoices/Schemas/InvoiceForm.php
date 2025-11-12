<?php

declare(strict_types=1);

namespace App\Filament\Resources\Invoices\Schemas;

use App\Enums\InvoiceStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        $components = [];

        if (Auth::user()?->isAdmin()) {
            $components[] = Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->searchable();
        }

        $components[] = Select::make('subscription_id')
            ->relationship(
                'subscription',
                'id',
                fn ($query) => Auth::user()?->isAdmin()
                    ? $query
                    : $query->where('user_id', Auth::id()),
            );

        $components = array_merge($components, [
            TextInput::make('stripe_invoice_id'),
            TextInput::make('stripe_payment_intent_id'),
            TextInput::make('billingo_invoice_id'),
            TextInput::make('invoice_number'),
            TextInput::make('amount')
                ->required()
                ->numeric(),
            TextInput::make('currency')
                ->required()
                ->default('USD'),
            Select::make('status')
                ->required()
                ->options(InvoiceStatus::class)
                ->default(InvoiceStatus::Draft),
            DateTimePicker::make('billingo_synced_at'),
            TextInput::make('pdf_path'),
        ]);

        return $schema->components($components);
    }
}
