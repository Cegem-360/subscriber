<?php

declare(strict_types=1);

use App\Enums\BillingPeriod;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has correct fillable attributes', function () {
    $plan = new Plan;

    expect($plan->getFillable())->toBe([
        'name',
        'slug',
        'plan_category_id',
        'description',
        'price',
        'billing_period',
        'stripe_price_id',
        'stripe_product_id',
        'features',
        'is_active',
        'sort_order',
    ]);
});

it('casts features to array', function () {
    $plan = Plan::factory()->create([
        'features' => ['feature1', 'feature2'],
    ]);

    expect($plan->features)->toBeArray()
        ->and($plan->features)->toBe(['feature1', 'feature2']);
});

it('casts is_active to boolean', function () {
    $plan = Plan::factory()->create(['is_active' => 1]);

    expect($plan->is_active)->toBeBool()
        ->and($plan->is_active)->toBeTrue();
});

it('casts price to decimal', function () {
    $plan = Plan::factory()->create(['price' => 99.99]);

    expect($plan->price)->toBe('99.99');
});

it('casts billing_period to enum', function () {
    $plan = Plan::factory()->create(['billing_period' => BillingPeriod::Monthly]);

    expect($plan->billing_period)->toBeInstanceOf(BillingPeriod::class)
        ->and($plan->billing_period)->toBe(BillingPeriod::Monthly);
});

it('belongs to a plan category', function () {
    $category = PlanCategory::factory()->create();
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

    expect($plan->planCategory)->toBeInstanceOf(PlanCategory::class)
        ->and($plan->planCategory->id)->toBe($category->id);
});

it('has many subscriptions', function () {
    $plan = Plan::factory()->create();
    $subscription = Subscription::factory()->create(['plan_id' => $plan->id]);

    expect($plan->subscriptions)->toHaveCount(1)
        ->and($plan->subscriptions->first()->id)->toBe($subscription->id);
});

it('filters active plans with scope', function () {
    Plan::factory()->create(['is_active' => true]);
    Plan::factory()->create(['is_active' => false]);
    Plan::factory()->create(['is_active' => true]);

    $activePlans = Plan::active()->get();

    expect($activePlans)->toHaveCount(2);
});
