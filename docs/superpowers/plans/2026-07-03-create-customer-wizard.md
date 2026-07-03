# „Új ügyfél" wizard — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Egy admin-panel wizard, ami egy menetben létrehoz egy főfiókot (owner), egy vagy több lokális előfizetést (csomag), opcionálisan egy team-et és tetszőleges számú tag-usert, teljes cross-app provizionálással.

**Architecture:** A provizionálási logika egy dedikált `App\Actions\CreateCustomer` akcióban él (DB tranzakció + `UserTeamSync` + `AttachSubscriptionMember`). Egy vékony Filament custom Page (`App\Filament\Pages\CreateCustomer`) adja a többlépcsős `Wizard` űrlapot és a submit-ot, ami az akciót hívja. A Subscription létrehozásakor a meglévő `SubscriptionObserver::created` automatikusan aktiválja az ownert a modulon.

**Tech Stack:** Laravel 13, Filament v5 (Schemas Wizard), Livewire 4, Pest v4, `madbox-99/laravel-user-team-sync`.

## Global Constraints

- Minden `.php` fájl tetején `declare(strict_types=1);`.
- Konstruktor property promotion, explicit típusok és visszatérési típusok mindenhol.
- PHPDoc array-shape a tömb-paraméterekhez.
- Filament namespace-ek: form mezők `Filament\Forms\Components\`, layout `Filament\Schemas\Components\`, Wizard `Filament\Schemas\Components\Wizard` (+ `\Wizard\Step`), actions `Filament\Actions\`, ikonok `Filament\Support\Icons\Heroicon`.
- Enumok: `UserRole` (`admin`/`manager`/`subscriber`), `SubscriptionType::Default`, `SubscriptionStatus::Active`, `Country` (alap `Hungary`).
- Lokális előfizetés: `stripe_status = SubscriptionStatus::Active`, `stripe_id = 'manual_' . Str::uuid()`, `type = SubscriptionType::Default`, valódi Stripe hívás NINCS.
- A panel id `admin`, a Page-ek auto-discovery-vel regisztrálódnak (`app/Filament/Pages`).
- Hozzáférés: csak admin (`User::isAdmin()`).
- Minden PHP módosítás után: `vendor/bin/pint --dirty --format agent`.
- Tesztek: `php artisan test --compact --filter=...`.
- **Sync-provizíció tesztelése:** a `UserTeamSync` facade metódusai job-okat dispatchelnek (`createUser`→`Madbox99\UserTeamSync\Publisher\Jobs\CreateUserJob`, `createTeam`→`CreateTeamJob`, `toggleUserActive`→`ToggleUserActiveJob`) `dispatch()`-en át. Ezért a tesztek `Bus::fake()`-et használnak és `Bus::assertDispatched(CreateUserJob::class, ...)` / `Bus::assertNotDispatched(...)`-tal ellenőriznek — NEM `UserTeamSync::spy()`-t (a facade spy Mockery-vel megbízhatatlan). Job property-k: `CreateUserJob->email`, `CreateTeamJob->teamName`, `ToggleUserActiveJob->userEmail/appKey`.

## File Structure

- Create: `app/Actions/CreateCustomer.php` — provizionáló akció (owner + team + subscriptions + members). Egyetlen `handle(array): User`.
- Create: `app/Filament/Pages/CreateCustomer.php` — Filament Page a Wizard űrlappal + `create()` submit.
- Create: `resources/views/filament/pages/create-customer.blade.php` — a Page nézete (wizard form + submit).
- Create: `tests/Feature/Actions/CreateCustomerActionTest.php` — az akció tesztjei.
- Create: `tests/Feature/Filament/Pages/CreateCustomerPageTest.php` — a Page (hozzáférés, flow, validáció) tesztjei.

Meglévő, újrahasznált fájlok (NEM módosulnak): `app/Actions/AttachSubscriptionMember.php`, `app/Observers/SubscriptionObserver.php`, `app/Models/{User,Subscription,Team,Plan}.php`, `vendor` UserTeamSync facade.

---

### Task 1: `CreateCustomer` action — owner + subscriptions

**Files:**
- Create: `app/Actions/CreateCustomer.php`
- Test: `tests/Feature/Actions/CreateCustomerActionTest.php`

**Interfaces:**
- Consumes: `Madbox99\UserTeamSync\Facades\UserTeamSync::createUser(string $email, string $name, string $password, string $role, string $ownerEmail)`; `App\Actions\AttachSubscriptionMember::handle(Subscription, User, ?string)`.
- Produces: `App\Actions\CreateCustomer::handle(array $data): User` — létrehozza az owner usert (hash-elt jelszó, `email_verified_at = now()`), lokális Subscription-öket, és visszaadja az owner `User`-t. `$data` flat kulcsai: `name,email,password,role,company_name,tax_number,address,city,postal_code,country`, `plans` (`array<int, array{plan_id, quantity}>`), `create_team` (bool), `team_name` (?string), `members` (`array<int, array{name,email,password,role}>`).

- [ ] **Step 1: Write the failing test**

Create `tests/Feature/Actions/CreateCustomerActionTest.php`:

```php
<?php

