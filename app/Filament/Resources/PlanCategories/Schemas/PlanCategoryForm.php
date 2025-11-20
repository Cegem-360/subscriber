<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PlanCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
