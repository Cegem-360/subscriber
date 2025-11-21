<?php

declare(strict_types=1);

namespace App\Models\Plan;

use App\Models\Plan;
use Database\Factories\Plan\PlanCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanCategory extends Model
{
    /** @use HasFactory<PlanCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'slug',
        'description',
    ];

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class, 'plan_category_id');
    }
}
