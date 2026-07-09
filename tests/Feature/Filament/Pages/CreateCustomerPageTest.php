<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Pages\CreateCustomer;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

test('admin can render the create customer page', function (): void {
    $this->actingAs(User::factory()->admin()->create());

    livewire(CreateCustomer::class)->assertSuccessful();
});

test('non-admin cannot access the create customer page', function (): void {
    expect(CreateCustomer::canAccess())->toBeFalse();

    $this->actingAs(User::factory()->admin()->create());
    expect(CreateCustomer::canAccess())->toBeTrue();
});

test('wizard creates owner, subscription and member end to end', function (): void {
    Bus::fake();
    $this->actingAs(User::factory()->admin()->create());

    $plan = Plan::factory()->create();

    livewire(CreateCustomer::class)
        ->fillForm([
            'name' => 'Kovács Anna',
            'email' => 'anna@example.com',
            'password' => 'password123',
            'role' => UserRole::Manager->value,
            'company_name' => 'Anna Kft.',
            'tax_number' => '11111111-1-11',
            'address' => 'Fő tér 2.',
            'city' => 'Szeged',
            'postal_code' => '6720',
            'country' => 'HU',
            'plans' => [
                ['plan_id' => $plan->id, 'quantity' => 4],
            ],
            'create_team' => true,
            'team_name' => 'Anna Csapat',
            'members' => [
                ['name' => 'Tag', 'email' => 'tag@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('users', ['email' => 'anna@example.com']);
    assertDatabaseHas('users', ['email' => 'tag@example.com']);

    $owner = User::query()->where('email', 'anna@example.com')->first();
    expect(Subscription::query()->withoutGlobalScopes()->where('user_id', $owner->id)->count())->toBe(1);
});

test('blocks submit when members exceed available seats', function (): void {
    Bus::fake();
    $this->actingAs(User::factory()->admin()->create());
    $plan = Plan::factory()->create();

    livewire(CreateCustomer::class)
        ->fillForm([
            'name' => 'Kis Pál', 'email' => 'pal@example.com', 'password' => 'password123',
            'role' => UserRole::Manager->value, 'company_name' => 'Pál Kft.', 'tax_number' => '2',
            'address' => 'A', 'city' => 'B', 'postal_code' => '1', 'country' => 'HU',
            'plans' => [['plan_id' => $plan->id, 'quantity' => 2]], // 1 seat for members
            'create_team' => false, 'team_name' => null,
            'members' => [
                ['name' => 'T1', 'email' => 't1@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
                ['name' => 'T2', 'email' => 't2@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ],
        ])
        ->call('create');

    expect(User::query()->where('email', 'pal@example.com')->exists())->toBeFalse();
});

test('blocks submit when an email is duplicated between owner and member', function (): void {
    Bus::fake();
    $this->actingAs(User::factory()->admin()->create());
    $plan = Plan::factory()->create();

    livewire(CreateCustomer::class)
        ->fillForm([
            'name' => 'Dup', 'email' => 'dup@example.com', 'password' => 'password123',
            'role' => UserRole::Manager->value, 'company_name' => 'Dup Kft.', 'tax_number' => '2',
            'address' => 'A', 'city' => 'B', 'postal_code' => '1', 'country' => 'HU',
            'plans' => [['plan_id' => $plan->id, 'quantity' => 5]],
            'create_team' => false, 'team_name' => null,
            'members' => [
                ['name' => 'T1', 'email' => 'dup@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ],
        ])
        ->call('create');

    expect(User::query()->where('email', 'dup@example.com')->exists())->toBeFalse();
});

test('duplicate email guard is case-insensitive', function (): void {
    Bus::fake();
    $this->actingAs(User::factory()->admin()->create());
    $plan = Plan::factory()->create();

    livewire(CreateCustomer::class)
        ->fillForm([
            'name' => 'Case', 'email' => 'dup@example.com', 'password' => 'password123',
            'role' => UserRole::Manager->value, 'company_name' => 'Case Kft.', 'tax_number' => '2',
            'address' => 'A', 'city' => 'B', 'postal_code' => '1', 'country' => 'HU',
            'plans' => [['plan_id' => $plan->id, 'quantity' => 5]],
            'create_team' => false, 'team_name' => null,
            'members' => [
                ['name' => 'T1', 'email' => 'DUP@Example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ],
        ])
        ->call('create');

    expect(User::query()->where('email', 'dup@example.com')->exists())->toBeFalse();
});
