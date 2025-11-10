<?php

namespace App\Filament\Resources\MicroservicePermissions\Pages;

use App\Filament\Resources\MicroservicePermissions\MicroservicePermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMicroservicePermissions extends ListRecords
{
    protected static string $resource = MicroservicePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
