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

it('shows stripe sync actions to admin users', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertActionExists('sync_stripe')
        ->assertActionExists('sync_stripe_force')
        ->assertActionExists('sync_stripe_dry_run');
});

it('shows subscription items sync action to admin users', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertActionExists('sync_subscription_items');
});

it('hides navigation for regular users', function (): void {
    $this->actingAs($this->regularUser);

    expect(Plans::shouldRegisterNavigation())->toBeFalse();
});

it('displays both command descriptions', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertSuccessful()
        ->assertSee('stripe:sync-prices')
        ->assertSee('subscriptions:sync-items');
});

it('can clear console output', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->set('consoleOutput', 'test output')
        ->call('clearOutput')
        ->assertSet('consoleOutput', '');
});
