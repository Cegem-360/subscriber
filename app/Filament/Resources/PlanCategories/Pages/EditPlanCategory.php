<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\Pages;

use Override;
use App\Filament\Resources\PlanCategories\PlanCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlanCategory extends EditRecord
{
    protected static string $resource = PlanCategoryResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
