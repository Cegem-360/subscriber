<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Livewire\ManageUsers;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
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
            'subscription_id' => $subscription->id,
            'role' => UserRole::Subscriber->value,
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
        User::factory()->create([
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription->id,
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

        $member = User::factory()->create([
            'name' => 'Test Member',
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription->id,
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

        User::factory()->create([
            'name' => 'Member One',
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription1->id,
        ]);

        User::factory()->create([
            'name' => 'Member Two',
            'role' => UserRole::Subscriber,
            'subscription_id' => $subscription2->id,
        ]);

        $component = Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->assertSee('Member One');

        $component->call('selectSubscription', $subscription2->id)
            ->assertSee('Member Two');
    });
});
