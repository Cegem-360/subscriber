<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogCategories;

use Override;
use App\Filament\Resources\BlogCategories\Pages\CreateBlogCategory;
use App\Filament\Resources\BlogCategories\Pages\EditBlogCategory;
use App\Filament\Resources\BlogCategories\Pages\ListBlogCategories;
use App\Filament\Resources\BlogCategories\RelationManagers\BlogsRelationManager;
use App\Filament\Resources\BlogCategories\Schemas\BlogCategoryForm;
use App\Filament\Resources\BlogCategories\Tables\BlogCategoriesTable;
use App\Models\Blog\BlogCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class BlogCategoryResource extends Resource
{
    protected static ?string $model = BlogCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static ?string $navigationLabel = 'Kategóriák';

    protected static ?string $modelLabel = 'Blog kategória';

    protected static ?string $pluralModelLabel = 'Blog kategóriák';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->isAdmin();
    }

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return BlogCategoryForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return BlogCategoriesTable::configure($table);
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
            'index' => ListBlogCategories::route('/'),
            'create' => CreateBlogCategory::route('/create'),
            'edit' => EditBlogCategory::route('/{record}/edit'),
        ];
    }
}
