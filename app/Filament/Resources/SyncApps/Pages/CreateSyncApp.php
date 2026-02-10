<?php

declare(strict_types=1);

namespace App\Filament\Resources\SyncApps\Pages;

use App\Filament\Resources\SyncApps\SyncAppResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSyncApp extends CreateRecord
{
    protected static string $resource = SyncAppResource::class;
}
