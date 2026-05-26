<?php

declare(strict_types=1);

namespace App\Filament\Resources\SyncApps;

use Override;
use App\Filament\Resources\SyncApps\Pages\CreateSyncApp;
use App\Filament\Resources\SyncApps\Pages\EditSyncApp;
use App\Filament\Resources\SyncApps\Pages\ListSyncApps;
use App\Filament\Resources\SyncApps\Schemas\SyncAppForm;
use App\Filament\Resources\SyncApps\Tables\SyncAppsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Madbox99\UserTeamSync\Models\SyncApp;
use UnitEnum;

class SyncAppResource extends Resource
{
    protected static ?string $model = SyncApp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedServerStack;

    protected static UnitEnum|string|null $navigationGroup = 'Settings';

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->isAdmin();
    }

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return SyncAppForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return SyncAppsTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListSyncApps::route('/'),
            'create' => CreateSyncApp::route('/create'),
            'edit' => EditSyncApp::route('/{record}/edit'),
        ];
    }
}
