# SSO 3. fázis — crm pilot (OAuth kliens mód) Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** A `crm` modul-app felhasználói a `cegem360.eu` identity providerén keresztül lépjenek be (authorization_code + PKCE), és minden belépés egyben teljes állapot-reconcile is legyen.

**Architecture:** A `madbox-99/laravel-user-team-sync` csomag kap egy harmadik módot: `client`. Ez két route-ot (`/auth/redirect`, `/auth/callback`), egy `IdentityProvisioner`-t (az egyetlen hely, ahol állapot keletkezik) és egy revalidáló middleware-t ad. A `crm` a `both` mód helyett `client`-re vált, de a legacy receiver végpontok a pilot alatt aktívak maradnak, így a régi push változatlanul kiszolgálja azokat, akik nincsenek az allowliston.

**Tech Stack:** PHP 8.4, Laravel 13, Pest 4, Orchestra Testbench, Filament 5 (tenancy), Spatie Permission, Laravel Passport (csak a publisher oldalon).

## Global Constraints

- A csomag verziója **v1.13.0** lesz, nem v2.0. **Eltérés a spectől**, indoklás lent a „Döntések" alatt.
- `declare(strict_types=1);` minden új PHP fájl elején.
- Új osztályok `final`-ok, kivéve ahol az öröklés szándékos.
- A csomag tesztjei SQLite `:memory:`-n futnak (`tests/TestCase.php`), a produkció MySQL `utf8mb4_unicode_ci`. **Semmi nem támaszkodhat a collation kis-nagybetű-érzéketlenségére** — lásd VF-2.
- A meglévő `receiver` és `publisher` mód viselkedése **nem változhat**. Minden meglévő csomag-teszt (154 db) zöld marad.
- Pint fut minden commit előtt: `vendor/bin/pint`.
- Hungarian kommentek tilosak a csomagban — a meglévő kód angol kommenteket használ, ezt kövessük.
- A csomagban **tilos** app-specifikus osztályra hivatkozni (`App\Models\*`); minden model a `config('user-team-sync.models.*')`-ból jön.

## Ellenőrzött tények (VF)

Ezeket éles rendszeren mértem le 2026-08-04-én. **Ne hidd el a specet, ha ezekkel ütközik.**

| # | Tény | Bizonyíték | Következmény |
|---|---|---|---|
| **VF-1** | A publisher `role` claimje kisbetűs: `admin`, `manager`, `subscriber` (33 manager, 23 subscriber, 1 admin). | `UserRole` enum, publisher DB | — |
| **VF-2** | A `crm` Spatie szerepei **nagybetűsek**: `Admin`, `Manager`, `Sales Representative`, `Subscriber`, `Support`. `Role::findByName('manager')` élesben mégis megtalálja a `Manager`-t, mert a `roles` tábla collationje `utf8mb4_unicode_ci`. | `Schema` + tinker a crm produkción | A spec `syncRoles([$claims['role']])` sora **SQLite-on kivételt dob** (`RoleDoesNotExist`), MySQL-en pedig csak véletlenül működik. Kell explicit feloldás — Task 2. |
| **VF-3** | A crm-ben **7 user és 16 team van `uuid` nélkül** (5 seed `@example.*`, `info@perometer.hu`, `mobilinfo.hu+1@gmail.com`). | `whereNull('uuid')->count()` | A spec `User::updateOrCreate(['uuid' => …])`-je ezekre **email-ütközést** okozna (`users_email_unique`). A `resolveTeam()`-nek van adoptáló ága, a usernek nincs — Task 2 pótolja. |
| **VF-4** | Ma egyik ütköző email sem létezik a publisheren (`info@perometer.hu` → NINCS, `mobilinfo.hu+1@gmail.com` → NINCS). | publisher DB | A hiba ma nem robban, de a 4. fázisban 15 további app ismeretlen lokális usereivel igen. |
| **VF-5** | A crm produkción `SESSION_DRIVER=database`, `QUEUE_CONNECTION=redis`. | `config()` a crm produkción | A spec infrastruktúra-előfeltételei a crm-re **már teljesülnek**, nincs teendő. |
| **VF-6** | A crm `App\Models\User` és `App\Models\Team` `#[Fillable]` attribútuma **nem tartalmazza a `uuid`-t**. | `app/Models/User.php`, `app/Models/Team.php` | A provisioner nem használhat sima mass assignmentet a uuid-ra. `forceFill()` kell — pont mint a `TeamSyncController`-ben. A csomag teszt-fixture-jei (`UserWithoutUuidFillable`, `TeamWithoutUuidFillable`) már léteznek erre. |
| **VF-7** | A crm receiverén `default_active = false`, és a panel `authMiddleware`-ében ott van az `EnsureUserHasActiveSubscription`. | `config/user-team-sync.php`, `AdminPanelServiceProvider` | Ha a provisioner nem állítja `is_active = true`-ra az SSO usert, az **minden SSO belépés után 403-at kap**. Task 2. |
| **VF-8** | A publisher access tokenjének élettartama `expires_in: 31536000` (1 év, Passport default). | éles token-csere 2026-08-04 | A refresh-ág ettől függetlenül kell (Task 4/6), mert a token visszavonható. A lejárat meghúzása külön döntés, **nem ennek a tervnek a része**. |
| **VF-9** | A `sync_logs` tábla oszlopa `status`, **nem** `success`. | `Schema::getColumnListing` | Ha bármelyik task naplót olvas, ezt használja. |
| **VF-10** | A crm `phpunit.xml`-je `DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:`. | `phpunit.xml:27-28` | A crm oldali tesztek is case-sensitive DB-n futnak → VF-2 ott is él. |

## Döntések (eltérések a spectől)

**D-1 — v1.13.0, nem v2.0.** A spec a `client` módot egy `IDENTITY_MODE` nevű új configkulcs mögé tette volna, v2.0 major verzióban, ami mind a 17 app `composer update`-jét megkövetelné, mielőtt a crm pilotozhat. A csomagnak **már van** `mode` kulcsa (`publisher|receiver|both`); a `client` egyszerűen egy negyedik érték. Additív, senki más appban nem változik semmi, és a legacy kód ugyanúgy törölhető a v2.0-ban, amikor az utolsó app is átállt.

**D-2 — a `POST /api/revoke` kimarad ebből a fázisból.** A spec maga mondja ki, hogy ez „optimalizáció, nem korrektségi követelmény", mert a 15 perces revalidáció elkapja. Egy app pilotjához 16 HTTP hívásos fan-outot építeni felesleges kockázat; a 4. fázisba tartozik.

**D-3 — a legacy végpontok törlése kimarad.** A spec „Ami törlődik" listája az 5. fázis. A pilot alatt a crm-nek mindkét világ kell.

**D-4 — a `->login()` marad a crm panelen.** A spec szerint „a Filament panelről a `->login()` lekerül", de az az állapot a 4. fázis vége. A pilot alatt az allowliston kívüliek jelszóval lépnek be, tehát a form kell. A login oldal kap egy „Belépés Cégem 360 fiókkal" gombot.

**D-5 — email-ütközés esetén a belépés meghiúsul, nem vesz át.** Ha a claim uuid-ja szerint nincs user, de az emailhez tartozó lokális usernek **más** uuid-ja van, az két különböző identitás ugyanazon az emailen. Ilyenkor kivétel, nem néma átvétel — ugyanaz az elv, mint a `TeamSyncController` 409-e. Csapatoknál viszont a slug-ütközés utótagot kap (két cég akarhatja ugyanazt a slugot), lásd Task 3.

## File Structure

**Csomag — `/Users/szabozoltan/Herd/laravel-user-team-sync`:**

| Fájl | Felelősség |
|---|---|
| `config/user-team-sync.php` | új `client` szekció (módosítás) |
| `src/UserTeamSyncServiceProvider.php` | `bootClient()` (módosítás) |
| `src/Client/IdentityProvisioner.php` | claim payload → bejelentkeztethető user. Az egyetlen hely, ahol állapot keletkezik. |
| `src/Client/IdentityClient.php` | HTTP a publisher felé: token-csere, refresh, userinfo |
| `src/Client/Exceptions/IdentityConflictException.php` | email-ütközés (D-5) |
| `src/Client/Exceptions/IdentityUnavailableException.php` | hálózat/5xx — türelmi idős ág |
| `src/Client/Exceptions/IdentityRejectedException.php` | 401 / invalid_grant — azonnali kiléptetés |
| `src/Client/Http/Controllers/IdentityRedirectController.php` | PKCE + state generálás, átirányítás |
| `src/Client/Http/Controllers/IdentityCallbackController.php` | state ellenőrzés, token-csere, entitlement, allowlist, login |
| `src/Client/Http/Middleware/RevalidateIdentity.php` | 15 perces reconcile, 401→logout, 5xx→grace |
| `src/Client/IdentitySession.php` | a session kulcsok egy helyen, titkosítva |
| `routes/identity-client.php` | a két auth route |
| `resources/views/identity/not-entitled.blade.php` | „nincs előfizetésed ehhez a modulhoz" |
| `tests/Unit/Client/IdentityProvisionerTest.php` | Task 2–3 |
| `tests/Unit/Client/IdentityClientTest.php` | Task 4 |
| `tests/Feature/Client/AuthFlowTest.php` | Task 5 |
| `tests/Feature/Client/RevalidateIdentityTest.php` | Task 6 |
| `tests/Feature/Client/ServiceProviderClientModeTest.php` | Task 1 |

**crm — `/Users/szabozoltan/Herd/crm`:**

| Fájl | Felelősség |
|---|---|
| `config/user-team-sync.php` | `client` szekció (módosítás) |
| `app/Providers/Filament/AdminPanelServiceProvider.php` | `RevalidateIdentity`, `tenantRegistration` kivétele (módosítás) |
| `app/Filament/Pages/Auth/Login.php` | SSO gomb (módosítás) |
| `tests/Feature/Identity/CrmSsoWiringTest.php` | Task 7 |

---

### Task 1: `client` mód a csomagban — config és provider-bekötés

A `client` mód route-okat tölt be és nem érinti a `receiver`/`publisher` ágat. Ez a task önmagában semmit nem csinál a felhasználóval; azt garantálja, hogy a következő taskok kódja egyáltalán betöltődik, és hogy a meglévő 11 app viselkedése nem változik.

**Files:**
- Modify: `config/user-team-sync.php`
- Modify: `src/UserTeamSyncServiceProvider.php:44-52` (a `$mode` elágazás)
- Create: `routes/identity-client.php`
- Create: `tests/Feature/Client/ServiceProviderClientModeTest.php`
- Modify: `tests/TestCase.php` (a `client` configok alapértéke a teszt-környezetben)

**Interfaces:**
- Consumes: semmit
- Produces:
  - `config('user-team-sync.client.*')` kulcsok: `app_key`, `identity_url`, `client_id`, `client_secret`, `redirect_uri`, `scopes`, `revalidate_after_minutes`, `grace_hours`, `allowlist`, `legacy_receiver`, `role_map`, `http_timeout`
  - route nevek: `identity.redirect`, `identity.callback`
  - a provider `bootClient()` privát metódusa

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/Client/ServiceProviderClientModeTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

