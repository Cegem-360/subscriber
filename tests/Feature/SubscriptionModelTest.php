<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

beforeEach(function (): void {
    PlanCategory::factory()->create();
    Plan::factory()->create();
});

uses(RefreshDatabase::class);

describe('Subscription available seats', function (): void {
    it('calculates available seats correctly with owner included', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => 5]);

        // quantity 5 = owner + 4 members max
        expect($subscription->availableSeats())->toBe(4);
    });

    it('reduces available seats when members are added', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => 5]);

        // Add 2 members
        User::factory()->count(2)->memberOf($subscription)->create([
            'role' => UserRole::Subscriber,
        ]);

        // quantity 5 = owner + 4 max, 2 used = 2 available
        expect($subscription->availableSeats())->toBe(2);
    });

    it('returns zero when subscription is full', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => 3]);

        // Add 2 members (max for quantity 3)
        User::factory()->count(2)->memberOf($subscription)->create([
            'role' => UserRole::Subscriber,
        ]);

        expect($subscription->availableSeats())->toBe(0);
    });

    it('returns negative when over capacity', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => 2]);

        // Add 3 members (over capacity)
        User::factory()->count(3)->memberOf($subscription)->create([
            'role' => UserRole::Subscriber,
        ]);

        expect($subscription->availableSeats())->toBe(-2);
    });

    it('handles null quantity gracefully', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => null]);

        expect($subscription->availableSeats())->toBe(-1);
    });
});

describe('User accessible subscriptions', function (): void {
    it('includes both owned and member subscriptions', function (): void {
        $plan = Plan::query()->first();

        $owner = User::factory()->create();
        $owned = Subscription::factory()->active()->for($owner)->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $otherOwner = User::factory()->create();
        $memberSub = Subscription::factory()->active()->for($otherOwner)->create(['plan_id' => $plan->id, 'quantity' => 5]);

        $member = User::factory()->memberOf($memberSub)->create();

        expect($owner->accessibleSubscriptions()->pluck('id')->all())->toContain($owned->id);
        expect($member->accessibleSubscriptions()->pluck('id')->all())
            ->toContain($memberSub->id)
            ->not->toContain($owned->id);
    });
});

describe('Subscription members relationship', function (): void {
    it('returns users assigned to subscription', function (): void {
        $manager = User::factory()->manager()->create();
        actingAs($manager);

        $subscription = Subscription::factory()
            ->active()
            ->for($manager)
            ->create(['quantity' => 5]);

        $members = User::factory()->count(3)->memberOf($subscription)->create([
            'role' => UserRole::Subscriber,
        ]);

        expect($subscription->members)->toHaveCount(3);
        expect($subscription->members->pluck('id')->toArray())
            ->toEqual($members->pluck('id')->toArray());
    });
});
