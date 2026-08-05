# Filament Data Portability Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Egy `madbox-99/filament-data-portability` Composer-csomag, amivel a receiver appok ügyfelei a Filament paneljükből letölthetik a teljes, csapatra szűrt adatállományukat egy JSONL + CSV + manifest ZIP-ben.

**Architecture:** A csomag egyetlen queued job-bal dolgozik. A job a containerbe köti az aktuális `Team`-et, amitől az appban már meglévő `TeamScope` globális scope minden regisztrált modellen magától szűr. A csomag semmilyen `App\` osztályt nem ismer — a tenant modell, a container-binding neve és a jogosultsági szabály configból jön. A modelleket appnként egy explicit regiszter sorolja fel.

**Tech Stack:** PHP 8.3+, Laravel 13, Filament v5, Pest v4, Orchestra Testbench, ZipArchive.

**Spec:** `docs/superpowers/specs/2026-08-05-filament-data-portability-design.md`

## Global Constraints

- Csomagnév: `madbox-99/filament-data-portability`. Namespace: `Madbox99\DataPortability\` (src), `Madbox99\DataPortability\Tests\` (tests).
- Repó helye: `~/Herd/filament-data-portability` (új git repó, a `~/Herd/laravel-user-team-sync` konvencióit követi).
- Composer constraint: `"php": "^8.3"`, `"laravel/framework": "^13.0"`, `"filament/filament": "^5.0"`.
- Minden PHP fájl első sora után `declare(strict_types=1);`. Osztályok `final`, ahol nem kell öröklés.
- A csomag **soha nem hivatkozhat `App\` névtérre** — ezt a 13. feladat architektúra-tesztje kényszeríti ki.
- A ZIP-be kerülő `README.md` **angol nyelvű**. A panel UI és a regiszter címkéi magyarok.
- Retenció: 7 nap (`retention_days`). Fájllimit: 2 GiB (`file_limit`). Napi limit: 3 (`daily_limit`).
- Minden feladat végén `vendor/bin/pint` fut, és a commit csak zöld teszt után születik.
- Commit üzenetek magyarul, Conventional Commits prefixszel (`feat:`, `test:`, `fix:`, `docs:`).

---

### Task 1: Csomag-váz, config és service provider

**Files:**
- Create: `composer.json`, `pint.json`, `phpunit.xml`, `.gitignore`, `LICENSE`
- Create: `config/data-portability.php`
- Create: `src/DataPortabilityServiceProvider.php`
- Test: `tests/TestCase.php`, `tests/Pest.php`, `tests/Feature/ServiceProviderTest.php`

**Interfaces:**
- Consumes: semmit (ez az első feladat).
- Produces: `Madbox99\DataPortability\DataPortabilityServiceProvider`; a `data-portability.*` config-kulcsok; a `data-exports` filesystem disk futásidejű regisztrációja; `Madbox99\DataPortability\Tests\TestCase` a további tesztekhez.

- [ ] **Step 1: Repó és váz létrehozása**

```bash
mkdir -p ~/Herd/filament-data-portability && cd ~/Herd/filament-data-portability
git init
mkdir -p src config database/migrations routes tests/Feature tests/Unit tests/Fixtures
```

- [ ] **Step 2: `composer.json`**

```json
{
    "name": "madbox-99/filament-data-portability",
    "description": "Team-scoped data portability exports for Filament panels",
    "type": "library",
    "keywords": ["laravel", "filament", "export", "gdpr", "data-portability", "multi-tenant"],
    "license": "MIT",
    "authors": [
        { "name": "Zoltán Tamás Szabó", "email": "zoli.szabok@gmail.com" }
    ],
    "require": {
        "php": "^8.3",
        "laravel/framework": "^13.0",
        "filament/filament": "^5.0",
        "ext-zip": "*"
    },
    "require-dev": {
        "orchestra/testbench": "^11.0",
        "pestphp/pest": "^4.0",
        "laravel/pint": "^1.0"
    },
    "autoload": {
        "psr-4": { "Madbox99\\DataPortability\\": "src/" }
    },
    "autoload-dev": {
        "psr-4": { "Madbox99\\DataPortability\\Tests\\": "tests/" }
    },
    "extra": {
        "laravel": {
            "providers": ["Madbox99\\DataPortability\\DataPortabilityServiceProvider"],
            "aliases": { "DataPortability": "Madbox99\\DataPortability\\Facades\\DataPortability" }
        }
    },
    "scripts": { "test": "pest", "lint": "pint" },
    "minimum-stability": "stable",
    "config": { "allow-plugins": { "pestphp/pest-plugin": true } }
}
```

Futtasd: `composer install`

- [ ] **Step 3: `pint.json` és `phpunit.xml`**

`pint.json`:

```json
{
    "preset": "laravel",
    "rules": {
        "declare_strict_types": true,
        "final_class": false,
        "ordered_imports": { "sort_algorithm": "alpha" }
    }
}
```

`phpunit.xml`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true">
    <testsuites>
        <testsuite name="Unit"><directory>tests/Unit</directory></testsuite>
        <testsuite name="Feature"><directory>tests/Feature</directory></testsuite>
    </testsuites>
    <source><include><directory>src</directory></include></source>
    <php>
        <env name="APP_KEY" value="base64:dGVzdGtleXRlc3RrZXl0ZXN0a2V5dGVzdGtleTE="/>
        <env name="DB_CONNECTION" value="testing"/>
    </php>
</phpunit>
```

`.gitignore`:

```
/vendor
/.phpunit.cache
composer.lock
.DS_Store
```

- [ ] **Step 4: `config/data-portability.php`**

```php
<?php

declare(strict_types=1);

return [
    // Az app tenant modellje, pl. App\Models\Team::class. Kötelező kitölteni.
    'tenant_model' => null,

    // A container-binding neve, amin a TeamScope figyel. A crm-ben 'current_team'.
    'tenant_binding' => 'current_team',

    // A kész ZIP-ek disk-je. A service provider regisztrálja, ha még nem létezik.
    'disk' => 'data-exports',

    // A feltöltött fájlok forrás-disk-je. null => config('filament.default_filesystem_disk').
    'source_disk' => null,

    'temp_path' => storage_path('app/private/data-portability-tmp'),

    'queue' => 'exports',

    'retention_days' => 7,

    'file_limit' => 2 * 1024 * 1024 * 1024,

    'daily_limit' => 3,

    'column_denylist' => [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ],

    'column_denylist_patterns' => [
        '/_secret$/',
        '/_token$/',
    ],

    // fn (Illuminate\Contracts\Auth\Authenticatable $user, Illuminate\Database\Eloquent\Model $team): bool
    'authorize' => null,

    'route_middleware' => ['web', 'auth'],

    'navigation_group' => null,
];
```

- [ ] **Step 5: `src/DataPortabilityServiceProvider.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

use Illuminate\Support\ServiceProvider;

final class DataPortabilityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/data-portability.php', 'data-portability');

        $this->registerExportDisk();
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/data-portability.php' => config_path('data-portability.php'),
        ], 'data-portability-config');
    }

    private function registerExportDisk(): void
    {
        $disk = (string) config('data-portability.disk');

        if (config("filesystems.disks.{$disk}") !== null) {
            return;
        }

        config()->set("filesystems.disks.{$disk}", [
            'driver' => 'local',
            'root' => storage_path('app/private/'.$disk),
            'serve' => false,
            'throw' => false,
        ]);
    }
}
```

Megjegyzés: a disk futásidejű regisztrációja szándékos — a `crm`-ben **nincs** `config/filesystems.php`, így a csomag nem építhet arra, hogy az app publikálta.

- [ ] **Step 6: `tests/TestCase.php` és `tests/Pest.php`**

`tests/TestCase.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Tests;

use Madbox99\DataPortability\DataPortabilityServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [DataPortabilityServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }
}
```

`tests/Pest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');
```

- [ ] **Step 7: Írd meg a bukó tesztet**

`tests/Feature/ServiceProviderTest.php`:

```php
<?php

declare(strict_types=1);

it('merges the package configuration', function (): void {
    expect(config('data-portability.tenant_binding'))->toBe('current_team')
        ->and(config('data-portability.retention_days'))->toBe(7)
        ->and(config('data-portability.daily_limit'))->toBe(3);
});

it('registers a private local disk for exports when the app has not defined one', function (): void {
    $disk = config('filesystems.disks.data-exports');

    expect($disk)->toBeArray()
        ->and($disk['driver'])->toBe('local')
        ->and($disk['serve'])->toBeFalse()
        ->and($disk['root'])->toContain('app/private/data-exports');
});
```

- [ ] **Step 8: Futtasd a tesztet**

Run: `vendor/bin/pest tests/Feature/ServiceProviderTest.php`
Expected: PASS (2 tests)

- [ ] **Step 9: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: csomag-váz, config és service provider"
```

---

### Task 2: `Exportable` definíció és `ExportRegistry`

**Files:**
- Create: `src/Exportable.php`, `src/ExportRegistry.php`, `src/Facades/DataPortability.php`
- Modify: `src/DataPortabilityServiceProvider.php` (registry singleton)
- Test: `tests/Unit/ExportableTest.php`, `tests/Unit/ExportRegistryTest.php`, `tests/Fixtures/` (modellek + migráció)

**Interfaces:**
- Consumes: `DataPortabilityServiceProvider` (1. feladat).
- Produces:
  - `Exportable::model(string $model): self`, `->label(string): self`, `->except(array): self`, `->files(Closure): self`, `->through(string $relation): self`, `->teamVia(Closure): self`
  - `Exportable::key(): string` (tábla neve), `->modelClass(): string`, `->labelText(): string`, `->columns(): array<string>`, `->newQuery(): Builder`, `->resolveTeamId(Model): int|string|null`, `->resolveFiles(Model): array<string>`
  - `ExportRegistry::register(Exportable ...$e): void`, `->all(): array<string, Exportable>`, `->isEmpty(): bool`
  - Facade: `DataPortability::register(...)`, `DataPortability::all()`

- [ ] **Step 1: Teszt-fixture modellek**

`tests/Fixtures/Models/Team.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;

final class Team extends Model
{
    protected $table = 'teams';

    protected $guarded = [];
}
```

`tests/Fixtures/Models/Customer.php` — ez hordozza a fixture `TeamScope`-ot, ami az appok viselkedését utánozza:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Madbox99\DataPortability\Tests\Fixtures\TeamScope;

final class Customer extends Model
{
    protected $table = 'customers';

    protected $guarded = [];

    protected $hidden = ['api_token'];

    protected static function booted(): void
    {
        static::addGlobalScope(new TeamScope);
    }
}
```

`tests/Fixtures/Models/CustomerAddress.php` — szándékosan **nincs** rajta scope:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';

    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
```

`tests/Fixtures/TeamScope.php` — a `crm` `TeamScope`-jának pontos mása:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Tests\Fixtures;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class TeamScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $binding = (string) config('data-portability.tenant_binding');

        $team = app()->bound($binding) ? resolve($binding) : null;

        if ($team instanceof Model) {
            $builder->where($model->qualifyColumn('team_id'), $team->getKey());
        }
    }
}
```

- [ ] **Step 2: Fixture séma a `TestCase`-be**

Bővítsd a `tests/TestCase.php`-t ezzel a metódussal, és hívd meg a `setUp()`-ban `parent::setUp()` után:

```php
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpFixtureSchema();

        config()->set('data-portability.tenant_model', \Madbox99\DataPortability\Tests\Fixtures\Models\Team::class);
    }

    protected function setUpFixtureSchema(): void
    {
        \Illuminate\Support\Facades\Schema::create('teams', function (\Illuminate\Database\Schema\Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Schema::create('customers', function (\Illuminate\Database\Schema\Blueprint $table): void {
            $table->id();
            $table->foreignId('team_id')->constrained('teams');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('api_token')->nullable();
            $table->string('vat_secret')->nullable();
            $table->string('logo_path')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Schema::create('customer_addresses', function (\Illuminate\Database\Schema\Blueprint $table): void {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('city');
            $table->timestamps();
        });
    }
```

- [ ] **Step 3: Írd meg a bukó teszteket**

