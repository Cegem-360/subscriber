<?php

declare(strict_types=1);

namespace App\Filament\Resources\PlanCategories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PlanCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Név')
                    ->required(),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->placeholder('https://example.cegem360.eu'),
                Textarea::make('description')
                    ->label('Leírás')
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    ColorPicker::make('color')
                        ->label('Szín')
                        ->default('#6366F1'),
                    Select::make('icon')
                        ->label('Ikon')
                        ->options([
                            'chart-bar' => 'Chart Bar (Kontrolling)',
                            'users' => 'Users (CRM)',
                            'cube' => 'Cube (Beszerzés)',
                            'cog' => 'Cog (Gyártás)',
                            'refresh' => 'Refresh (Automatizálás)',
                            'currency-dollar' => 'Currency Dollar (Értékesítés)',
                            'shopping-cart' => 'Shopping Cart',
                            'document-text' => 'Document Text',
                            'clipboard-list' => 'Clipboard List',
                            'calculator' => 'Calculator',
                        ])
                        ->default('cube'),
                ]),
            ]);
    }
}
