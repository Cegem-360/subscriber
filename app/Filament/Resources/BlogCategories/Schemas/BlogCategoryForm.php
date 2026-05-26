<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Alapadatok')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Név')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state): mixed => $set('slug', Str::slug($state ?? ''))),
                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                        ]),
                        Textarea::make('description')
                            ->label('Leírás')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Section::make('Beállítások')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('sort_order')
                                ->label('Sorrend')
                                ->numeric()
                                ->default(0),
                            Toggle::make('is_active')
                                ->label('Aktív')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }
}
