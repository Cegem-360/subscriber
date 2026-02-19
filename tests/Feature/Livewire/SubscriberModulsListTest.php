<?php

declare(strict_types=1);

use App\Livewire\SubscriberModulsList;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubscriberModulsList::class)
        ->assertSuccessful();
});

it('displays subscriptions in alphabetical order by category name', function (): void {
    $user = User::factory()->create();

    $categoryC = PlanCategory::factory()->create(['name' => 'CRM']);
    $categoryA = PlanCategory::factory()->create(['name' => 'Automatizálás']);
    $categoryB = PlanCategory::factory()->create(['name' => 'Beszerzés']);

    $planC = Plan::factory()->category($categoryC->id)->create();
    $planA = Plan::factory()->category($categoryA->id)->create();
    $planB = Plan::factory()->category($categoryB->id)->create();

    Subscription::factory()->active()->create(['user_id' => $user->id, 'plan_id' => $planC->id]);
    Subscription::factory()->active()->create(['user_id' => $user->id, 'plan_id' => $planA->id]);
    Subscription::factory()->active()->create(['user_id' => $user->id, 'plan_id' => $planB->id]);

    Livewire::actingAs($user)
        ->test(SubscriberModulsList::class)
        ->assertSeeInOrder(['Automatizálás', 'Beszerzés', 'CRM']);
});
