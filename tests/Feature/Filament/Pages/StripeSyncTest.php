<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Pages\Plans;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function (): void {
    $this->adminUser = User::factory()->create([
        'role' => UserRole::Admin,
    ]);

    $this->regularUser = User::factory()->create([
        'role' => UserRole::Subscriber,
    ]);
});

it('hides navigation for regular users', function (): void {
    $this->actingAs($this->regularUser);

    expect(Plans::shouldRegisterNavigation())->toBeFalse();
});

it('displays both command cards', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertSuccessful()
        ->assertSee('stripe:sync-prices')
        ->assertSee('subscriptions:sync-items');
});

it('can run syncPricesDryRun and shows output', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->call('syncPricesDryRun')
        ->assertSet('isRunning', false)
        ->assertNotSet('consoleOutput', '');
});

it('can clear console output', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->set('consoleOutput', 'test output')
        ->call('clearOutput')
        ->assertSet('consoleOutput', '');
});
