<?php

declare(strict_types=1);

use App\Livewire\SubscriberModulsList;
use App\Models\User;

use function Pest\Livewire\livewire;

it('shows the manage users button to admins and managers', function (string $role): void {
    $this->actingAs(User::factory()->{$role}()->create());

    livewire(SubscriberModulsList::class)
        ->assertSee('Felhasználók kezelése')
        ->assertSeeHtml(route('manage.users'));
})->with(['admin', 'manager']);

it('hides the manage users button from subscribers', function (): void {
    $this->actingAs(User::factory()->subscriber()->create());

    livewire(SubscriberModulsList::class)
        ->assertDontSee('Felhasználók kezelése');
});
