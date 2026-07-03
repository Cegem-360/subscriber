<?php

declare(strict_types=1);

use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\RelationManagers\SubscriptionsRelationManager;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('shows the user subscriptions with real columns in the relation manager', function (): void {
    $admin = User::factory()->admin()->create();
    actingAs($admin);

    $category = PlanCategory::factory()->create();
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);
    $owner = User::factory()->manager()->create();

    $subscriptions = Subscription::factory()
        ->active()
        ->count(2)
        ->for($owner)
        ->create([
            'plan_id' => $plan->id,
            'quantity' => 3,
        ]);

    livewire(SubscriptionsRelationManager::class, [
        'ownerRecord' => $owner,
        'pageClass' => EditUser::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($subscriptions)
        ->assertCanRenderTableColumn('plan.name')
        ->assertCanRenderTableColumn('stripe_status');
});
