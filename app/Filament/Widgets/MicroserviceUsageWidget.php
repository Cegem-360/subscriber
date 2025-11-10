<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\MicroservicePermission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\DB;

class MicroserviceUsageWidget extends TableWidget
{
    protected static ?string $heading = 'Microservice Usage';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                MicroservicePermission::query()
                    ->select([
                        'microservice_name',
                        'microservice_slug',
                        DB::raw('COUNT(*) as total_permissions'),
                        DB::raw('SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_permissions'),
                        DB::raw('SUM(CASE WHEN expires_at IS NOT NULL AND expires_at <= NOW() THEN 1 ELSE 0 END) as expired_permissions'),
                    ])
                    ->groupBy('microservice_name', 'microservice_slug')
                    ->orderByDesc('active_permissions'),
            )
            ->columns([
                TextColumn::make('microservice_name')
                    ->label('Microservice')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('microservice_slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_permissions')
                    ->label('Total Permissions')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('active_permissions')
                    ->label('Active')
                    ->numeric()
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->sortable(),

                TextColumn::make('expired_permissions')
                    ->label('Expired')
                    ->numeric()
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->getStateUsing(fn ($record) => $record->expired_permissions > 0 ? $record->expired_permissions : null)
                    ->placeholder('-'),

                TextColumn::make('usage_percentage')
                    ->label('Active %')
                    ->getStateUsing(fn ($record) => $record->total_permissions > 0
                        ? round(($record->active_permissions / $record->total_permissions) * 100, 1) . '%'
                        : '0%')
                    ->color(fn ($record) => match (true) {
                        $record->total_permissions == 0 => 'gray',
                        ($record->active_permissions / $record->total_permissions) >= 0.8 => 'success',
                        ($record->active_permissions / $record->total_permissions) >= 0.5 => 'warning',
                        default => 'danger',
                    }),
            ])
            ->paginated(false)
            ->defaultSort('active_permissions', 'desc');
    }
}
