<?php

declare(strict_types=1);

use App\Livewire\SubscrubersSubscriptionsTable;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('labels the date column as the next billing date, not "Lejár ekkor"', function (): void {
    $user = User::factory()->create();
    Subscription::factory()->active()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(SubscrubersSubscriptionsTable::class)
        ->assertSee(__('Next billing date'))
        ->assertDontSee('Lejár ekkor');
});

it('uses Hungarian column labels', function (): void {
    $user = User::factory()->create();
    Subscription::factory()->active()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(SubscrubersSubscriptionsTable::class)
        ->assertSee('Modul')
        ->assertSee('Modul link')
        ->assertDontSee('Module url');
});
