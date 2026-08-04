# SSO 2. fázis — Passport IdP a subscriberben

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** A `subscriber` OAuth2 identity providerré válik: Passport, `GET /api/userinfo` a teljes identitás-állapottal, és appnként regisztrált authorization_code + PKCE kliens.

**Architecture:** Passport `authorization_code` grant PKCE-vel, szándékosan **nem** szigorú OIDC (mind a 17 app first-party, szerver-oldali). A tokencsere után a kliens egyszer meghívja a `/api/userinfo`-t, ami **teljes állapotot** ad egy válaszban (nem deltát): `sub`, `email`, `name`, `role`, `orgs[]`, `apps[]`. Az `apps` a meglévő `User::accessibleAppKeys()`-ből jön. **Ebben a fázisban egyetlen modul-app sem használja** — a végpont felépül és tesztelt lesz, de a fogyasztó oldal a 3. fázis.

**Tech Stack:** PHP 8.4, Laravel 13, `laravel/passport` ^13.7, Pest 4, Pint.

## Global Constraints

- Minden `.php` fájl tetején `declare(strict_types=1);`.
- Minden új osztály `final`, kivéve ahol Eloquent/Laravel öröklés tiltja.
- Explicit visszatérési típusok és paraméter-típusok mindenhol.
- PHPDoc block inline komment helyett; array shape definíciók PHPDocban.
- Minden változás után `vendor/bin/pint --dirty --format agent`.
- Tesztek: Pest, `php artisan test --compact --filter=<név>`.
- Nem hozunk létre új gyökér-könyvtárat a meglévő struktúrán kívül.
- Nem változtatunk függőséget a tervben felsoroltakon túl.
- **Semmit nem deployolunk** ebben a fázisban — a push a Forge Quick Deploy miatt élesítene. A kiadás külön, jóváhagyással történik.

## Előzetesen ellenőrzött tények

Ezeket már megnéztem, ne ellenőrizd újra:

| Tény | Érték |
|---|---|
| `laravel/passport` legfrissebb | `v13.7.5`, Laravel 13-mal tisztán települ |
| `config/auth.php` | **nem létezik**, a framework default csak `web` guardot ad — `api` guardot létre kell hozni |
| `ClientRepository` metódus | `createAuthorizationCodeGrantClient(string $name, array $redirectUris, bool $confidential = true, ?Authenticatable $user = null, bool $enableDeviceFlow = false): Client` |
| Passport kulcsok | `PASSPORT_PRIVATE_KEY` / `PASSPORT_PUBLIC_KEY` env-ből is jöhetnek |
| Forge `storage/` | **szimlinkelt** közös könyvtárra (`current/storage -> ../storage`), tehát a `passport:keys` fájlok túlélik a zero-downtime deployt |
| `User::accessibleAppKeys(): array` | plan-kategória slugok tömbje az aktív előfizetésekből |
| `User::teams(): BelongsToMany` | `Team::class` |
| `UserRole` enum | `admin`, `manager`, `subscriber` (backed string) |
| `users.uuid`, `teams.uuid` | 1. fázisban feltöltve, 180/180 egyezés élesben |
| `routes/api.php` | létezik, regisztrálva a `bootstrap/app.php`-ban, **üres** |
| `config/oauth_proxy.php` | **nem** kapcsolódik ide (kifelé menő Google/Facebook OAuth), ne módosítsd |
| `sync_apps` séma | `id, name (unique), url, api_key (encrypted text), is_active, timestamps` |

## Eltérés a spectől — és miért

A spec azt írja: „Appnként OAuth kliens regisztráció a **bővített `sync_apps` táblában**".

A `sync_apps` táblát a `madbox-99/laravel-user-team-sync` csomag migrációja hozza létre, ezért a csomagban bővítve **mind a 16 receiver megkapná** a publisher-specifikus oszlopot, és egy csomag-kiadás + 11 újradeploy kellene hozzá.

**Ezért a `oauth_client_id` oszlopot a subscriber saját migrációja adja hozzá** a `sync_apps` táblához. Ez megtartja a spec szándékát (egy forrás arról, mely appok léteznek), csomag-kiadás és a receiverek fölösleges terhelése nélkül.

## File Structure

