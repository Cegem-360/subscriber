<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Laravel\Passport\Passport;

it('rejects an unauthenticated request', function (): void {
    $this->getJson('/api/userinfo')->assertStatus(401);
});

it('returns the full identity state in one response', function (): void {
    $user = User::factory()->create([
        'name' => 'Teszt Elek',
        'email' => 'teszt@example.com',
        'role' => UserRole::Manager,
    ]);

    $team = Team::query()->create(['name' => 'Acme Kft.', 'slug' => 'acme-kft']);
    $user->teams()->attach($team);

    Passport::actingAs($user);

    $response = $this->getJson('/api/userinfo')->assertOk();

    expect($response->json('sub'))->toBe($user->uuid)
        ->and($response->json('email'))->toBe('teszt@example.com')
        ->and($response->json('name'))->toBe('Teszt Elek')
        ->and($response->json('role'))->toBe('manager')
        ->and($response->json('orgs'))->toBe([[
            'uuid' => $team->uuid,
            'name' => 'Acme Kft.',
            'slug' => 'acme-kft',
        ]]);
});

it('serialises the role as the enum string value, not the enum object', function (): void {
    // A fogyasztó appok stringet várnak; egy szerializált enum objektum
    // csendben elrontaná a syncRoles() hívást a provisionerben.
    $user = User::factory()->create(['role' => UserRole::Subscriber]);

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('role'))->toBe('subscriber');
});

it('reports the plan category slug of an active subscription as an app key', function (): void {
    // Szándékosan konkrét slugra állít, nem a accessibleAppKeys() saját
    // visszatérésére: az önmagára hivatkozó összehasonlítás akkor is
    // átmenne, ha mindkét oldal ugyanúgy hibás.
    $user = User::factory()->create();

    $category = PlanCategory::factory()->create(['slug' => 'kontrolling']);
    $plan = Plan::factory()->create(['plan_category_id' => $category->id]);

    Subscription::factory()->active()->for($user)->create([
        'plan_id' => $plan->id,
        'quantity' => 5,
    ]);

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('apps'))->toBe(['kontrolling']);
});

it('returns an empty orgs list for a user with no teams', function (): void {
    $user = User::factory()->create();

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('orgs'))->toBe([]);
});

it('returns an empty apps list for a user with no subscription', function (): void {
    // Ez a 3. fázis hozzáférés-ellenőrzésének a bemenete: üres apps
    // claim = a felhasználó egyetlen modulba sem léphet be.
    $user = User::factory()->create();

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('apps'))->toBe([]);
});

it('stamps issued_at with the current timestamp', function (): void {
    $user = User::factory()->create();

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('issued_at'))
        ->toBe(now()->timestamp);
});

it('lists every team the user belongs to', function (): void {
    $user = User::factory()->create();

    $first = Team::query()->create(['name' => 'Egy', 'slug' => 'egy']);
    $second = Team::query()->create(['name' => 'Ketto', 'slug' => 'ketto']);
    $user->teams()->attach([$first->id, $second->id]);

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('orgs'))->toHaveCount(2);
});