declare(strict_types=1);

use App\Actions\CreateCustomer;
use App\Enums\SubscriptionStatus;
use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;
use Madbox99\UserTeamSync\Publisher\Jobs\CreateUserJob;

use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (): void {
    Bus::fake();
});

function ownerPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Nagy Béla',
        'email' => 'owner@example.com',
        'password' => 'password123',
        'role' => UserRole::Manager->value,
        'company_name' => 'Példa Kft.',
        'tax_number' => '12345678-1-42',
        'address' => 'Fő utca 1.',
        'city' => 'Budapest',
        'postal_code' => '1011',
        'country' => 'HU',
        'plans' => [],
        'create_team' => false,
        'team_name' => null,
        'members' => [],
    ], $overrides);
}

test('creates owner user with hashed password and provisions on module apps', function (): void {
    $plan = Plan::factory()->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [['plan_id' => $plan->id, 'quantity' => 3]],
    ]));

    expect($owner)->toBeInstanceOf(User::class)
        ->and($owner->role)->toBe(UserRole::Manager)
        ->and($owner->email_verified_at)->not->toBeNull()
        ->and(Hash::check('password123', $owner->password))->toBeTrue();

    assertDatabaseHas('users', ['email' => 'owner@example.com', 'company_name' => 'Példa Kft.']);

    assertDatabaseHas('subscriptions', [
        'user_id' => $owner->id,
        'plan_id' => $plan->id,
        'quantity' => 3,
        'stripe_status' => SubscriptionStatus::Active->value,
    ]);

    expect(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->first()->stripe_id)
        ->toStartWith('manual_');

    Bus::assertDispatched(CreateUserJob::class, fn (CreateUserJob $job): bool => $job->email === 'owner@example.com');
});

test('creates one subscription per selected plan', function (): void {
    $plans = Plan::factory()->count(2)->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [
            ['plan_id' => $plans[0]->id, 'quantity' => 1],
            ['plan_id' => $plans[1]->id, 'quantity' => 5],
        ],
    ]));

    expect(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->count())->toBe(2);
});
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: FAIL — `Class "App\Actions\CreateCustomer" not found`.

- [ ] **Step 3: Write minimal implementation**

Create `app/Actions/CreateCustomer.php`:

