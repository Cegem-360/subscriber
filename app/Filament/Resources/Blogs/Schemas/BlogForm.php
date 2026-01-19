<?php

declare(strict_types=1);

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    Grid::make(1)
                        ->schema([
                            Section::make('Alapadatok')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Cím')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                    TextInput::make('slug')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255),
                                    Select::make('blog_category_id')
                                        ->label('Kategória')
                                        ->relationship('blogCategory', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                ]),
                            Section::make('Tartalom')
                                ->schema([
                                    RichEditor::make('content')
                                        ->label('Tartalom')
                                        ->required()
                                        ->toolbarButtons([
                                            ['bold', 'italic', 'underline', 'strike', 'link'],
                                            ['h2', 'h3'],
                                            ['blockquote', 'bulletList', 'orderedList'],
                                            ['undo', 'redo'],
                                        ])
                                        ->fileAttachmentsDirectory('blog-attachments')
                                        ->columnSpanFull(),
                                    Textarea::make('excerpt')
                                        ->label('Rövid leírás')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpan(2),
                    Grid::make(1)
                        ->schema([
                            Section::make('Média')
                                ->schema([
                                    FileUpload::make('featured_image')
                                        ->label('Kiemelt kép')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('blog-images'),
                                    FileUpload::make('og_image')
                                        ->label('OG kép (megosztáshoz)')
                                        ->image()
                                        ->directory('blog-images'),
                                ]),
                            Section::make('SEO')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->label('Meta cím')
                                        ->maxLength(70)
                                        ->helperText('Max. 70 karakter'),
                                    Textarea::make('meta_description')
                                        ->label('Meta leírás')
                                        ->rows(3)
                                        ->maxLength(160)
                                        ->helperText('Max. 160 karakter'),
                                ]),
                            Section::make('Publikálás')
                                ->schema([
                                    DateTimePicker::make('published_at')
                                        ->label('Publikálás dátuma'),
                                    Toggle::make('is_active')
                                        ->label('Aktív')
                                        ->default(true),
                                ]),
                        ])
                        ->columnSpan(1),
                ]),
            ]);
    }
}
