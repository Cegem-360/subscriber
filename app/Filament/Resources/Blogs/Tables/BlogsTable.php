<?php

declare(strict_types=1);

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Kép')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Cím')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('blogCategory.name')
                    ->label('Kategória')
                    ->badge()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Publikálva')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Nincs'),
                IconColumn::make('is_active')
                    ->label('Aktív')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Létrehozva')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                SelectFilter::make('blog_category_id')
                    ->label('Kategória')
                    ->relationship('blogCategory', 'name'),
                TernaryFilter::make('is_active')
                    ->label('Aktív')
                    ->placeholder('Mind'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
