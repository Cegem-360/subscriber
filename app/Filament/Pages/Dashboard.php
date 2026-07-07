<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Widgets\SubscriptionStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Override;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Vezérlőpult';

    protected static ?int $navigationSort = -2;

    public function getTitle(): string
    {
        return 'Vezérlőpult';
    }

    #[Override]
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            SubscriptionStatsWidget::class,
        ];
    }

    #[Override]
    public function getColumns(): int|array
    {
        return 2;
    }
}
