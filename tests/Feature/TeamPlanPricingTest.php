<?php

declare(strict_types=1);

use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\TeamPlanPrice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    PlanCategory::factory()->create();
});

describe('TeamPlanPrice relationships', function (): void {
    it('belongs to a team and a plan', function (): void {
        $team = Team::factory()->create();
        $plan = Plan::factory()->create();

        $price = TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'price' => 150000,
            'price_eur' => 375,
        ]);

        expect($price->team->is($team))->toBeTrue();
        expect($price->plan->is($plan))->toBeTrue();
    });

    it('enforces unique team_id + plan_id pair', function (): void {
        $team = Team::factory()->create();
        $plan = Plan::factory()->create();

        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
        ]);

        expect(fn () => TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
        ]))->toThrow(Exception::class);
    });

    it('cascades only the deleted team prices, leaving other teams untouched', function (): void {
        $teamToDelete = Team::factory()->create();
        $otherTeam = Team::factory()->create();
        $plan = Plan::factory()->create();

        $deletedPrice = TeamPlanPrice::factory()->create([
            'team_id' => $teamToDelete->id,
            'plan_id' => $plan->id,
        ]);
        $survivingPrice = TeamPlanPrice::factory()->create([
            'team_id' => $otherTeam->id,
            'plan_id' => $plan->id,
        ]);

        $teamToDelete->delete();

        expect(TeamPlanPrice::query()->find($deletedPrice->id))->toBeNull();
        expect(TeamPlanPrice::query()->find($survivingPrice->id))->not->toBeNull();
    });

    it('cascades only the deleted plan prices, leaving other plans untouched', function (): void {
        $team = Team::factory()->create();
        $planToDelete = Plan::factory()->create();
        $otherPlan = Plan::factory()->create();

        $deletedPrice = TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $planToDelete->id,
        ]);
        $survivingPrice = TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $otherPlan->id,
        ]);

        $planToDelete->delete();

        expect(TeamPlanPrice::query()->find($deletedPrice->id))->toBeNull();
        expect(TeamPlanPrice::query()->find($survivingPrice->id))->not->toBeNull();
    });
});

describe('Team.planPrices relationship', function (): void {
    it('returns all plan prices for a team', function (): void {
        $team = Team::factory()->create();
        TeamPlanPrice::factory()->count(3)->create(['team_id' => $team->id]);

        expect($team->planPrices)->toHaveCount(3);
    });

    it('exposes plans via belongsToMany pivot', function (): void {
        $team = Team::factory()->create();
        $plan = Plan::factory()->create();
        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'price' => 200000,
        ]);

        expect($team->plans()->first()->pivot->price)->toEqual('200000.00');
    });
});

describe('Plan priceForTeam helpers', function (): void {
    it('returns team custom price when set', function (): void {
        $team = Team::factory()->create();
        $plan = Plan::factory()->create(['price' => 99990, 'price_eur' => 250]);
        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'price' => 75000,
            'price_eur' => 180,
            'stripe_price_id' => 'price_team_custom',
        ]);

        $team->load('planPrices');

        expect((float) $plan->priceForTeam($team))->toEqual(75000.00);
        expect((float) $plan->priceEurForTeam($team))->toEqual(180.00);
        expect($plan->stripePriceIdForTeam($team))->toBe('price_team_custom');
        expect($plan->hasCustomPriceForTeam($team))->toBeTrue();
    });

    it('falls back to plan values when team has no custom price', function (): void {
        $team = Team::factory()->create();
        $plan = Plan::factory()->create([
            'price' => 99990,
            'stripe_price_id' => 'price_plan_default',
        ]);
        $team->load('planPrices');

        expect((float) $plan->priceForTeam($team))->toEqual(99990.00);
        expect($plan->stripePriceIdForTeam($team))->toBe('price_plan_default');
        expect($plan->hasCustomPriceForTeam($team))->toBeFalse();
    });

    it('falls back to plan values when team is null', function (): void {
        $plan = Plan::factory()->create(['price' => 99990]);

        expect((float) $plan->priceForTeam(null))->toEqual(99990.00);
        expect($plan->hasCustomPriceForTeam(null))->toBeFalse();
    });
});

describe('Subscription effective price', function (): void {
    it('returns the plan default price when no team is assigned', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $plan = Plan::factory()->create(['price' => 99990]);
        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => null]);

        expect((float) $subscription->effectivePrice())->toEqual(99990.00);
    });

    it('returns the plan default price when team has no custom pricing for that plan', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $team = Team::factory()->create();
        $plan = Plan::factory()->create(['price' => 99990]);

        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => $team->id]);

        expect((float) $subscription->effectivePrice())->toEqual(99990.00);
    });

    it('returns the team custom price when the team has a TeamPlanPrice for the plan', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $team = Team::factory()->create();
        $plan = Plan::factory()->create(['price' => 99990]);

        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'price' => 75000,
        ]);

        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => $team->id]);

        expect((float) $subscription->effectivePrice())->toEqual(75000.00);
    });

    it('returns custom EUR price when set on team plan price', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $team = Team::factory()->create();
        $plan = Plan::factory()->create(['price' => 99990, 'price_eur' => 249]);

        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'price' => 75000,
            'price_eur' => 190,
        ]);

        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => $team->id]);

        expect((float) $subscription->effectivePriceEur())->toEqual(190.00);
    });

    it('returns custom stripe_price_id from team plan price when set', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $team = Team::factory()->create();
        $plan = Plan::factory()->create([
            'stripe_price_id' => 'price_plan_default',
        ]);

        TeamPlanPrice::factory()->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'stripe_price_id' => 'price_team_custom',
        ]);

        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => $team->id]);

        expect($subscription->effectiveStripePriceId())->toBe('price_team_custom');
    });

    it('falls back to plan stripe_price_id when team has no custom one', function (): void {
        $user = User::factory()->manager()->create();
        $this->actingAs($user);

        $team = Team::factory()->create();
        $plan = Plan::factory()->create([
            'stripe_price_id' => 'price_plan_default',
        ]);

        $subscription = Subscription::factory()
            ->for($user)
            ->create(['plan_id' => $plan->id, 'team_id' => $team->id]);

        expect($subscription->effectiveStripePriceId())->toBe('price_plan_default');
    });
});
