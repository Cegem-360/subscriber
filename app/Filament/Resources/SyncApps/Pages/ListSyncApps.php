<?php

declare(strict_types=1);

namespace App\Filament\Resources\SyncApps\Pages;

use App\Filament\Resources\SyncApps\SyncAppResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSyncApps extends ListRecords
{
    protected static string $resource = SyncAppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
