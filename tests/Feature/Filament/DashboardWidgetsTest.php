<?php

declare(strict_types=1);

use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\SubscriptionStatsWidget;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

beforeEach(function (): void {
    $this->user = User::factory()->admin()->create();
});

test('subscription stats widget can render', function (): void {
    Livewire::actingAs($this->user)
        ->test(SubscriptionStatsWidget::class)
        ->assertSuccessful();
});

test('revenue chart widget can render', function (): void {
    Livewire::actingAs($this->user)
        ->test(RevenueChartWidget::class)
        ->assertSuccessful();
});

test('dashboard page can render', function (): void {
    /** @var TestCase $this */
    $this->actingAs($this->user);

    $this->get('/admin')
        ->assertSuccessful();
});
