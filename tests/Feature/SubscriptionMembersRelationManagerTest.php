<?php

declare(strict_types=1);

use App\Filament\Resources\Subscriptions\Pages\EditSubscription;
use App\Filament\Resources\Subscriptions\RelationManagers\MembersRelationManager;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Http::fake();
    $category = PlanCategory::factory()->create();
    Plan::factory()->create(['plan_category_id' => $category->id]);
});

it('attaches an existing account through the relation manager', function (): void {
    Bus::fake();

    $admin = User::factory()->admin()->create();

    $plan = Plan::query()->first();
    $team = Team::factory()->create();
    $owner = User::factory()->manager()->create();
    $owner->teams()->attach($team);
    $subscription = Subscription::factory()->active()->for($owner)->create([
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    $existing = User::factory()->create();
    $existing->teams()->attach($team);

    Livewire::actingAs($admin)->test(MembersRelationManager::class, [
        'ownerRecord' => $subscription,
        'pageClass' => EditSubscription::class,
    ])
        ->callAction(TestAction::make('attach')->table(), ['recordId' => $existing->id])
        ->assertHasNoFormErrors();

    assertDatabaseHas('subscription_user', [
        'subscription_id' => $subscription->id,
        'user_id' => $existing->id,
    ]);

    Bus::assertDispatched(
        ToggleUserActiveJob::class,
        fn (ToggleUserActiveJob $job): bool => $job->userEmail === $existing->email
            && $job->isActive
            && $job->appKey === $plan->planCategory->slug,
    );
});

it('deactivates on the app when detaching the last subscription for that app', function (): void {
    Bus::fake();

    $admin = User::factory()->admin()->create();

    $plan = Plan::query()->first();
    $owner = User::factory()->manager()->create();
    $subscription = Subscription::factory()->active()->for($owner)->create([
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    $member = User::factory()->memberOf($subscription)->create();

    Livewire::actingAs($admin)->test(MembersRelationManager::class, [
        'ownerRecord' => $subscription,
        'pageClass' => EditSubscription::class,
    ])
        ->callAction(TestAction::make('detach')->table($member));

    assertDatabaseMissing('subscription_user', [
        'subscription_id' => $subscription->id,
        'user_id' => $member->id,
    ]);

    Bus::assertDispatched(
        ToggleUserActiveJob::class,
        fn (ToggleUserActiveJob $job): bool => $job->userEmail === $member->email
            && $job->isActive === false
            && $job->appKey === $plan->planCategory->slug,
    );
});

it('keeps the account active when another subscription grants the same app', function (): void {
    Bus::fake();

    $admin = User::factory()->admin()->create();

    $plan = Plan::query()->first();
    $owner = User::factory()->manager()->create();

    $sub1 = Subscription::factory()->active()->for($owner)->create([
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    $sub2 = Subscription::factory()->active()->for($owner)->create([
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    $member = User::factory()->memberOf($sub1)->memberOf($sub2)->create();

    expect($member->memberSubscriptions()->count())->toBe(2);

    Livewire::actingAs($admin)->test(MembersRelationManager::class, [
        'ownerRecord' => $sub1,
        'pageClass' => EditSubscription::class,
    ])
        ->callAction(TestAction::make('detach')->table($member));

    // The owner-activation jobs from the SubscriptionObserver are expected; only
    // assert the member was NOT deactivated, since sub2 still grants the same app.
    Bus::assertNotDispatched(
        ToggleUserActiveJob::class,
        fn (ToggleUserActiveJob $job): bool => $job->userEmail === $member->email
            && $job->isActive === false,
    );
});
