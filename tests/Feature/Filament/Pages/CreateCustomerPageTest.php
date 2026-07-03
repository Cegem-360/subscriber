<?php

declare(strict_types=1);

use App\Filament\Pages\CreateCustomer;
use App\Models\User;

use function Pest\Livewire\livewire;

test('admin can render the create customer page', function (): void {
    $this->actingAs(User::factory()->admin()->create());

    livewire(CreateCustomer::class)->assertSuccessful();
});

test('non-admin cannot access the create customer page', function (): void {
    expect(CreateCustomer::canAccess())->toBeFalse();

    $this->actingAs(User::factory()->admin()->create());
    expect(CreateCustomer::canAccess())->toBeTrue();
});