```php
<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Facades\UserTeamSync;

final class CreateCustomer
{
    public function __construct(
        private readonly AttachSubscriptionMember $attachMember,
    ) {}

    /**
     * @param array{
     *   name: string, email: string, password: string, role: string,
     *   company_name: string, tax_number: string, address: string,
     *   city: string, postal_code: string, country: string,
     *   plans: array<int, array{plan_id: int|string, quantity: int|string}>,
     *   create_team: bool, team_name: string|null,
     *   members: array<int, array{name: string, email: string, password: string, role: string}>,
     * } $data
     */
    public function handle(array $data): User
    {
        return DB::transaction(function () use ($data): User {
            $owner = $this->createOwner($data);

            $team = ! empty($data['create_team'])
                ? $this->createTeam($this->resolveTeamName($data, $owner), $owner)
                : null;

            $subscriptions = $this->createSubscriptions($owner, $data['plans'] ?? [], $team);

            foreach ($data['members'] ?? [] as $member) {
                $this->createMember($member, $owner, $subscriptions);
            }

            return $owner;
        });
    }

    /**
     * @param array<string, mixed> $data
     */
    private function createOwner(array $data): User
    {
        $owner = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'company_name' => $data['company_name'],
            'tax_number' => $data['tax_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
            'email_verified_at' => now(),
        ]);

        UserTeamSync::createUser(
            email: $owner->email,
            name: $owner->name,
            password: $data['password'],
            role: $owner->role->value,
            ownerEmail: $owner->email,
        );

        return $owner;
    }

    /**
     * @param array<int, array{plan_id: int|string, quantity: int|string}> $plans
     * @return Collection<int, Subscription>
     */
    private function createSubscriptions(User $owner, array $plans, ?Team $team): Collection
    {
        return collect($plans)->map(function (array $row) use ($owner, $team): Subscription {
            $plan = Plan::query()->findOrFail($row['plan_id']);

            return Subscription::query()->create([
                'user_id' => $owner->id,
                'plan_id' => $plan->id,
                'team_id' => $team?->id,
                'type' => SubscriptionType::Default,
                'stripe_id' => 'manual_' . Str::uuid()->toString(),
                'stripe_status' => SubscriptionStatus::Active,
                'stripe_price' => $plan->stripe_price_id,
                'quantity' => (int) $row['quantity'],
            ]);
        })->values();
    }

    // --- Team + member helpers filled in by later tasks ---

    /**
     * @param array<string, mixed> $data
     */
    private function resolveTeamName(array $data, User $owner): string
    {
        return filled($data['team_name'] ?? null) ? (string) $data['team_name'] : (string) $owner->company_name;
    }

    private function createTeam(string $name, User $owner): Team
    {
        throw new \LogicException('Implemented in Task 2.');
    }

    /**
     * @param array{name: string, email: string, password: string, role: string} $member
     * @param Collection<int, Subscription> $subscriptions
     */
    private function createMember(array $member, User $owner, Collection $subscriptions): void
    {
        throw new \LogicException('Implemented in Task 3.');
    }
}
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: PASS (2 tests). A team/member ágak nem futnak ezekben a tesztekben.

- [ ] **Step 5: Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
git add app/Actions/CreateCustomer.php tests/Feature/Actions/CreateCustomerActionTest.php
git commit -m "feat: add CreateCustomer action (owner + subscriptions)"
```

---

### Task 2: `CreateCustomer` action — team creation

**Files:**
- Modify: `app/Actions/CreateCustomer.php` (replace the `createTeam()` stub)
- Test: `tests/Feature/Actions/CreateCustomerActionTest.php` (add cases)

**Interfaces:**
- Consumes: `Madbox99\UserTeamSync\Facades\UserTeamSync::createTeam(string $teamName, string $userEmail, ?string $slug = null, ?string $userName = null)`; `App\Models\Team` (`name`, `slug` fillable); `User::teams()` belongsToMany (pivot `team_user`).
- Produces: amikor `create_team = true`, létrejön egy lokális `Team`, az owner hozzácsatolódik, `UserTeamSync::createTeam` lefut, és a subscription-ök `team_id`-ja a team-re áll.

- [ ] **Step 1: Write the failing test**

Add the job import near the top of `tests/Feature/Actions/CreateCustomerActionTest.php` (next to the existing `use Madbox99\UserTeamSync\Publisher\Jobs\CreateUserJob;`):

```php
use Madbox99\UserTeamSync\Publisher\Jobs\CreateTeamJob;
```

Add these tests to `tests/Feature/Actions/CreateCustomerActionTest.php`:

```php
test('creates a team, attaches owner, and links subscriptions to it', function (): void {
    $plan = Plan::factory()->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => 'Csapat Egy',
        'plans' => [['plan_id' => $plan->id, 'quantity' => 2]],
    ]));

    $team = \App\Models\Team::query()->where('name', 'Csapat Egy')->first();

    expect($team)->not->toBeNull()
        ->and($owner->teams()->whereKey($team->id)->exists())->toBeTrue()
        ->and(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->first()->team_id)
            ->toBe($team->id);

    Bus::assertDispatched(CreateTeamJob::class, fn (CreateTeamJob $job): bool => $job->teamName === 'Csapat Egy');
});

test('falls back to company name when team name is blank', function (): void {
    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'create_team' => true,
        'team_name' => null,
    ]));

    expect(\App\Models\Team::query()->where('name', 'Példa Kft.')->exists())->toBeTrue();
});

test('creates no team when create_team is false', function (): void {
    app(CreateCustomer::class)->handle(ownerPayload(['create_team' => false]));

    expect(\App\Models\Team::query()->count())->toBe(0);
    Bus::assertNotDispatched(CreateTeamJob::class);
});
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: FAIL — `LogicException: Implemented in Task 2.`

- [ ] **Step 3: Write minimal implementation**

In `app/Actions/CreateCustomer.php`, replace the `createTeam()` stub with:

```php
    private function createTeam(string $name, User $owner): Team
    {
        $team = Team::query()->create([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::lower(Str::random(6)),
        ]);

        $owner->teams()->attach($team);

        UserTeamSync::createTeam(
            teamName: $team->name,
            userEmail: $owner->email,
            userName: $owner->name,
        );

        return $team;
    }
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: PASS (all 5 tests).

