<?php

declare(strict_types=1);

namespace App\Filament\Resources\Tags;

use Override;
use App\Filament\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Tags\Pages\EditTag;
use App\Filament\Resources\Tags\Pages\ListTags;
use App\Filament\Resources\Tags\RelationManagers\BlogsRelationManager;
use App\Filament\Resources\Tags\Schemas\TagForm;
use App\Filament\Resources\Tags\Tables\TagsTable;
use App\Models\Blog\Tag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static ?string $navigationLabel = 'Címkék';

    protected static ?string $modelLabel = 'Címke';

    protected static ?string $pluralModelLabel = 'Címkék';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            BlogsRelationManager::class,
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
