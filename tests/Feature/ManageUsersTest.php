<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Livewire\ManageUsers;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Http::fake();
    $category = PlanCategory::factory()->create();
    Plan::factory()->create(['plan_category_id' => $category->id]);
});

describe('ManageUsers page access', function (): void {
    it('allows managers to access the page', function (): void {
        $manager = User::factory()->manager()->create();

        actingAs($manager)
            ->get('/manage-users')
            ->assertOk();
    });

    it('allows admins to access the page', function (): void {
        $admin = User::factory()->admin()->create();

        actingAs($admin)
            ->get('/manage-users')
            ->assertOk();
    });

    it('requires authentication', function (): void {
        get('/manage-users')
            ->assertRedirect('/login');
    });
});

describe('ManageUsers component', function (): void {
    it('displays manager subscriptions', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->assertSee($plan->name);
    });

    it('creates a new user within seat limit', function (): void {
        Bus::fake();

        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', 'New User')
            ->set('data.email', 'newuser@test.com')
            ->set('data.password', 'password123')
            ->call('createUser')
            ->assertHasNoErrors();

        assertDatabaseHas('users', [
            'email' => 'newuser@test.com',
            'role' => UserRole::Subscriber->value,
        ]);

        $newUserId = User::query()->where('email', 'newuser@test.com')->value('id');

        assertDatabaseHas('subscription_user', [
            'subscription_id' => $subscription->id,
            'user_id' => $newUserId,
        ]);

        Bus::assertDispatched(
            ToggleUserActiveJob::class,
            fn (ToggleUserActiveJob $job): bool => $job->userEmail === 'newuser@test.com'
                && $job->isActive
                && $job->appKey === $plan->planCategory->slug,
        );
    });

    it('prevents creating user when subscription is full', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 2, // owner + 1 member max
            ]);

        // Fill the subscription
        User::factory()->memberOf($subscription)->create([
            'role' => UserRole::Subscriber,
        ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', 'New User')
            ->set('data.email', 'newuser@test.com')
            ->set('data.password', 'password123')
            ->call('createUser');

        assertDatabaseMissing('users', [
            'email' => 'newuser@test.com',
        ]);
    });

    it('validates required fields when creating user', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', '')
            ->set('data.email', '')
            ->set('data.password', '')
            ->call('createUser')
            ->assertHasErrors(['data.name', 'data.email', 'data.password']);
    });

    it('validates unique email', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        $existingUser = User::factory()->create();

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', 'New User')
            ->set('data.email', $existingUser->email)
            ->set('data.password', 'password123')
            ->call('createUser')
            ->assertHasErrors(['data.email']);
    });

    it('displays users in selected subscription', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        $member = User::factory()->memberOf($subscription)->create([
            'name' => 'Test Member',
            'role' => UserRole::Subscriber,
        ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->assertSee('Test Member');
    });

    it('switches between subscriptions', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription1 = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 5,
            ]);

        $subscription2 = Subscription::factory()
            ->active()
            ->for($manager)
            ->create([
                'plan_id' => $plan->id,
                'quantity' => 3,
            ]);

        User::factory()->memberOf($subscription1)->create([
            'name' => 'Member One',
            'role' => UserRole::Subscriber,
        ]);

        User::factory()->memberOf($subscription2)->create([
            'name' => 'Member Two',
            'role' => UserRole::Subscriber,
        ]);

        $component = Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->assertSee('Member One');

        $component->call('selectSubscription', $subscription2->id)
            ->assertSee('Member Two');
    });
});

describe('ManageUsers attaching existing accounts', function (): void {
    it('attaches an existing account from the same organization', function (): void {
        Bus::fake();

        $team = Team::factory()->create();
        $manager = User::factory()->manager()->create();
        $manager->teams()->attach($team);

        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $existing = User::factory()->create();
        $existing->teams()->attach($team);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->call('attachExistingUser', $existing->id)
            ->assertHasNoErrors();

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

    it('does not attach an account from another organization', function (): void {
        $team = Team::factory()->create();
        $manager = User::factory()->manager()->create();
        $manager->teams()->attach($team);

        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 5]);

        // Belongs to a different organization (different team).
        $outsider = User::factory()->create();
        $outsider->teams()->attach(Team::factory()->create());

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->call('attachExistingUser', $outsider->id);

        assertDatabaseMissing('subscription_user', [
            'subscription_id' => $subscription->id,
            'user_id' => $outsider->id,
        ]);

        $options = Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->instance()
            ->getAttachableUsers();

        expect($options)->not->toHaveKey($outsider->id);
    });

    it('lets the same account belong to two subscriptions', function (): void {
        Bus::fake();

        $team = Team::factory()->create();
        $manager = User::factory()->manager()->create();
        $manager->teams()->attach($team);

        $plan = Plan::query()->first();

        $sub1 = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $sub2 = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $account = User::factory()->memberOf($sub1)->create();
        $account->teams()->attach($team);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->call('selectSubscription', $sub2->id)
            ->call('attachExistingUser', $account->id);

        assertDatabaseHas('subscription_user', ['subscription_id' => $sub1->id, 'user_id' => $account->id]);
        assertDatabaseHas('subscription_user', ['subscription_id' => $sub2->id, 'user_id' => $account->id]);

        expect($account->memberSubscriptions()->count())->toBe(2);
    });

    it('prevents attaching when the subscription is full', function (): void {
        $manager = User::factory()->manager()->create();
        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 1]); // owner only, no member seats

        $existing = User::factory()->create();

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->call('attachExistingUser', $existing->id);

        assertDatabaseMissing('subscription_user', [
            'subscription_id' => $subscription->id,
            'user_id' => $existing->id,
        ]);
    });

    it('only lists organization accounts that are not yet members', function (): void {
        $team = Team::factory()->create();
        $manager = User::factory()->manager()->create();
        $manager->teams()->attach($team);

        $plan = Plan::query()->first();

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $member = User::factory()->memberOf($subscription)->create();
        $member->teams()->attach($team);

        $available = User::factory()->create();
        $available->teams()->attach($team);

        $outsider = User::factory()->create();
        $outsider->teams()->attach(Team::factory()->create());

        $options = Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->instance()
            ->getAttachableUsers();

        expect($options)
            ->toHaveKey($available->id)
            ->not->toHaveKey($member->id)
            ->not->toHaveKey($manager->id)
            ->not->toHaveKey($outsider->id);
    });
});
