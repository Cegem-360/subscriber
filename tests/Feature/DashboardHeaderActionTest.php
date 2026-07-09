<?php

declare(strict_types=1);

use App\Filament\Pages\Dashboard;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('shows the manage users action to admins and managers', function (string $role): void {
    actingAs(User::factory()->{$role}()->create());

    livewire(Dashboard::class)
        ->assertActionVisible('manageUsers');
})->with(['admin', 'manager']);

it('hides the manage users action from subscribers', function (): void {
    actingAs(User::factory()->subscriber()->create());
    livewire(Dashboard::class)
        ->assertActionDoesNotExist('manageUsers');
});