function routeUris(): array
{
    return collect(Route::getRoutes()->getRoutes())
        ->map(fn ($route): string => $route->uri())
        ->all();
}

it('registers the auth routes in client mode', function (): void {
    $this->bootWithConfig(['user-team-sync.mode' => 'client']);

    expect(routeUris())
        ->toContain('auth/redirect')
        ->toContain('auth/callback');
});

it('does not register the auth routes in receiver mode', function (): void {
    // The other 10 apps stay on 'receiver'. If client routes leaked into that
    // mode, every one of them would publish an unconfigured OAuth entry point.
    $this->bootWithConfig(['user-team-sync.mode' => 'receiver']);

    expect(routeUris())
        ->not->toContain('auth/redirect')
        ->not->toContain('auth/callback');
});

it('keeps the legacy receiver endpoints available in client mode when the switch is on', function (): void {
    // Phase 3 runs both worlds side by side: allowlisted users go through SSO,
    // everyone else is still served by the legacy push.
    $this->bootWithConfig([
        'user-team-sync.mode' => 'client',
        'user-team-sync.client.legacy_receiver' => true,
    ]);

    expect(routeUris())->toContain('api/create-user');
});

it('drops the legacy receiver endpoints in client mode once the switch is off', function (): void {
    $this->bootWithConfig([
        'user-team-sync.mode' => 'client',
        'user-team-sync.client.legacy_receiver' => false,
    ]);

    expect(routeUris())->not->toContain('api/create-user');
});
```

> **Miért `bootWithConfig()` és nem `config()->set()` + `refreshApplication()`:** a routeokat a service provider a boot alatt regisztrálja, tehát a módot a boot **előtt** kell beállítani. A `refreshApplication()` viszont újrafuttatja a `defineEnvironment()`-et, ami visszaírná az alapértékeket — a teszten belüli `config()->set()` így elveszne. A Step 7 ezért egy olyan helpert vesz fel a `TestCase`-be, ami a felülírásokat a `defineEnvironment()`-en **keresztül** juttatja be.

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
cd /Users/szabozoltan/Herd/laravel-user-team-sync
vendor/bin/pest tests/Feature/Client/ServiceProviderClientModeTest.php
```

Elvárt: FAIL — `auth/redirect` nincs a route-ok között.

- [ ] **Step 3: Vedd fel a `client` configszekciót**

`config/user-team-sync.php` — a `'mode'` kulcs kommentjét egészítsd ki, majd a `'receiver'` szekció **után** szúrd be:

```php
    /*
    |--------------------------------------------------------------------------
    | Client Configuration
    |--------------------------------------------------------------------------
    | Used when mode is 'client': this app delegates authentication to the
    | identity provider and rebuilds its local user state from the token
    | claims on every login and every revalidation.
    */
    'client' => [
        /*
        | This app's own key. Must equal sync_apps.name on the publisher and
        | the slug of the plan category that grants access to this app. The
        | callback rejects the login when this key is absent from the token's
        | 'apps' claim.
        */
        'app_key' => env('IDENTITY_APP_KEY'),

        'identity_url' => env('IDENTITY_URL', 'https://cegem360.eu'),
        'client_id' => env('IDENTITY_CLIENT_ID'),
        'client_secret' => env('IDENTITY_CLIENT_SECRET'),
        'redirect_uri' => env('IDENTITY_REDIRECT_URI'),
        'scopes' => '',

        'http_timeout' => env('IDENTITY_HTTP_TIMEOUT', 10),

        /*
        | Re-fetch the claims and re-run the provisioner when the session's
        | last check is older than this. This is what makes a team rename, a
        | new membership or a cancelled subscription reach the app without any
        | push from the publisher.
        */
        'revalidate_after_minutes' => env('IDENTITY_REVALIDATE_MINUTES', 15),

        /*
        | How long a session survives while the identity provider is
        | unreachable. An outage is not the same thing as revoked access: an
        | already-working user keeps working, only new logins are blocked.
        */
        'grace_hours' => env('IDENTITY_GRACE_HOURS', 24),

        /*
        | Transitional, phase 3 only. Comma-separated e-mail addresses. When
        | non-empty, only these users may sign in through SSO; everyone else
        | keeps using the legacy login form and the legacy push. Empty means
        | everyone goes through SSO.
        */
        'allowlist' => array_values(array_filter(array_map(
            'trim',
            explode(',', (string) env('IDENTITY_SSO_ALLOWLIST', '')),
        ))),

        /*
        | Transitional, phase 3 only. Keeps the legacy receiver endpoints
        | mounted while both worlds run side by side.
        */
        'legacy_receiver' => env('IDENTITY_LEGACY_RECEIVER', true),

        /*
        | Maps a role name from the token onto a local role name. The publisher
        | sends lower-case values ('admin', 'manager', 'subscriber') while a
        | receiver may name its roles differently ('Manager'). Leave empty to
        | rely on the case-insensitive fallback in IdentityProvisioner.
        */
        'role_map' => [],

        /*
        | Where to send a user who authenticated successfully but has no
        | subscription covering this app.
        */
        'subscribe_url' => env('IDENTITY_SUBSCRIBE_URL', 'https://cegem360.eu'),
    ],
```

- [ ] **Step 4: Hozd létre a route fájlt**

A controller osztályok csak a Task 5-ben születnek meg, ezért itt string-referenciaként hivatkozunk rájuk: a route regisztráció nem tölti be az osztályt, csak eltárolja a nevét, így a fájl már most betölthető.

`routes/identity-client.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// The controllers arrive in a later task. Referencing them by name keeps this
// file loadable in the meantime; the string form is replaced with real imports
// once the classes exist.
Route::middleware('web')->group(function (): void {
    Route::get('/auth/redirect', '\Madbox99\UserTeamSync\Client\Http\Controllers\IdentityRedirectController')
        ->name('identity.redirect');
    Route::get('/auth/callback', '\Madbox99\UserTeamSync\Client\Http\Controllers\IdentityCallbackController')
        ->name('identity.callback');
});
```

- [ ] **Step 5: Kösd be a providerbe**

`src/UserTeamSyncServiceProvider.php` — a `boot()` mód-elágazását cseréld erre:

```php
        $mode = config('user-team-sync.mode');

        if (in_array($mode, ['publisher', 'both'], true)) {
            $this->bootPublisher();
        }

        // In client mode the legacy receiver endpoints stay mounted for as long
        // as the transition switch is on: allowlisted users come in through SSO
        // while everyone else is still served by the publisher's push.
        $bootReceiver = in_array($mode, ['receiver', 'both'], true)
            || ($mode === 'client' && (bool) config('user-team-sync.client.legacy_receiver', true));

        if ($bootReceiver) {
            $this->bootReceiver();
        }

        if ($mode === 'client') {
            $this->bootClient();
        }
```

És vedd fel a privát metódust a `bootReceiver()` alá:

```php
    private function bootClient(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/identity-client.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'user-team-sync');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/user-team-sync'),
        ], 'user-team-sync-views');
    }
```

- [ ] **Step 6: Hozd létre a „nincs előfizetés" nézetet**

A `loadViewsFrom()` létező könyvtárat vár, ezért a nézet már itt a végleges tartalmával készül el; a Task 5 callbackje ezt fogja visszaadni.

