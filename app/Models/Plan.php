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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'price_eur',
        'billing_period',
        'stripe_price_id',
        'stripe_price_id_eur',
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
            'price_eur' => 'decimal:2',
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

    public function teamPrices(): HasMany
    {
        return $this->hasMany(TeamPlanPrice::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_plan_prices')
            ->withPivot(['price', 'price_eur', 'stripe_price_id', 'stripe_price_id_eur'])
            ->withTimestamps();
    }

    public function priceForTeam(?Team $team): ?string
    {
        return $this->teamPriceField($team, 'price') ?? $this->price;
    }

    public function priceEurForTeam(?Team $team): ?string
    {
        return $this->teamPriceField($team, 'price_eur') ?? $this->price_eur;
    }

    public function stripePriceIdForTeam(?Team $team): ?string
    {
        return $this->teamPriceField($team, 'stripe_price_id') ?? $this->stripe_price_id;
    }

    public function stripePriceIdEurForTeam(?Team $team): ?string
    {
        return $this->teamPriceField($team, 'stripe_price_id_eur') ?? $this->stripe_price_id_eur;
    }

    public function hasCustomPriceForTeam(?Team $team): bool
    {
        return $this->teamPriceField($team, 'price') !== null;
    }

    protected function teamPriceField(?Team $team, string $field): mixed
    {
        if ($team === null) {
            return null;
        }

        return $team->planPrices->firstWhere('plan_id', $this->id)?->{$field};
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
