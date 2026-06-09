<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Scopes\ForCurrentUserScope;
use App\Observers\SubscriptionObserver;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Subscription as CashierSubscription;
use Override;

#[ScopedBy([ForCurrentUserScope::class])]
#[ObservedBy([SubscriptionObserver::class])]
#[Fillable([
    'user_id',
    'team_id',
    'plan_id',
    'type',
    'stripe_id',
    'stripe_status',
    'stripe_price',
    'quantity',
    'trial_ends_at',
    'ends_at',
])]
class Subscription extends CashierSubscription
{
    use HasFactory;

    #[Override]
    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'type' => SubscriptionType::class,
            'stripe_status' => SubscriptionStatus::class,
            'trial_ends_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    #[Override]
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function teamPlanPrice(): ?TeamPlanPrice
    {
        if ($this->team_id === null || $this->plan_id === null) {
            return null;
        }

        return $this->team?->planPrices->firstWhere('plan_id', $this->plan_id);
    }

    public function effectivePrice(): ?string
    {
        return $this->effective('price');
    }

    public function effectivePriceEur(): ?string
    {
        return $this->effective('price_eur');
    }

    public function effectiveStripePriceId(): ?string
    {
        return $this->effective('stripe_price_id');
    }

    public function effectiveStripePriceIdEur(): ?string
    {
        return $this->effective('stripe_price_id_eur');
    }

    protected function effective(string $field): mixed
    {
        return $this->teamPlanPrice()?->{$field} ?? $this->plan?->{$field};
    }

    public function localInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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
