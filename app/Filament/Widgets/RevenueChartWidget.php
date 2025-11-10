<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected ?string $description = 'Revenue from paid invoices over the last 12 months';

    protected function getData(): array
    {
        $data = $this->getRevenuePerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data['amounts'],
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getRevenuePerMonth(): array
    {
        $months = [];
        $amounts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');

            $revenue = Invoice::query()
                ->where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');

            $amounts[] = (float) $revenue;
        }

        return [
            'months' => $months,
            'amounts' => $amounts,
        ];
    }

    protected ?int $height = 300;

    protected static ?int $sort = 2;
}
