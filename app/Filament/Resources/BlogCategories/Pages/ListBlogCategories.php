<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogCategories\Pages;

use Override;
use App\Filament\Resources\BlogCategories\BlogCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBlogCategories extends ListRecords
{
    protected static string $resource = BlogCategoryResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
