<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TeamPlanPriceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamPlanPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'plan_id',
        'price',
        'price_eur',
        'stripe_price_id',
        'stripe_price_id_eur',
    ];

    protected static function newFactory(): TeamPlanPriceFactory
    {
        return TeamPlanPriceFactory::new();
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'price_eur' => 'decimal:2',
        ];
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