`tests/Unit/ExportableTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\Tests\Fixtures\Models\Customer;
use Madbox99\DataPortability\Tests\Fixtures\Models\CustomerAddress;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;

it('derives the key from the model table and defaults the label to the class basename', function (): void {
    $exportable = Exportable::model(Customer::class);

    expect($exportable->key())->toBe('customers')
        ->and($exportable->labelText())->toBe('Customer');
});

it('exports every column except hidden, denylisted and explicitly excluded ones', function (): void {
    $columns = Exportable::model(Customer::class)->except(['meta'])->columns();

    expect($columns)->toContain('id', 'team_id', 'name', 'email', 'logo_path')
        ->and($columns)->not->toContain('api_token')   // $hidden
        ->and($columns)->not->toContain('vat_secret')  // denylist pattern /_secret$/
        ->and($columns)->not->toContain('meta');       // except()
});

it('resolves the team id from the team_id column by default', function (): void {
    $team = Team::create(['name' => 'A']);
    $customer = Customer::withoutGlobalScopes()->create(['team_id' => $team->id, 'name' => 'Ügyfél']);

    expect(Exportable::model(Customer::class)->resolveTeamId($customer))->toBe($team->id);
});

it('resolves the team id through a relation when through() is declared', function (): void {
    $team = Team::create(['name' => 'A']);
    $customer = Customer::withoutGlobalScopes()->create(['team_id' => $team->id, 'name' => 'Ügyfél']);
    $address = CustomerAddress::create(['customer_id' => $customer->id, 'city' => 'Budapest']);

    $exportable = Exportable::model(CustomerAddress::class)->through('customer');

    expect($exportable->resolveTeamId($address->fresh()))->toBe($team->id);
});

it('constrains the query with whereHas when through() is declared', function (): void {
    $sql = Exportable::model(CustomerAddress::class)->through('customer')->newQuery()->toSql();

    expect($sql)->toContain('exists')->and($sql)->toContain('customers');
});

it('returns the declared file paths for a row', function (): void {
    $team = Team::create(['name' => 'A']);
    $customer = Customer::withoutGlobalScopes()->create([
        'team_id' => $team->id, 'name' => 'Ügyfél', 'logo_path' => 'logos/a.png',
    ]);

    $exportable = Exportable::model(Customer::class)
        ->files(fn (Customer $c): array => array_filter([$c->logo_path]));

    expect($exportable->resolveFiles($customer))->toBe(['logos/a.png']);
});

it('returns an empty file list when no files callback is declared', function (): void {
    $team = Team::create(['name' => 'A']);
    $customer = Customer::withoutGlobalScopes()->create(['team_id' => $team->id, 'name' => 'Ügyfél']);

    expect(Exportable::model(Customer::class)->resolveFiles($customer))->toBe([]);
});
```

`tests/Unit/ExportRegistryTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\ExportRegistry;
use Madbox99\DataPortability\Facades\DataPortability;
use Madbox99\DataPortability\Tests\Fixtures\Models\Customer;
use Madbox99\DataPortability\Tests\Fixtures\Models\CustomerAddress;

it('starts empty', function (): void {
    expect(app(ExportRegistry::class)->isEmpty())->toBeTrue();
});

it('registers exportables keyed by table name through the facade', function (): void {
    DataPortability::register(
        Exportable::model(Customer::class)->label('Ügyfelek'),
        Exportable::model(CustomerAddress::class)->label('Címek')->through('customer'),
    );

    expect(array_keys(DataPortability::all()))->toBe(['customers', 'customer_addresses'])
        ->and(DataPortability::all()['customers']->labelText())->toBe('Ügyfelek');
});

it('keeps a single registry instance across resolutions', function (): void {
    DataPortability::register(Exportable::model(Customer::class));

    expect(app(ExportRegistry::class)->all())->toHaveCount(1);
});
```

- [ ] **Step 4: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Unit`
Expected: FAIL — `Class "Madbox99\DataPortability\Exportable" not found`

- [ ] **Step 5: `src/Exportable.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

final class Exportable
{
    private string $label;

    /** @var array<int, string> */
    private array $except = [];

    private ?Closure $filesResolver = null;

    private ?Closure $teamResolver = null;

    private ?string $throughRelation = null;

    /** @param class-string<Model> $model */
    private function __construct(private readonly string $model)
    {
        $this->label = class_basename($model);
    }

    /** @param class-string<Model> $model */
    public static function model(string $model): self
    {
        return new self($model);
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /** @param array<int, string> $columns */
    public function except(array $columns): self
    {
        $this->except = $columns;

        return $this;
    }

    public function files(Closure $resolver): self
    {
        $this->filesResolver = $resolver;

        return $this;
    }

    public function teamVia(Closure $resolver): self
    {
        $this->teamResolver = $resolver;

        return $this;
    }

    /**
     * A szülőn keresztüli csapat-hovatartozás. Egyszerre szűkíti a lekérdezést
     * (whereHas — a szülő TeamScope-ja ezen belül érvényesül) és adja meg a
     * soronkénti team-feloldót.
     */
    public function through(string $relation): self
    {
        $this->throughRelation = $relation;

        return $this;
    }

    /** @return class-string<Model> */
    public function modelClass(): string
    {
        return $this->model;
    }

    public function labelText(): string
    {
        return $this->label;
    }

    public function key(): string
    {
        return $this->newModel()->getTable();
    }

    /** @return array<int, string> */
    public function columns(): array
    {
        $model = $this->newModel();

        $columns = Schema::connection($model->getConnectionName())
            ->getColumnListing($model->getTable());

        $denied = array_merge(
            (array) config('data-portability.column_denylist', []),
            $model->getHidden(),
            $this->except,
        );

        $patterns = (array) config('data-portability.column_denylist_patterns', []);

        return array_values(array_filter(
            $columns,
            static function (string $column) use ($denied, $patterns): bool {
                if (in_array($column, $denied, true)) {
                    return false;
                }

                foreach ($patterns as $pattern) {
                    if (Str::isMatch($pattern, $column)) {
                        return false;
                    }
                }

                return true;
            },
        ));
    }

    /** @return Builder<Model> */
    public function newQuery(): Builder
    {
        $query = $this->newModel()->newQuery();

        if ($this->throughRelation !== null) {
            $query->whereHas($this->throughRelation)->with($this->throughRelation);
        }

        return $query;
    }

    public function resolveTeamId(Model $row): int|string|null
    {
        if ($this->teamResolver instanceof Closure) {
            return ($this->teamResolver)($row);
        }

        if ($this->throughRelation !== null) {
            $parent = $row->getRelationValue($this->throughRelation);

            return $parent instanceof Model ? $parent->getAttribute('team_id') : null;
        }

        return $row->getAttribute('team_id');
    }

    /** @return array<int, string> */
    public function resolveFiles(Model $row): array
    {
        if (! $this->filesResolver instanceof Closure) {
            return [];
        }

        return array_values(array_filter(
            (array) ($this->filesResolver)($row),
            static fn (mixed $path): bool => is_string($path) && $path !== '',
        ));
    }

    private function newModel(): Model
    {
        return new ($this->model)();
    }
}
```

- [ ] **Step 6: `src/ExportRegistry.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

final class ExportRegistry
{
    /** @var array<string, Exportable> */
    private array $exportables = [];

    public function register(Exportable ...$exportables): void
    {
        foreach ($exportables as $exportable) {
            $this->exportables[$exportable->key()] = $exportable;
        }
    }

    /** @return array<string, Exportable> */
    public function all(): array
    {
        return $this->exportables;
    }

    public function isEmpty(): bool
    {
        return $this->exportables === [];
    }
}
```

- [ ] **Step 7: `src/Facades/DataPortability.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Facades;

use Illuminate\Support\Facades\Facade;
use Madbox99\DataPortability\ExportRegistry;

/**
 * @method static void register(\Madbox99\DataPortability\Exportable ...$exportables)
 * @method static array<string, \Madbox99\DataPortability\Exportable> all()
 * @method static bool isEmpty()
 *
 * @see ExportRegistry
 */
final class DataPortability extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ExportRegistry::class;
    }
}
```

- [ ] **Step 8: Registry singleton a providerbe**

A `src/DataPortabilityServiceProvider.php` `register()` metódusába, a `mergeConfigFrom` után:

```php
        $this->app->singleton(ExportRegistry::class);
```

és fent `use Madbox99\DataPortability\ExportRegistry;` (azonos névtér, így elhagyható — akkor csak `ExportRegistry::class`).

- [ ] **Step 9: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Unit`
Expected: PASS (10 tests)

- [ ] **Step 10: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: Exportable definíció és ExportRegistry"
```

---

### Task 3: `DataExport` modell, migráció, `ExportStatus` enum

**Files:**
- Create: `src/Enums/ExportStatus.php`, `src/Models/DataExport.php`, `database/migrations/2026_08_05_000000_create_data_exports_table.php`
- Modify: `src/DataPortabilityServiceProvider.php` (`loadMigrationsFrom`)
- Test: `tests/Feature/DataExportModelTest.php`

**Interfaces:**
- Consumes: `DataPortabilityServiceProvider` (1. feladat).
- Produces: `DataExport` a `team_id`, `user_id`, `status`, `path`, `size_bytes`, `row_counts`, `error`, `started_at`, `completed_at`, `expires_at`, `downloaded_at`, `download_count` mezőkkel; `DataExport::isDownloadable(): bool`; `ExportStatus::{Pending,Running,Completed,Failed}`.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/DataExportModelTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Models\DataExport;

it('creates a pending export with a uuid', function (): void {
    $export = DataExport::create(['team_id' => 1, 'user_id' => 2]);

    expect($export->status)->toBe(ExportStatus::Pending)
        ->and($export->uuid)->not->toBeNull()
        ->and($export->download_count)->toBe(0);
});

it('casts row counts to an array and timestamps to dates', function (): void {
    $export = DataExport::create([
        'team_id' => 1,
        'user_id' => 2,
        'row_counts' => ['customers' => 3],
        'completed_at' => now(),
    ]);

    expect($export->fresh()->row_counts)->toBe(['customers' => 3])
        ->and($export->fresh()->completed_at)->toBeInstanceOf(Illuminate\Support\Carbon::class);
});

it('is downloadable only when completed, unexpired and backed by a file', function (): void {
    $base = ['team_id' => 1, 'user_id' => 2, 'path' => 'team/a.zip', 'expires_at' => now()->addDay()];

    expect(DataExport::create($base + ['status' => ExportStatus::Completed])->isDownloadable())->toBeTrue()
        ->and(DataExport::create($base + ['status' => ExportStatus::Running])->isDownloadable())->toBeFalse()
        ->and(DataExport::create($base + ['status' => ExportStatus::Failed])->isDownloadable())->toBeFalse();
});

it('is not downloadable once expired', function (): void {
    $export = DataExport::create([
        'team_id' => 1, 'user_id' => 2, 'path' => 'team/a.zip',
        'status' => ExportStatus::Completed, 'expires_at' => now()->subMinute(),
    ]);

    expect($export->isDownloadable())->toBeFalse();
});

it('is not downloadable without a stored path', function (): void {
    $export = DataExport::create([
        'team_id' => 1, 'user_id' => 2,
        'status' => ExportStatus::Completed, 'expires_at' => now()->addDay(),
    ]);

    expect($export->isDownloadable())->toBeFalse();
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/DataExportModelTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Models\DataExport" not found`

- [ ] **Step 3: `src/Enums/ExportStatus.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Enums;

enum ExportStatus: string
{
    case Pending = 'pending';
    case Running = 'running';
    case Completed = 'completed';
    case Failed = 'failed';
}
```

- [ ] **Step 4: Migráció**

`database/migrations/2026_08_05_000000_create_data_exports_table.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_exports', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('team_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('status')->default('pending')->index();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();
            $table->json('row_counts')->nullable();
            $table->text('error')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamp('downloaded_at')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_exports');
    }
};
```

- [ ] **Step 5: `src/Models/DataExport.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Madbox99\DataPortability\Enums\ExportStatus;

final class DataExport extends Model
{
    use HasUuids;

    protected $table = 'data_exports';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected function casts(): array
    {
        return [
            'status' => ExportStatus::class,
            'row_counts' => 'array',
            'size_bytes' => 'integer',
            'download_count' => 'integer',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'expires_at' => 'datetime',
            'downloaded_at' => 'datetime',
        ];
    }

    public function isDownloadable(): bool
    {
        return $this->status === ExportStatus::Completed
            && $this->path !== null
            && $this->expires_at !== null
            && $this->expires_at->isFuture();
    }
}
```

Figyelem: a `HasUuids` alapból a primary key-t generálná. A `uniqueIds()` felülírása miatt csak az `uuid` oszlopot tölti, az `id` marad auto-increment.

- [ ] **Step 6: Migrációk betöltése a providerben**

A `boot()` metódus elejére:

```php
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
```

