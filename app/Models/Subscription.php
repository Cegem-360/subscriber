<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SubscriptionStatus;
use App\Models\Scopes\ForCurrentUserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Subscription as CashierSubscription;

#[ScopedBy([ForCurrentUserScope::class])]
class Subscription extends CashierSubscription
{
    protected $fillable = [
        'user_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'plan_id',
    ];

    protected function casts(): array
    {
        return [
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

    public function permissions(): HasMany
    {
        return $this->hasMany(MicroservicePermission::class);
    }

    public function hasAccessTo(string $microservice): bool
    {
        if (! $this->active()) {
            return false;
        }

        if (! $this->plan) {
            return false;
        }

        return $this->plan->hasMicroservice($microservice);
    }
}
