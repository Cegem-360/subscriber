<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\Pages;

use App\Filament\Resources\PlanCategories\PlanCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePlanCategory extends CreateRecord
{
    protected static string $resource = PlanCategoryResource::class;
}