`resources/views/identity/not-entitled.blade.php`:

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('No access to this module') }}</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #f8fafc;
               display: flex; align-items: center; justify-content: center;
               min-height: 100vh; margin: 0; color: #1e293b; }
        .card { background: #fff; padding: 2.5rem; border-radius: .75rem; max-width: 32rem;
                box-shadow: 0 1px 3px rgb(0 0 0 / .1); text-align: center; }
        h1 { font-size: 1.25rem; margin: 0 0 .75rem; }
        p { margin: 0 0 1.5rem; line-height: 1.6; color: #475569; }
        a { display: inline-block; background: #4f46e5; color: #fff; padding: .625rem 1.25rem;
            border-radius: .5rem; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="card">
        <h1>{{ __('No access to this module') }}</h1>
        <p>{{ __('Your account signed in successfully, but your subscription does not cover this module.') }}</p>
        <a href="{{ $subscribeUrl }}">{{ __('Manage subscription') }}</a>
    </div>
</body>
</html>
```

- [ ] **Step 7: Add meg a teszt-alapértékeket és a `bootWithConfig()` helpert**

`tests/TestCase.php` — vedd fel az osztály tetejére a mezőt és a helpert:

```php
    /** @var array<string, mixed> */
    protected array $configOverrides = [];

    /**
     * Reboot the application with extra configuration applied. Routes are
     * registered while the service provider boots, so anything that decides
     * which routes exist has to be in place before that — and a plain
     * config()->set() would be undone by defineEnvironment() on the way
     * through refreshApplication().
     *
     * @param  array<string, mixed>  $overrides
     */
    protected function bootWithConfig(array $overrides): void
    {
        $this->configOverrides = $overrides;

        $this->refreshApplication();

        $this->setUpDatabase();
    }
```

A `setUpDatabase()` láthatóságát emeld `private`-ról `protected`-re, hogy a helper hívhassa.

A `defineEnvironment()` **végére** pedig:

```php
        $app['config']->set('user-team-sync.client.app_key', 'crm');
        $app['config']->set('user-team-sync.client.identity_url', 'https://identity.test');
        $app['config']->set('user-team-sync.client.client_id', 'test-client-id');
        $app['config']->set('user-team-sync.client.client_secret', 'test-client-secret');
        $app['config']->set('user-team-sync.client.redirect_uri', 'https://app.test/auth/callback');
        $app['config']->set('user-team-sync.client.subscribe_url', 'https://identity.test');
        $app['config']->set('user-team-sync.client.allowlist', []);
        $app['config']->set('user-team-sync.client.legacy_receiver', true);
        $app['config']->set('user-team-sync.client.role_map', []);
        $app['config']->set('user-team-sync.client.revalidate_after_minutes', 15);
        $app['config']->set('user-team-sync.client.grace_hours', 24);
        $app['config']->set('auth.providers.users.model', \Madbox99\UserTeamSync\Tests\Fixtures\User::class);

        // Applied last so a test's own overrides always win.
        foreach ($this->configOverrides as $key => $value) {
            $app['config']->set($key, $value);
        }
```

- [ ] **Step 8: Futtasd a tesztet**

```bash
vendor/bin/pest tests/Feature/Client/ServiceProviderClientModeTest.php
```

Elvárt: PASS (4 teszt).

- [ ] **Step 9: Futtasd a TELJES csomag-tesztet**

```bash
vendor/bin/pest
```

Elvárt: PASS, **154 + 4 teszt**. Ha bármelyik meglévő teszt bukik, a mód-elágazás elrontotta a `receiver`/`publisher` viselkedést — javítsd, ne a tesztet írd át.

- [ ] **Step 10: Commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: client mode scaffolding — config, routes and provider wiring"
```

---

### Task 2: `IdentityProvisioner` — a felhasználó és a szerepkör

Ez a task a provisioner user-ágát építi. A csapatok a Task 3-ban jönnek; addig a `orgs` claimet a provisioner elfogadja, de nem dolgozza fel.

**Files:**
- Create: `src/Client/IdentityProvisioner.php`
- Create: `src/Client/Exceptions/IdentityConflictException.php`
- Create: `tests/Unit/Client/IdentityProvisionerTest.php`

**Interfaces:**
- Consumes: `config('user-team-sync.client.role_map')`, `config('user-team-sync.receiver.default_role')`, `config('user-team-sync.models.user')`
- Produces:
  - `IdentityProvisioner::provision(array $claims): Model` — a claim payloadot kapja (`sub`, `email`, `name`, `role`, `orgs`, `apps`, `issued_at`, `claims_version`), és a bejelentkeztethető user modellt adja vissza
  - `IdentityConflictException` — akkor dobódik, ha az email egy másik uuid-jú userhez tartozik

- [ ] **Step 1: Írd meg a bukó teszteket**

`tests/Unit/Client/IdentityProvisionerTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\UserTeamSync\Client\Exceptions\IdentityConflictException;
use Madbox99\UserTeamSync\Client\IdentityProvisioner;
use Madbox99\UserTeamSync\Tests\Fixtures\User;
use Madbox99\UserTeamSync\Tests\Fixtures\UserWithoutUuidFillable;

function claims(array $overrides = []): array
{
    return array_merge([
        'sub' => '11111111-1111-4111-8111-111111111111',
        'email' => 'anna@example.test',
        'name' => 'Anna Teszt',
        'role' => 'manager',
        'orgs' => [],
        'apps' => ['crm'],
        'issued_at' => 1785832300,
        'claims_version' => 1,
    ], $overrides);
}

it('creates a user from the claims', function (): void {
    $user = app(IdentityProvisioner::class)->provision(claims());

    expect($user->uuid)->toBe('11111111-1111-4111-8111-111111111111')
        ->and($user->email)->toBe('anna@example.test')
        ->and($user->name)->toBe('Anna Teszt');
});

it('is idempotent', function (): void {
    $provisioner = app(IdentityProvisioner::class);

    $provisioner->provision(claims());
    $provisioner->provision(claims());

    expect(User::query()->count())->toBe(1);
});

it('updates the name and e-mail of an existing user matched by uuid', function (): void {
    User::query()->create([
        'uuid' => '11111111-1111-4111-8111-111111111111',
        'name' => 'Regi Nev',
        'email' => 'regi@example.test',
        'password' => 'irrelevant',
    ]);

    $user = app(IdentityProvisioner::class)->provision(claims());

    expect(User::query()->count())->toBe(1)
        ->and($user->name)->toBe('Anna Teszt')
        ->and($user->email)->toBe('anna@example.test');
});

it('adopts a local user that has no uuid but the same e-mail', function (): void {
    // Production reality: crm has 7 users with a NULL uuid. Matching on uuid
    // alone would try to INSERT a second row with the same e-mail and hit the
    // unique index, so the very first SSO login of such a user would 500.
    $existing = User::query()->create([
        'uuid' => null,
        'name' => 'Regi Nev',
        'email' => 'anna@example.test',
        'password' => 'irrelevant',
    ]);

    $user = app(IdentityProvisioner::class)->provision(claims());

    expect(User::query()->count())->toBe(1)
        ->and($user->getKey())->toBe($existing->getKey())
        ->and($user->uuid)->toBe('11111111-1111-4111-8111-111111111111');
});

it('refuses to take over an e-mail that belongs to a different uuid', function (): void {
    User::query()->create([
        'uuid' => '99999999-9999-4999-8999-999999999999',
        'name' => 'Valaki Mas',
        'email' => 'anna@example.test',
        'password' => 'irrelevant',
    ]);

    expect(fn () => app(IdentityProvisioner::class)->provision(claims()))
        ->toThrow(IdentityConflictException::class);
});

it('writes the uuid even when the receiver model does not list it as fillable', function (): void {
    // App\Models\User in crm declares #[Fillable] without 'uuid'. Mass
    // assignment would silently drop it and every login would create a new row.
    config()->set('user-team-sync.models.user', UserWithoutUuidFillable::class);

    $user = app(IdentityProvisioner::class)->provision(claims());

    expect($user->fresh()->uuid)->toBe('11111111-1111-4111-8111-111111111111');
});

it('activates the user because the token already proves entitlement', function (): void {
    // The receiver's default_active is false and the panel is behind
    // EnsureUserHasActiveSubscription, so without this every SSO login 403s.
    $user = app(IdentityProvisioner::class)->provision(claims());

    expect((bool) $user->is_active)->toBeTrue();
});

it('leaves no usable password on the account', function (): void {
    // Password replication is what SSO removes: the hash must not be copied to
    // 16 apps. An empty string is not a valid bcrypt hash, so Hash::check()
    // can never succeed against it.
    $user = app(IdentityProvisioner::class)->provision(claims());

    expect(Hash::check('password', (string) $user->password))->toBeFalse()
        ->and(Hash::check('', (string) $user->password))->toBeFalse();
});

it('marks the e-mail as verified because the identity provider already did', function (): void {
    $user = app(IdentityProvisioner::class)->provision(claims());

    expect($user->email_verified_at)->not->toBeNull();
});

it('resolves a lower-case claim role onto a differently-cased local role', function (): void {
    // Verified on production: the publisher sends 'manager', crm's Spatie role
    // is named 'Manager', and it only works today because MySQL's collation is
    // case-insensitive. These tests run on SQLite, where it is not.
    config()->set('user-team-sync.client.role_map', []);

    $resolved = app(IdentityProvisioner::class)
        ->resolveRoleName('manager', ['Admin', 'Manager', 'Subscriber']);

    expect($resolved)->toBe('Manager');
});

it('prefers an explicit role map over the case-insensitive fallback', function (): void {
    config()->set('user-team-sync.client.role_map', ['manager' => 'Sales Representative']);

    $resolved = app(IdentityProvisioner::class)
        ->resolveRoleName('manager', ['Admin', 'Manager', 'Sales Representative']);

    expect($resolved)->toBe('Sales Representative');
});

it('falls back to the default role when the claim role has no local counterpart', function (): void {
    config()->set('user-team-sync.receiver.default_role', 'Subscriber');

    $resolved = app(IdentityProvisioner::class)
        ->resolveRoleName('kozgazdasz', ['Admin', 'Manager', 'Subscriber']);

    expect($resolved)->toBe('Subscriber');
});

it('stores the role on the users table when the role driver is not spatie', function (): void {
    config()->set('user-team-sync.receiver.role_driver', 'column');

    $user = app(IdentityProvisioner::class)->provision(claims());

    expect($user->fresh()->role)->toBe('manager');
});
```

> A `Hash` facade importja a Pest fájl tetején nem kell, a `Hash::check` globálisan elérhető a Testbench alatt. Ha statikus analízis panaszkodik, tedd hozzá: `use Illuminate\Support\Facades\Hash;`.

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
vendor/bin/pest tests/Unit/Client/IdentityProvisionerTest.php
```

Elvárt: FAIL — `Class "Madbox99\UserTeamSync\Client\IdentityProvisioner" does not exist`.

- [ ] **Step 3: Hozd létre a kivételt**

`src/Client/Exceptions/IdentityConflictException.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Exceptions;

use RuntimeException;

/**
 * The claims describe an identity that cannot be reconciled with what is
 * already in this app's database without destroying information — for
 * instance an e-mail address that belongs to a local user carrying a
 * different uuid. Signing in is refused rather than silently taking the
 * record over.
 */
final class IdentityConflictException extends RuntimeException
{
    public static function emailBelongsToAnotherIdentity(string $email): self
    {
        return new self(
            "The e-mail address [{$email}] already belongs to a local user with a different identity.",
        );
    }
}
```

- [ ] **Step 4: Írd meg a provisionert (user-ág)**

`src/Client/IdentityProvisioner.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityConflictException;

/**
 * Turns a claim payload from the identity provider into a local, signed-in-able
 * user. This is the only place in client mode where state is created, and it
 * runs both on login and on every revalidation: it is a reconcile that happens
 * to also be the login path.
 */
final class IdentityProvisioner
{
    /**
     * @param  array<string, mixed>  $claims
     */
    public function provision(array $claims): Model
    {
        return DB::transaction(function () use ($claims): Model {
            $user = $this->resolveUser($claims);

            $this->applyRole($user, (string) ($claims['role'] ?? ''));

            return $user;
        });
    }

    /**
     * Resolve the claim's role name onto a role that actually exists in this
     * app. The publisher sends lower-case names while a receiver may capitalise
     * its own; relying on the database collation to bridge that works on MySQL
     * and fails on SQLite, so the match is made in PHP.
     *
     * @param  array<int, string>  $localRoleNames
     */
    public function resolveRoleName(string $claimRole, array $localRoleNames): string
    {
        /** @var array<string, string> $map */
        $map = config('user-team-sync.client.role_map', []);

        if (isset($map[$claimRole])) {
            return $map[$claimRole];
        }

        foreach ($localRoleNames as $name) {
            if (mb_strtolower($name) === mb_strtolower($claimRole)) {
                return $name;
            }
        }

        return (string) config('user-team-sync.receiver.default_role', 'subscriber');
    }

    /**
     * @param  array<string, mixed>  $claims
     */
    private function resolveUser(array $claims): Model
    {
        /** @var class-string<Model> $userModel */
        $userModel = config('user-team-sync.models.user');

        $uuid = (string) $claims['sub'];
        $email = (string) $claims['email'];

        $user = $userModel::query()->where('uuid', $uuid)->first();

        if (! $user instanceof Model) {
            $byEmail = $userModel::query()->where('email', $email)->first();

            if ($byEmail instanceof Model) {
                // Adopt a local account that predates the identity layer. A row
                // that already carries a *different* uuid is a genuine identity
                // clash and must not be taken over silently.
                if ($byEmail->getAttribute('uuid') !== null) {
                    throw IdentityConflictException::emailBelongsToAnotherIdentity($email);
                }

                $user = $byEmail;
            } else {
                $user = new $userModel;
            }
        }

        // forceFill, because a receiver's user model is free to leave 'uuid'
        // out of $fillable — crm's does. Mass assignment would drop it and
        // every login would then look like a brand new identity.
        $user->forceFill([
            'uuid' => $uuid,
            'name' => (string) $claims['name'],
            'email' => $email,
            'email_verified_at' => $user->getAttribute('email_verified_at') ?? now(),
            'is_active' => true,
        ]);

        if ($user->exists === false) {
            // Never a valid bcrypt hash, so Hash::check() can never match it.
            // SSO accounts have no password anywhere in the fleet.
            $user->forceFill(['password' => '']);
        }

        $user->save();

        return $user;
    }

    private function applyRole(Model $user, string $claimRole): void
    {
        if ($claimRole === '') {
            return;
        }

        if (config('user-team-sync.receiver.role_driver') === 'spatie' && method_exists($user, 'syncRoles')) {
            /** @var class-string<Model> $roleModel */
            $roleModel = config('permission.models.role', \Spatie\Permission\Models\Role::class);

            /** @var array<int, string> $localRoleNames */
            $localRoleNames = $roleModel::query()->pluck('name')->all();

            $user->syncRoles([$this->resolveRoleName($claimRole, $localRoleNames)]);

            return;
        }

        $user->forceFill(['role' => $claimRole])->save();
    }
}
```

- [ ] **Step 5: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Unit/Client/IdentityProvisionerTest.php
```

Elvárt: PASS (13 teszt).

> Ha a spatie-s tesztek elhasalnak azon, hogy a `spatie/laravel-permission` nincs a csomag dev-függőségei között: **ne** vedd fel függőségnek. A `resolveRoleName()` tesztjei nem igénylik a Spatie-t (tiszta függvény), a `provision()` tesztjei pedig a `role_driver = 'column'` ágon futnak. Állítsd a TestCase alapértékét `'column'`-ra, és a spatie-ágat csak a `resolveRoleName()` unit tesztjei fedjék.

- [ ] **Step 6: Bizonyítsd, hogy a tesztek teherbírók (mutációs próba)**

Írd át ideiglenesen a `resolveRoleName()` fallback ciklusát szigorú `===`-re (`$name === $claimRole`), és futtasd:

```bash
vendor/bin/pest tests/Unit/Client/IdentityProvisionerTest.php
```

Elvárt: a „resolves a lower-case claim role" teszt **bukik**. Ha zöld marad, a teszt nem mér semmit — javítsd. Utána állítsd vissza.

Ugyanígy: vedd ki a `forceFill`-ből az `'is_active' => true`-t → az aktiválási tesztnek buknia kell.

- [ ] **Step 7: Futtasd a teljes csomag-tesztet**

```bash
vendor/bin/pest
```

Elvárt: minden zöld.

- [ ] **Step 8: Commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: IdentityProvisioner user branch with e-mail adoption and role resolution"
```

---

### Task 3: `IdentityProvisioner` — csapatok és tagságok

**Files:**
- Modify: `src/Client/IdentityProvisioner.php`
- Modify: `tests/Unit/Client/IdentityProvisionerTest.php`

**Interfaces:**
- Consumes: Task 2 `IdentityProvisioner::provision()`
- Produces: `provision()` a `$claims['orgs']` tömb alapján beállítja a `$user->teams()` kapcsolatot

- [ ] **Step 1: Írd meg a bukó teszteket**

Fűzd hozzá a `tests/Unit/Client/IdentityProvisionerTest.php` végéhez:

```php
use Madbox99\UserTeamSync\Tests\Fixtures\Team;
use Madbox99\UserTeamSync\Tests\Fixtures\TeamWithoutUuidFillable;

function org(string $uuid, string $name, string $slug): array
{
    return ['uuid' => $uuid, 'name' => $name, 'slug' => $slug];
}

it('creates the team from the orgs claim and attaches the user', function (): void {
    $user = app(IdentityProvisioner::class)->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    $team = Team::query()->firstWhere('uuid', '22222222-2222-4222-8222-222222222222');

    expect($team)->not->toBeNull()
        ->and($team->slug)->toBe('acme-kft')
        ->and($user->teams()->pluck('teams.id')->all())->toBe([$team->getKey()]);
});

it('follows a team rename instead of creating a second team', function (): void {
    // This is the bug the whole project exists to kill: the publisher renames a
    // team, the slug changes, and the receiver used to match on slug forever.
    $provisioner = app(IdentityProvisioner::class);

    $provisioner->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    $user = $provisioner->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Zrt.', 'acme-zrt')],
    ]));

    expect(Team::query()->count())->toBe(1)
        ->and(Team::query()->first()->slug)->toBe('acme-zrt')
        ->and($user->teams()->count())->toBe(1);
});