- [ ] **Step 7: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/DataExportModelTest.php`
Expected: PASS (5 tests)

- [ ] **Step 8: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: DataExport modell, migráció és státusz enum"
```

---

### Task 4: `TenantContext` — a container-binding és az 1. őr

**Files:**
- Create: `src/TenantContext.php`, `src/Exceptions/TenantNotBound.php`
- Test: `tests/Feature/TenantContextTest.php`

**Interfaces:**
- Consumes: `data-portability.tenant_model`, `data-portability.tenant_binding` (1. feladat).
- Produces: `TenantContext::resolveTeam(int|string $teamId): Model`, `->bind(Model $team): void`, `->assertBound(int|string $teamId): void`, `->binding(): string`; `TenantNotBound` kivétel.

- [ ] **Step 1: Írd meg a bukó tesztet — benne a mutációval igazolt őr-teszt**

`tests/Feature/TenantContextTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Exceptions\TenantNotBound;
use Madbox99\DataPortability\TenantContext;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;

it('resolves the tenant model configured by the application', function (): void {
    $team = Team::create(['name' => 'A']);

    expect(app(TenantContext::class)->resolveTeam($team->id)->is($team))->toBeTrue();
});

it('binds the team into the container under the configured binding', function (): void {
    $team = Team::create(['name' => 'A']);

    app(TenantContext::class)->bind($team);

    expect(app()->bound('current_team'))->toBeTrue()
        ->and(resolve('current_team')->is($team))->toBeTrue();
});

/**
 * 1. ŐR — mutációval igazolva: ha a bind() elmarad, ennek a tesztnek buknia kell.
 * Ez az a hiba, amitől a TeamScope némán kikapcsol és minden csapat adata kimenne.
 */
it('refuses to proceed when nothing is bound', function (): void {
    $team = Team::create(['name' => 'A']);

    app()->forgetInstance('current_team');

    app(TenantContext::class)->assertBound($team->id);
})->throws(TenantNotBound::class);

it('refuses to proceed when a different team is bound', function (): void {
    $teamA = Team::create(['name' => 'A']);
    $teamB = Team::create(['name' => 'B']);

    app(TenantContext::class)->bind($teamB);

    app(TenantContext::class)->assertBound($teamA->id);
})->throws(TenantNotBound::class);

it('refuses to proceed when the binding holds something that is not a model', function (): void {
    app()->instance('current_team', 'nem modell');

    app(TenantContext::class)->assertBound(1);
})->throws(TenantNotBound::class);

it('fails loudly when the application has not configured a tenant model', function (): void {
    config()->set('data-portability.tenant_model', null);

    app(TenantContext::class)->resolveTeam(1);
})->throws(TenantNotBound::class);
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/TenantContextTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\TenantContext" not found`

- [ ] **Step 3: `src/Exceptions/TenantNotBound.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Exceptions;

use RuntimeException;

final class TenantNotBound extends RuntimeException
{
    public static function missing(string $binding): self
    {
        return new self("A(z) [{$binding}] container-binding nincs beállítva, ezért a csapat-szűrés nem érvényesülne.");
    }

    public static function mismatch(string $binding): self
    {
        return new self("A(z) [{$binding}] container-binding nem az exportált csapatot tartalmazza.");
    }

    public static function noTenantModel(): self
    {
        return new self('A data-portability.tenant_model nincs beállítva.');
    }
}
```

- [ ] **Step 4: `src/TenantContext.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

use Illuminate\Database\Eloquent\Model;
use Madbox99\DataPortability\Exceptions\TenantNotBound;

final class TenantContext
{
    public function binding(): string
    {
        return (string) config('data-portability.tenant_binding');
    }

    public function resolveTeam(int|string $teamId): Model
    {
        $class = config('data-portability.tenant_model');

        if (! is_string($class) || ! class_exists($class)) {
            throw TenantNotBound::noTenantModel();
        }

        /** @var Model $model */
        $model = new $class();

        return $model->newQuery()->findOrFail($teamId);
    }

    public function bind(Model $team): void
    {
        app()->instance($this->binding(), $team);

        $this->assertBound($team->getKey());
    }

    public function assertBound(int|string $teamId): void
    {
        $binding = $this->binding();

        if (! app()->bound($binding)) {
            throw TenantNotBound::missing($binding);
        }

        $bound = resolve($binding);

        if (! $bound instanceof Model || (string) $bound->getKey() !== (string) $teamId) {
            throw TenantNotBound::mismatch($binding);
        }
    }
}
```

- [ ] **Step 5: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/TenantContextTest.php`
Expected: PASS (6 tests)

- [ ] **Step 6: Bizonyítsd az őrt mutációval**

Kommenteld ki ideiglenesen az `assertBound()` hívást a `bind()`-ban, majd:

Run: `vendor/bin/pest tests/Feature/TenantContextTest.php`
Expected: FAIL — a „refuses to proceed when a different team is bound" bukik.
Ezután **állítsd vissza** a sort, és futtasd újra: PASS.

- [ ] **Step 7: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: TenantContext és az első tenant-őr"
```

---

### Task 5: `TableWriter` — JSONL + CSV streamelés és a 2. őr

**Files:**
- Create: `src/Writers/TableWriter.php`, `src/Writers/TableResult.php`, `src/Exceptions/TenantLeakDetected.php`
- Test: `tests/Feature/TableWriterTest.php`

**Interfaces:**
- Consumes: `Exportable` (2. feladat).
- Produces: `TableWriter::__construct(string $baseDir, Exportable $exportable, int|string $teamId)`, `->write(?Closure $onRow = null): TableResult`; `TableResult::__construct(public readonly string $key, public readonly int $rows, public readonly array $columns)`; `TenantLeakDetected::forRow(string $table, int|string|null $key, int|string|null $foundTeamId)` kivétel.
  A `$onRow` closure szignatúrája: `fn (Illuminate\Database\Eloquent\Model $row): void`.
  Kiírt fájlok: `{$baseDir}/data/{$key}.jsonl` és `{$baseDir}/csv/{$key}.csv`.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/TableWriterTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Exceptions\TenantLeakDetected;
use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\Tests\Fixtures\Models\Customer;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;
use Madbox99\DataPortability\Writers\TableWriter;

beforeEach(function (): void {
    $this->baseDir = sys_get_temp_dir().'/dp-'.bin2hex(random_bytes(6));
    mkdir($this->baseDir.'/data', 0755, true);
    mkdir($this->baseDir.'/csv', 0755, true);
});

afterEach(function (): void {
    exec('rm -rf '.escapeshellarg($this->baseDir));
});

it('writes one jsonl line and one csv row per record, with a schema-derived header', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    Customer::create(['name' => 'Első', 'email' => 'a@example.com', 'api_token' => 'titok']);
    Customer::create(['name' => 'Második', 'email' => 'b@example.com']);

    $exportable = Exportable::model(Customer::class);
    $result = (new TableWriter($this->baseDir, $exportable, $team->id))->write();

    $jsonl = file($this->baseDir.'/data/customers.jsonl', FILE_IGNORE_NEW_LINES);
    $csv = file($this->baseDir.'/csv/customers.csv', FILE_IGNORE_NEW_LINES);

    expect($result->rows)->toBe(2)
        ->and($jsonl)->toHaveCount(2)
        ->and($csv)->toHaveCount(3) // fejléc + 2 sor
        ->and(json_decode($jsonl[0], true)['name'])->toBe('Első')
        ->and($csv[0])->toStartWith('id,team_id,name,email');
});

it('never writes hidden or denylisted columns', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    Customer::create(['name' => 'Első', 'api_token' => 'titok', 'vat_secret' => 'másik-titok']);

    (new TableWriter($this->baseDir, Exportable::model(Customer::class), $team->id))->write();

    $contents = file_get_contents($this->baseDir.'/data/customers.jsonl')
        .file_get_contents($this->baseDir.'/csv/customers.csv');

    expect($contents)->not->toContain('titok')
        ->and($contents)->not->toContain('api_token')
        ->and($contents)->not->toContain('vat_secret');
});

it('writes exactly as many csv rows as jsonl lines', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    foreach (range(1, 25) as $i) {
        Customer::create(['name' => "Ügyfél {$i}"]);
    }

    $result = (new TableWriter($this->baseDir, Exportable::model(Customer::class), $team->id))->write();

    $jsonlCount = count(file($this->baseDir.'/data/customers.jsonl', FILE_IGNORE_NEW_LINES));
    $csvCount = count(file($this->baseDir.'/csv/customers.csv', FILE_IGNORE_NEW_LINES)) - 1;

    expect($result->rows)->toBe(25)->and($jsonlCount)->toBe(25)->and($csvCount)->toBe(25);
});

it('invokes the row callback once per record', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    Customer::create(['name' => 'Első']);
    Customer::create(['name' => 'Második']);

    $seen = [];
    (new TableWriter($this->baseDir, Exportable::model(Customer::class), $team->id))
        ->write(function ($row) use (&$seen): void {
            $seen[] = $row->name;
        });

    expect($seen)->toBe(['Első', 'Második']);
});

/**
 * 2. ŐR — mutációval igazolva: idegen csapat sorára az egész export megszakad.
 * Itt szándékosan kikapcsoljuk a TeamScope-ot (a lekérdezésbe így bekerül B sora),
 * hogy a soronkénti ellenőrzés fogjon.
 */
it('aborts the whole export when a foreign row reaches the writer', function (): void {
    $teamA = Team::create(['name' => 'A']);
    $teamB = Team::create(['name' => 'B']);

    app()->instance('current_team', $teamB);
    Customer::create(['name' => 'B ügyfele']);

    app()->forgetInstance('current_team'); // scope kikapcsolva → minden sor jön

    (new TableWriter($this->baseDir, Exportable::model(Customer::class), $teamA->id))->write();
})->throws(TenantLeakDetected::class);

it('aborts when a row has no resolvable team id', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    $customer = Customer::create(['name' => 'Első']);
    Customer::withoutGlobalScopes()->whereKey($customer->id)->update(['team_id' => null]);

    app()->forgetInstance('current_team');

    (new TableWriter($this->baseDir, Exportable::model(Customer::class), $team->id))->write();
})->throws(TenantLeakDetected::class);
```

Megjegyzés a `team_id` nullázásához: a fixture migráció `foreignId('team_id')->constrained('teams')` — a `nullable()` hiányzik. Egészítsd ki a `tests/TestCase.php` `customers` táblájában `team_id`-t `->nullable()`-lel, hogy ez a teszt működjön:
`$table->foreignId('team_id')->nullable()->constrained('teams');`

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/TableWriterTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Writers\TableWriter" not found`

- [ ] **Step 3: `src/Exceptions/TenantLeakDetected.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Exceptions;

use RuntimeException;

final class TenantLeakDetected extends RuntimeException
{
    public static function forRow(string $table, int|string|null $key, int|string|null $foundTeamId): self
    {
        return new self(sprintf(
            'Idegen sor került az exportba: tábla [%s], kulcs [%s], team_id [%s]. Az export megszakadt.',
            $table,
            (string) $key,
            $foundTeamId === null ? 'null' : (string) $foundTeamId,
        ));
    }
}
```

- [ ] **Step 4: `src/Writers/TableResult.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Writers;

final class TableResult
{
    /** @param array<int, string> $columns */
    public function __construct(
        public readonly string $key,
        public readonly int $rows,
        public readonly array $columns,
    ) {}
}
```

- [ ] **Step 5: `src/Writers/TableWriter.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Writers;

use BackedEnum;
use Closure;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Madbox99\DataPortability\Exceptions\TenantLeakDetected;
use Madbox99\DataPortability\Exportable;

final class TableWriter
{
    private const CHUNK = 1000;

    public function __construct(
        private readonly string $baseDir,
        private readonly Exportable $exportable,
        private readonly int|string $teamId,
    ) {}

    public function write(?Closure $onRow = null): TableResult
    {
        $key = $this->exportable->key();
        $columns = $this->exportable->columns();

        $jsonl = fopen("{$this->baseDir}/data/{$key}.jsonl", 'wb');
        $csv = fopen("{$this->baseDir}/csv/{$key}.csv", 'wb');

        fputcsv($csv, $columns);

        $rows = 0;

        try {
            foreach ($this->exportable->newQuery()->lazyById(self::CHUNK) as $row) {
                $this->guardTenant($row, $key);

                $attributes = $row->attributesToArray();
                $ordered = [];

                foreach ($columns as $column) {
                    $ordered[$column] = $attributes[$column] ?? null;
                }

                fwrite($jsonl, json_encode($ordered, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n");
                fputcsv($csv, array_map($this->toScalar(...), $ordered));

                if ($onRow instanceof Closure) {
                    $onRow($row);
                }

                $rows++;
            }
        } finally {
            fclose($jsonl);
            fclose($csv);
        }

        return new TableResult($key, $rows, $columns);
    }

    private function guardTenant(Model $row, string $key): void
    {
        $rowTeamId = $this->exportable->resolveTeamId($row);

        if ($rowTeamId === null || (string) $rowTeamId !== (string) $this->teamId) {
            throw TenantLeakDetected::forRow($key, $row->getKey(), $rowTeamId);
        }
    }

    private function toScalar(mixed $value): string
    {
        return match (true) {
            $value === null => '',
            is_bool($value) => $value ? '1' : '0',
            is_array($value) => (string) json_encode($value, JSON_UNESCAPED_UNICODE),
            $value instanceof DateTimeInterface => $value->format(DateTimeInterface::ATOM),
            $value instanceof BackedEnum => (string) $value->value,
            default => (string) $value,
        };
    }
}
```

