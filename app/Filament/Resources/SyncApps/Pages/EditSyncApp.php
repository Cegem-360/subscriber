<?php

declare(strict_types=1);

namespace App\Filament\Resources\SyncApps\Pages;

use Override;
use App\Filament\Resources\SyncApps\SyncAppResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSyncApp extends EditRecord
{
    protected static string $resource = SyncAppResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