it('adopts a local team that matches by slug and has no uuid', function (): void {
    // crm has 16 such teams in production.
    $existing = Team::query()->create(['uuid' => null, 'name' => 'Acme Kft.', 'slug' => 'acme-kft']);

    app(IdentityProvisioner::class)->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    expect(Team::query()->count())->toBe(1)
        ->and($existing->fresh()->uuid)->toBe('22222222-2222-4222-8222-222222222222');
});

it('suffixes the slug when a different team already owns it', function (): void {
    // Two unrelated organisations may legitimately want the same slug. Unlike
    // the e-mail case, this is not an identity clash — so it gets a suffix
    // rather than refusing the login.
    Team::query()->create([
        'uuid' => '99999999-9999-4999-8999-999999999999',
        'name' => 'Masik Acme',
        'slug' => 'acme-kft',
    ]);

    app(IdentityProvisioner::class)->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    $team = Team::query()->firstWhere('uuid', '22222222-2222-4222-8222-222222222222');

    expect(Team::query()->count())->toBe(2)
        ->and($team->slug)->toBe('acme-kft-2');
});

it('detaches the user from a team that is no longer in the claims', function (): void {
    // The token is complete state, so an absence is information. Nothing in the
    // legacy sync ever removed a membership.
    $provisioner = app(IdentityProvisioner::class);

    $provisioner->provision(claims([
        'orgs' => [
            org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft'),
            org('33333333-3333-4333-8333-333333333333', 'Bolt Bt.', 'bolt-bt'),
        ],
    ]));

    $user = $provisioner->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    expect($user->teams()->pluck('teams.slug')->all())->toBe(['acme-kft']);
});

it('writes the team uuid even when the receiver team model does not list it as fillable', function (): void {
    config()->set('user-team-sync.models.team', TeamWithoutUuidFillable::class);

    app(IdentityProvisioner::class)->provision(claims([
        'orgs' => [org('22222222-2222-4222-8222-222222222222', 'Acme Kft.', 'acme-kft')],
    ]));

    expect(TeamWithoutUuidFillable::query()->first()->uuid)
        ->toBe('22222222-2222-4222-8222-222222222222');
});

it('leaves the user in no team when the orgs claim is empty', function (): void {
    $user = app(IdentityProvisioner::class)->provision(claims(['orgs' => []]));

    expect($user->teams()->count())->toBe(0);
});
```

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
vendor/bin/pest tests/Unit/Client/IdentityProvisionerTest.php
```

Elvárt: az új 7 teszt FAIL (a `provision()` még nem nyúl a csapatokhoz).

- [ ] **Step 3: Egészítsd ki a provisionert**

`src/Client/IdentityProvisioner.php` — a `provision()` törzsében a `applyRole()` **után**:

```php
            $this->syncTeams($user, $claims['orgs'] ?? []);
```

És vedd fel a két privát metódust:

```php
    /**
     * @param  array<int, array<string, string>>  $orgs
     */
    private function syncTeams(Model $user, array $orgs): void
    {
        $teamIds = [];

        foreach ($orgs as $org) {
            $teamIds[] = $this->resolveTeam($org)->getKey();
        }

        // sync(), not syncWithoutDetaching(): the token carries complete state,
        // so a membership that is absent from it has genuinely ended.
        $user->teams()->sync($teamIds);
    }

    /**
     * Resolution order: uuid, then an uuid-less local team with the same slug
     * (adoption), then creation. Adoption keeps the legacy push and the SSO
     * path from building duplicates of each other's teams while both run.
     *
     * @param  array<string, string>  $org
     */
    private function resolveTeam(array $org): Model
    {
        /** @var class-string<Model> $teamModel */
        $teamModel = config('user-team-sync.models.team');

        $uuid = $org['uuid'];

        $team = $teamModel::query()->where('uuid', $uuid)->first();

        if (! $team instanceof Model) {
            $team = $teamModel::query()
                ->where('slug', $org['slug'])
                ->whereNull('uuid')
                ->first();
        }

        $team ??= new $teamModel;

        $team->forceFill([
            'uuid' => $uuid,
            'name' => $org['name'],
            'slug' => $this->availableSlug($teamModel, $org['slug'], $uuid),
        ])->save();

        return $team;
    }

    /**
     * The team being resolved must not see itself as a collision: on the
     * adoption branch it already holds the slug it is about to keep. Only a
     * *different* row taking the slug earns a suffix.
     *
     * @param  class-string<Model>  $teamModel
     */
    private function availableSlug(string $teamModel, string $slug, int|string|null $exceptId): string
    {
        $candidate = $slug;
        $suffix = 1;

        while ($teamModel::query()
            ->where('slug', $candidate)
            ->when($exceptId !== null, fn ($query) => $query->whereKeyNot($exceptId))
            ->exists()
        ) {
            $suffix++;
            $candidate = $slug.'-'.$suffix;
        }

        return $candidate;
    }
```

> A `resolveTeam()` fenti `forceFill`-jében a slug sora ezért így néz ki:
> ```php
> 'slug' => $this->availableSlug($teamModel, $org['slug'], $team->exists ? $team->getKey() : null),
> ```
> Az „adopts a local team" és a „suffixes the slug" teszt **együtt** méri ezt: az első bukik, ha a kizárás hiányzik, a második, ha a ciklus.

- [ ] **Step 4: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Unit/Client/IdentityProvisionerTest.php
```

Elvárt: PASS (20 teszt). Ha az „adopts" és a „suffixes" közül csak az egyik zöld, a Step 3 megjegyzésében leírt hiba van benne.

- [ ] **Step 5: Futtasd a teljes csomag-tesztet és commitolj**

```bash
vendor/bin/pest && vendor/bin/pint
git add -A
git commit -m "feat: IdentityProvisioner team resolution with adoption, rename tracking and detach"
```

---

### Task 4: `IdentityClient` — HTTP a publisher felé

**Files:**
- Create: `src/Client/IdentityClient.php`
- Create: `src/Client/Exceptions/IdentityUnavailableException.php`
- Create: `src/Client/Exceptions/IdentityRejectedException.php`
- Create: `tests/Unit/Client/IdentityClientTest.php`

**Interfaces:**
- Consumes: `config('user-team-sync.client.*')`
- Produces:
  - `IdentityClient::exchangeCode(string $code, string $codeVerifier): array` — `['access_token' => string, 'refresh_token' => string, 'expires_in' => int]`
  - `IdentityClient::refresh(string $refreshToken): array` — ugyanaz az alak
  - `IdentityClient::fetchClaims(string $accessToken): array` — a `/api/userinfo` payload
  - `IdentityClient::authorizeUrl(string $state, string $codeChallenge): string`
  - `IdentityRejectedException` (401 / `invalid_grant`), `IdentityUnavailableException` (hálózat, 5xx, timeout)

- [ ] **Step 1: Írd meg a bukó teszteket**

`tests/Unit/Client/IdentityClientTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityRejectedException;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityUnavailableException;
use Madbox99\UserTeamSync\Client\IdentityClient;

