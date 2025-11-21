<?php

declare(strict_types=1);

use App\Livewire\SubscriberModulsList;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubscriberModulsList::class)
        ->assertStatus(200);
});