- [ ] **Step 5: Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
git add app/Actions/CreateCustomer.php tests/Feature/Actions/CreateCustomerActionTest.php
git commit -m "feat: CreateCustomer action creates and links team"
```

---

### Task 3: `CreateCustomer` action — members via AttachSubscriptionMember

**Files:**
- Modify: `app/Actions/CreateCustomer.php` (replace the `createMember()` stub)
- Test: `tests/Feature/Actions/CreateCustomerActionTest.php` (add cases)

**Interfaces:**
- Consumes: `App\Actions\AttachSubscriptionMember::handle(Subscription $subscription, User $user, ?string $rawPassword = null): void` (member pivot + `UserTeamSync::createUser` + `ToggleUserActiveJob`).
- Produces: minden tag-user létrejön (hash-elt jelszó, `email_verified_at = now()`, owner cégneve), és MINDEN létrehozott subscription-höz hozzácsatolódik a `subscription_user` pivoton.

- [ ] **Step 1: Write the failing test**

Add to `tests/Feature/Actions/CreateCustomerActionTest.php`:

```php
test('creates members and attaches each to every subscription', function (): void {
    $plans = Plan::factory()->count(2)->create();

    $owner = app(CreateCustomer::class)->handle(ownerPayload([
        'plans' => [
            ['plan_id' => $plans[0]->id, 'quantity' => 5],
            ['plan_id' => $plans[1]->id, 'quantity' => 5],
        ],
        'members' => [
            ['name' => 'Tag Egy', 'email' => 'tag1@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
            ['name' => 'Tag Kettő', 'email' => 'tag2@example.com', 'password' => 'secret123', 'role' => UserRole::Subscriber->value],
        ],
    ]));

    $member = User::query()->where('email', 'tag1@example.com')->first();

    expect($member)->not->toBeNull()
        ->and($member->company_name)->toBe('Példa Kft.')
        ->and(Hash::check('secret123', $member->password))->toBeTrue();

    // attached to both subscriptions
    $subscriptionIds = Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->pluck('id');
    expect($member->memberSubscriptions()->pluck('subscriptions.id')->sort()->values()->all())
        ->toEqual($subscriptionIds->sort()->values()->all());
});
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: FAIL — `LogicException: Implemented in Task 3.`

- [ ] **Step 3: Write minimal implementation**

In `app/Actions/CreateCustomer.php`, replace the `createMember()` stub with:

```php
    private function createMember(array $member, User $owner, Collection $subscriptions): void
    {
        $user = User::query()->create([
            'name' => $member['name'],
            'email' => $member['email'],
            'password' => Hash::make($member['password']),
            'role' => $member['role'],
            'company_name' => $owner->company_name,
            'email_verified_at' => now(),
        ]);

        foreach ($subscriptions as $subscription) {
            $this->attachMember->handle($subscription, $user, $member['password']);
        }
    }
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerActionTest`
Expected: PASS (all 6 tests).

- [ ] **Step 5: Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
git add app/Actions/CreateCustomer.php tests/Feature/Actions/CreateCustomerActionTest.php
git commit -m "feat: CreateCustomer action provisions members"
```

---

### Task 4: Filament Page skeleton + access control + view

**Files:**
- Create: `app/Filament/Pages/CreateCustomer.php`
- Create: `resources/views/filament/pages/create-customer.blade.php`
- Test: `tests/Feature/Filament/Pages/CreateCustomerPageTest.php`

**Interfaces:**
- Consumes: `App\Actions\CreateCustomer::handle(array): User` (Task 3).
- Produces: `App\Filament\Pages\CreateCustomer` Livewire Page az `admin` panelen; `create(): void` submit metódus; `data` állapot a wizard űrlaphoz. `shouldRegisterNavigation()` és `canAccess()` csak adminnak `true`.

- [ ] **Step 1: Write the failing test**

Create `tests/Feature/Filament/Pages/CreateCustomerPageTest.php`:

```php
<?php

declare(strict_types=1);

use App\Filament\Pages\CreateCustomer;
use App\Models\User;

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
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: FAIL — `Class "App\Filament\Pages\CreateCustomer" not found`.

- [ ] **Step 3: Write minimal implementation**

Create `app/Filament/Pages/CreateCustomer.php`:

```php
<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Override;

final class CreateCustomer extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserPlus;

    protected static ?string $slug = 'uj-ugyfel';

    protected static ?string $navigationLabel = 'Új ügyfél';

    protected static ?string $title = 'Új ügyfél létrehozása';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.create-customer';

    /** @var array<string, mixed> */
    public ?array $data = [];

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function canAccess(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        // Wizard steps added in Task 5.
        return $schema
            ->components([])
            ->statePath('data');
    }

    public function create(): void
    {
        // Implemented in Task 5.
    }
}
```

Create `resources/views/filament/pages/create-customer.blade.php`:

```blade
<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: PASS (2 tests).

- [ ] **Step 5: Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
git add app/Filament/Pages/CreateCustomer.php resources/views/filament/pages/create-customer.blade.php tests/Feature/Filament/Pages/CreateCustomerPageTest.php
git commit -m "feat: add CreateCustomer Filament page (admin-only skeleton)"
```

---

### Task 5: Wizard form + submit (happy path)

**Files:**
- Modify: `app/Filament/Pages/CreateCustomer.php` (fill in `form()` and `create()`)
- Test: `tests/Feature/Filament/Pages/CreateCustomerPageTest.php` (add flow test)

**Interfaces:**
- Consumes: `App\Actions\CreateCustomer::handle(array): User`; `App\Models\Plan` (`active()` scope, `name`, `planCategory`); `App\Filament\Resources\Users\UserResource::getUrl('edit', ['record' => $owner])`.
- Produces: működő 5-lépcsős wizard (`owner` mezők a `data` gyökerén, `plans` repeater, `create_team`/`team_name`, `members` repeater), és a `create()` submit, ami az akciót hívja, sikert jelez és a User edit oldalára irányít.

- [ ] **Step 1: Write the failing test**

Add to `tests/Feature/Filament/Pages/CreateCustomerPageTest.php`:

```php
use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\assertDatabaseHas;

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
    expect(Subscription::withoutGlobalScopes()->where('user_id', $owner->id)->count())->toBe(1);
});
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: FAIL — nincs `plan_id`/mezők a form-ban, nem jön létre user.

- [ ] **Step 3: Write minimal implementation**

In `app/Filament/Pages/CreateCustomer.php`, add the imports and replace `form()` + `create()`:

Imports (top of file):

```php
use App\Actions\CreateCustomer as CreateCustomerAction;
use App\Enums\Country;
use App\Enums\UserRole;
use App\Filament\Resources\Users\UserResource;
use App\Models\Plan;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
```

`form()`:

```php
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Főfiók')
                        ->schema([
                            TextInput::make('name')->label('Név')->required()->maxLength(255),
                            TextInput::make('email')->label('E-mail')->email()->required()
                                ->unique('users', 'email')->maxLength(255),
                            TextInput::make('password')->label('Jelszó')->password()->required()->minLength(8),
                            Select::make('role')->label('Szerep')
                                ->options([
                                    UserRole::Manager->value => 'Manager',
                                    UserRole::Subscriber->value => 'Subscriber',
                                    UserRole::Admin->value => 'Admin',
                                ])
                                ->default(UserRole::Manager->value)->required(),
                            TextInput::make('company_name')->label('Cégnév')->required()->maxLength(255),
                            TextInput::make('tax_number')->label('Adószám')->required()->maxLength(255),
                            TextInput::make('address')->label('Cím')->required()->maxLength(255),
                            TextInput::make('city')->label('Város')->required()->maxLength(255),
                            TextInput::make('postal_code')->label('Irányítószám')->required()->maxLength(20),
                            Select::make('country')->label('Ország')
                                ->options(Country::class)->default(Country::Hungary)->required(),
                        ])
                        ->columns(2),
                    Step::make('Csomagok')
                        ->schema([
                            Repeater::make('plans')
                                ->label('Csomagok')
                                ->schema([
                                    Select::make('plan_id')->label('Csomag')
                                        ->options(fn (): array => Plan::query()->active()
                                            ->with('planCategory')->get()
                                            ->mapWithKeys(fn (Plan $plan): array => [
                                                $plan->id => ($plan->planCategory?->name ? $plan->planCategory->name . ' — ' : '') . $plan->name,
                                            ])->all())
                                        ->required()->searchable(),
                                    TextInput::make('quantity')->label('Férőhelyek (owner + tagok)')
                                        ->integer()->minValue(1)->default(1)->required(),
                                ])
                                ->minItems(1)->defaultItems(1)->columns(2)
                                ->addActionLabel('Csomag hozzáadása'),
                        ]),
                    Step::make('Team')
                        ->schema([
                            Toggle::make('create_team')->label('Team létrehozása')->default(false)->live(),
                            TextInput::make('team_name')->label('Team neve')
                                ->placeholder('Alapértelmezés: a cégnév')
                                ->visible(fn (Get $get): bool => (bool) $get('create_team')),
                        ]),
                    Step::make('Tagok')
                        ->schema([
                            Repeater::make('members')
                                ->label('Tagok')
                                ->schema([
                                    TextInput::make('name')->label('Név')->required()->maxLength(255),
                                    TextInput::make('email')->label('E-mail')->email()->required()
                                        ->unique('users', 'email')->maxLength(255),
                                    TextInput::make('password')->label('Jelszó')->password()->required()->minLength(8),
                                    Select::make('role')->label('Szerep')
                                        ->options([
                                            UserRole::Subscriber->value => 'Subscriber',
                                            UserRole::Manager->value => 'Manager',
                                        ])
                                        ->default(UserRole::Subscriber->value)->required(),
                                ])
                                ->defaultItems(0)->columns(2)
                                ->addActionLabel('Tag hozzáadása'),
                        ]),
                ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }
