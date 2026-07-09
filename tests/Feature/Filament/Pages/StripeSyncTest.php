<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Pages\Plans;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('hides navigation for regular users', function (): void {
    actingAs(User::factory()->create([
        'role' => UserRole::Subscriber,
    ]));

    expect(Plans::shouldRegisterNavigation())->toBeFalse();
});

it('displays both command cards', function (): void {
    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(Plans::class)
        ->assertSuccessful()
        ->assertSee('stripe:sync-prices')
        ->assertSee('subscriptions:sync-items');
});

it('can run syncPricesDryRun and shows output', function (): void {
    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(Plans::class)
        ->call('syncPricesDryRun')
        ->assertSet('isRunning', false)
        ->assertNotSet('consoleOutput', '');
});

it('can clear console output', function (): void {
    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(Plans::class)
        ->set('consoleOutput', 'test output')
        ->call('clearOutput')
        ->assertSet('consoleOutput', '');
});
