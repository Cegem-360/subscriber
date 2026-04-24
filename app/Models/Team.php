<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Madbox99\UserTeamSync\Models\Team as BaseTeam;

class Team extends BaseTeam
{
    use HasFactory;

    protected static function newFactory(): TeamFactory
    {
        return TeamFactory::new();
    }

    public function planPrices(): HasMany
    {
        return $this->hasMany(TeamPlanPrice::class);
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'team_plan_prices')
            ->withPivot(['price', 'price_eur', 'stripe_price_id', 'stripe_price_id_eur'])
            ->withTimestamps();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
