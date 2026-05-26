<?php

declare(strict_types=1);

namespace App\Filament\Resources\Teams;

use Override;
use App\Filament\Resources\Teams\Pages\CreateTeam;
use App\Filament\Resources\Teams\Pages\EditTeam;
use App\Filament\Resources\Teams\Pages\ListTeams;
use App\Filament\Resources\Teams\RelationManagers\PlanPricesRelationManager;
use App\Filament\Resources\Teams\RelationManagers\UsersRelationManager;
use App\Filament\Resources\Teams\Schemas\TeamForm;
use App\Filament\Resources\Teams\Tables\TeamsTable;
use App\Models\Team;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->isAdmin();
    }

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return TeamForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            PlanPricesRelationManager::class,
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