it('builds an authorize url with pkce and the configured client', function (): void {
    $url = app(IdentityClient::class)->authorizeUrl('state-abc', 'challenge-xyz');

    expect($url)->toStartWith('https://identity.test/oauth/authorize?');

    parse_str((string) parse_url($url, PHP_URL_QUERY), $query);

    expect($query)->toMatchArray([
        'client_id' => 'test-client-id',
        'redirect_uri' => 'https://app.test/auth/callback',
        'response_type' => 'code',
        'state' => 'state-abc',
        'code_challenge' => 'challenge-xyz',
        'code_challenge_method' => 'S256',
    ]);
});

it('exchanges an authorization code for tokens', function (): void {
    Http::fake([
        'identity.test/oauth/token' => Http::response([
            'token_type' => 'Bearer',
            'expires_in' => 31536000,
            'access_token' => 'access-1',
            'refresh_token' => 'refresh-1',
        ]),
    ]);

    $tokens = app(IdentityClient::class)->exchangeCode('code-1', 'verifier-1');

    expect($tokens['access_token'])->toBe('access-1')
        ->and($tokens['refresh_token'])->toBe('refresh-1');

    Http::assertSent(fn (Request $request): bool => $request['grant_type'] === 'authorization_code'
        && $request['code'] === 'code-1'
        && $request['code_verifier'] === 'verifier-1'
        && $request['client_secret'] === 'test-client-secret');
});

it('treats a rejected code as a rejection, not an outage', function (): void {
    Http::fake([
        'identity.test/oauth/token' => Http::response(['error' => 'invalid_grant'], 400),
    ]);

    expect(fn () => app(IdentityClient::class)->exchangeCode('code-1', 'verifier-1'))
        ->toThrow(IdentityRejectedException::class);
});

it('treats a 5xx as an outage, not a rejection', function (): void {
    // This distinction decides whether an identity-provider outage logs the
    // whole fleet out or lets working sessions carry on.
    Http::fake([
        'identity.test/api/userinfo' => Http::response('gateway down', 502),
    ]);

    expect(fn () => app(IdentityClient::class)->fetchClaims('access-1'))
        ->toThrow(IdentityUnavailableException::class);
});

it('treats a connection failure as an outage', function (): void {
    Http::fake(fn () => throw new Illuminate\Http\Client\ConnectionException('timeout'));

    expect(fn () => app(IdentityClient::class)->fetchClaims('access-1'))
        ->toThrow(IdentityUnavailableException::class);
});

it('treats a 401 on userinfo as a rejection', function (): void {
    Http::fake([
        'identity.test/api/userinfo' => Http::response(['message' => 'Unauthenticated.'], 401),
    ]);

    expect(fn () => app(IdentityClient::class)->fetchClaims('access-1'))
        ->toThrow(IdentityRejectedException::class);
});

it('fetches the claims with a bearer token', function (): void {
    Http::fake([
        'identity.test/api/userinfo' => Http::response([
            'sub' => '11111111-1111-4111-8111-111111111111',
            'email' => 'anna@example.test',
            'name' => 'Anna Teszt',
            'role' => 'manager',
            'orgs' => [],
            'apps' => ['crm'],
            'issued_at' => 1785832300,
            'claims_version' => 1,
        ]),
    ]);

    $claims = app(IdentityClient::class)->fetchClaims('access-1');

    expect($claims['sub'])->toBe('11111111-1111-4111-8111-111111111111')
        ->and($claims['apps'])->toBe(['crm']);

    Http::assertSent(fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer access-1'));
});

it('refreshes an expired access token', function (): void {
    Http::fake([
        'identity.test/oauth/token' => Http::response([
            'access_token' => 'access-2',
            'refresh_token' => 'refresh-2',
            'expires_in' => 31536000,
        ]),
    ]);

    $tokens = app(IdentityClient::class)->refresh('refresh-1');

    expect($tokens['access_token'])->toBe('access-2');

    Http::assertSent(fn (Request $request): bool => $request['grant_type'] === 'refresh_token'
        && $request['refresh_token'] === 'refresh-1');
});
```

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
vendor/bin/pest tests/Unit/Client/IdentityClientTest.php
```

Elvárt: FAIL — az `IdentityClient` osztály nem létezik.

- [ ] **Step 3: Hozd létre a két kivételt**

`src/Client/Exceptions/IdentityUnavailableException.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Exceptions;

use RuntimeException;

/**
 * The identity provider could not be reached or answered with a server error.
 * This is explicitly NOT the same as access being revoked: an existing session
 * survives it for the configured grace period.
 */
final class IdentityUnavailableException extends RuntimeException {}
```

`src/Client/Exceptions/IdentityRejectedException.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Exceptions;

use RuntimeException;

/**
 * The identity provider answered, and the answer was no — an expired or
 * revoked token, or a code that cannot be exchanged. The session ends
 * immediately.
 */
final class IdentityRejectedException extends RuntimeException {}
```

- [ ] **Step 4: Írd meg az `IdentityClient`-et**

`src/Client/IdentityClient.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityRejectedException;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityUnavailableException;

final class IdentityClient
{
    public function authorizeUrl(string $state, string $codeChallenge): string
    {
        return $this->baseUrl().'/oauth/authorize?'.http_build_query([
            'client_id' => (string) config('user-team-sync.client.client_id'),
            'redirect_uri' => (string) config('user-team-sync.client.redirect_uri'),
            'response_type' => 'code',
            'scope' => (string) config('user-team-sync.client.scopes', ''),
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);
    }

    /**
     * @return array{access_token: string, refresh_token: string, expires_in: int}
     */
    public function exchangeCode(string $code, string $codeVerifier): array
    {
        return $this->token([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => (string) config('user-team-sync.client.redirect_uri'),
            'code_verifier' => $codeVerifier,
        ]);
    }

    /**
     * @return array{access_token: string, refresh_token: string, expires_in: int}
     */
    public function refresh(string $refreshToken): array
    {
        return $this->token([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'scope' => (string) config('user-team-sync.client.scopes', ''),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function fetchClaims(string $accessToken): array
    {
        $response = $this->send(fn (): Response => Http::timeout($this->timeout())
            ->withToken($accessToken)
            ->acceptJson()
            ->get($this->baseUrl().'/api/userinfo'));

        /** @var array<string, mixed> $claims */
        $claims = $response->json();

        return $claims;
    }

    /**
     * @param  array<string, string>  $payload
     * @return array{access_token: string, refresh_token: string, expires_in: int}
     */
    private function token(array $payload): array
    {
        $response = $this->send(fn (): Response => Http::timeout($this->timeout())
            ->asForm()
            ->acceptJson()
            ->post($this->baseUrl().'/oauth/token', array_merge($payload, [
                'client_id' => (string) config('user-team-sync.client.client_id'),
                'client_secret' => (string) config('user-team-sync.client.client_secret'),
            ])));

        /** @var array{access_token: string, refresh_token: string, expires_in: int} $tokens */
        $tokens = $response->json();

        return $tokens;
    }

    /**
     * The whole point of this method is the distinction it draws: a 4xx is the
     * provider saying no, anything else is the provider being unreachable.
     * Collapsing the two would turn a five-minute outage into a fleet-wide
     * forced logout.
     *
     * @param  callable(): Response  $request
     */
    private function send(callable $request): Response
    {
        try {
            $response = $request();
        } catch (ConnectionException $exception) {
            throw new IdentityUnavailableException($exception->getMessage(), previous: $exception);
        }

        if ($response->serverError()) {
            throw new IdentityUnavailableException(
                'The identity provider answered with HTTP '.$response->status().'.',
            );
        }

        if ($response->clientError()) {
            throw new IdentityRejectedException(
                'The identity provider rejected the request with HTTP '.$response->status().'.',
            );
        }

        return $response;
    }

    private function baseUrl(): string
    {
        return rtrim((string) config('user-team-sync.client.identity_url'), '/');
    }

    private function timeout(): int
    {
        return (int) config('user-team-sync.client.http_timeout', 10);
    }
}
```

- [ ] **Step 5: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Unit/Client/IdentityClientTest.php
```

Elvárt: PASS (8 teszt).

- [ ] **Step 6: Bizonyítsd, hogy a legfontosabb teszt teherbíró**

Cseréld a `send()`-ben a `serverError()`-os ágat `clientError()`-ra (azaz mindent elutasításnak véve), és futtasd. Elvárt: a „treats a 5xx as an outage" **bukik**. Állítsd vissza.

- [ ] **Step 7: Commit**

```bash
vendor/bin/pest && vendor/bin/pint
git add -A
git commit -m "feat: IdentityClient with an explicit outage-vs-rejection split"
```

---

### Task 5: `/auth/redirect` és `/auth/callback`

**Files:**
- Create: `src/Client/IdentitySession.php`
- Create: `src/Client/Http/Controllers/IdentityRedirectController.php`
- Create: `src/Client/Http/Controllers/IdentityCallbackController.php`
- Modify: `routes/identity-client.php` (a string-referenciák visszaírása `use`-os alakra)
- Create: `tests/Feature/Client/AuthFlowTest.php`

**Interfaces:**
- Consumes: Task 2–3 `IdentityProvisioner::provision()`, Task 4 `IdentityClient`
- Produces:
  - `IdentitySession` statikus metódusai: `putTokens(array $tokens): void`, `accessToken(): ?string`, `refreshToken(): ?string`, `markChecked(): void`, `checkedAt(): ?CarbonInterface`, `graceStartedAt(): ?CarbonInterface`, `startGrace(): void`, `clearGrace(): void`, `forget(): void`
  - route nevek `identity.redirect` és `identity.callback`

- [ ] **Step 1: Írd meg a bukó teszteket**

`tests/Feature/Client/AuthFlowTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Madbox99\UserTeamSync\Tests\Fixtures\User;

beforeEach(function (): void {
    $this->bootWithConfig(['user-team-sync.mode' => 'client']);
});

function fakeIdentity(array $claimOverrides = []): void
{
    Http::fake([
        'identity.test/oauth/token' => Http::response([
            'access_token' => 'access-1',
            'refresh_token' => 'refresh-1',
            'expires_in' => 31536000,
        ]),
        'identity.test/api/userinfo' => Http::response(array_merge([
            'sub' => '11111111-1111-4111-8111-111111111111',
            'email' => 'anna@example.test',
            'name' => 'Anna Teszt',
            'role' => 'manager',
            'orgs' => [['uuid' => '22222222-2222-4222-8222-222222222222', 'name' => 'Acme Kft.', 'slug' => 'acme-kft']],
            'apps' => ['crm'],
            'issued_at' => 1785832300,
            'claims_version' => 1,
        ], $claimOverrides)),
    ]);
}

it('redirects to the identity provider with pkce', function (): void {
    $response = $this->get('/auth/redirect');

    $response->assertRedirectContains('https://identity.test/oauth/authorize');

    parse_str((string) parse_url($response->headers->get('Location'), PHP_URL_QUERY), $query);

    expect($query['code_challenge_method'])->toBe('S256')
        ->and($query['code_challenge'])->not->toBeEmpty()
        ->and($query['state'])->not->toBeEmpty();

    // The verifier must stay on this side — sending it would defeat PKCE.
    expect(session('identity.code_verifier'))->not->toBeEmpty()
        ->and($query)->not->toHaveKey('code_verifier');
});

it('signs the user in through the callback', function (): void {
    fakeIdentity();

    $this->get('/auth/redirect');

    $response = $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    $response->assertRedirect();

    expect(auth()->check())->toBeTrue()
        ->and(auth()->user()->email)->toBe('anna@example.test')
        ->and(User::query()->count())->toBe(1);
});

it('rejects a callback whose state does not match', function (): void {
    // Without this check any site could initiate a login into this app.
    fakeIdentity();

    $this->get('/auth/redirect');

    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => 'forged-state',
    ]))->assertForbidden();

    expect(auth()->check())->toBeFalse();
});