| Fájl | Felelősség |
|---|---|
| `config/auth.php` | **Új.** A framework default másolata, kiegészítve a `api` guarddal (`passport` driver). |
| `config/passport.php` | **Új** (publikált). Kulcsok, guard. |
| `config/identity.php` | **Új.** Az IdP saját beállításai (`userinfo` claim-verzió). |
| `app/Models/User.php` | **Módosul.** `HasApiTokens` trait. |
| `app/Http/Controllers/Api/UserInfoController.php` | **Új.** Egyetlen `__invoke`, a token-szerződést adja vissza. |
| `routes/api.php` | **Módosul.** `GET /userinfo`, `auth:api` middleware-rel. |
| `database/migrations/…_add_oauth_client_id_to_sync_apps_table.php` | **Új.** `oauth_client_id` a `sync_apps`-ra. |
| `app/Console/Commands/IdentityRegisterClientsCommand.php` | **Új.** Appnként Passport kliens létrehozása, id eltárolása, secret egyszeri kiírása. |
| `tests/Feature/Api/UserInfoControllerTest.php` | **Új.** A token-szerződés tesztjei. |
| `tests/Feature/Console/IdentityRegisterClientsCommandTest.php` | **Új.** A regisztrációs parancs tesztjei. |

---

### Task 1: Passport telepítés, `api` guard, kulcsok

**Files:**
- Modify: `composer.json` (függőség)
- Create: `config/auth.php`
- Create: `config/passport.php` (publikálva)
- Modify: `app/Models/User.php`
- Test: `tests/Feature/Api/PassportInstallationTest.php`

**Interfaces:**
- Consumes: semmi.
- Produces: működő `api` guard `passport` driverrel; a `User` modellen `Laravel\Passport\HasApiTokens`; `Laravel\Passport\ClientRepository` a konténerből feloldható.

- [ ] **Step 1: Passport telepítése**

```bash
composer require laravel/passport:^13.7 --no-interaction
```

- [ ] **Step 2: Migrációk és config publikálása**

```bash
php artisan vendor:publish --tag=passport-config --no-interaction
php artisan vendor:publish --tag=passport-migrations --no-interaction
php artisan migrate --no-interaction
```

- [ ] **Step 3: `config/auth.php` létrehozása az `api` guarddal**

A framework defaultja csak `web` guardot ad. Másold be teljes egészében:

```php
<?php

declare(strict_types=1);

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Az IdP végpontjai (jelenleg csak /api/userinfo) Passport
        // access tokennel hitelesítenek, nem munkamenettel.
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
```

- [ ] **Step 4: `HasApiTokens` a `User` modellre**

`app/Models/User.php` — két pontosan meghatározott szerkesztés. **Ne írd át a fájl többi részét.**

Elsőként az import, a `use Laravel\Cashier\Billable;` sor (21.) **után**, ábécésorrendben:

```php
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Override;
```

Másodszor a trait az osztálytörzs tetején (45–47. sor). A meglévő:

```php
    use Billable;
    use HasFactory;
    use Notifiable;
```

Cseréld erre:

```php
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
```

- [ ] **Step 5: Írd meg a bukó tesztet**

Hozd létre: `tests/Feature/Api/PassportInstallationTest.php`

```php
<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\HasApiTokens;

it('registers an api guard backed by the passport driver', function (): void {
    expect(config('auth.guards.api.driver'))->toBe('passport')
        ->and(config('auth.guards.api.provider'))->toBe('users');
});

it('gives the User model passport token support', function (): void {
    // A HasApiTokens nélkül a Passport nem tudja a felhasználót
    // erőforrás-tulajdonosként kezelni a tokencserénél.
    expect(in_array(HasApiTokens::class, class_uses_recursive(User::class), true))->toBeTrue();
});

it('can resolve the passport client repository', function (): void {
    expect(app(ClientRepository::class))->toBeInstanceOf(ClientRepository::class);
});

it('creates the oauth tables', function (): void {
    expect(Schema::hasTable('oauth_clients'))->toBeTrue()
        ->and(Schema::hasTable('oauth_access_tokens'))->toBeTrue()
        ->and(Schema::hasTable('oauth_auth_codes'))->toBeTrue();
});
```

- [ ] **Step 6: Futtasd, hogy lásd, bukik**

```bash
php artisan test --compact --filter=PassportInstallationTest
```

Elvárt: FAIL, mielőtt a 3–4. lépés kész (guard driver `null`, trait hiányzik).

- [ ] **Step 7: Futtasd újra, most átmegy**

```bash
php artisan test --compact --filter=PassportInstallationTest
```

Elvárt: PASS, 4 teszt.

