<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\MicroservicePermission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class MicroserviceUsageWidget extends TableWidget
{
    protected static ?string $heading = 'Microservice Usage';

    protected static string $model = MicroservicePermission::class;

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(MicroservicePermission::query()->active())
            ->columns([
                TextColumn::make('microservice_name')
                    ->label('Microservice')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('microservice_slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_permissions')
                    ->label('Total Permissions')
                    ->numeric(),

                TextColumn::make('active_permissions')
                    ->label('Active')
                    ->numeric()
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
            ])
            ->paginated(false)
            ->defaultSort(null);
    }
}
