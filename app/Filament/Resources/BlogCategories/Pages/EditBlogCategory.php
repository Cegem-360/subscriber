<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogCategories\Pages;

use Override;
use App\Filament\Resources\BlogCategories\BlogCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogCategory extends EditRecord
{
    protected static string $resource = BlogCategoryResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