it('rejects a callback with no prior redirect', function (): void {
    fakeIdentity();

    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => 'anything',
    ]))->assertForbidden();
});

it('refuses the login when the app key is missing from the apps claim', function (): void {
    fakeIdentity(['apps' => ['mes']]);

    $this->get('/auth/redirect');

    $response = $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    $response->assertOk();
    $response->assertSee('Manage subscription');

    expect(auth()->check())->toBeFalse();
});

it('provisions the user even though the login is refused for entitlement', function (): void {
    // Deliberate: the account and its teams are real, only the subscription is
    // missing. Provisioning anyway means the user works the moment they buy.
    fakeIdentity(['apps' => []]);

    $this->get('/auth/redirect');
    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    expect(User::query()->where('email', 'anna@example.test')->exists())->toBeTrue();
});

it('refuses a user who is not on the allowlist while the allowlist is in force', function (): void {
    config()->set('user-team-sync.client.allowlist', ['belsos@cegem360.hu']);
    fakeIdentity();

    $this->get('/auth/redirect');

    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]))->assertForbidden();

    expect(auth()->check())->toBeFalse()
        ->and(User::query()->count())->toBe(0);
});

it('lets an allowlisted user through', function (): void {
    config()->set('user-team-sync.client.allowlist', ['anna@example.test']);
    fakeIdentity();

    $this->get('/auth/redirect');

    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    expect(auth()->check())->toBeTrue();
});

it('does not leave the code verifier in the session after a successful login', function (): void {
    fakeIdentity();

    $this->get('/auth/redirect');
    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    expect(session('identity.code_verifier'))->toBeNull()
        ->and(session('identity.state'))->toBeNull();
});

it('stores the refresh token encrypted rather than in the clear', function (): void {
    fakeIdentity();

    $this->get('/auth/redirect');
    $this->get('/auth/callback?'.http_build_query([
        'code' => 'code-1',
        'state' => session('identity.state'),
    ]));

    expect(session('identity.refresh_token'))->not->toBe('refresh-1')
        ->and(decrypt(session('identity.refresh_token')))->toBe('refresh-1');
});
```

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
vendor/bin/pest tests/Feature/Client/AuthFlowTest.php
```

Elvárt: FAIL — a controller osztályok nem léteznek.

- [ ] **Step 3: Hozd létre az `IdentitySession`-t**

`src/Client/IdentitySession.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

/**
 * Every session key the client mode touches lives here, so the token storage
 * format is decided in exactly one place.
 */
final class IdentitySession
{
    public const string STATE = 'identity.state';

    public const string CODE_VERIFIER = 'identity.code_verifier';

    public const string ACCESS_TOKEN = 'identity.access_token';

    public const string REFRESH_TOKEN = 'identity.refresh_token';

    public const string CHECKED_AT = 'identity.claims_checked_at';

    public const string GRACE_STARTED_AT = 'identity.grace_started_at';

    public const string INTENDED = 'identity.intended';

    /**
     * @param  array{access_token: string, refresh_token?: string, expires_in?: int}  $tokens
     */
    public static function putTokens(array $tokens): void
    {
        // Encrypted rather than plain: session payloads land in the database on
        // every receiver, and a refresh token is a long-lived credential.
        Session::put(self::ACCESS_TOKEN, Crypt::encryptString($tokens['access_token']));

        if (isset($tokens['refresh_token'])) {
            Session::put(self::REFRESH_TOKEN, Crypt::encryptString($tokens['refresh_token']));
        }
    }

    public static function accessToken(): ?string
    {
        return self::decrypt(self::ACCESS_TOKEN);
    }

    public static function refreshToken(): ?string
    {
        return self::decrypt(self::REFRESH_TOKEN);
    }

    public static function markChecked(): void
    {
        Session::put(self::CHECKED_AT, Carbon::now()->timestamp);
    }

    public static function checkedAt(): ?CarbonInterface
    {
        $timestamp = Session::get(self::CHECKED_AT);

        return is_int($timestamp) ? Carbon::createFromTimestamp($timestamp) : null;
    }

    public static function startGrace(): void
    {
        if (! Session::has(self::GRACE_STARTED_AT)) {
            Session::put(self::GRACE_STARTED_AT, Carbon::now()->timestamp);
        }
    }

    public static function graceStartedAt(): ?CarbonInterface
    {
        $timestamp = Session::get(self::GRACE_STARTED_AT);

        return is_int($timestamp) ? Carbon::createFromTimestamp($timestamp) : null;
    }

    public static function clearGrace(): void
    {
        Session::forget(self::GRACE_STARTED_AT);
    }

    public static function forgetHandshake(): void
    {
        Session::forget([self::STATE, self::CODE_VERIFIER]);
    }

    public static function forget(): void
    {
        Session::forget([
            self::STATE,
            self::CODE_VERIFIER,
            self::ACCESS_TOKEN,
            self::REFRESH_TOKEN,
            self::CHECKED_AT,
            self::GRACE_STARTED_AT,
        ]);
    }

    private static function decrypt(string $key): ?string
    {
        $value = Session::get($key);

        if (! is_string($value)) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable) {
            return null;
        }
    }
}
```

- [ ] **Step 4: Hozd létre a redirect controllert**

`src/Client/Http/Controllers/IdentityRedirectController.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Client\IdentityClient;
use Madbox99\UserTeamSync\Client\IdentitySession;

final class IdentityRedirectController
{
    public function __invoke(Request $request, IdentityClient $client): RedirectResponse
    {
        $state = Str::random(40);
        $verifier = Str::random(128);

        Session::put(IdentitySession::STATE, $state);
        Session::put(IdentitySession::CODE_VERIFIER, $verifier);

        if ($request->filled('intended')) {
            Session::put(IdentitySession::INTENDED, (string) $request->string('intended'));
        }

        $challenge = rtrim(strtr(base64_encode(hash('sha256', $verifier, true)), '+/', '-_'), '=');

        return redirect()->away($client->authorizeUrl($state, $challenge));
    }
}
```

- [ ] **Step 5: Hozd létre a callback controllert**

`src/Client/Http/Controllers/IdentityCallbackController.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Madbox99\UserTeamSync\Client\IdentityClient;
use Madbox99\UserTeamSync\Client\IdentityProvisioner;
use Madbox99\UserTeamSync\Client\IdentitySession;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final class IdentityCallbackController
{
    public function __invoke(
        Request $request,
        IdentityClient $client,
        IdentityProvisioner $provisioner,
    ): RedirectResponse|View {
        $expectedState = Session::get(IdentitySession::STATE);
        $verifier = Session::get(IdentitySession::CODE_VERIFIER);

        // A callback that does not match a handshake this session started is
        // either a forged login or a stale tab. Both get the same answer.
        if (! is_string($expectedState) || ! is_string($verifier)
            || ! hash_equals($expectedState, (string) $request->string('state'))
        ) {
            IdentitySession::forgetHandshake();

            throw new AccessDeniedHttpException('The login response did not match this session.');
        }

        $tokens = $client->exchangeCode((string) $request->string('code'), $verifier);
        $claims = $client->fetchClaims($tokens['access_token']);

        $this->assertAllowlisted((string) $claims['email']);

        $user = $provisioner->provision($claims);

        IdentitySession::forgetHandshake();

        /** @var array<int, string> $apps */
        $apps = $claims['apps'] ?? [];

        if (! in_array((string) config('user-team-sync.client.app_key'), $apps, true)) {
            // Authentication succeeded, entitlement did not. The account is
            // already provisioned, so buying the module is all that is left.
            return view('user-team-sync::identity.not-entitled', [
                'subscribeUrl' => (string) config('user-team-sync.client.subscribe_url'),
            ]);
        }

        Session::regenerate();

        Auth::login($user, remember: true);

        IdentitySession::putTokens($tokens);
        IdentitySession::markChecked();
        IdentitySession::clearGrace();

        $intended = Session::pull(IdentitySession::INTENDED);

        return redirect()->to(is_string($intended) && $intended !== '' ? $intended : '/');
    }

    private function assertAllowlisted(string $email): void
    {
        /** @var array<int, string> $allowlist */
        $allowlist = config('user-team-sync.client.allowlist', []);

        if ($allowlist === []) {
            return;
        }

        foreach ($allowlist as $allowed) {
            if (mb_strtolower($allowed) === mb_strtolower($email)) {
                return;
            }
        }

        IdentitySession::forgetHandshake();

        throw new AccessDeniedHttpException('This account is not part of the SSO pilot yet.');
    }
}
```

> **Sorrendi figyelmeztetés:** az allowlist-ellenőrzés a provisioning **előtt** fut, mert az „refuses a user who is not on the allowlist" teszt azt is állítja, hogy `User::count()` nulla marad. Ha átrendezed, az a teszt bukik — és joggal: egy pilotból kihagyott felhasználót nem szabad a pilot mellékhatásaként átírni.

- [ ] **Step 6: Írd vissza a route fájlt rendes importokra**

`routes/identity-client.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Madbox99\UserTeamSync\Client\Http\Controllers\IdentityCallbackController;
use Madbox99\UserTeamSync\Client\Http\Controllers\IdentityRedirectController;

Route::middleware('web')->group(function (): void {
    Route::get('/auth/redirect', IdentityRedirectController::class)->name('identity.redirect');
    Route::get('/auth/callback', IdentityCallbackController::class)->name('identity.callback');
});
```