```

`create()`:

```php
    public function create(): void
    {
        $data = $this->form->getState();

        $owner = app(CreateCustomerAction::class)->handle($data);

        Notification::make()
            ->success()
            ->title('Ügyfél létrehozva')
            ->body("{$owner->name} és a hozzá tartozó előfizetés(ek) elkészültek.")
            ->send();

        $this->redirect(UserResource::getUrl('edit', ['record' => $owner]), navigate: false);
    }
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: PASS (3 tests).

- [ ] **Step 5: Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
git add app/Filament/Pages/CreateCustomer.php tests/Feature/Filament/Pages/CreateCustomerPageTest.php
git commit -m "feat: implement CreateCustomer wizard form and submit"
```

---

### Task 6: Seat + duplicate-email guards

**Files:**
- Modify: `app/Filament/Pages/CreateCustomer.php` (guard logic in `create()`)
- Test: `tests/Feature/Filament/Pages/CreateCustomerPageTest.php` (add validation tests)

**Interfaces:**
- Consumes: a Task 5 `create()` + `data` állapot.
- Produces: a `create()` a provizionálás ELŐTT ellenőrzi (a) nincs duplikált e-mail owner/tagok közt, (b) a tagok száma egyik csomagnál sem lépi túl a `quantity - 1` szabad helyet; hiba esetén danger `Notification`-t küld és megszakít (nem hoz létre semmit).

- [ ] **Step 1: Write the failing test**

Add to `tests/Feature/Filament/Pages/CreateCustomerPageTest.php`:

```php
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
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: FAIL — a guardok nélkül létrejön a user (vagy a seat túllépésnél part-provisioned), a `toBeFalse()` elbukik.

