<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Subscription as CashierSubscription;

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

    public function usageLogs(): HasMany
    {
        return $this->hasMany(SubscriptionUsageLog::class);
    }

    public function hasAccessTo(string $microservice): bool
    {
        if (!$this->active()) {
            return false;
        }

        if (!$this->plan) {
            return false;
        }

        return $this->plan->hasMicroservice($microservice);
    }
}
