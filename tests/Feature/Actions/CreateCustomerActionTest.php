<?php

declare(strict_types=1);

use App\Actions\CreateCustomer;
use App\Enums\SubscriptionStatus;
use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;
use Madbox99\UserTeamSync\Publisher\Jobs\CreateTeamJob;
use Madbox99\UserTeamSync\Publisher\Jobs\CreateUserJob;

use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (): void {
    Bus::fake();
});

function ownerPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Nagy Béla',
        'email' => 'owner@example.com',
        'password' => 'password123',
        'role' => UserRole::Manager->value,
        'company_name' => 'Példa Kft.',
        'tax_number' => '12345678-1-42',
        'address' => 'Fő utca 1.',
        'city' => 'Budapest',
        'postal_code' => '1011',
        'country' => 'HU',
        'plans' => [],
        'create_team' => false,
        'team_name' => null,
        'members' => [],
    ], $overrides);
}

test('creates owner user with hashed password and provisions on module apps', function (): void {
    $plan = Plan::factory()->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [['plan_id' => $plan->id, 'quantity' => 3]],
    ]));

    expect($owner)->toBeInstanceOf(User::class)
        ->and($owner->role)->toBe(UserRole::Manager)
        ->and($owner->email_verified_at)->not->toBeNull()
        ->and(Hash::check('password123', $owner->password))->toBeTrue();

    assertDatabaseHas('users', ['email' => 'owner@example.com', 'company_name' => 'Példa Kft.']);

    assertDatabaseHas('subscriptions', [
        'user_id' => $owner->id,
        'plan_id' => $plan->id,
        'quantity' => 3,
        'stripe_status' => SubscriptionStatus::Active->value,
    ]);

    expect(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->first()->stripe_id)
        ->toStartWith('manual_');

    Bus::assertDispatched(CreateUserJob::class, function (CreateUserJob $job): bool {
        return $job->email === 'owner@example.com';
    });
});

test('creates one subscription per selected plan', function (): void {
    $plans = Plan::factory()->count(2)->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [
            ['plan_id' => $plans[0]->id, 'quantity' => 1],
            ['plan_id' => $plans[1]->id, 'quantity' => 5],
        ],
    ]));

    expect(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->count())->toBe(2);
});

test('creates a team, attaches owner, and links subscriptions to it', function (): void {
    $plan = Plan::factory()->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => 'Csapat Egy',
        'plans' => [['plan_id' => $plan->id, 'quantity' => 2]],
    ]));

    $team = Team::query()->where('name', 'Csapat Egy')->first();

    expect($team)->not->toBeNull()
        ->and($owner->teams()->whereKey($team->id)->exists())->toBeTrue()
        ->and(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->first()->team_id)
        ->toBe($team->id);

    Bus::assertDispatched(CreateTeamJob::class, fn (CreateTeamJob $job): bool => $job->teamName === 'Csapat Egy');
});

test('falls back to company name when team name is blank', function (): void {
    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => null,
    ]));

    expect(Team::query()->where('name', 'Példa Kft.')->exists())->toBeTrue();
});

test('creates no team when create_team is false', function (): void {
    app(CreateCustomer::class)->handle(ownerPayload(['create_team' => false]));

    expect(Team::query()->count())->toBe(0);
    Bus::assertNotDispatched(CreateTeamJob::class);
});
