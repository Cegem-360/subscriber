<?php

declare(strict_types=1);

namespace App\Filament\Resources\Tags\RelationManagers;

use Override;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BlogsRelationManager extends RelationManager
{
    protected static string $relationship = 'blogs';

    protected static ?string $title = 'Bejegyzések';

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Cím')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('blogCategory.name')
                    ->label('Kategória')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Publikálva')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Nincs'),
                IconColumn::make('is_active')
                    ->label('Aktív')
                    ->boolean(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
