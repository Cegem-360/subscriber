<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Scopes\ForCurrentUserScope;
use App\Observers\SubscriptionObserver;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Subscription as CashierSubscription;

#[ScopedBy([ForCurrentUserScope::class])]
#[ObservedBy([SubscriptionObserver::class])]
class Subscription extends CashierSubscription
{
    use HasFactory;

    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }

    protected $fillable = [
        'user_id',
        'plan_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => SubscriptionType::class,
            'stripe_status' => SubscriptionStatus::class,
            'trial_ends_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function localInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'subscription_id');
    }

    public function availableSeats(): int
    {
        // quantity includes the owner, so available = quantity - 1 (owner) - members
        return ($this->quantity ?? 0) - 1 - $this->members()->count();
    }

    public function isActive(): bool
    {
        return $this->stripe_status === SubscriptionStatus::Active;
    }

    #[Scope]
    protected function activeSubscription($query): void
    {
        $query->where('stripe_status', SubscriptionStatus::Active);
    }
}
