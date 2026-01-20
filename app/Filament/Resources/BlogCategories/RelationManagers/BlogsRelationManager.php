<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogCategories\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BlogsRelationManager extends RelationManager
{
    protected static string $relationship = 'blogs';

    protected static ?string $title = 'Bejegyzések';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Alapadatok')
                    ->schema([
                        TextInput::make('title')
                            ->label('Cím')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(callback: fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ]),
                Section::make('Tartalom')
                    ->columnSpanFull()
                    ->schema([
                        ToggleButtons::make('editor_mode')
                            ->label('Szerkesztő mód')
                            ->options([
                                'visual' => 'Vizuális',
                                'html' => 'HTML',
                            ])
                            ->icons([
                                'visual' => 'heroicon-o-eye',
                                'html' => 'heroicon-o-code-bracket',
                            ])
                            ->default('visual')
                            ->inline()
                            ->live(),
                        RichEditor::make('content')
                            ->label('Tartalom')
                            ->required(fn (Get $get): bool => $get('editor_mode') !== 'html')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->columnSpanFull()
                            ->visible(fn (Get $get): bool => $get('editor_mode') !== 'html'),
                        CodeEditor::make('content_html')
                            ->label('HTML tartalom')
                            ->required(fn (Get $get): bool => $get('editor_mode') === 'html')
                            ->language(Language::Html)
                            ->columnSpanFull()
                            ->visible(fn (Get $get): bool => $get('editor_mode') === 'html'),
                        Textarea::make('excerpt')
                            ->label('Rövid leírás')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Section::make('Beállítások')
                    ->schema([
                        Grid::make(2)->schema([
                            DateTimePicker::make('published_at')
                                ->label('Publikálás dátuma'),
                            Toggle::make('is_active')
                                ->label('Aktív')
                                ->default(true),
                        ]),
                    ]),
            ]);
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
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
