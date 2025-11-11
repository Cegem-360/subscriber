<?php

declare(strict_types=1);

namespace App\Filament\Resources\Invoices\Schemas;

use App\Enums\InvoiceStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('subscription_id')
                    ->relationship('subscription', 'id'),
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
    }
}