- [ ] **Step 8: Teljes suite, hogy semmi ne romoljon el**

```bash
php artisan test --compact
```

Elvárt: az 515 meglévő teszt továbbra is zöld.

- [ ] **Step 9: Pint és commit**

```bash
vendor/bin/pint --dirty --format agent
git add composer.json composer.lock config/auth.php config/passport.php app/Models/User.php database/migrations tests/Feature/Api/PassportInstallationTest.php
git commit -m "feat(sso): Passport telepítése és api guard az IdP-hez"
```

---

### Task 2: `GET /api/userinfo` — a token-szerződés

**Files:**
- Create: `app/Http/Controllers/Api/UserInfoController.php`
- Create: `config/identity.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/Api/UserInfoControllerTest.php`

**Interfaces:**
- Consumes: Task 1 `api` guardja és a `HasApiTokens` trait.
- Produces: `GET /api/userinfo` végpont, `auth:api` mögött. Válasz alakja:
  `array{sub: string, email: string, name: string, role: string, orgs: list<array{uuid: string, name: string, slug: string}>, apps: list<string>, issued_at: int}`

- [ ] **Step 1: Írd meg a bukó teszteket**

Hozd létre: `tests/Feature/Api/UserInfoControllerTest.php`

```php
<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Plan;
use App\Models\PlanCategory;
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
```

- [ ] **Step 2: Futtasd, hogy lásd, bukik**

```bash
php artisan test --compact --filter=UserInfoControllerTest
```

Elvárt: FAIL, 404 a nem létező route miatt.

- [ ] **Step 3: `config/identity.php` létrehozása**

```php
<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Claim-verzió
    |--------------------------------------------------------------------------
    | A /api/userinfo válasz alakjának verziója. A fogyasztó appok ezt
    | naplózhatják, hogy egy szerződés-változás visszakövethető legyen.
    */
    'claims_version' => 1,
];
```

- [ ] **Step 4: Írd meg a controllert**

Hozd létre: `app/Http/Controllers/Api/UserInfoController.php`

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * A központi identitás teljes állapota egyetlen válaszban.
 *
 * Szándékosan teljes állapot, nem delta: nincs mit sorrendbe rakni és nincs
 * mit elveszíteni. Minden hívás egyben reconcile is a fogyasztó appon.
 */
final class UserInfoController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return response()->json([
            'sub' => $user->uuid,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role?->value,
            'orgs' => $user->teams()
                ->get(['teams.id', 'teams.uuid', 'teams.name', 'teams.slug'])
                ->map(fn (Team $team): array => [
                    'uuid' => $team->uuid,
                    'name' => $team->name,
                    'slug' => $team->slug,
                ])
                ->values()
                ->all(),
            'apps' => $user->accessibleAppKeys(),
            'issued_at' => now()->timestamp,
        ]);
    }
}
```

- [ ] **Step 5: Route regisztrálása**

`routes/api.php` — írd felül a teljes fájlt:

```php
<?php

declare(strict_types=1);

