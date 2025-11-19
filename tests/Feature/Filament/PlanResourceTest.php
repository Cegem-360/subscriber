<?php

declare(strict_types=1);

use App\Enums\BillingPeriod;
use App\Filament\Resources\Plans\Pages\CreatePlan;
use App\Filament\Resources\Plans\Pages\EditPlan;
use App\Filament\Resources\Plans\Pages\ListPlans;
use App\Models\Plan;
use App\Models\User;

use function Pest\Livewire\livewire;

beforeEach(function (): void {
    $this->actingAs(User::factory()->create());
});

test('can render plans list page', function (): void {
    livewire(ListPlans::class)
        ->assertSuccessful();
});

test('can list plans', function (): void {
    $plans = Plan::factory()->count(3)->create();

    livewire(ListPlans::class)
        ->assertCanSeeTableRecords($plans);
});

test('can search plans by name', function (): void {
    $plans = Plan::factory()->count(5)->create();
    $planToFind = $plans->first();

    livewire(ListPlans::class)
        ->searchTable($planToFind->name)
        ->assertCanSeeTableRecords([$planToFind])
        ->assertCanNotSeeTableRecords($plans->skip(1));
});

test('can sort plans by name', function (): void {
    $plans = Plan::factory()->count(3)->create();

    livewire(ListPlans::class)
        ->sortTable('name')
        ->assertCanSeeTableRecords($plans->sortBy('name'), inOrder: true)
        ->sortTable('name', 'desc')
        ->assertCanSeeTableRecords($plans->sortByDesc('name'), inOrder: true);
});

test('can filter plans by billing period', function (): void {
    $monthlyPlans = Plan::factory()->count(2)->create(['billing_period' => BillingPeriod::Monthly]);
    $yearlyPlans = Plan::factory()->count(2)->create(['billing_period' => BillingPeriod::Yearly]);

    livewire(ListPlans::class)
        ->filterTable('billing_period', 'monthly')
        ->assertCanSeeTableRecords($monthlyPlans)
        ->assertCanNotSeeTableRecords($yearlyPlans);
});

test('can render create plan page', function (): void {
    livewire(CreatePlan::class)
        ->assertSuccessful();
});

test('can create a plan via model', function (): void {
    $slug = 'test-plan-' . uniqid();

    $plan = Plan::query()->create([
        'name' => 'Test Plan',
        'slug' => $slug,
        'description' => 'A test plan',
        'price' => 19.99,
        'billing_period' => BillingPeriod::Monthly,
        'features' => ['Feature 1', 'Feature 2'],
        'is_active' => true,
        'sort_order' => 1,
    ]);

    expect($plan->exists)->toBeTrue()
        ->and($plan->name)->toBe('Test Plan')
        ->and((float) $plan->price)->toBe(19.99)
        ->and($plan->billing_period)->toBe(BillingPeriod::Monthly)
        ->and($plan->features)->toBe(['Feature 1', 'Feature 2'])
        ->and($plan->is_active)->toBeTrue();
});

test('can validate plan creation', function (): void {
    livewire(CreatePlan::class)
        ->fillForm([
            'name' => '',
            'slug' => '',
            'price' => null,
        ])
        ->call('create')
        ->assertHasFormErrors(['name', 'slug', 'price']);
});

test('can render edit plan page', function (): void {
    $plan = Plan::factory()->create();

    livewire(EditPlan::class, ['record' => $plan->id])
        ->assertSuccessful();
});

test('can retrieve plan data for editing', function (): void {
    $plan = Plan::factory()->create();

    livewire(EditPlan::class, ['record' => $plan->id])
        ->assertFormSet([
            'name' => $plan->name,
            'slug' => $plan->slug,
            'price' => $plan->price,
            'billing_period' => $plan->billing_period,
        ]);
});

test('can update a plan via model', function (): void {
    $plan = Plan::factory()->create([
        'name' => 'Original Plan',
        'price' => 19.99,
    ]);

    $plan->update([
        'name' => 'Updated Plan Name',
        'price' => 29.99,
    ]);

    expect($plan->name)->toBe('Updated Plan Name')
        ->and((float) $plan->price)->toBe(29.99);
});

test('can toggle plan active status', function (): void {
    $plan = Plan::factory()->create(['is_active' => true]);

    livewire(ListPlans::class)
        ->callTableAction('toggle_status', $plan);

    $plan->refresh();

    expect($plan->is_active)->toBeFalse();
});