- [ ] **Step 3: Write minimal implementation**

In `app/Filament/Pages/CreateCustomer.php`, add `use Illuminate\Support\Str;` to the imports, and replace `create()` with the guarded version:

```php
    public function create(): void
    {
        $data = $this->form->getState();

        if (! $this->passesGuards($data)) {
            return;
        }

        $owner = app(CreateCustomerAction::class)->handle($data);

        Notification::make()
            ->success()
            ->title('Ügyfél létrehozva')
            ->body("{$owner->name} és a hozzá tartozó előfizetés(ek) elkészültek.")
            ->send();

        $this->redirect(UserResource::getUrl('edit', ['record' => $owner]), navigate: false);
    }

    /**
     * @param array<string, mixed> $data
     */
    private function passesGuards(array $data): bool
    {
        $emails = collect([$data['email']])
            ->merge(collect($data['members'] ?? [])->pluck('email'))
            ->map(fn (string $email): string => Str::lower(trim($email)));

        if ($emails->count() !== $emails->unique()->count()) {
            Notification::make()
                ->danger()
                ->title('Duplikált e-mail cím')
                ->body('Az owner és a tagok e-mail címei nem egyezhetnek meg.')
                ->send();

            return false;
        }

        $memberCount = count($data['members'] ?? []);
        $minSeats = collect($data['plans'])->min(fn (array $plan): int => (int) $plan['quantity'] - 1) ?? 0;

        if ($memberCount > $minSeats) {
            Notification::make()
                ->danger()
                ->title('Nincs elég férőhely')
                ->body("A tagok száma ({$memberCount}) meghaladja a legszűkebb csomag szabad helyeit ({$minSeats}). Növeld a férőhelyeket vagy vegyél fel kevesebb tagot.")
                ->send();

            return false;
        }

        return true;
    }
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --compact --filter=CreateCustomerPageTest`
Expected: PASS (5 tests).

