<?php

declare(strict_types=1);

use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

uses(RefreshDatabase::class);

it('activates CRM when a plan is linked to a subscription created without one', function (): void {
    Bus::fake();

    $category = PlanCategory::factory()->create(['slug' => 'kontrolling']);
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);
    $user = User::factory()->create();

    // Mirrors the Stripe import: the subscription is created without a plan,
    // so the "created" observer cannot resolve an appKey and skips activation.
    $subscription = Subscription::factory()->active()->for($user)->create(['plan_id' => null]);

    Bus::assertNotDispatched(ToggleUserActiveJob::class);

    // The controller links the plan afterwards — this must trigger activation.
    $subscription->plan_id = $plan->id;
    $subscription->save();

    Bus::assertDispatched(
        ToggleUserActiveJob::class,
        fn (ToggleUserActiveJob $job): bool => $job->userEmail === $user->email
            && $job->isActive
            && $job->appKey === $category->slug,
    );
});

it('activates CRM when a subscription is created with a plan already set', function (): void {
    Bus::fake();

    $category = PlanCategory::factory()->create(['slug' => 'crm']);
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);
    $user = User::factory()->create();

    Subscription::factory()->active()->for($user)->create(['plan_id' => $plan->id]);

    Bus::assertDispatched(
        ToggleUserActiveJob::class,
        fn (ToggleUserActiveJob $job): bool => $job->userEmail === $user->email
            && $job->isActive
            && $job->appKey === $category->slug,
    );
});

it('does not activate CRM while the linked plan has no category', function (): void {
    Bus::fake();

    $plan = Plan::factory()->create(['plan_category_id' => null]);
    $user = User::factory()->create();

    $subscription = Subscription::factory()->active()->for($user)->create(['plan_id' => null]);
    $subscription->plan_id = $plan->id;
    $subscription->save();

    Bus::assertNotDispatched(ToggleUserActiveJob::class);
});
