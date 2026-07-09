<?php

declare(strict_types=1);

use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\SubscriptionStatsWidget;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('subscription stats widget can render', function (): void {
    Livewire::actingAs(User::factory()->admin()->create())
        ->test(SubscriptionStatsWidget::class)
        ->assertSuccessful();
});

test('revenue chart widget can render', function (): void {
    Livewire::actingAs(User::factory()->admin()->create())
        ->test(RevenueChartWidget::class)
        ->assertSuccessful();
});

test('dashboard page can render', function (): void {
    actingAs(User::factory()->admin()->create());

    get('/admin')
        ->assertSuccessful();
});
