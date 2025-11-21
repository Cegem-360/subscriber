<?php

declare(strict_types=1);

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a plan with factory', function () {
    $plan = Plan::factory()->create();

    expect($plan)->toBeInstanceOf(Plan::class)
        ->and($plan->id)->not->toBeNull()
        ->and($plan->name)->not->toBeNull()
        ->and($plan->slug)->not->toBeNull();
});

it('creates plan with custom attributes', function () {
    $plan = Plan::factory()->create([
        'name' => 'Premium Plan',
        'price' => 199.99,
        'is_active' => true,
    ]);

    expect($plan->name)->toBe('Premium Plan')
        ->and($plan->price)->toBe('199.99')
        ->and($plan->is_active)->toBeTrue();
});

it('creates a basic plan with factory', function () {
    $plan = Plan::factory()->basic()->create();

    expect($plan->name)->toBe('Basic Plan')
        ->and($plan->slug)->toBe('basic')
        ->and($plan->price)->toBe('9.99')
        ->and($plan->sort_order)->toBe(1);
});

it('creates a pro plan with factory', function () {
    $plan = Plan::factory()->pro()->create();

    expect($plan->name)->toBe('Pro Plan')
        ->and($plan->slug)->toBe('pro')
        ->and($plan->price)->toBe('29.99')
        ->and($plan->sort_order)->toBe(2);
});

it('creates an enterprise plan with factory', function () {
    $plan = Plan::factory()->enterprise()->create();

    expect($plan->name)->toBe('Enterprise Plan')
        ->and($plan->slug)->toBe('enterprise')
        ->and($plan->price)->toBe('99.99')
        ->and($plan->sort_order)->toBe(3);
});

it('creates plan with category', function () {
    $category = \App\Models\Plan\PlanCategory::factory()->create();
    $plan = Plan::factory()->category($category->id)->create();

    expect($plan->plan_category_id)->toBe($category->id);
});
