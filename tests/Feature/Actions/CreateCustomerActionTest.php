<?php

declare(strict_types=1);

use App\Actions\CreateCustomer;
use App\Enums\SubscriptionStatus;
use App\Enums\UserRole;
use App\Mail\CustomerCredentialsMail;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Madbox99\UserTeamSync\Publisher\Jobs\CreateTeamJob;
use Madbox99\UserTeamSync\Publisher\Jobs\CreateUserJob;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (): void {
    Bus::fake();
    Mail::fake();
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

    $owner = resolve(CreateCustomer::class)->handle(ownerPayload([
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

    expect(Subscription::query()->withoutGlobalScopes()->where('user_id', $owner->id)->first()->stripe_id)
        ->toStartWith('manual_');

    Bus::assertDispatched(CreateUserJob::class, fn (CreateUserJob $job): bool => $job->email === 'owner@example.com');
});

test('emails login credentials and active modules to the owner and every member', function (): void {
    $category = PlanCategory::factory()->create(['name' => 'MarketingHUB', 'slug' => 'marketinghub', 'url' => 'https://marketinghub.cegem360.eu']);
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

    resolve(CreateCustomer::class)->handle(ownerPayload([
        'password' => 'owner-secret',
        'plans' => [['plan_id' => $plan->id, 'quantity' => 5]],
        'members' => [
            ['name' => 'Tag Egy', 'email' => 'tag1@example.com', 'password' => 'tag-one-secret', 'role' => UserRole::Subscriber->value],
            ['name' => 'Tag Kettő', 'email' => 'tag2@example.com', 'password' => 'tag-two-secret', 'role' => UserRole::Subscriber->value],
        ],
    ]));

    $carriesModule = fn (CustomerCredentialsMail $mail): bool => count($mail->modules) === 1
        && $mail->modules[0]['name'] === 'MarketingHUB'
        && $mail->modules[0]['url'] === 'https://marketinghub.cegem360.eu';

    Mail::assertQueued(CustomerCredentialsMail::class, fn (CustomerCredentialsMail $mail): bool => $mail->hasTo('owner@example.com') && $mail->password === 'owner-secret' && $carriesModule($mail));
    Mail::assertQueued(CustomerCredentialsMail::class, fn (CustomerCredentialsMail $mail): bool => $mail->hasTo('tag1@example.com') && $mail->password === 'tag-one-secret' && $carriesModule($mail));
    Mail::assertQueued(CustomerCredentialsMail::class, fn (CustomerCredentialsMail $mail): bool => $mail->hasTo('tag2@example.com') && $mail->password === 'tag-two-secret' && $carriesModule($mail));
    Mail::assertQueued(CustomerCredentialsMail::class, 3);
});

test('activates the owner on the sub-app with a delayed toggle, not during the transaction', function (): void {
    $category = PlanCategory::factory()->create(['slug' => 'kontrolling']);
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

    resolve(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [['plan_id' => $plan->id, 'quantity' => 1]],
    ]));

    // Exactly one owner activation, dispatched with a delay so it runs AFTER the
    // user has been synced to the sub-app — not the racing in-transaction toggle
    // that the SubscriptionObserver would otherwise fire before the user exists.
    Bus::assertDispatched(ToggleUserActiveJob::class, fn (ToggleUserActiveJob $job): bool => $job->userEmail === 'owner@example.com'
        && $job->appKey === 'kontrolling'
        && $job->isActive
        && $job->delay !== null);
    Bus::assertDispatchedTimes(ToggleUserActiveJob::class, 1);
});

test('creates one subscription per selected plan', function (): void {
    $plans = Plan::factory()->count(2)->create();

    $owner = resolve(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [
            ['plan_id' => $plans[0]->id, 'quantity' => 1],
            ['plan_id' => $plans[1]->id, 'quantity' => 5],
        ],
    ]));

    expect(Subscription::query()->withoutGlobalScopes()->where('user_id', $owner->id)->count())->toBe(2);
});

test('creates a team, attaches owner, and links subscriptions to it', function (): void {
    $plan = Plan::factory()->create();

    $owner = resolve(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => 'Csapat Egy',
        'plans' => [['plan_id' => $plan->id, 'quantity' => 2]],
    ]));

    $team = Team::query()->where('name', 'Csapat Egy')->first();

    expect($team)->not->toBeNull()
        ->and($owner->teams()->whereKey($team->id)->exists())->toBeTrue()
        ->and(Subscription::query()->withoutGlobalScopes()->where('user_id', $owner->id)->first()->team_id)
        ->toBe($team->id);

    Bus::assertDispatched(CreateTeamJob::class, fn (CreateTeamJob $job): bool => $job->teamName === 'Csapat Egy');
});

test('falls back to company name when team name is blank', function (): void {
    $owner = resolve(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => null,
    ]));

    expect(Team::query()->where('name', 'Példa Kft.')->exists())->toBeTrue();
});

test('creates no team when create_team is false', function (): void {
    resolve(CreateCustomer::class)->handle(ownerPayload(['create_team' => false]));

    expect(Team::query()->count())->toBe(0);
    Bus::assertNotDispatched(CreateTeamJob::class);
});

test('creates members and attaches each to every subscription', function (): void {
    $plans = Plan::factory()->count(2)->create();

    $owner = resolve(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [
            ['plan_id' => $plans[0]->id, 'quantity' => 5],
            ['plan_id' => $plans[1]->id, 'quantity' => 5],
        ],
        'members' => [
            ['name' => 'Tag Egy', 'email' => 'tag1@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ['name' => 'Tag Kettő', 'email' => 'tag2@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
        ],
    ]));

    $member = User::query()->where('email', 'tag1@example.com')->first();

    expect($member)->not->toBeNull()
        ->and($member->company_name)->toBe('Példa Kft.')
        ->and(Hash::check('secret123', $member->password))->toBeTrue();

    // attached to both subscriptions
    $subscriptionIds = Subscription::query()->withoutGlobalScopes()->where('user_id', $owner->id)->pluck('id');
    expect($member->memberSubscriptions()->pluck('subscriptions.id')->sort()->values()->all())
        ->toEqual($subscriptionIds->sort()->values()->all());
});
