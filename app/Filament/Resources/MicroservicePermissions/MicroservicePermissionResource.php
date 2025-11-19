<?php

declare(strict_types=1);

namespace App\Filament\Resources\MicroservicePermissions;

use App\Filament\Resources\MicroservicePermissions\Pages\CreateMicroservicePermission;
use App\Filament\Resources\MicroservicePermissions\Pages\EditMicroservicePermission;
use App\Filament\Resources\MicroservicePermissions\Pages\ListMicroservicePermissions;
use App\Filament\Resources\MicroservicePermissions\Schemas\MicroservicePermissionForm;
use App\Filament\Resources\MicroservicePermissions\Tables\MicroservicePermissionsTable;
use App\Models\MicroservicePermission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MicroservicePermissionResource extends Resource
{
    protected static ?string $model = MicroservicePermission::class;

    public static function getNavigationLabel(): string
    {
        return __('Services');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    public static function form(Schema $schema): Schema
    {
        return MicroservicePermissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MicroservicePermissionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMicroservicePermissions::route('/'),
            'create' => CreateMicroservicePermission::route('/create'),
            'edit' => EditMicroservicePermission::route('/{record}/edit'),
        ];
    }
}
