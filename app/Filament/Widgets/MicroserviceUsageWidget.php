<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\MicroservicePermission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MicroserviceUsageWidget extends TableWidget
{
    protected static ?string $heading = 'Microservice Usage';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        // NOTE: This query works in production but may fail in strict PostgreSQL tests
        // due to Filament auto-adding model.id to ORDER BY which conflicts with GROUP BY
        $query = MicroservicePermission::query()->active();

        if (Auth::user()?->isSubscriber()) {
            $query->whereHas('subscription', fn (Builder $query) => $query->where('user_id', Auth::id()));
        }

        return $table
            ->query(fn (): Builder => $query)
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
