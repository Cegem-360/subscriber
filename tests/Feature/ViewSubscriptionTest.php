<?php

declare(strict_types=1);

use App\Livewire\Page\ViewSubscriptionPage;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\TeamPlanPrice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Number;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->user = User::factory()->create();

    $this->planCategory = PlanCategory::factory()->create([
        'name' => 'Controlling',
        'slug' => 'controlling',
    ]);

    $this->plan = Plan::factory()->create([
        'name' => 'Basic',
        'plan_category_id' => $this->planCategory->id,
        'price' => 5000,
        'stripe_price_id' => 'price_basic_test',
    ]);

    $this->subscription = Subscription::factory()->create([
        'user_id' => $this->user->id,
        'plan_id' => $this->plan->id,
        'quantity' => 3,
        'stripe_status' => 'active',
        'stripe_id' => 'sub_test_123',
    ]);
});

it('can access view page for own subscription', function (): void {
    actingAs($this->user)
        ->get(route('subscription.view', $this->subscription))
        ->assertOk()
        ->assertSee(__('Subscription Details'));
});

it('displays subscription details', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee($this->plan->name)
        ->assertSee($this->planCategory->name)
        ->assertSee('3'); // quantity
});

it('shows plan and billing information', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Plan Details'))
        ->assertSee(__('Billing Details'))
        ->assertSee(__('Seats & Usage'));
});

it('shows active status for active subscription', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Active'));
});

it('shows update button for active subscription', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee(__('Update'));
});

it('shows stripe details when subscription is linked', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee('sub_test_123')
        ->assertSee(__('Technical Details'));
});

it('shows team members when present', function (): void {
    $member = User::factory()->memberOf($this->subscription)->create();

    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertSee($member->name)
        ->assertSee($member->email);
});

it('shows team-specific custom price when set', function (): void {
    $team = Team::factory()->create();

    TeamPlanPrice::factory()->create([
        'team_id' => $team->id,
        'plan_id' => $this->plan->id,
        'price' => 3500,
    ]);

    $this->subscription->update(['team_id' => $team->id]);

    Livewire::actingAs($this->user)
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription->fresh()])
        ->assertSee(__('(egyedi)'))
        ->assertSee(Number::currency(3500, 'HUF', 'hu', 0))
        ->assertSee(Number::currency(3500 * 3, 'HUF', 'hu', 0));
});

it('shows plan default price when team has no custom pricing', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ViewSubscriptionPage::class, ['subscription' => $this->subscription])
        ->assertDontSee(__('(egyedi)'))
        ->assertSee(Number::currency(5000, 'HUF', 'hu', 0));
});
