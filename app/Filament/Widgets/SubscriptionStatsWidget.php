<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SubscriptionStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $activeSubscriptions = Subscription::query()
            ->where('stripe_status', 'active')
            ->count();

        $trialingSubscriptions = Subscription::query()
            ->where('stripe_status', 'trialing')
            ->count();

        $pastDueSubscriptions = Subscription::query()
            ->where('stripe_status', 'past_due')
            ->count();

        $canceledThisMonth = Subscription::query()
            ->whereNotNull('ends_at')
            ->whereMonth('ends_at', now()->month)
            ->whereYear('ends_at', now()->year)
            ->count();

        $totalMrr = Subscription::query()
            ->where('stripe_status', 'active')
            ->sum(DB::raw('CAST(stripe_price AS DECIMAL(10,2)) / 100'));

        return [
            Stat::make('Active Subscriptions', $activeSubscriptions)
                ->description('Currently active paid subscriptions')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->chart($this->getSubscriptionTrend()),

            Stat::make('Trial Subscriptions', $trialingSubscriptions)
                ->description('Active trial periods')
                ->descriptionIcon('heroicon-o-clock')
                ->color('info'),

            Stat::make('Monthly Recurring Revenue', '$' . number_format($totalMrr, 2))
                ->description('Total MRR from active subscriptions')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Past Due', $pastDueSubscriptions)
                ->description('Subscriptions with payment issues')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning'),

            Stat::make('Cancellations This Month', $canceledThisMonth)
                ->description('Subscriptions ending this month')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }

    protected function getSubscriptionTrend(): array
    {
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $trend[] = Subscription::query()
                ->where('stripe_status', 'active')
                ->whereDate('created_at', '<=', $date)
                ->count();
        }

        return $trend;
    }
}