- [ ] **Step 5: Run the full suite + Pint + commit**

```bash
vendor/bin/pint --dirty --format agent
php artisan test --compact
git add app/Filament/Pages/CreateCustomer.php tests/Feature/Filament/Pages/CreateCustomerPageTest.php
git commit -m "feat: guard CreateCustomer wizard against oversubscribed seats and duplicate emails"
```

---

## Self-Review

**Spec coverage:**
- Owner + cégadatok létrehozás → Task 1 (action) + Task 5 (form Főfiók lépés). ✓
- Több csomag → lokális Subscription/csomag → Task 1 (`createSubscriptions`) + Task 5 (plans repeater). ✓
- Cross-app provizíció (owner) → Task 1 (`UserTeamSync::createUser`) + `SubscriptionObserver` (meglévő) aktiválás. ✓
- Team opcionális + `UserTeamSync::createTeam` + `team_id` → Task 2 + Task 5 (Team lépés). ✓
- Tagok + `AttachSubscriptionMember` minden subscription-höz → Task 3 + Task 5 (members repeater). ✓
- Egyedi email (owner+tagok, wizardon belül is) → Task 5 (`->unique`) + Task 6 (duplikátum guard). ✓
- Seat túllépés tiltás → Task 6. ✓
- Atomikus DB tranzakció → Task 1 (`DB::transaction`). ✓
- Siker: notification + redirect a User edit oldalára → Task 5 (`create()`). ✓
- Csak admin hozzáférés → Task 4 (`canAccess`/`shouldRegisterNavigation`). ✓
- Tesztek (admin render, nem-admin tiltás, teljes flow, seat, sync mock) → Task 4/5/6. ✓
- Nem cél (valós Stripe, team-árak, owner szerkesztés) → nincs benne. ✓

**Placeholder scan:** A Task 1 `createTeam`/`createMember` szándékosan `LogicException` stub, amit Task 2/3 valós kóddal cserél (a Task 1 tesztjei nem érintik ezeket az ágakat) — nem placeholder a kész tervben, hanem inkrementális TDD lépés. Nincs „TBD/TODO".

**Type consistency:** `handle(array): User`, `createSubscriptions(...): Collection<int, Subscription>`, `createTeam(string, User): Team`, `createMember(array, User, Collection): void`, `passesGuards(array): bool`, `create(): void`, `canAccess(): bool` — a taskok közt konzisztens. A `data` flat kulcsai (owner mezők a gyökéren, `plans`/`members` repeaterek) egyeznek az akció array-shape-jével.

## Provizionálási megjegyzés (elfogadott kompromisszum)

A tagok minden subscription-höz `AttachSubscriptionMember`-en át csatlakoznak, ami tagonként/subscription-önként meghívja a `UserTeamSync::createUser`-t (redundáns, de idempotens a fogadó appokon). Ez a „teljes hozzáférés" döntés egyszerű megvalósítása; ha a jövőben zavaró, egy külön „create once, attach many" refaktor lehetséges.
