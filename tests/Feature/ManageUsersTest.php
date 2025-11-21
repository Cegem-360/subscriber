<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Livewire\ManageUsers;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    PlanCategory::factory()->create();
    Plan::factory()->create();
});

describe('ManageUsers page access', function (): void {
    it('allows managers to access the page', function (): void {
        $manager = User::factory()->manager()->create();

        $this->actingAs($manager)
            ->get('/manage-users')
            ->assertOk();
    });

    it('allows admins to access the page', function (): void {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/manage-users')
            ->assertOk();
    });

    it('requires authentication', function (): void {
        $this->get('/manage-users')
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

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@test.com',
            'subscription_id' => $subscription->id,
            'role' => UserRole::Subscriber->value,
        ]);
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

        $this->assertDatabaseMissing('users', [
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
