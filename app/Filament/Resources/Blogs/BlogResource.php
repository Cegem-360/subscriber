<?php

declare(strict_types=1);

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\CreateBlog;
use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Filament\Resources\Blogs\RelationManagers\TagsRelationManager;
use App\Filament\Resources\Blogs\Schemas\BlogForm;
use App\Filament\Resources\Blogs\Tables\BlogsTable;
use App\Models\Blog\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static ?string $navigationLabel = 'Bejegyzések';

    protected static ?string $modelLabel = 'Bejegyzés';

    protected static ?string $pluralModelLabel = 'Bejegyzések';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }
}
