<?php

declare(strict_types=1);

use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\artisan;

uses(RefreshDatabase::class);
beforeEach(function (): void {
    PlanCategory::factory()->create();
});

it('backfills team_id on subscriptions with NULL team_id from user\'s first team', function (): void {
    $team = Team::factory()->create();
    $user = User::factory()->manager()->create();
    $user->teams()->attach($team);
    actingAs($user);

    $plan = Plan::factory()->create();
    $sub = Subscription::factory()
        ->for($user)
        ->create(['plan_id' => $plan->id, 'team_id' => null]);

    artisan('subscriptions:backfill-teams')->assertSuccessful();

    expect($sub->fresh()->team_id)->toBe($team->id);
});

it('leaves subscriptions with existing team_id untouched', function (): void {
    $team1 = Team::factory()->create();
    $team2 = Team::factory()->create();
    $user = User::factory()->manager()->create();
    $user->teams()->attach($team1);
    actingAs($user);

    $plan = Plan::factory()->create();
    $sub = Subscription::factory()
        ->for($user)
        ->create(['plan_id' => $plan->id, 'team_id' => $team2->id]);

    artisan('subscriptions:backfill-teams')->assertSuccessful();

    expect($sub->fresh()->team_id)->toBe($team2->id);
});

it('is idempotent', function (): void {
    $team = Team::factory()->create();
    $user = User::factory()->manager()->create();
    $user->teams()->attach($team);
    actingAs($user);

    $plan = Plan::factory()->create();
    Subscription::factory()
        ->for($user)
        ->create(['plan_id' => $plan->id, 'team_id' => null]);

    artisan('subscriptions:backfill-teams')->assertSuccessful();
    artisan('subscriptions:backfill-teams')->assertSuccessful();

    expect(Subscription::query()->whereNotNull('team_id', 'and')->count('*'))->toBe(1);
});

it('does not persist changes in dry-run mode', function (): void {
    $team = Team::factory()->create();
    $user = User::factory()->manager()->create();
    $user->teams()->attach($team);
    actingAs($user);

    $plan = Plan::factory()->create();
    $sub = Subscription::factory()
        ->for($user)
        ->create(['plan_id' => $plan->id, 'team_id' => null]);

    artisan('subscriptions:backfill-teams', ['--dry-run' => true])
        ->assertSuccessful();

    expect($sub->fresh()->team_id)->toBeNull();
});
