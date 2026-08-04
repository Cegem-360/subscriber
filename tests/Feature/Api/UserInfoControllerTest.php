<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Passport\ClientRepository;
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

it('fails loudly instead of emitting a null sub for a user not yet backfilled with a uuid', function (): void {
    // uuid is nullable on purpose: rows from before the migration are
    // filled in later by a separate backfill command. The `creating` hook
    // only stamps new rows, so update the column directly and bypass model
    // events, the way a not-yet-backfilled legacy row would look.
    $user = User::factory()->create();

    User::query()->whereKey($user->id)->update(['uuid' => null]);
    $user->refresh();

    expect($user->uuid)->toBeNull();

    Passport::actingAs($user);

    $this->getJson('/api/userinfo')->assertStatus(500);
});

it('stamps the response with the configured claims_version', function (): void {
    // Consumers log this so a future contract change is traceable. Emitting
    // it costs nothing now; retrofitting it after apps integrate would mean
    // coordinating a deploy per app.
    config(['identity.claims_version' => 3]);

    $user = User::factory()->create();

    Passport::actingAs($user);

    expect($this->getJson('/api/userinfo')->json('claims_version'))->toBe(3);
});

it('rejects a request over the rate limit with 429', function (): void {
    // Anonymous callers must be stopped by the pre-auth, IP-keyed throttle
    // middleware, cheaply, before Passport's ResourceServer ever parses or
    // verifies a JWT.
    $ip = '203.0.113.5';
    $this->withServerVariables(['REMOTE_ADDR' => $ip]);

    for ($i = 0; $i < 60; $i++) {
        $this->getJson('/api/userinfo')->assertStatus(401);
    }

    $this->getJson('/api/userinfo')->assertStatus(429);

    // Defensive: this test's array cache store belongs to this test's own
    // Application instance and is torn down automatically, but clear the
    // hit count explicitly so a future change to that guarantee can't leak
    // rate-limit state into another test.
    RateLimiter::clear('pre-auth-throttle:' . $ip);
});

it('authenticates via a real bearer token with the pre-auth throttle ahead of auth:api', function (): void {
    // Regression test for the bug that shipped in the first fix attempt:
    // moving ThrottleRequests ahead of Authenticate globally in
    // bootstrap/app.php made `Authenticate::authenticate()` call
    // `$this->auth->shouldUse('api')` too late for the throttle's own
    // closure, but it also risked masking guard-resolution bugs everywhere
    // else, because `Passport::actingAs()` calls `shouldUse('api')` directly
    // and never exercises the real HTTP auth pipeline at all.
    //
    // Issue a genuine RS256-signed token through Passport's real
    // token-issuing pipeline and authenticate purely via the Authorization
    // header, so this test would fail if the pre-auth middleware were ever
    // turned back into something that disturbs guard resolution (for
    // example, by reading `$request->user()` before `auth:api` runs).
    $user = User::factory()->create();

    app(ClientRepository::class)->createPersonalAccessGrantClient('Regression Test Client');

    $accessToken = $user->createToken('regression-test-token')->accessToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $accessToken)
        ->getJson('/api/userinfo');

    $response->assertOk();

    expect($response->json('sub'))->toBe($user->uuid);
});

it('fails loudly instead of emitting a null orgs uuid for a team not yet backfilled with a uuid', function (): void {
    $user = User::factory()->create();

    $team = Team::query()->create(['name' => 'Acme Kft.', 'slug' => 'acme-kft']);
    $user->teams()->attach($team);

    Team::query()->whereKey($team->id)->update(['uuid' => null]);
    $team->refresh();

    expect($team->uuid)->toBeNull();

    Passport::actingAs($user);

    $this->getJson('/api/userinfo')->assertStatus(500);
});
