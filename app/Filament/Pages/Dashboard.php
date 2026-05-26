<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Override;
use App\Filament\Widgets\SubscriptionStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
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