- [ ] **Step 7: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Feature/Client/AuthFlowTest.php
```

Elvárt: PASS (10 teszt). Az `auth()->check()` a Task 1 Step 7-ben beállított `auth.providers.users.model` miatt működik.

- [ ] **Step 8: Futtasd a teljes csomag-tesztet és commitolj**

```bash
vendor/bin/pest && vendor/bin/pint
git add -A
git commit -m "feat: /auth/redirect and /auth/callback with PKCE, state, allowlist and entitlement"
```

---

### Task 6: `RevalidateIdentity` middleware

Ez teszi az egészet önjavítóvá: átnevezés, új tagság, megvont előfizetés 15 percen belül átér push nélkül.

**Files:**
- Create: `src/Client/Http/Middleware/RevalidateIdentity.php`
- Create: `tests/Feature/Client/RevalidateIdentityTest.php`

**Interfaces:**
- Consumes: Task 4 `IdentityClient`, Task 2–3 `IdentityProvisioner`, Task 5 `IdentitySession`
- Produces: `RevalidateIdentity` middleware osztály, panelbe köthető

- [ ] **Step 1: Írd meg a bukó teszteket**

`tests/Feature/Client/RevalidateIdentityTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Madbox99\UserTeamSync\Client\Http\Middleware\RevalidateIdentity;
use Madbox99\UserTeamSync\Client\IdentitySession;
use Madbox99\UserTeamSync\Tests\Fixtures\Team;
use Madbox99\UserTeamSync\Tests\Fixtures\User;

beforeEach(function (): void {
    $this->bootWithConfig(['user-team-sync.mode' => 'client']);

    // Defined after the reboot, or the fresh application would not have it.
    Route::middleware(['web', RevalidateIdentity::class])
        ->get('/protected', fn (): string => 'ok');

    $this->user = User::query()->create([
        'uuid' => '11111111-1111-4111-8111-111111111111',
        'name' => 'Anna Teszt',
        'email' => 'anna@example.test',
        'password' => '',
        'is_active' => true,
    ]);
});

function claimsResponse(array $overrides = []): array
{
    return array_merge([
        'sub' => '11111111-1111-4111-8111-111111111111',
        'email' => 'anna@example.test',
        'name' => 'Anna Teszt',
        'role' => 'manager',
        'orgs' => [['uuid' => '22222222-2222-4222-8222-222222222222', 'name' => 'Acme Kft.', 'slug' => 'acme-kft']],
        'apps' => ['crm'],
        'issued_at' => 1785832300,
        'claims_version' => 1,
    ], $overrides);
}

it('does nothing for a guest', function (): void {
    Http::fake();

    $this->get('/protected')->assertOk();

    Http::assertNothingSent();
});

it('does not call the identity provider while the check is still fresh', function (): void {
    Http::fake();

    $this->actingAs($this->user)
        ->withSession([IdentitySession::CHECKED_AT => Carbon::now()->timestamp])
        ->get('/protected')
        ->assertOk();

    Http::assertNothingSent();
});

it('re-runs the provisioner once the check is stale', function (): void {
    Http::fake(['identity.test/api/userinfo' => Http::response(claimsResponse())]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
        ])
        ->get('/protected')
        ->assertOk();

    expect(Team::query()->where('slug', 'acme-kft')->exists())->toBeTrue();
});

it('picks up a team rename without any push from the publisher', function (): void {
    // The behaviour the whole project is for.
    Team::query()->create([
        'uuid' => '22222222-2222-4222-8222-222222222222',
        'name' => 'Acme Kft.',
        'slug' => 'acme-kft',
    ]);

    Http::fake(['identity.test/api/userinfo' => Http::response(claimsResponse([
        'orgs' => [['uuid' => '22222222-2222-4222-8222-222222222222', 'name' => 'Acme Zrt.', 'slug' => 'acme-zrt']],
    ]))]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
        ])
        ->get('/protected')
        ->assertOk();

    expect(Team::query()->count())->toBe(1)
        ->and(Team::query()->first()->slug)->toBe('acme-zrt');
});

it('logs the user out when the identity provider rejects the token', function (): void {
    Http::fake(['identity.test/api/userinfo' => Http::response(['message' => 'Unauthenticated.'], 401)]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
        ])
        ->get('/protected')
        ->assertRedirect();

    expect(Auth::check())->toBeFalse();
});

it('keeps the session alive when the identity provider is down', function (): void {
    // An outage must not be read as revoked access — this is the single
    // decision that separates "SSO is a fix" from "SSO is a new outage source".
    Http::fake(['identity.test/api/userinfo' => Http::response('down', 503)]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
        ])
        ->get('/protected')
        ->assertOk();

    expect(Auth::check())->toBeTrue();
});

it('logs the user out once the grace period has run out', function (): void {
    Http::fake(['identity.test/api/userinfo' => Http::response('down', 503)]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
            IdentitySession::GRACE_STARTED_AT => Carbon::now()->subHours(25)->timestamp,
        ])
        ->get('/protected')
        ->assertRedirect();

    expect(Auth::check())->toBeFalse();
});

it('logs the user out when entitlement to this app disappears', function (): void {
    Http::fake(['identity.test/api/userinfo' => Http::response(claimsResponse(['apps' => ['mes']]))]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
        ])
        ->get('/protected')
        ->assertRedirect();

    expect(Auth::check())->toBeFalse();
});

it('refreshes an expired access token instead of logging the user out', function (): void {
    $calls = 0;

    Http::fake([
        'identity.test/api/userinfo' => function () use (&$calls) {
            $calls++;

            return $calls === 1
                ? Http::response(['message' => 'Unauthenticated.'], 401)
                : Http::response(claimsResponse());
        },
        'identity.test/oauth/token' => Http::response([
            'access_token' => 'access-2',
            'refresh_token' => 'refresh-2',
            'expires_in' => 31536000,
        ]),
    ]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
            IdentitySession::REFRESH_TOKEN => encrypt('refresh-1'),
        ])
        ->get('/protected')
        ->assertOk();

    expect(Auth::check())->toBeTrue();
});

it('clears the grace marker after a successful revalidation', function (): void {
    Http::fake(['identity.test/api/userinfo' => Http::response(claimsResponse())]);

    $this->actingAs($this->user)
        ->withSession([
            IdentitySession::CHECKED_AT => Carbon::now()->subMinutes(20)->timestamp,
            IdentitySession::ACCESS_TOKEN => encrypt('access-1'),
            IdentitySession::GRACE_STARTED_AT => Carbon::now()->subHours(2)->timestamp,
        ])
        ->get('/protected')
        ->assertOk();

    expect(session(IdentitySession::GRACE_STARTED_AT))->toBeNull();
});
```

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
vendor/bin/pest tests/Feature/Client/RevalidateIdentityTest.php
```

Elvárt: FAIL — a middleware nem létezik.

- [ ] **Step 3: Írd meg a middleware-t**

`src/Client/Http/Middleware/RevalidateIdentity.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\UserTeamSync\Client\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityConflictException;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityRejectedException;
use Madbox99\UserTeamSync\Client\Exceptions\IdentityUnavailableException;
use Madbox99\UserTeamSync\Client\IdentityClient;
use Madbox99\UserTeamSync\Client\IdentityProvisioner;
use Madbox99\UserTeamSync\Client\IdentitySession;
use Symfony\Component\HttpFoundation\Response;

/**
 * Re-fetches the claims and re-runs the provisioner when the session's last
 * check has gone stale. This is what makes the fleet self-healing: a rename, a
 * new membership or a cancelled subscription arrives without anyone pushing it.
 */
final class RevalidateIdentity
{
    public function __construct(
        private readonly IdentityClient $client,
        private readonly IdentityProvisioner $provisioner,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || $this->isFresh()) {
            return $next($request);
        }

        try {
            $claims = $this->fetchClaims();
        } catch (IdentityRejectedException) {
            // The provider answered, and the answer was no.
            return $this->logout($request);
        } catch (IdentityUnavailableException $exception) {
            return $this->tolerateOutage($request, $next, $exception);
        }

        /** @var array<int, string> $apps */
        $apps = $claims['apps'] ?? [];

        if (! in_array((string) config('user-team-sync.client.app_key'), $apps, true)) {
            return $this->logout($request);
        }

        try {
            $this->provisioner->provision($claims);
        } catch (IdentityConflictException $exception) {
            Log::warning('user-team-sync: identity conflict during revalidation.', [
                'message' => $exception->getMessage(),
            ]);

            return $this->logout($request);
        }

        IdentitySession::markChecked();
        IdentitySession::clearGrace();

        return $next($request);
    }

    /**
     * @return array<string, mixed>
     */
    private function fetchClaims(): array
    {
        $accessToken = IdentitySession::accessToken();

        if ($accessToken === null) {
            throw new IdentityRejectedException('No access token in the session.');
        }

        try {
            return $this->client->fetchClaims($accessToken);
        } catch (IdentityRejectedException $exception) {
            $refreshToken = IdentitySession::refreshToken();

            if ($refreshToken === null) {
                throw $exception;
            }

            // A 401 usually just means the access token aged out; only a
            // refresh that also fails proves the access was taken away.
            $tokens = $this->client->refresh($refreshToken);

            IdentitySession::putTokens($tokens);

            return $this->client->fetchClaims($tokens['access_token']);
        }
    }

    private function isFresh(): bool
    {
        $checkedAt = IdentitySession::checkedAt();

        if ($checkedAt === null) {
            return false;
        }

        $minutes = (int) config('user-team-sync.client.revalidate_after_minutes', 15);

        return $checkedAt->greaterThan(Carbon::now()->subMinutes($minutes));
    }

    private function tolerateOutage(Request $request, Closure $next, IdentityUnavailableException $exception): Response
    {
        IdentitySession::startGrace();

        $graceStartedAt = IdentitySession::graceStartedAt();
        $hours = (int) config('user-team-sync.client.grace_hours', 24);

        if ($graceStartedAt !== null && $graceStartedAt->lessThan(Carbon::now()->subHours($hours))) {
            Log::warning('user-team-sync: grace period expired while the identity provider was unreachable.');

            return $this->logout($request);
        }

        // The session carries on and the next request tries again.
        return $next($request);
    }

    private function logout(Request $request): Response
    {
        Auth::logout();

        IdentitySession::forget();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
```

- [ ] **Step 4: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Feature/Client/RevalidateIdentityTest.php
```

Elvárt: PASS (10 teszt).

- [ ] **Step 5: Bizonyítsd, hogy a legfontosabb teszt teherbíró**

Cseréld a `handle()`-ben az `IdentityUnavailableException` ágat `return $this->logout($request);`-re, és futtasd. Elvárt: a „keeps the session alive when the identity provider is down" **bukik**. Állítsd vissza.

- [ ] **Step 6: Futtasd a teljes csomag-tesztet és commitolj**

```bash
vendor/bin/pest && vendor/bin/pint
git add -A
git commit -m "feat: RevalidateIdentity middleware with grace window and refresh retry"
```

- [ ] **Step 7: Frissítsd a README-t és adj ki verziót**

A `README.md`-be vegyél fel egy `## Client mode (SSO)` szekciót, ami leírja a `mode => 'client'` beállítást, a `client` config kulcsokat és a két route-ot, plusz azt, hogy a `RevalidateIdentity`-t a fogadó appnak kell a panel `authMiddleware`-ébe tennie.

```bash
git add README.md
git commit -m "docs: client mode"
git tag v1.13.0
git push origin main --tags
```

---

### Task 7: A `crm` bekötése

