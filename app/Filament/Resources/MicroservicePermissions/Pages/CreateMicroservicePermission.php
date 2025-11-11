<?php

declare(strict_types=1);

namespace App\Filament\Resources\MicroservicePermissions\Pages;

use App\Filament\Resources\MicroservicePermissions\MicroservicePermissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMicroservicePermission extends CreateRecord
{
    protected static string $resource = MicroservicePermissionResource::class;
}
