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

it('displays the main account modules to an attached member', function (): void {
    $category = PlanCategory::factory()->create(['name' => 'CRM']);
    $plan = Plan::factory()->category($category->id)->create();

    $owner = User::factory()->create();
    $subscription = Subscription::factory()->active()->create([
        'user_id' => $owner->id,
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    $member = User::factory()->memberOf($subscription)->create();

    Livewire::actingAs($member)
        ->test(SubscriberModulsList::class)
        ->assertSee('CRM')
        ->assertDontSee('Nincs aktív modul');
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
