<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Widgets\MicroserviceUsageWidget;
use App\Filament\Widgets\RecentInvoicesWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\SubscriptionStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            SubscriptionStatsWidget::class,
            // RevenueChartWidget::class,
            // RecentInvoicesWidget::class,
            // MicroserviceUsageWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
