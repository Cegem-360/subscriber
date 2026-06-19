<?php

declare(strict_types=1);

use App\Livewire\ManageUsers;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function (): void {
    Http::fake();
});

describe('unverified user can view the customer app', function (): void {
    it('allows access to the modules page', function (): void {
        $user = User::factory()->subscriber()->unverified()->create();

        actingAs($user)->get(route('modules'))->assertOk();
    });

    it('allows access to the subscriptions page', function (): void {
        $user = User::factory()->subscriber()->unverified()->create();

        actingAs($user)->get(route('subscriptions'))->assertOk();
    });

    it('allows access to the manage users page', function (): void {
        $user = User::factory()->manager()->unverified()->create();

        actingAs($user)->get(route('manage.users'))->assertOk();
    });
});

describe('unverified user cannot write in the customer app', function (): void {
    it('blocks creating a user and does not persist it', function (): void {
        Bus::fake();

        $manager = User::factory()->manager()->unverified()->create();
        $category = PlanCategory::factory()->create();
        $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

        Subscription::factory()->active()->for($manager)->create([
            'plan_id' => $plan->id,
            'quantity' => 5,
        ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', 'New User')
            ->set('data.email', 'newuser@test.com')
            ->set('data.password', 'password123')
            ->call('createUser')
            ->assertNotified(__('Verify your email address'));

        expect(User::query()->where('email', 'newuser@test.com')->exists())->toBeFalse();
    });

    it('blocks the checkout endpoint and redirects to the verification notice', function (): void {
        $user = User::factory()->subscriber()->unverified()->create();
        $category = PlanCategory::factory()->create();
        $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

        actingAs($user)
            ->post(route('subscription.checkout', $plan))
            ->assertRedirect(route('verification.notice'));
    });
});

describe('verified user keeps full write access (regression)', function (): void {
    it('allows creating a user', function (): void {
        Bus::fake();

        $manager = User::factory()->manager()->create();
        $category = PlanCategory::factory()->create();
        $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

        Subscription::factory()->active()->for($manager)->create([
            'plan_id' => $plan->id,
            'quantity' => 5,
        ]);

        Livewire::actingAs($manager)
            ->test(ManageUsers::class)
            ->set('data.name', 'New User')
            ->set('data.email', 'newuser@test.com')
            ->set('data.password', 'password123')
            ->call('createUser')
            ->assertNotified(__('User created successfully'));

        expect(User::query()->where('email', 'newuser@test.com')->exists())->toBeTrue();
    });
});

describe('admin panel respects verification state', function (): void {
    it('lets an unverified admin view the dashboard', function (): void {
        $admin = User::factory()->admin()->unverified()->create();

        actingAs($admin)->get(route('filament.admin.pages.dashboard'))->assertOk();
    });

    it('blocks an unverified admin from a resource create page', function (): void {
        $admin = User::factory()->admin()->unverified()->create();

        actingAs($admin)
            ->get(route('filament.admin.resources.blogs.create'))
            ->assertRedirect(route('filament.admin.resources.blogs.index'));
    });

    it('lets a verified admin reach a resource create page', function (): void {
        $admin = User::factory()->admin()->create();

        actingAs($admin)
            ->get(route('filament.admin.resources.blogs.create'))
            ->assertOk();
    });

    it('redirects an unverified non-admin out of the panel to modules', function (): void {
        $user = User::factory()->subscriber()->unverified()->create();

        actingAs($user)
            ->get(route('filament.admin.pages.dashboard'))
            ->assertRedirect(route('modules'));
    });
});

describe('verification email can be resent', function (): void {
    it('sends a verification notification to the current user', function (): void {
        Notification::fake();

        $user = User::factory()->subscriber()->unverified()->create();

        actingAs($user)
            ->post(route('verification.send'))
            ->assertRedirect();

        Notification::assertSentTo($user, VerifyEmail::class);
    });

    it('does not resend when the email is already verified', function (): void {
        Notification::fake();

        $user = User::factory()->subscriber()->create();

        actingAs($user)->post(route('verification.send'));

        Notification::assertNothingSent();
    });
});
