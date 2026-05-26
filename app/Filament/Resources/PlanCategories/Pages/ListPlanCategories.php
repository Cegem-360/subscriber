<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\Pages;

use App\Filament\Resources\PlanCategories\PlanCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

class ListPlanCategories extends ListRecords
{
    protected static string $resource = PlanCategoryResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