use App\Http\Controllers\Api\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function (): void {
    Route::get('/userinfo', UserInfoController::class);
});
```

- [ ] **Step 6: Futtasd, most átmegy**

```bash
php artisan test --compact --filter=UserInfoControllerTest
```

Elvárt: PASS, 8 teszt.

- [ ] **Step 7: Igazold, hogy a teszt tényleg fog**

Vedd ki ideiglenesen a `auth:api` middleware-t a `routes/api.php`-ból, futtasd újra, és győződj meg róla, hogy a „rejects an unauthenticated request" **bukik** (401 helyett 500 vagy 200). Ezután állítsd vissza, és futtasd újra — zöldnek kell lennie.

Ez azért kell, mert egy 404 is „401-nek látszhat" rosszul megírt tesztnél; itt bizonyítjuk, hogy a védelem az, ami fog.

- [ ] **Step 8: Teljes suite**

```bash
php artisan test --compact
```

- [ ] **Step 9: Pint és commit**

```bash
vendor/bin/pint --dirty --format agent
git add config/identity.php app/Http/Controllers/Api/UserInfoController.php routes/api.php tests/Feature/Api/UserInfoControllerTest.php
git commit -m "feat(sso): GET /api/userinfo a teljes identitás-állapottal"
```

---

### Task 3: OAuth kliensek appnként

**Files:**
- Create: `database/migrations/2026_08_03_000000_add_oauth_client_id_to_sync_apps_table.php`
- Create: `app/Console/Commands/IdentityRegisterClientsCommand.php`
- Test: `tests/Feature/Console/IdentityRegisterClientsCommandTest.php`

**Interfaces:**
- Consumes: Task 1 `ClientRepository`-ja.
- Produces: `identity:register-clients` parancs. A `sync_apps.oauth_client_id` oszlop a Passport kliens azonosítóját tartja.

- [ ] **Step 1: Írd meg a bukó teszteket**

Hozd létre: `tests/Feature/Console/IdentityRegisterClientsCommandTest.php`

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Madbox99\UserTeamSync\Models\SyncApp;

use function Pest\Laravel\artisan;

beforeEach(function (): void {
    config()->set('user-team-sync.publisher.app_source', 'database');
});

it('creates one authorization code client per active app', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    $app = SyncApp::query()->where('name', 'crm')->first();

    expect($app->oauth_client_id)->not->toBeNull();

    $client = Client::query()->find($app->oauth_client_id);

    expect($client)->not->toBeNull()
        ->and($client->redirect_uris)->toBe(['https://crm.test/auth/callback']);
});

it('skips an app that already has a client', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);
    $first = SyncApp::query()->where('name', 'crm')->value('oauth_client_id');

    artisan('identity:register-clients')->assertExitCode(0);
    $second = SyncApp::query()->where('name', 'crm')->value('oauth_client_id');

    expect($second)->toBe($first)
        ->and(Client::query()->count())->toBe(1);
});

it('ignores inactive apps', function (): void {
    SyncApp::create([
        'name' => 'kikapcsolt',
        'url' => 'https://kikapcsolt.test',
        'api_key' => 'secret',
        'is_active' => false,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    expect(SyncApp::query()->where('name', 'kikapcsolt')->value('oauth_client_id'))->toBeNull()
        ->and(Client::query()->count())->toBe(0);
});

it('prints the client secret exactly once, because it cannot be read back later', function (): void {
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')
        ->expectsOutputToContain('crm')
        ->expectsOutputToContain('IDENTITY_CLIENT_SECRET')
        ->assertExitCode(0);
});

it('creates a confidential client, not a public one', function (): void {
    // Mind a 17 app szerver-oldali és first-party: a secret biztonságosan
    // tárolható, és a confidential kliens erősebb, mint a public.
    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    artisan('identity:register-clients')->assertExitCode(0);

    $client = Client::query()->first();

    expect($client->secret)->not->toBeNull();
});
```

- [ ] **Step 2: Futtasd, hogy lásd, bukik**

```bash
php artisan test --compact --filter=IdentityRegisterClientsCommandTest
```

Elvárt: FAIL, „Command identity:register-clients is not defined".

- [ ] **Step 3: Migráció az `oauth_client_id` oszlophoz**

Hozd létre: `database/migrations/2026_08_03_000000_add_oauth_client_id_to_sync_apps_table.php`

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A sync_apps táblát a laravel-user-team-sync csomag hozza létre, de ez az
 * oszlop kizárólag a publisher IdP-szerepéhez tartozik. Ezért a subscriber
 * saját migrációja adja hozzá: a csomagban bővítve mind a 16 receiver
 * megkapná, teljesen fölöslegesen.
 *
 * Szándékosan string, nem uuid: a Passport kliens kulcsa a
 * Passport::$clientUuids beállítástól függően uuid vagy autoinkrement
 * egész, és a string mindkettőt elbírja.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sync_apps', function (Blueprint $table): void {
            $table->string('oauth_client_id')->nullable()->after('api_key');
        });
    }

    public function down(): void
    {
        Schema::table('sync_apps', function (Blueprint $table): void {
            $table->dropColumn('oauth_client_id');
        });
    }
};
```

- [ ] **Step 4: A parancs megírása**

Hozd létre: `app/Console/Commands/IdentityRegisterClientsCommand.php`

```php
<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Laravel\Passport\ClientRepository;
use Madbox99\UserTeamSync\Models\SyncApp;

/**
 * Appnként egy confidential authorization_code klienst hoz létre.
 *
 * Idempotens: egy már felvett klienst nem duplikál. A secret csak
 * létrehozáskor olvasható, ezért egyszer kiírjuk — utána már nem kérdezhető le.
 */
