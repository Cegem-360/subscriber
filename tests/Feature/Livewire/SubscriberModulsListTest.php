<?php

declare(strict_types=1);

use App\Livewire\SubscriberModulsList;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(SubscriberModulsList::class)
        ->assertStatus(200);
});
