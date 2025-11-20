<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories;

use App\Filament\Resources\PlanCategories\Pages\CreatePlanCategory;
use App\Filament\Resources\PlanCategories\Pages\EditPlanCategory;
use App\Filament\Resources\PlanCategories\Pages\ListPlanCategories;
use App\Filament\Resources\PlanCategories\Schemas\PlanCategoryForm;
use App\Filament\Resources\PlanCategories\Tables\PlanCategoriesTable;
use App\Models\Plan\PlanCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PlanCategoryResource extends Resource
{
    protected static ?string $model = PlanCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return PlanCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlanCategoriesTable::configure($table);
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
            'index' => ListPlanCategories::route('/'),
            'create' => CreatePlanCategory::route('/create'),
            'edit' => EditPlanCategory::route('/{record}/edit'),
        ];
    }
}
