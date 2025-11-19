<?php

declare(strict_types=1);

use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\SubscriptionStatsWidget;
use App\Models\User;

use function Pest\Livewire\livewire;

use Tests\TestCase;

beforeEach(function (): void {
    /** @var TestCase $this */
    $this->actingAs(User::factory()->create());
});

test('subscription stats widget can render', function (): void {
    livewire(SubscriptionStatsWidget::class)
        ->assertSuccessful();
});

test('revenue chart widget can render', function (): void {
    livewire(RevenueChartWidget::class)
        ->assertSuccessful();
});

test('dashboard page can render', function (): void {
    /** @var TestCase $this */
    $this->get('/admin')
        ->assertSuccessful();
});
