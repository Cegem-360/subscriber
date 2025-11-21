<?php

declare(strict_types=1);

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates an invoice with factory', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->create(['user_id' => $user->id]);

    expect($invoice)->toBeInstanceOf(Invoice::class)
        ->and($invoice->id)->not->toBeNull()
        ->and($invoice->user_id)->toBe($user->id);
});

it('creates a paid invoice with factory', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->paid()->create(['user_id' => $user->id]);

    expect($invoice->status)->toBe(InvoiceStatus::Paid)
        ->and($invoice->stripe_payment_intent_id)->not->toBeNull()
        ->and($invoice->billingo_invoice_id)->not->toBeNull()
        ->and($invoice->billingo_synced_at)->not->toBeNull();
});

it('creates a pending invoice with factory', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->pending()->create(['user_id' => $user->id]);

    expect($invoice->status)->toBe(InvoiceStatus::Open)
        ->and($invoice->stripe_payment_intent_id)->toBeNull()
        ->and($invoice->billingo_invoice_id)->toBeNull()
        ->and($invoice->billingo_synced_at)->toBeNull();
});