- [ ] **Step 6: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/TableWriterTest.php`
Expected: PASS (6 tests)

- [ ] **Step 7: Bizonyítsd a 2. őrt mutációval**

Kommenteld ki a `guardTenant()` hívást a `write()` ciklusából, majd:

Run: `vendor/bin/pest tests/Feature/TableWriterTest.php`
Expected: FAIL — az „aborts the whole export…" és az „aborts when a row has no resolvable team id" bukik.
Ezután **állítsd vissza** a sort, és futtasd újra: PASS.

- [ ] **Step 8: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: TableWriter JSONL/CSV streameléssel és a második tenant-őrrel"
```

---

### Task 6: `FileCollector` — fájlmásolás méretkorláttal

**Files:**
- Create: `src/Writers/FileCollector.php`
- Test: `tests/Feature/FileCollectorTest.php`

**Interfaces:**
- Consumes: `data-portability.source_disk`, `data-portability.file_limit` (1. feladat).
- Produces: `FileCollector::__construct(string $baseDir, int $limitBytes, ?string $sourceDisk = null)`, `->collect(string $table, int|string $rowKey, array $paths): void`, `->included(): int`, `->bytes(): int`, `->skipped(): array<int, array{table: string, row_id: string, path: string, reason: string}>`.
  Cél-útvonal a ZIP-ben: `files/{$table}/{$rowKey}/{basename}`.
  `reason` értékei: `'missing'` (a forrásfájl nincs meg) és `'limit'` (a méretkorlát betelt).

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/FileCollectorTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Writers\FileCollector;

beforeEach(function (): void {
    Storage::fake('uploads');
    config()->set('data-portability.source_disk', 'uploads');

    $this->baseDir = sys_get_temp_dir().'/dp-'.bin2hex(random_bytes(6));
    mkdir($this->baseDir, 0755, true);
});

afterEach(function (): void {
    exec('rm -rf '.escapeshellarg($this->baseDir));
});

it('copies a declared file into files/<table>/<id>/', function (): void {
    Storage::disk('uploads')->put('invoices/szamla.pdf', 'PDF-tartalom');

    $collector = new FileCollector($this->baseDir, 1024);
    $collector->collect('invoices', 7, ['invoices/szamla.pdf']);

    expect(file_exists($this->baseDir.'/files/invoices/7/szamla.pdf'))->toBeTrue()
        ->and(file_get_contents($this->baseDir.'/files/invoices/7/szamla.pdf'))->toBe('PDF-tartalom')
        ->and($collector->included())->toBe(1)
        ->and($collector->bytes())->toBe(12)
        ->and($collector->skipped())->toBe([]);
});

it('records a missing source file as skipped instead of failing', function (): void {
    $collector = new FileCollector($this->baseDir, 1024);
    $collector->collect('invoices', 7, ['invoices/nincs-ilyen.pdf']);

    expect($collector->included())->toBe(0)
        ->and($collector->skipped())->toHaveCount(1)
        ->and($collector->skipped()[0]['reason'])->toBe('missing')
        ->and($collector->skipped()[0]['path'])->toBe('invoices/nincs-ilyen.pdf');
});

it('stops copying once the byte limit is reached and reports what was left out', function (): void {
    Storage::disk('uploads')->put('a.txt', str_repeat('a', 60));
    Storage::disk('uploads')->put('b.txt', str_repeat('b', 60));

    $collector = new FileCollector($this->baseDir, 100);
    $collector->collect('invoices', 1, ['a.txt']);
    $collector->collect('invoices', 2, ['b.txt']);

    expect($collector->included())->toBe(1)
        ->and($collector->bytes())->toBe(60)
        ->and($collector->skipped())->toHaveCount(1)
        ->and($collector->skipped()[0]['reason'])->toBe('limit')
        ->and($collector->skipped()[0]['path'])->toBe('b.txt')
        ->and(file_exists($this->baseDir.'/files/invoices/2/b.txt'))->toBeFalse();
});

