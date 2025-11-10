<?php

declare(strict_types=1);

use App\Filament\Widgets\MicroserviceUsageWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\SubscriptionStatsWidget;
use App\Models\User;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('subscription stats widget can render', function () {
    livewire(SubscriptionStatsWidget::class)
        ->assertSuccessful();
});

test('revenue chart widget can render', function () {
    livewire(RevenueChartWidget::class)
        ->assertSuccessful();
});

test('microservice usage widget can render', function () {
    livewire(MicroserviceUsageWidget::class)
        ->assertSuccessful();
});