#[Signature('identity:register-clients')]
#[Description('Create an OAuth client for every active module app.')]
final class IdentityRegisterClientsCommand extends Command
{
    public function handle(ClientRepository $clients): int
    {
        $apps = SyncApp::query()->where('is_active', true)->get();

        if ($apps->isEmpty()) {
            $this->warn('No active apps configured. Nothing to register.');

            return self::SUCCESS;
        }

        foreach ($apps as $app) {
            if ($app->oauth_client_id !== null) {
                $this->line("  {$app->name}: már van kliense, kihagyva.");

                continue;
            }

            $redirectUri = rtrim((string) $app->url, '/') . '/auth/callback';

            $client = $clients->createAuthorizationCodeGrantClient(
                name: $app->name,
                redirectUris: [$redirectUri],
                confidential: true,
            );

            $app->forceFill(['oauth_client_id' => $client->getKey()])->save();

            $this->newLine();
            $this->info("=== {$app->name} ===");
            $this->line("  redirect: {$redirectUri}");
            $this->line("  IDENTITY_CLIENT_ID={$client->getKey()}");
            $this->line("  IDENTITY_CLIENT_SECRET={$client->plainSecret}");
        }

        $this->newLine();
        $this->warn('A secret csak most olvasható. Mentsd el az adott app .env fájljába.');

        return self::SUCCESS;
    }
}
```

- [ ] **Step 5: Migráció futtatása és a tesztek**

```bash
php artisan migrate --no-interaction
php artisan test --compact --filter=IdentityRegisterClientsCommandTest
```

Elvárt: PASS, 5 teszt.

- [ ] **Step 6: Igazold, hogy az idempotencia-teszt tényleg fog**

Vedd ki ideiglenesen a `if ($app->oauth_client_id !== null) { … continue; }` blokkot, futtasd újra, és győződj meg róla, hogy a „skips an app that already has a client" **bukik**. Ezután állítsd vissza és futtasd újra.

- [ ] **Step 7: Teljes suite**

```bash
php artisan test --compact
```

- [ ] **Step 8: Pint és commit**

```bash
vendor/bin/pint --dirty --format agent
git add database/migrations app/Console/Commands/IdentityRegisterClientsCommand.php tests/Feature/Console/IdentityRegisterClientsCommandTest.php
git commit -m "feat(sso): appnkénti OAuth kliens-regisztráció"
```

---

## Deploy — külön jóváhagyással

**Ne futtasd a terv részeként.** A `main`-re pusholás a Forge Quick Deploy miatt azonnal élesít.

Amikor a kiadás jóváhagyást kap, ez a sorrend:

1. `git push origin main` — a deploy script lefuttatja a `php artisan migrate`-et, ami létrehozza az `oauth_*` táblákat és az `oauth_client_id` oszlopot.
2. Kulcsok generálása **egyszer**, a megosztott `storage/`-ba:
   ```bash
   cd /home/forge/cegem360.eu/current && php artisan passport:keys
   ```
   A `current/storage` szimlink a `/home/forge/cegem360.eu/storage` könyvtárra mutat, tehát a kulcsok túlélik a következő deployt. **Ha újragenerálódnának, minden kiadott token érvénytelenné válna.**
3. `php artisan identity:register-clients` — a kiírt `IDENTITY_CLIENT_ID` / `IDENTITY_CLIENT_SECRET` párokat el kell menteni; a 3. fázisban a `crm` `.env`-jébe kerülnek.
4. Ellenőrzés: a `/api/userinfo` token nélkül **401**-et adjon.

Ebben a fázisban egyetlen modul-app sem hívja a végpontot, tehát a deploynak nincs felhasználói hatása.

## Ami szándékosan kimarad ebből a fázisból

- `/auth/redirect`, `/auth/callback` a modul-appokon — **3. fázis**.
- `IdentityProvisioner` — **3. fázis**.
- Revalidációs middleware, `POST /api/revoke` — **3. fázis**.
- `tenantRegistration` kivezetése — **3. fázis**.
- A régi szinkron bármely részének törlése — **5. fázis**. A legacy push változatlanul fut.

## Ismert, e fázison kívüli megállapítás

A `composer audit` **4 közepes súlyosságú advisory**-t jelez a `guzzlehttp/guzzle <7.15.1` csomagra (redirect Referer szivárgás, host-only cookie scope, korlátlan cookie DoS). Ez **nem** a Passporttól van, már bent volt. A sync HTTP-hívásai ezen a csomagon mennek. Külön, kis feladat frissíteni — nem része ennek a tervnek, de érdemes ütemezni.