it('falls back to the filament default disk when no source disk is configured', function (): void {
    config()->set('data-portability.source_disk', null);
    config()->set('filament.default_filesystem_disk', 'uploads');
    Storage::disk('uploads')->put('c.txt', 'x');

    $collector = new FileCollector($this->baseDir, 1024);
    $collector->collect('invoices', 3, ['c.txt']);

    expect($collector->included())->toBe(1);
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/FileCollectorTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Writers\FileCollector" not found`

- [ ] **Step 3: `src/Writers/FileCollector.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Writers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

final class FileCollector
{
    private int $bytes = 0;

    private int $included = 0;

    /** @var array<int, array{table: string, row_id: string, path: string, reason: string}> */
    private array $skipped = [];

    private readonly Filesystem $source;

    public function __construct(
        private readonly string $baseDir,
        private readonly int $limitBytes,
        ?string $sourceDisk = null,
    ) {
        $disk = $sourceDisk
            ?? config('data-portability.source_disk')
            ?? config('filament.default_filesystem_disk')
            ?? 'local';

        $this->source = Storage::disk((string) $disk);
    }

    /** @param array<int, string> $paths */
    public function collect(string $table, int|string $rowKey, array $paths): void
    {
        foreach ($paths as $path) {
            if (! $this->source->exists($path)) {
                $this->skip($table, $rowKey, $path, 'missing');

                continue;
            }

            $size = (int) $this->source->size($path);

            if ($this->bytes + $size > $this->limitBytes) {
                $this->skip($table, $rowKey, $path, 'limit');

                continue;
            }

            $target = sprintf('%s/files/%s/%s', $this->baseDir, $table, (string) $rowKey);

            if (! is_dir($target)) {
                mkdir($target, 0755, true);
            }

            file_put_contents($target.'/'.basename($path), $this->source->get($path));

            $this->bytes += $size;
            $this->included++;
        }
    }

    public function included(): int
    {
        return $this->included;
    }

    public function bytes(): int
    {
        return $this->bytes;
    }

    /** @return array<int, array{table: string, row_id: string, path: string, reason: string}> */
    public function skipped(): array
    {
        return $this->skipped;
    }

    private function skip(string $table, int|string $rowKey, string $path, string $reason): void
    {
        $this->skipped[] = [
            'table' => $table,
            'row_id' => (string) $rowKey,
            'path' => $path,
            'reason' => $reason,
        ];
    }
}
```

- [ ] **Step 4: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/FileCollectorTest.php`
Expected: PASS (4 tests)

- [ ] **Step 5: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: FileCollector méretkorláttal és kihagyás-naplóval"
```

---

### Task 7: `ManifestBuilder` — `manifest.json` és az angol `README.md`

**Files:**
- Create: `src/Writers/ManifestBuilder.php`, `resources/stubs/export-readme.md`
- Test: `tests/Feature/ManifestBuilderTest.php`

**Interfaces:**
- Consumes: `TableResult` (5. feladat), `FileCollector` (6. feladat), `Exportable` (2. feladat).
- Produces: `ManifestBuilder::__construct(string $baseDir, Model $team)`, `->write(array $results, array $exportables, FileCollector $files): array` — kiírja a `manifest.json`-t és a `README.md`-t a `$baseDir`-be, és visszaadja a manifest tömböt.
  `$results`: `array<string, TableResult>`, `$exportables`: `array<string, Exportable>`, mindkettő tábla-név szerint kulcsolva.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/ManifestBuilderTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\Tests\Fixtures\Models\Customer;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;
use Madbox99\DataPortability\Writers\FileCollector;
use Madbox99\DataPortability\Writers\ManifestBuilder;
use Madbox99\DataPortability\Writers\TableResult;

beforeEach(function (): void {
    $this->baseDir = sys_get_temp_dir().'/dp-'.bin2hex(random_bytes(6));
    mkdir($this->baseDir, 0755, true);
});

afterEach(function (): void {
    exec('rm -rf '.escapeshellarg($this->baseDir));
});

it('describes every exported table with its label, row count and file paths', function (): void {
    $team = Team::create(['name' => 'A csapat']);

    $manifest = (new ManifestBuilder($this->baseDir, $team))->write(
        ['customers' => new TableResult('customers', 12, ['id', 'team_id', 'name'])],
        ['customers' => Exportable::model(Customer::class)->label('Ügyfelek')],
        new FileCollector($this->baseDir, 1024),
    );

    $table = $manifest['tables'][0];

    expect($manifest['schema_version'])->toBe(1)
        ->and($manifest['team']['name'])->toBe('A csapat')
        ->and($table['name'])->toBe('customers')
        ->and($table['label'])->toBe('Ügyfelek')
        ->and($table['rows'])->toBe(12)
        ->and($table['data_file'])->toBe('data/customers.jsonl')
        ->and($table['csv_file'])->toBe('csv/customers.csv')
        ->and($table['columns'])->toBe(['id', 'team_id', 'name']);
});

it('derives foreign key relations from the database schema', function (): void {
    $team = Team::create(['name' => 'A csapat']);

    $manifest = (new ManifestBuilder($this->baseDir, $team))->write(
        ['customers' => new TableResult('customers', 1, ['id', 'team_id'])],
        ['customers' => Exportable::model(Customer::class)],
        new FileCollector($this->baseDir, 1024),
    );

    expect($manifest['tables'][0]['relations'])->toContain([
        'column' => 'team_id',
        'references_table' => 'teams',
        'references_column' => 'id',
    ]);
});

it('reports the file budget and everything that was left out', function (): void {
    $team = Team::create(['name' => 'A csapat']);

    $files = new FileCollector($this->baseDir, 10);
    $files->collect('invoices', 1, ['nincs-ilyen.pdf']);

    $manifest = (new ManifestBuilder($this->baseDir, $team))->write([], [], $files);

    expect($manifest['files']['limit_bytes'])->toBe(10)
        ->and($manifest['files']['included'])->toBe(0)
        ->and($manifest['files']['skipped'])->toHaveCount(1)
        ->and($manifest['files']['skipped'][0]['reason'])->toBe('missing');
});

it('writes manifest.json and an English README.md into the export root', function (): void {
    $team = Team::create(['name' => 'A csapat']);

    (new ManifestBuilder($this->baseDir, $team))->write([], [], new FileCollector($this->baseDir, 10));

    $readme = file_get_contents($this->baseDir.'/README.md');

    expect(file_exists($this->baseDir.'/manifest.json'))->toBeTrue()
        ->and($readme)->toContain('This archive contains')
        ->and($readme)->toContain('data/')
        ->and($readme)->toContain('manifest.json');
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/ManifestBuilderTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Writers\ManifestBuilder" not found`

- [ ] **Step 3: `resources/stubs/export-readme.md` (angol)**

```markdown
# Data export

This archive contains a complete, machine-readable copy of the data held for
the team **{{team}}**, generated on {{generated_at}}.

## Layout

| Path | What it holds |
| --- | --- |
| `manifest.json` | The authoritative description of this archive: every table, its columns, its row count, and the foreign keys that link tables together. Read this first. |
| `data/` | One `.jsonl` file per table. Each line is a single record encoded as JSON, with raw, untransformed values. This is the canonical copy — use it when importing into another system. |
| `csv/` | The same records as comma-separated values, one file per table, with a header row. Convenient for spreadsheets; lossier than the JSONL copy. |
| `files/` | Uploaded documents and images, organised as `files/<table>/<record id>/<filename>`. |

## Rebuilding relationships

Primary keys (`id`, `uuid`) and foreign keys are preserved exactly as stored.
The `relations` array of each table in `manifest.json` tells you which column
points at which table, so the original graph can be reconstructed.

## Note on omitted files

If the archive hit its size limit, `files.skipped` in `manifest.json` lists
every file that was left out, together with the reason. Request a new export
after removing large attachments, or ask support for a split export.
```

- [ ] **Step 4: `src/Writers/ManifestBuilder.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Writers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

final class ManifestBuilder
{
    public function __construct(
        private readonly string $baseDir,
        private readonly Model $team,
    ) {}

    /**
     * @param  array<string, TableResult>  $results
     * @param  array<string, \Madbox99\DataPortability\Exportable>  $exportables
     * @return array<string, mixed>
     */
    public function write(array $results, array $exportables, FileCollector $files): array
    {
        $generatedAt = now()->toAtomString();

        $tables = [];

        foreach ($results as $key => $result) {
            $tables[] = [
                'name' => $key,
                'label' => $exportables[$key]?->labelText() ?? $key,
                'model' => $exportables[$key]?->modelClass() ?? null,
                'rows' => $result->rows,
                'columns' => $result->columns,
                'data_file' => "data/{$key}.jsonl",
                'csv_file' => "csv/{$key}.csv",
                'relations' => $this->relationsFor($key),
            ];
        }

        $manifest = [
            'schema_version' => 1,
            'generated_at' => $generatedAt,
            'application' => [
                'name' => (string) config('app.name'),
                'url' => (string) config('app.url'),
            ],
            'team' => [
                'id' => $this->team->getKey(),
                'uuid' => $this->team->getAttribute('uuid'),
                'name' => $this->team->getAttribute('name'),
            ],
            'tables' => $tables,
            'files' => [
                'included' => $files->included(),
                'bytes' => $files->bytes(),
                'limit_bytes' => (int) config('data-portability.file_limit'),
                'skipped' => $files->skipped(),
            ],
        ];

        file_put_contents(
            $this->baseDir.'/manifest.json',
            json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        );

        file_put_contents($this->baseDir.'/README.md', $this->readme($generatedAt));

        return $manifest;
    }

    /** @return array<int, array{column: string, references_table: string, references_column: string}> */
    private function relationsFor(string $table): array
    {
        $relations = [];

        foreach (Schema::getForeignKeys($table) as $foreignKey) {
            foreach ($foreignKey['columns'] as $index => $column) {
                $relations[] = [
                    'column' => $column,
                    'references_table' => $foreignKey['foreign_table'],
                    'references_column' => $foreignKey['foreign_columns'][$index] ?? 'id',
                ];
            }
        }

        return $relations;
    }

    private function readme(string $generatedAt): string
    {
        $stub = file_get_contents(__DIR__.'/../../resources/stubs/export-readme.md');

        return str_replace(
            ['{{team}}', '{{generated_at}}'],
            [(string) $this->team->getAttribute('name'), $generatedAt],
            $stub,
        );
    }
}
```

Figyelem: a `$exportables[$key]?->...` csak akkor működik, ha a kulcs létezik. Használd helyette az `isset($exportables[$key]) ? $exportables[$key]->labelText() : $key` formát, ha a Pint/PHPStan panaszkodik.

- [ ] **Step 5: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/ManifestBuilderTest.php`
Expected: PASS (4 tests)

- [ ] **Step 6: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: ManifestBuilder és az angol nyelvű export README"
```

---

### Task 8: `ArchiveBuilder` — ZIP előállítás

**Files:**
- Create: `src/Writers/ArchiveBuilder.php`
- Test: `tests/Feature/ArchiveBuilderTest.php`

**Interfaces:**
- Consumes: semmit a korábbi feladatokból.
- Produces: `ArchiveBuilder::build(string $sourceDir, string $zipPath): int` — visszaadja a ZIP méretét bájtban; a ZIP-en belüli útvonalak a `$sourceDir`-hez relatívak.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/ArchiveBuilderTest.php`:

```php
<?php

declare(strict_types=1);

use Madbox99\DataPortability\Writers\ArchiveBuilder;

beforeEach(function (): void {
    $this->sourceDir = sys_get_temp_dir().'/dp-src-'.bin2hex(random_bytes(6));
    $this->zipPath = sys_get_temp_dir().'/dp-'.bin2hex(random_bytes(6)).'.zip';

    mkdir($this->sourceDir.'/data', 0755, true);
    mkdir($this->sourceDir.'/files/invoices/7', 0755, true);

    file_put_contents($this->sourceDir.'/manifest.json', '{"schema_version":1}');
    file_put_contents($this->sourceDir.'/data/customers.jsonl', '{"id":1}'."\n");
    file_put_contents($this->sourceDir.'/files/invoices/7/szamla.pdf', 'PDF');
});

afterEach(function (): void {
    exec('rm -rf '.escapeshellarg($this->sourceDir));
    @unlink($this->zipPath);
});

it('packs every file with paths relative to the source directory', function (): void {
    $size = (new ArchiveBuilder)->build($this->sourceDir, $this->zipPath);

    $zip = new ZipArchive;
    $zip->open($this->zipPath);

    $entries = [];
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $entries[] = $zip->getNameIndex($i);
    }
    $zip->close();

    sort($entries);

    expect($entries)->toBe([
        'data/customers.jsonl',
        'files/invoices/7/szamla.pdf',
        'manifest.json',
    ])->and($size)->toBeGreaterThan(0)
        ->and($size)->toBe(filesize($this->zipPath));
});

it('preserves file contents', function (): void {
    (new ArchiveBuilder)->build($this->sourceDir, $this->zipPath);

    $zip = new ZipArchive;
    $zip->open($this->zipPath);

    expect($zip->getFromName('files/invoices/7/szamla.pdf'))->toBe('PDF');

    $zip->close();
});

it('fails loudly when the zip cannot be created', function (): void {
    (new ArchiveBuilder)->build($this->sourceDir, '/nem/letezo/konyvtar/a.zip');
})->throws(RuntimeException::class);
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/ArchiveBuilderTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Writers\ArchiveBuilder" not found`

- [ ] **Step 3: `src/Writers/ArchiveBuilder.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Writers;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use SplFileInfo;
use ZipArchive;

final class ArchiveBuilder
{
    public function build(string $sourceDir, string $zipPath): int
    {
        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new RuntimeException("A ZIP nem hozható létre itt: [{$zipPath}].");
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourceDir, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY,
        );

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $zip->addFile(
                $file->getRealPath(),
                ltrim(str_replace($sourceDir, '', $file->getRealPath()), '/'),
            );
        }

        $zip->close();

        clearstatcache(true, $zipPath);

        return (int) filesize($zipPath);
    }
}
```

- [ ] **Step 4: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/ArchiveBuilderTest.php`
Expected: PASS (3 tests)

- [ ] **Step 5: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: ArchiveBuilder a ZIP előállításához"
```

---

### Task 9: `BuildDataExportJob` — a teljes futás, események, hibakezelés

**Files:**
- Create: `src/Jobs/BuildDataExportJob.php`, `src/Events/DataExportRequested.php`, `src/Events/DataExportCompleted.php`, `src/Events/DataExportFailed.php`
- Test: `tests/Feature/BuildDataExportJobTest.php`

**Interfaces:**
- Consumes: `TenantContext` (4.), `ExportRegistry`/`Exportable` (2.), `TableWriter` (5.), `FileCollector` (6.), `ManifestBuilder` (7.), `ArchiveBuilder` (8.), `DataExport`/`ExportStatus` (3.).
- Produces: `BuildDataExportJob::__construct(int $dataExportId)`, `->handle(TenantContext $tenant, ExportRegistry $registry, ArchiveBuilder $archive): void`, `->failed(Throwable $e): void`.
  Események: `DataExportCompleted(DataExport $export)`, `DataExportFailed(DataExport $export, string $reason)`.
  A kész ZIP a `data-portability.disk` disken: `{team_uuid vagy team_id}/{export uuid}.zip`.

- [ ] **Step 1: Írd meg a bukó teszteket — köztük a KÖZPONTI szivárgás-tesztet**

`tests/Feature/BuildDataExportJobTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Events\DataExportCompleted;
use Madbox99\DataPortability\Events\DataExportFailed;
use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\Facades\DataPortability;
use Madbox99\DataPortability\Jobs\BuildDataExportJob;
use Madbox99\DataPortability\Models\DataExport;
use Madbox99\DataPortability\Tests\Fixtures\Models\Customer;
use Madbox99\DataPortability\Tests\Fixtures\Models\CustomerAddress;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;

beforeEach(function (): void {
    Storage::fake('data-exports');
    Storage::fake('uploads');
    config()->set('data-portability.source_disk', 'uploads');
});

/**
 * Ez a csomag legfontosabb tesztje. Két csapat feltöltött adatbázisa, az egyikük
 * exportja — és egyetlen sor sem tartozhat a másikhoz.
 */
it('exports only the requesting team, never another team', function (): void {
    $teamA = Team::create(['name' => 'A csapat']);
    $teamB = Team::create(['name' => 'B csapat']);

    app()->instance('current_team', $teamA);
    $customerA = Customer::create(['name' => 'A ügyfele', 'email' => 'a@example.com']);
    CustomerAddress::create(['customer_id' => $customerA->id, 'city' => 'Budapest']);

    app()->instance('current_team', $teamB);
    $customerB = Customer::create(['name' => 'B ügyfele', 'email' => 'b@example.com']);
    CustomerAddress::create(['customer_id' => $customerB->id, 'city' => 'Debrecen']);

    app()->forgetInstance('current_team');

    DataPortability::register(
        Exportable::model(Customer::class)->label('Ügyfelek'),
        Exportable::model(CustomerAddress::class)->label('Címek')->through('customer'),
    );

    $export = DataExport::create(['team_id' => $teamA->id, 'user_id' => 1]);

    (new BuildDataExportJob($export->id))->handle(
        app(Madbox99\DataPortability\TenantContext::class),
        app(Madbox99\DataPortability\ExportRegistry::class),
        app(Madbox99\DataPortability\Writers\ArchiveBuilder::class),
    );

    $export->refresh();
    $contents = extractZip(Storage::disk('data-exports')->path($export->path));

    expect($export->status)->toBe(ExportStatus::Completed)
        ->and($contents['data/customers.jsonl'])->toContain('A ügyfele')
        ->and($contents['data/customers.jsonl'])->not->toContain('B ügyfele')
        ->and($contents['data/customer_addresses.jsonl'])->toContain('Budapest')
        ->and($contents['data/customer_addresses.jsonl'])->not->toContain('Debrecen')
        ->and($export->row_counts)->toBe(['customers' => 1, 'customer_addresses' => 1]);
});

it('produces a zip that contains the manifest, the readme, jsonl and csv', function (): void {
    $team = Team::create(['name' => 'A csapat']);
    app()->instance('current_team', $team);
    Customer::create(['name' => 'Ügyfél']);
    app()->forgetInstance('current_team');

    DataPortability::register(Exportable::model(Customer::class)->label('Ügyfelek'));

    $export = DataExport::create(['team_id' => $team->id, 'user_id' => 1]);
    dispatchExportJob($export);

    $contents = extractZip(Storage::disk('data-exports')->path($export->refresh()->path));

    expect(array_keys($contents))->toContain(
        'manifest.json', 'README.md', 'data/customers.jsonl', 'csv/customers.csv',
    );
});

it('records size, row counts and an expiry seven days out', function (): void {
    $team = Team::create(['name' => 'A csapat']);
    app()->instance('current_team', $team);
    Customer::create(['name' => 'Ügyfél']);
    app()->forgetInstance('current_team');

    DataPortability::register(Exportable::model(Customer::class));

    $export = DataExport::create(['team_id' => $team->id, 'user_id' => 1]);
    dispatchExportJob($export);
    $export->refresh();

    expect($export->size_bytes)->toBeGreaterThan(0)
        ->and($export->row_counts)->toBe(['customers' => 1])
        ->and($export->completed_at)->not->toBeNull()
        ->and($export->expires_at->diffInDays(now()))->toBeLessThanOrEqual(7)
        ->and($export->isDownloadable())->toBeTrue();
});

it('fires a completed event', function (): void {
    Event::fake([DataExportCompleted::class]);

    $team = Team::create(['name' => 'A csapat']);
    DataPortability::register(Exportable::model(Customer::class));
    $export = DataExport::create(['team_id' => $team->id, 'user_id' => 1]);

    dispatchExportJob($export);

    Event::assertDispatched(DataExportCompleted::class);
});

it('leaves no temporary directory behind after a successful run', function (): void {
    $team = Team::create(['name' => 'A csapat']);
    DataPortability::register(Exportable::model(Customer::class));
    $export = DataExport::create(['team_id' => $team->id, 'user_id' => 1]);

    dispatchExportJob($export);

    expect(glob(config('data-portability.temp_path').'/*'))->toBe([]);
});

it('marks the export failed and keeps nothing downloadable when the job blows up', function (): void {
    Event::fake([DataExportFailed::class]);

    $team = Team::create(['name' => 'A csapat']);
    $export = DataExport::create(['team_id' => $team->id, 'user_id' => 1]);

    $job = new BuildDataExportJob($export->id);
    $job->failed(new RuntimeException('valami elromlott'));

    $export->refresh();

    expect($export->status)->toBe(ExportStatus::Failed)
        ->and($export->isDownloadable())->toBeFalse()
        ->and($export->error)->not->toBeNull()
        ->and(glob(config('data-portability.temp_path').'/*'))->toBe([]);

    Event::assertDispatched(DataExportFailed::class);
});
```

Vedd fel a `tests/Pest.php`-be ezt a két segédfüggvényt:

```php
function dispatchExportJob(Madbox99\DataPortability\Models\DataExport $export): void
{
    (new Madbox99\DataPortability\Jobs\BuildDataExportJob($export->id))->handle(
        app(Madbox99\DataPortability\TenantContext::class),
        app(Madbox99\DataPortability\ExportRegistry::class),
        app(Madbox99\DataPortability\Writers\ArchiveBuilder::class),
    );
}

/** @return array<string, string> */
function extractZip(string $zipPath): array
{
    $zip = new ZipArchive;
    $zip->open($zipPath);

    $contents = [];
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $name = (string) $zip->getNameIndex($i);
        $contents[$name] = (string) $zip->getFromIndex($i);
    }
    $zip->close();

    return $contents;
}
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/BuildDataExportJobTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\Jobs\BuildDataExportJob" not found`

- [ ] **Step 3: Események**

`src/Events/DataExportCompleted.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Madbox99\DataPortability\Models\DataExport;

final class DataExportCompleted
{
    use Dispatchable;

    public function __construct(public readonly DataExport $export) {}
}
```

`src/Events/DataExportRequested.php` — ugyanez a törzs, `DataExportRequested` névvel.

`src/Events/DataExportFailed.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Madbox99\DataPortability\Models\DataExport;

final class DataExportFailed
{
    use Dispatchable;

    public function __construct(
        public readonly DataExport $export,
        public readonly string $reason,
    ) {}
}
```

- [ ] **Step 4: `src/Jobs/BuildDataExportJob.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Jobs;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Events\DataExportCompleted;
use Madbox99\DataPortability\Events\DataExportFailed;
use Madbox99\DataPortability\ExportRegistry;
use Madbox99\DataPortability\Models\DataExport;
use Madbox99\DataPortability\TenantContext;
use Madbox99\DataPortability\Writers\ArchiveBuilder;
use Madbox99\DataPortability\Writers\FileCollector;
use Madbox99\DataPortability\Writers\ManifestBuilder;
use Madbox99\DataPortability\Writers\TableWriter;
use Throwable;

final class BuildDataExportJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;

    public int $timeout = 3600;

    public function __construct(public readonly int $dataExportId)
    {
        $this->onQueue((string) config('data-portability.queue'));
    }

    public function handle(TenantContext $tenant, ExportRegistry $registry, ArchiveBuilder $archive): void
    {
        $export = DataExport::findOrFail($this->dataExportId);
        $export->update(['status' => ExportStatus::Running, 'started_at' => now()]);

        $team = $tenant->resolveTeam($export->team_id);
        $tenant->bind($team);

        $workDir = rtrim((string) config('data-portability.temp_path'), '/').'/'.Str::ulid()->toString();
        $zipPath = $workDir.'.zip';

        try {
            File::ensureDirectoryExists($workDir.'/data');
            File::ensureDirectoryExists($workDir.'/csv');

            $files = new FileCollector($workDir, (int) config('data-portability.file_limit'));

            $results = [];

            foreach ($registry->all() as $key => $exportable) {
                $results[$key] = (new TableWriter($workDir, $exportable, $team->getKey()))
                    ->write(function ($row) use ($exportable, $files, $key): void {
                        $paths = $exportable->resolveFiles($row);

                        if ($paths !== []) {
                            $files->collect($key, $row->getKey(), $paths);
                        }
                    });
            }

            (new ManifestBuilder($workDir, $team))->write($results, $registry->all(), $files);

            $size = $archive->build($workDir, $zipPath);

            $relativePath = sprintf(
                '%s/%s.zip',
                (string) ($team->getAttribute('uuid') ?? $team->getKey()),
                (string) $export->uuid,
            );

            Storage::disk((string) config('data-portability.disk'))
                ->put($relativePath, file_get_contents($zipPath));

            $export->update([
                'status' => ExportStatus::Completed,
                'path' => $relativePath,
                'size_bytes' => $size,
                'row_counts' => array_map(static fn ($r): int => $r->rows, $results),
                'completed_at' => now(),
                'expires_at' => now()->addDays((int) config('data-portability.retention_days')),
            ]);

            DataExportCompleted::dispatch($export);

            $this->notify($export);
        } finally {
            File::deleteDirectory($workDir);
            File::delete($zipPath);
        }
    }

    public function failed(Throwable $exception): void
    {
        $export = DataExport::find($this->dataExportId);

        if (! $export instanceof DataExport) {
            return;
        }

        if ($export->path !== null) {
            Storage::disk((string) config('data-portability.disk'))->delete($export->path);
        }

        File::cleanDirectory((string) config('data-portability.temp_path'));

        $export->update([
            'status' => ExportStatus::Failed,
            'path' => null,
            'error' => class_basename($exception),
            'completed_at' => now(),
        ]);

        DataExportFailed::dispatch($export, class_basename($exception));
    }

    private function notify(DataExport $export): void
    {
        $userClass = config('auth.providers.users.model');

        if (! is_string($userClass) || $export->user_id === null) {
            return;
        }

        $user = $userClass::find($export->user_id);

        if ($user === null) {
            return;
        }

        Notification::make()
            ->title(__('Elkészült az adatexport'))
            ->body(__('A csomag letölthető az Adatexport oldalon.'))
            ->success()
            ->sendToDatabase($user);
    }
}
```

Figyelem az `error` mezőre: **csak a kivétel osztálynevét** tároljuk, sosem az üzenetét — az tartalmazhat SQL-t vagy adatot, és a panelen megjelenne.

- [ ] **Step 5: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/BuildDataExportJobTest.php`
Expected: PASS (6 tests)

- [ ] **Step 6: Futtasd a teljes suite-ot**

Run: `vendor/bin/pest`
Expected: PASS (minden korábbi teszt is)

- [ ] **Step 7: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: BuildDataExportJob a teljes export-futással"
```

---

### Task 10: Letöltő route és jogosultság-ellenőrzés

**Files:**
- Create: `routes/web.php`, `src/Http/Controllers/DownloadDataExportController.php`
- Modify: `src/DataPortabilityServiceProvider.php` (`loadRoutesFrom`)
- Test: `tests/Feature/DownloadDataExportTest.php`

**Interfaces:**
- Consumes: `DataExport` (3.), `data-portability.route_middleware`, `data-portability.authorize` (1.).
- Produces: `data-portability.download` nevű route (`GET /data-exports/{dataExport:uuid}/download`).

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/DownloadDataExportTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Models\DataExport;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;

beforeEach(function (): void {
    Storage::fake('data-exports');
    config()->set('data-portability.route_middleware', ['web']);
});

function completedExport(Team $team): DataExport
{
    Storage::disk('data-exports')->put('a/export.zip', 'ZIP-tartalom');

    return DataExport::create([
        'team_id' => $team->id,
        'user_id' => 1,
        'status' => ExportStatus::Completed,
        'path' => 'a/export.zip',
        'size_bytes' => 12,
        'expires_at' => now()->addDay(),
    ]);
}

it('serves the archive to a member of the owning team', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    $export = completedExport($team);

    $this->get(route('data-portability.download', $export))
        ->assertOk()
        ->assertHeader('content-disposition');
});

it('records the download', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);
    $export = completedExport($team);

    $this->get(route('data-portability.download', $export));

    expect($export->refresh()->download_count)->toBe(1)
        ->and($export->downloaded_at)->not->toBeNull();
});

