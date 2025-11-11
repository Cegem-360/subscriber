<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'stripe_invoice_id',
        'stripe_payment_intent_id',
        'billingo_invoice_id',
        'invoice_number',
        'amount',
        'currency',
        'status',
        'billingo_synced_at',
        'pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => InvoiceStatus::class,
            'billingo_synced_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    #[Scope]
    protected function paid(Builder $query): void
    {
        $query->where('status', InvoiceStatus::Paid);
    }

    #[Scope]
    protected function pending(Builder $query): void
    {
        $query->where('status', InvoiceStatus::Open);
    }

    public function isPaid(): bool
    {
        return $this->status === InvoiceStatus::Paid;
    }

    public function isSyncedToBillingo(): bool
    {
        return ! is_null($this->billingo_invoice_id);
    }

    public function markAsPaid(): void
    {
        $this->update(['status' => InvoiceStatus::Paid]);
    }
}
