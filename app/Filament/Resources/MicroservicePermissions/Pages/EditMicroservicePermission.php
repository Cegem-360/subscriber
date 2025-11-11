<?php

declare(strict_types=1);

namespace App\Filament\Resources\MicroservicePermissions\Pages;

use App\Filament\Resources\MicroservicePermissions\MicroservicePermissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMicroservicePermission extends EditRecord
{
    protected static string $resource = MicroservicePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
