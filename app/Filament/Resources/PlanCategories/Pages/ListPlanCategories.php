<?php

namespace App\Filament\Resources\PlanCategories\Pages;

use App\Filament\Resources\PlanCategories\PlanCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlanCategories extends ListRecords
{
    protected static string $resource = PlanCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
