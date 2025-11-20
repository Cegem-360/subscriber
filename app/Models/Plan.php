<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BillingPeriod;
use App\Models\Plan\PlanCategory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'plan_category_id',
        'description',
        'price',
        'billing_period',
        'stripe_price_id',
        'stripe_product_id',
        'features',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'billing_period' => BillingPeriod::class,
        ];
    }

    public function planCategory(): BelongsTo
    {
        return $this->belongsTo(PlanCategory::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