it('refuses a member of another team with 403', function (): void {
    $teamA = Team::create(['name' => 'A']);
    $teamB = Team::create(['name' => 'B']);

    $export = completedExport($teamA);

    app()->instance('current_team', $teamB);

    $this->get(route('data-portability.download', $export))->assertForbidden();
});

it('returns 404 for an expired export', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    $export = completedExport($team);
    $export->update(['expires_at' => now()->subMinute()]);

    $this->get(route('data-portability.download', $export))->assertNotFound();
});

it('returns 404 for an export that is still running', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    $export = completedExport($team);
    $export->update(['status' => ExportStatus::Running]);

    $this->get(route('data-portability.download', $export))->assertNotFound();
});

it('returns 404 for a failed export even if a file lingers', function (): void {
    $team = Team::create(['name' => 'A']);
    app()->instance('current_team', $team);

    $export = completedExport($team);
    $export->update(['status' => ExportStatus::Failed]);

    $this->get(route('data-portability.download', $export))->assertNotFound();
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/DownloadDataExportTest.php`
Expected: FAIL — `Route [data-portability.download] not defined.`

- [ ] **Step 3: `routes/web.php`**

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Madbox99\DataPortability\Http\Controllers\DownloadDataExportController;

Route::middleware((array) config('data-portability.route_middleware', ['web', 'auth']))
    ->get('/data-exports/{dataExport}/download', DownloadDataExportController::class)
    ->name('data-portability.download');
```

- [ ] **Step 4: `src/Http/Controllers/DownloadDataExportController.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Models\DataExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class DownloadDataExportController
{
    public function __invoke(Request $request, DataExport $dataExport): StreamedResponse
    {
        $binding = (string) config('data-portability.tenant_binding');
        $team = app()->bound($binding) ? resolve($binding) : null;

        abort_unless(
            $team instanceof Model && (string) $team->getKey() === (string) $dataExport->team_id,
            403,
        );

        abort_unless($dataExport->isDownloadable(), 404);

        $dataExport->increment('download_count');
        $dataExport->update(['downloaded_at' => now()]);

        return Storage::disk((string) config('data-portability.disk'))->download(
            $dataExport->path,
            sprintf('adatexport-%s.zip', $dataExport->created_at->format('Y-m-d')),
        );
    }
}
```

A sorrend szándékos: előbb a **403** (nem a tiéd), utána a **404** (nincs mit adni). Így egy idegen csapat tagja nem tudja a státusz alapján megkülönböztetni a létező és nem létező exportokat.

- [ ] **Step 5: Route-ok betöltése a providerben**

A `boot()` metódusba, a `loadMigrationsFrom` mellé:

```php
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
```

- [ ] **Step 6: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/DownloadDataExportTest.php`
Expected: PASS (6 tests)

- [ ] **Step 7: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: letöltő route csapat- és állapot-ellenőrzéssel"
```

---

### Task 11: `PruneDataExportsCommand` — 7 napos retenció

**Files:**
- Create: `src/Console/PruneDataExportsCommand.php`
- Modify: `src/DataPortabilityServiceProvider.php` (command regisztráció + napi ütemezés)
- Test: `tests/Feature/PruneDataExportsCommandTest.php`

**Interfaces:**
- Consumes: `DataExport` (3.).
- Produces: `data-portability:prune` artisan parancs; napi ütemezés a provider `boot()`-jában.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/PruneDataExportsCommandTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Models\DataExport;

beforeEach(function (): void {
    Storage::fake('data-exports');
});

it('deletes expired exports together with their files', function (): void {
    Storage::disk('data-exports')->put('a/regi.zip', 'ZIP');

    $expired = DataExport::create([
        'team_id' => 1, 'user_id' => 1, 'status' => ExportStatus::Completed,
        'path' => 'a/regi.zip', 'expires_at' => now()->subDay(),
    ]);

    $this->artisan('data-portability:prune')->assertSuccessful();

    expect(DataExport::find($expired->id))->toBeNull()
        ->and(Storage::disk('data-exports')->exists('a/regi.zip'))->toBeFalse();
});

it('keeps exports that have not expired', function (): void {
    Storage::disk('data-exports')->put('a/uj.zip', 'ZIP');

    $fresh = DataExport::create([
        'team_id' => 1, 'user_id' => 1, 'status' => ExportStatus::Completed,
        'path' => 'a/uj.zip', 'expires_at' => now()->addDay(),
    ]);

    $this->artisan('data-portability:prune')->assertSuccessful();

    expect(DataExport::find($fresh->id))->not->toBeNull()
        ->and(Storage::disk('data-exports')->exists('a/uj.zip'))->toBeTrue();
});

it('removes failed exports older than the retention window even without an expiry', function (): void {
    $failed = DataExport::create([
        'team_id' => 1, 'user_id' => 1, 'status' => ExportStatus::Failed,
        'created_at' => now()->subDays(8), 'updated_at' => now()->subDays(8),
    ]);

    $this->artisan('data-portability:prune')->assertSuccessful();

    expect(DataExport::find($failed->id))->toBeNull();
});

it('reports how many exports it removed', function (): void {
    DataExport::create([
        'team_id' => 1, 'user_id' => 1, 'status' => ExportStatus::Completed,
        'expires_at' => now()->subDay(),
    ]);

    $this->artisan('data-portability:prune')
        ->expectsOutputToContain('1')
        ->assertSuccessful();
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/PruneDataExportsCommandTest.php`
Expected: FAIL — `The command "data-portability:prune" does not exist.`

- [ ] **Step 3: `src/Console/PruneDataExportsCommand.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Models\DataExport;

final class PruneDataExportsCommand extends Command
{
    protected $signature = 'data-portability:prune';

    protected $description = 'Lejárt adatexportok és fájljaik törlése';

    public function handle(): int
    {
        $retention = (int) config('data-portability.retention_days');
        $disk = Storage::disk((string) config('data-portability.disk'));

        $stale = DataExport::query()
            ->where(fn ($query) => $query
                ->whereNotNull('expires_at')->where('expires_at', '<', now()))
            ->orWhere(fn ($query) => $query
                ->where('status', ExportStatus::Failed)
                ->where('created_at', '<', now()->subDays($retention)))
            ->get();

        foreach ($stale as $export) {
            if ($export->path !== null) {
                $disk->delete($export->path);
            }

            $export->delete();
        }

        $this->info("Törölt export: {$stale->count()}");

        return self::SUCCESS;
    }
}
```

- [ ] **Step 4: Regisztráció és ütemezés a providerben**

A `boot()` metódusba:

```php
        if ($this->app->runningInConsole()) {
            $this->commands([\Madbox99\DataPortability\Console\PruneDataExportsCommand::class]);

            $this->app->booted(function (): void {
                app(\Illuminate\Console\Scheduling\Schedule::class)
                    ->command('data-portability:prune')
                    ->daily();
            });
        }
```

- [ ] **Step 5: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/PruneDataExportsCommandTest.php`
Expected: PASS (4 tests)

- [ ] **Step 6: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: lejárt exportok napi takarítása"
```

---

### Task 12: Filament plugin, panel-oldal és a futási limitek

**Files:**
- Create: `src/DataPortabilityPlugin.php`, `src/Filament/Pages/DataExports.php`, `src/ExportLauncher.php`, `src/Exceptions/ExportLimitReached.php`
- Create: `resources/views/filament/pages/data-exports.blade.php`
- Modify: `src/DataPortabilityServiceProvider.php` (`loadViewsFrom`)
- Test: `tests/Feature/ExportLauncherTest.php`

**Interfaces:**
- Consumes: `DataExport`/`ExportStatus` (3.), `BuildDataExportJob` (9.), `data-portability.daily_limit`, `data-portability.authorize` (1.).
- Produces:
  - `ExportLauncher::launch(Model $team, ?Authenticatable $user): DataExport` — létrehozza a rekordot és dispatch-eli a jobot; `ExportLimitReached`-et dob, ha már fut export vagy betelt a napi keret.
  - `ExportLauncher::canLaunch(Model $team): bool`
  - `DataPortabilityPlugin::make(): static` (Filament `Plugin` implementáció)
  - `Madbox99\DataPortability\Filament\Pages\DataExports` panel-oldal.

- [ ] **Step 1: Írd meg a bukó tesztet**

`tests/Feature/ExportLauncherTest.php`:

```php
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Queue;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Exceptions\ExportLimitReached;
use Madbox99\DataPortability\ExportLauncher;
use Madbox99\DataPortability\Jobs\BuildDataExportJob;
use Madbox99\DataPortability\Models\DataExport;
use Madbox99\DataPortability\Tests\Fixtures\Models\Team;

beforeEach(function (): void {
    Queue::fake();
});

it('creates a pending export and dispatches the job', function (): void {
    $team = Team::create(['name' => 'A']);

    $export = app(ExportLauncher::class)->launch($team, null);

    expect($export->status)->toBe(ExportStatus::Pending)
        ->and($export->team_id)->toBe($team->id);

    Queue::assertPushed(BuildDataExportJob::class);
});

it('refuses a second export while one is already running for the team', function (): void {
    $team = Team::create(['name' => 'A']);
    DataExport::create(['team_id' => $team->id, 'user_id' => 1, 'status' => ExportStatus::Running]);

    app(ExportLauncher::class)->launch($team, null);
})->throws(ExportLimitReached::class);

it('refuses once the daily limit is reached', function (): void {
    config()->set('data-portability.daily_limit', 2);
    $team = Team::create(['name' => 'A']);

    foreach (range(1, 2) as $i) {
        DataExport::create([
            'team_id' => $team->id, 'user_id' => 1, 'status' => ExportStatus::Completed,
        ]);
    }

    app(ExportLauncher::class)->launch($team, null);
})->throws(ExportLimitReached::class);

it('counts only today towards the daily limit', function (): void {
    config()->set('data-portability.daily_limit', 1);
    $team = Team::create(['name' => 'A']);

    DataExport::create([
        'team_id' => $team->id, 'user_id' => 1, 'status' => ExportStatus::Completed,
        'created_at' => now()->subDays(2), 'updated_at' => now()->subDays(2),
    ]);

    expect(app(ExportLauncher::class)->canLaunch($team))->toBeTrue();
});

it('counts limits per team, not globally', function (): void {
    config()->set('data-portability.daily_limit', 1);
    $teamA = Team::create(['name' => 'A']);
    $teamB = Team::create(['name' => 'B']);

    DataExport::create(['team_id' => $teamA->id, 'user_id' => 1, 'status' => ExportStatus::Completed]);

    expect(app(ExportLauncher::class)->canLaunch($teamB))->toBeTrue()
        ->and(app(ExportLauncher::class)->canLaunch($teamA))->toBeFalse();
});
```

- [ ] **Step 2: Futtasd, győződj meg róla, hogy bukik**

Run: `vendor/bin/pest tests/Feature/ExportLauncherTest.php`
Expected: FAIL — `Class "Madbox99\DataPortability\ExportLauncher" not found`

- [ ] **Step 3: `src/Exceptions/ExportLimitReached.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Exceptions;

use RuntimeException;

final class ExportLimitReached extends RuntimeException
{
    public static function alreadyRunning(): self
    {
        return new self(__('Már fut egy export ehhez a csapathoz. Várd meg, amíg elkészül.'));
    }

    public static function dailyLimit(int $limit): self
    {
        return new self(__('Naponta legfeljebb :count exportot lehet indítani.', ['count' => $limit]));
    }
}
```

- [ ] **Step 4: `src/ExportLauncher.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Events\DataExportRequested;
use Madbox99\DataPortability\Exceptions\ExportLimitReached;
use Madbox99\DataPortability\Jobs\BuildDataExportJob;
use Madbox99\DataPortability\Models\DataExport;

final class ExportLauncher
{
    public function launch(Model $team, ?Authenticatable $user): DataExport
    {
        if ($this->hasRunning($team)) {
            throw ExportLimitReached::alreadyRunning();
        }

        $limit = (int) config('data-portability.daily_limit');

        if ($this->todayCount($team) >= $limit) {
            throw ExportLimitReached::dailyLimit($limit);
        }

        $export = DataExport::create([
            'team_id' => $team->getKey(),
            'user_id' => $user?->getAuthIdentifier(),
            'status' => ExportStatus::Pending,
        ]);

        DataExportRequested::dispatch($export);

        BuildDataExportJob::dispatch($export->id);

        return $export;
    }

    public function canLaunch(Model $team): bool
    {
        return ! $this->hasRunning($team)
            && $this->todayCount($team) < (int) config('data-portability.daily_limit');
    }

    private function hasRunning(Model $team): bool
    {
        return DataExport::query()
            ->where('team_id', $team->getKey())
            ->whereIn('status', [ExportStatus::Pending, ExportStatus::Running])
            ->exists();
    }

    private function todayCount(Model $team): int
    {
        return DataExport::query()
            ->where('team_id', $team->getKey())
            ->whereDate('created_at', now()->toDateString())
            ->count();
    }
}
```

- [ ] **Step 5: Futtasd a teszteket**

Run: `vendor/bin/pest tests/Feature/ExportLauncherTest.php`
Expected: PASS (5 tests)

- [ ] **Step 6: `src/Filament/Pages/DataExports.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Filament\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Exceptions\ExportLimitReached;
use Madbox99\DataPortability\ExportLauncher;
use Madbox99\DataPortability\Models\DataExport;

final class DataExports extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'data-portability::filament.pages.data-exports';

    public static function getNavigationLabel(): string
    {
        return __('Adatexport');
    }

    public function getTitle(): string
    {
        return __('Adatexport');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('data-portability.navigation_group');
    }

    public static function canAccess(): bool
    {
        $authorize = config('data-portability.authorize');
        $team = Filament::getTenant();

        if (! is_callable($authorize) || $team === null) {
            return $team !== null;
        }

        return (bool) $authorize(Auth::user(), $team);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label(__('Új export indítása'))
                ->icon('heroicon-o-arrow-down-tray')
                ->requiresConfirmation()
                ->modalDescription(__('A csomag a háttérben készül el. Értesítést kapsz, amint letölthető.'))
                ->action(function (): void {
                    try {
                        app(ExportLauncher::class)->launch(Filament::getTenant(), Auth::user());
                    } catch (ExportLimitReached $exception) {
                        \Filament\Notifications\Notification::make()
                            ->title($exception->getMessage())
                            ->warning()
                            ->send();

                        return;
                    }

                    \Filament\Notifications\Notification::make()
                        ->title(__('Az export elindult'))
                        ->success()
                        ->send();
                }),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                DataExport::query()
                    ->where('team_id', Filament::getTenant()?->getKey())
                    ->latest(),
            )
            ->columns([
                TextColumn::make('created_at')->label(__('Indítva'))->dateTime('Y-m-d H:i'),
                TextColumn::make('status')
                    ->label(__('Állapot'))
                    ->badge()
                    ->formatStateUsing(fn (ExportStatus $state): string => match ($state) {
                        ExportStatus::Pending => __('Várakozik'),
                        ExportStatus::Running => __('Készül'),
                        ExportStatus::Completed => __('Kész'),
                        ExportStatus::Failed => __('Hiba'),
                    })
                    ->color(fn (ExportStatus $state): string => match ($state) {
                        ExportStatus::Completed => 'success',
                        ExportStatus::Failed => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('size_bytes')
                    ->label(__('Méret'))
                    ->formatStateUsing(fn (?int $state): string => $state === null ? '—' : number_format($state / 1048576, 1).' MB'),
                TextColumn::make('expires_at')->label(__('Lejár'))->dateTime('Y-m-d H:i')->placeholder('—'),
            ])
            ->recordActions([
                Action::make('download')
                    ->label(__('Letöltés'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn (DataExport $record): bool => $record->isDownloadable())
                    ->url(fn (DataExport $record): string => route('data-portability.download', $record))
                    ->openUrlInNewTab(),
            ])
            ->poll('10s');
    }
}
```

- [ ] **Step 7: A nézet és a plugin**

`resources/views/filament/pages/data-exports.blade.php`:

```blade
<x-filament-panels::page>
    <div class="fi-section-content-ctn">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('Az export a csapatod teljes adatállományát tartalmazza JSON és CSV formátumban, a feltöltött fájlokkal együtt. A csomag :days napig érhető el.', ['days' => config('data-portability.retention_days')]) }}
        </p>
    </div>

    {{ $this->table }}
</x-filament-panels::page>
```

`src/DataPortabilityPlugin.php`:

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Madbox99\DataPortability\Filament\Pages\DataExports;

final class DataPortabilityPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'data-portability';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([DataExports::class]);
    }

    public function boot(Panel $panel): void {}
}
```

A provider `boot()`-jába:

```php
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'data-portability');
```

- [ ] **Step 8: Futtasd a teljes suite-ot**

Run: `vendor/bin/pest`
Expected: PASS

- [ ] **Step 9: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: Filament plugin, panel-oldal és indítási limitek"
```

---

### Task 13: Architektúra-teszt, opcionális activitylog, csomag-dokumentáció

**Files:**
- Create: `tests/Unit/ArchitectureTest.php`, `src/Listeners/LogDataExportActivity.php`
- Create: `README.md`, `CHANGELOG.md`
- Modify: `src/DataPortabilityServiceProvider.php` (feltételes listener)

**Interfaces:**
- Consumes: az összes korábbi feladat.
- Produces: `LogDataExportActivity` (csak akkor aktív, ha a `spatie/laravel-activitylog` telepítve van).

- [ ] **Step 1: Írd meg az architektúra-tesztet**

`tests/Unit/ArchitectureTest.php`:

```php
<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;

it('never references the host application namespace', function (): void {
    $offenders = [];

    foreach (Finder::create()->files()->in(__DIR__.'/../../src')->name('*.php') as $file) {
        if (preg_match('/(?<![A-Za-z_])App\\\\/', (string) file_get_contents($file->getRealPath())) === 1) {
            $offenders[] = $file->getRelativePathname();
        }
    }

    expect($offenders)->toBe([]);
});

it('does not hard-depend on spatie activitylog', function (): void {
    $composer = json_decode((string) file_get_contents(__DIR__.'/../../composer.json'), true);

    expect($composer['require'])->not->toHaveKey('spatie/laravel-activitylog');
});
```

- [ ] **Step 2: Futtasd**

Run: `vendor/bin/pest tests/Unit/ArchitectureTest.php`
Expected: PASS (2 tests). Ha bukik, a `src/` alatt van `App\` hivatkozás — javítsd, ne a tesztet lazítsd.

- [ ] **Step 3: `src/Listeners/LogDataExportActivity.php`**

```php
<?php

declare(strict_types=1);

namespace Madbox99\DataPortability\Listeners;

use Madbox99\DataPortability\Events\DataExportCompleted;
use Madbox99\DataPortability\Events\DataExportFailed;
use Madbox99\DataPortability\Events\DataExportRequested;

final class LogDataExportActivity
{
    public function handle(DataExportRequested|DataExportCompleted|DataExportFailed $event): void
    {
        $description = match (true) {
            $event instanceof DataExportRequested => 'adatexport igényelve',
            $event instanceof DataExportCompleted => 'adatexport elkészült',
            $event instanceof DataExportFailed => 'adatexport meghiúsult',
        };

        activity()
            ->performedOn($event->export)
            ->withProperties([
                'team_id' => $event->export->team_id,
                'user_id' => $event->export->user_id,
            ])
            ->log($description);
    }
}
```

- [ ] **Step 4: Feltételes regisztráció a providerben**

A `boot()` metódusba:

```php
        if (class_exists(\Spatie\Activitylog\ActivitylogServiceProvider::class)) {
            \Illuminate\Support\Facades\Event::listen([
                \Madbox99\DataPortability\Events\DataExportRequested::class,
                \Madbox99\DataPortability\Events\DataExportCompleted::class,
                \Madbox99\DataPortability\Events\DataExportFailed::class,
            ], \Madbox99\DataPortability\Listeners\LogDataExportActivity::class);
        }
```

- [ ] **Step 5: `README.md` (a csomagé, magyarul)**

Írd meg az alábbi szakaszokkal, mindegyikhez futtatható példával:
`Telepítés` (composer require, `php artisan vendor:publish --tag=data-portability-config`, `php artisan migrate`) ·
`Konfiguráció` (a `tenant_model` és `tenant_binding` kötelező, példa a `crm`-ből) ·
`A regiszter` (`DataPortability::register(...)` teljes példa, `through()` magyarázattal) ·
`A panelbe kötés` (`->plugin(DataPortabilityPlugin::make())`) ·
`A két tenant-őr` (mit véd, mikor dob, miért nem elhagyható) ·
`A ZIP szerkezete` (a `manifest.json` mezői) ·
`Queue` (a job az `exports` queue-n fut, Horizon-konfiguráció szükséges).

`CHANGELOG.md`: `## 1.0.0 — 2026-08-05` és az első kiadás tartalma.

- [ ] **Step 6: Futtasd a teljes suite-ot**

Run: `vendor/bin/pest`
Expected: PASS

- [ ] **Step 7: Lint és commit**

```bash
vendor/bin/pint
git add -A
git commit -m "feat: architektúra-teszt, opcionális activitylog és dokumentáció"
git tag v1.0.0
```

---

### Task 14: `crm` pilot

**Files:**
- Modify: `~/Herd/crm/composer.json` (path repository + require)
- Create: `~/Herd/crm/config/data-portability.php`
- Create: `~/Herd/crm/app/Providers/DataPortabilityServiceProvider.php`
- Modify: `~/Herd/crm/bootstrap/providers.php`
- Modify: `~/Herd/crm/app/Providers/Filament/AdminPanelServiceProvider.php:40-100` (plugin bekötés)
- Test: `~/Herd/crm/tests/Feature/DataPortabilityTest.php`

**Interfaces:**
- Consumes: a csomag teljes felülete (1–13. feladat).
- Produces: működő `Adatexport` oldal a `crm` admin paneljében.

- [ ] **Step 1: A csomag bekötése path-repóként**

A `~/Herd/crm/composer.json`-be:

```json
    "repositories": [
        { "type": "path", "url": "../filament-data-portability", "options": { "symlink": true } }
    ]
```

Majd:

```bash
cd ~/Herd/crm
composer require madbox-99/filament-data-portability:@dev
php artisan vendor:publish --tag=data-portability-config
php artisan migrate
```

- [ ] **Step 2: `config/data-portability.php` kitöltése**

A publikált fájlban csak ezt a két kulcsot kell átírni:

```php
    'tenant_model' => App\Models\Team::class,
    'tenant_binding' => App\Models\Team::CONTAINER_BINDING,
    'navigation_group' => App\Enums\NavigationGroup::Settings->value,
```

- [ ] **Step 3: A regiszter provider**

`app/Providers/DataPortabilityServiceProvider.php`:

```php
<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Campaign;
use App\Models\CampaignResponse;
use App\Models\Complaint;
use App\Models\ComplaintEscalation;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerContact;
use App\Models\Discount;
use App\Models\EmailTemplate;
use App\Models\Interaction;
use App\Models\Invoice;
use App\Models\Opportunity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Madbox99\DataPortability\Exportable;
use Madbox99\DataPortability\Facades\DataPortability;

final class DataPortabilityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        DataPortability::register(
            // Saját team_id-vel rendelkező, ügyfél-adatot hordozó modellek
            Exportable::model(Customer::class)->label('Ügyfelek'),
            Exportable::model(CustomerContact::class)->label('Kapcsolattartók'),
            Exportable::model(Interaction::class)->label('Interakciók'),
            Exportable::model(Opportunity::class)->label('Lehetőségek'),
            Exportable::model(Quote::class)->label('Árajánlatok'),
            Exportable::model(Order::class)->label('Rendelések'),
            Exportable::model(Invoice::class)->label('Számlák')
                ->files(fn (Invoice $invoice): array => (array) ($invoice->files ?? [])),
            Exportable::model(Product::class)->label('Termékek'),
            Exportable::model(ProductCategory::class)->label('Termékkategóriák'),
            Exportable::model(Discount::class)->label('Kedvezmények'),
            Exportable::model(Task::class)->label('Feladatok'),
            Exportable::model(Complaint::class)->label('Reklamációk'),
            Exportable::model(SupportTicket::class)->label('Support jegyek'),
            Exportable::model(Campaign::class)->label('Kampányok'),
            Exportable::model(EmailTemplate::class)->label('E-mail sablonok'),

            // Team-oszlop nélküli, szülőn keresztül tartozó modellek
            Exportable::model(QuoteItem::class)->label('Árajánlat-tételek')->through('quote'),
            Exportable::model(OrderItem::class)->label('Rendelés-tételek')->through('order'),
            Exportable::model(CustomerAddress::class)->label('Ügyfél-címek')->through('customer'),
            Exportable::model(ComplaintEscalation::class)->label('Reklamáció-eszkalációk')->through('complaint'),
            Exportable::model(SupportTicketMessage::class)->label('Support üzenetek')->through('supportTicket'),
            Exportable::model(CampaignResponse::class)->label('Kampány-válaszok')->through('campaign'),
        );
    }
}
```

**Szándékosan kimaradnak** (belső működési adat, nem ügyfél-adat): `AiUsageLog`, `BugReport`, `ChatMessage`, `ChatSession`, `GoogleCalendarToken`, `LeadScore`, `TeamSetting`, `WorkflowConfig`, `CustomerConsent`, `CustomFieldValue`, `CustomField`, `CustomerAttribute`.

Ellenőrizd a `through()` relációneveket a modellekben, mielőtt futtatod — ha egy reláció más néven van (pl. `ticket` a `supportTicket` helyett), a `whereHas` kivételt dob.

Vedd fel a `bootstrap/providers.php`-be:

```php
    App\Providers\DataPortabilityServiceProvider::class,
```

- [ ] **Step 4: A plugin bekötése a panelbe**

A `app/Providers/Filament/AdminPanelServiceProvider.php` `panel()` metódusában, a `->databaseNotifications()` sor után:

```php
            ->plugin(\Madbox99\DataPortability\DataPortabilityPlugin::make())
```

- [ ] **Step 5: Írd meg az app-oldali tesztet**

`~/Herd/crm/tests/Feature/DataPortabilityTest.php`:

```php
<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Madbox99\DataPortability\Enums\ExportStatus;
use Madbox99\DataPortability\Jobs\BuildDataExportJob;
use Madbox99\DataPortability\Models\DataExport;

it('exports only the requesting team from the real crm schema', function (): void {
    Storage::fake('data-exports');

    $teamA = Team::factory()->create();
    $teamB = Team::factory()->create();

    app()->instance(Team::CONTAINER_BINDING, $teamA);
    Customer::factory()->create(['name' => 'A ügyfele']);

    app()->instance(Team::CONTAINER_BINDING, $teamB);
    Customer::factory()->create(['name' => 'B ügyfele']);

    app()->forgetInstance(Team::CONTAINER_BINDING);

    $export = DataExport::create(['team_id' => $teamA->id, 'user_id' => null]);

    (new BuildDataExportJob($export->id))->handle(
        app(Madbox99\DataPortability\TenantContext::class),
        app(Madbox99\DataPortability\ExportRegistry::class),
        app(Madbox99\DataPortability\Writers\ArchiveBuilder::class),
    );

    $export->refresh();

    $zip = new ZipArchive;
    $zip->open(Storage::disk('data-exports')->path($export->path));
    $customers = (string) $zip->getFromName('data/customers.jsonl');
    $zip->close();

    expect($export->status)->toBe(ExportStatus::Completed)
        ->and($customers)->toContain('A ügyfele')
        ->and($customers)->not->toContain('B ügyfele');
});

it('registers every exportable model with a resolvable table', function (): void {
    foreach (Madbox99\DataPortability\Facades\DataPortability::all() as $key => $exportable) {
        expect($exportable->columns())->not->toBeEmpty("A(z) [{$key}] tábla oszlopai nem oldhatók fel.");
    }
});
```

- [ ] **Step 6: Futtasd**

Run: `cd ~/Herd/crm && php artisan test --filter=DataPortability`
Expected: PASS (2 tests)

- [ ] **Step 7: Nézd meg élőben**

```bash
cd ~/Herd/crm
php artisan queue:work --queue=exports --once
```

Nyisd meg a panelben az `Adatexport` oldalt, indíts egy exportot, és töltsd le a ZIP-et. Ellenőrizd a `manifest.json`-t és azt, hogy a `data/customers.jsonl` sorai a saját csapatodhoz tartoznak.

- [ ] **Step 8: Commit**

```bash
cd ~/Herd/crm
git checkout -b feat/data-portability
git add -A
git commit -m "feat: csapat-szintű adatexport a Filament panelben"
```

---

## Bevezetés a többi appra

A 14. feladat mintája ismételhető appnként: path-repó helyett Packagist/privát repó, `config/data-portability.php` két kulcsa, egy saját `DataPortabilityServiceProvider` a regiszterrel, egy sor a panel providerben, és az app-oldali szivárgás-teszt. Minden app saját PR-t kap.
