<?php

declare(strict_types=1);

use App\Models\Plan\PlanCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a plan category with factory', function () {
    $category = PlanCategory::factory()->create();

    expect($category)->toBeInstanceOf(PlanCategory::class)
        ->and($category->id)->not->toBeNull()
        ->and($category->name)->not->toBeNull();
});
