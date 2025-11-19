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

it('shows sync action to admin users', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertActionExists('sync_stripe');
});

it('does not show sync action to regular users', function (): void {
    $this->actingAs($this->regularUser);

    Livewire::test(Plans::class)
        ->assertActionDoesNotExist('sync_stripe');
});

it('displays plans page correctly', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(Plans::class)
        ->assertSuccessful();
});