**Files:**
- Modify: `/Users/szabozoltan/Herd/crm/composer.json` (`^1.13`)
- Modify: `/Users/szabozoltan/Herd/crm/config/user-team-sync.php`
- Modify: `/Users/szabozoltan/Herd/crm/app/Providers/Filament/AdminPanelServiceProvider.php`
- Modify: `/Users/szabozoltan/Herd/crm/app/Filament/Pages/Auth/Login.php`
- Create: `/Users/szabozoltan/Herd/crm/tests/Feature/Identity/CrmSsoWiringTest.php`

**Interfaces:**
- Consumes: Task 1–6 minden publikus felülete
- Produces: működő SSO belépés a crm-en

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/Identity/CrmSsoWiringTest.php`:

```php
<?php

declare(strict_types=1);

use App\Providers\Filament\AdminPanelServiceProvider;
use Filament\Facades\Filament;
use Madbox99\UserTeamSync\Client\Http\Middleware\RevalidateIdentity;

it('runs the identity revalidation on every authenticated panel request', function (): void {
    $panel = Filament::getPanel('admin');

    expect($panel->getAuthMiddleware())->toContain(RevalidateIdentity::class);
});

it('no longer offers tenant registration', function (): void {
    // Teams are created on the publisher and arrive in the claims. A team
    // created here would have no uuid and no counterpart anywhere else.
    expect(Filament::getPanel('admin')->getTenantRegistrationPage())->toBeNull();
});

it('maps the publisher role names onto the local ones', function (): void {
    // Verified on production: the publisher sends 'manager', this app's Spatie
    // role is 'Manager'. MySQL's collation hides the difference, SQLite (which
    // these tests run on) does not.
    expect(config('user-team-sync.client.role_map'))->toBe([
        'admin' => 'Admin',
        'manager' => 'Manager',
        'subscriber' => 'Subscriber',
    ]);
});

it('declares its own app key so the entitlement check can work', function (): void {
    expect(config('user-team-sync.client.app_key'))->toBe('crm');
});

it('keeps the legacy receiver mounted during the pilot', function (): void {
    expect(config('user-team-sync.client.legacy_receiver'))->toBeTrue();
});
```

- [ ] **Step 2: Futtasd, hogy lássd a bukást**

```bash
cd /Users/szabozoltan/Herd/crm
vendor/bin/pest tests/Feature/Identity/CrmSsoWiringTest.php
```

Elvárt: FAIL.

- [ ] **Step 3: Frissítsd a csomagot**

```bash
composer require madbox-99/laravel-user-team-sync:^1.13 --no-interaction
```

- [ ] **Step 4: Vedd fel a `client` szekciót a crm configjába**

`config/user-team-sync.php` — a `'mode'` értékét hagyd `receiver`-en (a `.env` állítja át), és a `'receiver'` szekció után szúrd be:

```php
    'client' => [
        'app_key' => env('IDENTITY_APP_KEY', 'crm'),
        'identity_url' => env('IDENTITY_URL', 'https://cegem360.eu'),
        'client_id' => env('IDENTITY_CLIENT_ID'),
        'client_secret' => env('IDENTITY_CLIENT_SECRET'),
        'redirect_uri' => env('IDENTITY_REDIRECT_URI', 'https://crm.cegem360.eu/auth/callback'),
        'scopes' => '',
        'http_timeout' => env('IDENTITY_HTTP_TIMEOUT', 10),
        'revalidate_after_minutes' => env('IDENTITY_REVALIDATE_MINUTES', 15),
        'grace_hours' => env('IDENTITY_GRACE_HOURS', 24),
        'allowlist' => array_values(array_filter(array_map(
            'trim',
            explode(',', (string) env('IDENTITY_SSO_ALLOWLIST', '')),
        ))),
        'legacy_receiver' => env('IDENTITY_LEGACY_RECEIVER', true),

        /*
        | The publisher's UserRole enum is lower-case; this app's Spatie roles
        | are capitalised. Production MySQL papers over that with a
        | case-insensitive collation, but nothing should depend on the
        | collation, so the mapping is explicit.
        */
        'role_map' => [
            'admin' => 'Admin',
            'manager' => 'Manager',
            'subscriber' => 'Subscriber',
        ],

        'subscribe_url' => env('IDENTITY_SUBSCRIBE_URL', 'https://cegem360.eu'),
    ],
```

- [ ] **Step 5: Kösd be a panelt**

`app/Providers/Filament/AdminPanelServiceProvider.php`:

Vedd fel az importot:

```php
use Madbox99\UserTeamSync\Client\Http\Middleware\RevalidateIdentity;
```

Töröld a `->tenantRegistration(RegisterTeam::class)` sort és a `use App\Filament\Pages\RegisterTeam;` importot.

Cseréld az `authMiddleware()` hívást:

```php
            ->authMiddleware([
                Authenticate::class,
                RevalidateIdentity::class,
                EnsureUserHasActiveSubscription::class,
            ])
```

> A sorrend számít: az `Authenticate` után kell futnia (guest esetén nincs mit revalidálni), és az `EnsureUserHasActiveSubscription` **előtt**, hogy egy frissen visszakapott előfizetés már ezen a kérésen érvényesüljön.

Az `app/Filament/Pages/RegisterTeam.php` fájlt **ne töröld** ebben a taskban — a fájl törlése külön commit, miután élesben igazoltuk, hogy semmi nem hivatkozik rá.

- [ ] **Step 6: Tedd ki az SSO gombot a login oldalra**

`app/Filament/Pages/Auth/Login.php` — vedd fel a metódust az osztály végére:

```php
    /**
     * During the pilot the password form stays for everyone who is not on the
     * SSO allowlist yet, so this is an extra way in, not a replacement.
     */
    public function ssoUrl(): string
    {
        return route('identity.redirect');
    }
```

A `resources/views/filament/pages/auth/login.blade.php` nézetbe, a form alá:

```blade
<div class="mt-6 border-t border-gray-200 pt-6 text-center dark:border-gray-700">
    <a
        href="{{ $this->ssoUrl() }}"
        class="fi-btn fi-btn-size-md inline-flex w-full items-center justify-center gap-1.5 rounded-lg bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-500"
    >
        {{ __('Sign in with your Cégem 360 account') }}
    </a>
</div>
```

- [ ] **Step 7: Futtasd a teszteket**

```bash
vendor/bin/pest tests/Feature/Identity/CrmSsoWiringTest.php
```

Elvárt: PASS (5 teszt).

> A „runs the identity revalidation" teszt csak akkor lát `client` módot, ha a teszt-környezet is annak látja. Ha bukik, vedd fel a `phpunit.xml`-be:
> ```xml
> <env name="USER_TEAM_SYNC_MODE" value="client"/>
> <env name="IDENTITY_CLIENT_ID" value="test-client-id"/>
> <env name="IDENTITY_CLIENT_SECRET" value="test-client-secret"/>
> ```

- [ ] **Step 8: Futtasd a crm TELJES tesztjét**

```bash
vendor/bin/pest
```

Elvárt: minden zöld. A `tenantRegistration` kivétele elronthat meglévő teszteket — ha egy teszt a csapat-regisztráló oldalt hívja, az a teszt is elavult, **de csak akkor töröld, ha meggyőződtél róla, hogy tényleg a kivezetett funkciót méri**.

- [ ] **Step 9: Commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: SSO kliens mód bekötése — revalidáció, szerepkör-leképezés, tenantRegistration kivezetése"
```

- [ ] **Step 10: Élesítés — a `.env` a Forge szerveren**

**Kézzel, interaktív SSH-n, nem a Forge parancsfuttatójával** (az naplózza a kimenetet, a secret pedig nem kerülhet naplóba).

```bash
ssh vps-cegem360-eu
# A crm client_id/secret a mentett fájlból:
grep -A3 '^crm' /home/forge/identity-clients-20260804.txt
```

Vedd fel a `/home/forge/crm.cegem360.eu/.env`-be:

```
USER_TEAM_SYNC_MODE=client
IDENTITY_APP_KEY=crm
IDENTITY_URL=https://cegem360.eu
IDENTITY_CLIENT_ID=<a fájlból>
IDENTITY_CLIENT_SECRET=<a fájlból>
IDENTITY_REDIRECT_URI=https://crm.cegem360.eu/auth/callback
IDENTITY_LEGACY_RECEIVER=true
IDENTITY_SSO_ALLOWLIST=info@cegem360.hu
IDENTITY_SUBSCRIBE_URL=https://cegem360.eu
```

> **Az allowlist egyetlen belsős címmel indul.** A spec figyelmeztetése itt válik konkréttá: a provisioner `sync()`-je a token szerinti állapotra állítja a tagságokat, tehát ha egy allowlistes felhasználó ma olyan crm-csapatban van, ami a subscriberben nincs nála, azt az első SSO belépés **leválasztja**. Ezért az első kör csak ellenőrizhető, belsős felhasználó lehet.

Deploy után:

```bash
cd /home/forge/crm.cegem360.eu/current
php artisan config:clear && php artisan config:cache
```

- [ ] **Step 11: Élesben mérd végig**

1. `https://crm.cegem360.eu/app` → a login oldalon ott a „Belépés Cégem 360 fiókkal" gomb.
2. A gomb → `cegem360.eu/oauth/authorize` → hozzájárulás nélkül vissza a callbackre.
3. Belépve a helyes tenant URL-en (`/app/<team-slug>`), a szerepkör `Manager` (nem `manager`).
4. Nevezd át a csapatot a publisheren, várj 15 percet (vagy állítsd ideiglenesen `IDENTITY_REVALIDATE_MINUTES=1`-re), tölts újra egy crm oldalt → a slug követte az átnevezést, a felhasználó bent maradt.
5. Egy allowliston kívüli felhasználó a jelszavas formon **továbbra is be tud lépni**.

Ellenőrizd a `users` és `teams` darabszámot előtte-utána: az SSO belépés **nem hozhat létre új sort** egy meglévő felhasználóra.

---

## Self-Review

**Spec-lefedettség.** A spec 3. fázisából megvalósul: `client` mód konfigurációval (Task 1), adoptáló `resolveTeam()` (Task 3), allowlist (Task 5), `/auth/redirect` + `/auth/callback` (Task 5), `IdentityProvisioner` (Task 2–3), revalidáció a teljes hibakezelési táblával (Task 6), `tenantRegistration` kivezetése (Task 7). A spec teszt-táblájának mind a 9 esete szerepel valamelyik taskban, kivéve a „Backfill" sort, ami az 1. fázisban már elkészült.

**Tudatosan kimarad:** `POST /api/revoke` (D-2), a legacy végpontok törlése (D-3), a `->login()` eltávolítása (D-4), a `SyncPasswordJob` törlése (az 5. fázis). A `sessions` tábla `user_id` indexe és a `SESSION_DRIVER` már megvan a crm-en (VF-5), így nincs infrastruktúra-lépés.

**Nyitott kérdés a 4. fázishoz, nem ide:** az `anest` és a `pirometer` még v1.9.0/v1.8.0-n van, tehát nincs uuid-juk. Amíg fel nem mennek, SSO-ra nem állíthatók.
