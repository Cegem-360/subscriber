# Csapat-szintű adathordozhatóság a receiver appokban — Design

**Dátum:** 2026-08-05
**Állapot:** jóváhagyva (implementáció előtt)
**Érintett repók:** új csomag (`madbox-99/filament-data-portability`) + a Filament v5-ös receiver appok. Pilot: `crm`.

## Cél

Az ügyfél a saját Filament paneljéből, egy gombnyomással letölthesse a **teljes
csapat-adatállományát** egy géppel is feldolgozható csomagban, amit később más
rendszerbe tud portolni. Nem SQL dump: strukturált, dokumentált,
csapat-szűrt adatexport.

Ma erre nincs eszköz. Ami van: appnként néhány Filament `Exporter` osztály
(a `crm`-ben 12 db az `app/Filament/Exports/` alatt), ezek táblánként, CSV/XLSX-be,
megjelenítésre formázott értékekkel exportálnak.

## Piaci körkép (miért saját csomag)

| Csomag | Mit ad | Miért nem elég |
| --- | --- | --- |
| Filament beépített `Exporter` (v3.2+) | táblánként CSV/XLSX, oszlopválasztó, queued job batch | egy resource egyszerre; megjelenítésre formázott értékek; a batch a `notifications` táblába dolgozik, nem ZIP-be |
| `spatie/laravel-personal-data-export` (v4.3.2) | ZIP, nem publikus disk, auth-olt letöltés, e-mailes link, queued job | a `User` modellre kötött: a ZIP tulajdonosa és a letöltési jog user-alapú. Nálunk a **csapat** a tulajdonos, és cégadatot exportálunk, nem személyes adatot. A panel-oldal + saját történet + saját retenció döntés után pont az a rétege maradna ki, ami az értéke |
| `ryangjchandler/filament-data-studio`, `alperenersoy/filament-export` | tábla-szintű export/nyomtatás | ugyanaz a szint, mint a beépített |

**Döntés:** önálló, vékony csomag saját export-motorral. A `spatie` csomagot nem
használjuk (kényszerzubbony a user-központú modellje miatt), a meglévő Filament
`Exporter` osztályokat nem váltjuk ki (más a céljuk).

## Döntések (brainstormingból)

- **Terjedelem:** explicit modell-regiszter appnként. Nem automatikus felderítés —
  új modell soha ne kerüljön ki magától.
- **Formátum:** JSON + CSV egy ZIP-ben, `manifest.json`-nal. A JSONL a kanonikus
  (nyers értékek, megőrzött `id`/`uuid`/FK), a CSV az Excel-barát nézet.
- **Fájlok:** a feltöltött fájlok bekerülnek a ZIP-be, konfigurálható
  méretkorláttal. A limit felett a job **nem hasal el**, hanem a manifestbe írja,
  mi maradt ki és miért.
- **Jogosultság:** **bármely belépett csapattag** indíthat exportot.
  *Kockázat, tudatosan vállalva:* ez minden alkalmazottnak egykattintásos teljes
  csapat-adatmásolatot ad. Ellensúlyok: esemény-alapú audit, futó/napi limit, és
  a küszöb config-closure mögött ül, hogy egy app kódmódosítás nélkül szigoríthasson.
- **Kézbesítés:** panelen belüli listás oldal + Filament DB-notification.
  Nem megy ki adat e-mailben. 7 napos retenció.
- **A ZIP-en belüli leíró fájl (`README.md`) angol nyelvű.** A panel UI és a
  regiszter címkéi magyarok maradnak.
- **Hatókör:** a Filament v5 / Laravel 13 / PHP ≥8.3 receiver appok. A `navigator`
  kimarad (Laravel 12, nincs Filament a `require`-ben).

## Architektúra

### Csomag-határ

`madbox-99/filament-data-portability`, constraint: `php:^8.3`,
`filament/filament:^5.0`, `illuminate/contracts:^13.0`.

A csomag **nem hivatkozik semmilyen `App\` osztályra** — sem `App\Models\Team`-re,
sem a `TeamScope`-ra. Az app-specifikus kötések configból jönnek:

```php
// config/data-portability.php
'tenant_model'   => App\Models\Team::class,
'tenant_binding' => App\Models\Team::CONTAINER_BINDING,  // 'current_team' a crm-ben
'disk'           => 'data-exports',
'retention_days' => 7,
'file_limit'     => 2 * 1024 * 1024 * 1024,
'daily_limit'    => 3,
'authorize'      => fn ($user, $team): bool => $user->canAccessTenant($team),
```

Indok: a `Team::CONTAINER_BINDING` app-szintű konstans, a tenant modell osztálya
appnként más.

### Osztályok

| Osztály | Felelősség |
| --- | --- |
| `DataPortabilityPlugin` | Filament plugin: panel-oldal regisztráció |
| `Exportable` | fluent modell-definíció (címke, kizárt oszlopok, fájlok, team-feloldó) |
| `ExportRegistry` | a regisztrált `Exportable`-ök tára |
| `DataExport` | Eloquent modell + migráció (az export rekordja) |
| `BuildDataExportJob` | a teljes export előállítása |
| `PruneDataExportsCommand` | lejárt exportok törlése |

### A regiszter API

Appnként egy service providerben:

```php
DataPortability::register(
    Exportable::model(Customer::class)
        ->label('Ügyfelek')
        ->files(fn (Customer $c): array => array_filter([$c->logo_path])),

    Exportable::model(Invoice::class)->label('Számlák'),
    Exportable::model(Task::class)->label('Feladatok')->except(['internal_note']),
);
```

**Oszlopok:** alapértelmezésben mind kimegy, mínusz a modell `$hidden`-je, mínusz
a csomag-szintű tiltólista (`password`, `remember_token`, `two_factor_*`,
`*_secret`, `*_token`). A *modelleket* sorolja fel az app explicit módon, az
oszlopokat nem: egy új mező magától bekerül, egy új **modell** viszont soha nem
szivárog ki magától.

**Nincs beágyazott reláció.** Minden modell külön táblaként megy ki, az
`id`/`uuid` és minden idegen kulcs nyers, változatlan értékkel. A kapcsolatokat a
`manifest.json` írja le (`Schema::getForeignKeys()`-ből), így a fogadó rendszer
újra tudja építeni őket.

## Adatfolyam

Egyetlen queued job (`BuildDataExportJob`) a dedikált `exports` queue-n,
`tries = 1`, `timeout = 3600`. Nem batch: párhuzamos worker-ek nem osztoznának a
temp könyvtáron, egy job viszont konstans memóriával végigstreamel.

1. **Team bekötése:** `app()->instance($binding, $team)` — ettől a meglévő
   `TeamScope` minden regisztrált modellen szűr, egyetlen kézzel írt `where()`
   nélkül.
2. **Írás modellenként:** `lazyById(1000)`; soronként egy JSONL-sor (cast-olt,
   nyers értékek) és egy CSV-sor. A CSV fejléce a sémából jön
   (`Schema::getColumnListing()` mínusz tiltólista) — fix és determinisztikus,
   nem kell sorokat pufferelni.
3. **Fájlok:** a deklarált fájlok másolása `files/<tábla>/<id>/` alá, futó
   bájt-számlálóval a `file_limit` ellen.
4. **Csomagolás:** `ZipArchive` a lokális temp könyvtárból
   (`storage/app/private/exports/tmp/<ulid>`), majd mozgatás a `data-exports`
   diskre. A temp könyvtár `finally` ágban törlődik.

### A ZIP tartalma

```
manifest.json      séma, sorszámok, FK-kapcsolatok, kihagyott fájlok, app- és exportverzió
README.md          angol nyelvű leírás a szerkezetről
data/*.jsonl       kanonikus
csv/*.csv          Excel-barát
files/<tábla>/<id>/<fájl>
```

## A tenant-szivárgás elleni két őr

Ez a design legveszélyesebb pontja: **ha a container-binding elmarad vagy a
config kulcs elgépelt, a `TeamScope` némán kikapcsol, és az export minden csapat
adatát tartalmazza.** Csendes, katasztrofális hiba. Két, egymástól független őr:

1. **Indításkor:** `app()->bound($binding)`, és a feloldott példány kulcsa
   `=== $teamId`. Különben a job elhasal, mielőtt egy sort is írna.
2. **Soronként:** minden kiírt rekordból kiolvassuk a csapat-azonosítót.
   Alapértelmezett feloldó: `team_id`. A `TeamThroughScope`-os modelleknél a
   regiszterben **kötelező** a `->teamVia(fn ($m) => $m->customer?->team_id)`.
   Eltérés vagy `null` → `TenantLeakDetected`, az egész export megszakad, a
   részleges ZIP törlődik.

A soronkénti ellenőrzés költsége egy egész-összehasonlítás. A második őr akkor is
fog, ha valaki később elront egy globális scope-ot.

## UI, tárolás, biztonság

- **Panel-oldal (`Adatexport`):** „Új export" gomb, alatta a korábbi exportok
  táblája — mikor, ki indította, státusz, méret, sorszám, lejárat, letöltés.
  Elkészültkor Filament DB-notification az indítónak.
- **Limitek:** csapatonként egyszerre **egy** futó export, és napi `daily_limit`
  (default 3). Ez védi a queue-t is.
- **Audit:** a csomag `DataExportRequested` / `DataExportCompleted` /
  `DataExportDownloaded` eseményeket dob. Activitylog-listenert **csak akkor**
  regisztrál, ha a `spatie/laravel-activitylog` osztály létezik — a `mes` és a
  `controling` nem használja, a csomag nem függhet tőle.
- **Tárolás:** nem publikus `data-exports` disk,
  `storage/app/private/data-exports/<team-uuid>/<ulid>.zip`.
- **Letöltés:** auth-olt route, `Storage::download`, három feltétel: a rekord a
  belépő csapatáé, a státusz `completed`, és nem járt le.
- **Retenció:** `expires_at = +7 nap`; napi `data-portability:prune` command
  törli a fájlt és a sort.

### `data_exports` tábla

`id`, `uuid`, `team_id`, `user_id`, `status` (pending/running/completed/failed),
`path`, `size_bytes`, `row_counts` (json), `error`, `started_at`, `completed_at`,
`expires_at`, `downloaded_at`, `download_count`.

## Hibakezelés

A `failed()` törli a temp könyvtárat és a részleges ZIP-et, a `DataExport`
`failed` státuszba megy rövid, nem szivárogtató indoklással. A letöltő route
**csak `completed` státuszú** rekordot szolgál ki — részleges csomag sosem jut ki.

A `file_limit` túllépése **nem hiba**: a job befejeződik, a manifest sorolja fel a
kihagyott fájlokat.

## Tesztelés (Pest v4)

**A központi teszt:** két csapat feltöltött adatbázisán lefuttatjuk az A csapat
exportját, és állítjuk, hogy a ZIP egyetlen sora sem tartozik B-hez.

**Két őr-teszt, ami mutációval igazolja magát:**
- a container-binding kiszedésével a job elhasal (1. őr),
- becsempészett idegen sorra `TenantLeakDetected` dobódik (2. őr).

Ha bármelyik őr kikerül a kódból, a hozzá tartozó teszt piros lesz.

**További fedezet:** sorszám-egyezés JSONL és CSV között; fájllimit túllépésekor a
manifest tartalma; hibás job után nem marad temp és nem letölthető részleges ZIP;
idegen csapat tagja 403-at kap a letöltésen; lejárt export 404-et; napi limit és
az egyidejűség-korlát.

**Architektúra-teszt:** a csomag soha nem hivatkozik `App\` névtérre.

## Bevezetés

1. Csomag megírása, saját teszt-suite-tal.
2. Pilot a `crm`-ben (ugyanaz a minta, ami az SSO 3. fázisánál bevált).
3. Kiterjesztés a többi Filament v5-ös receiver appra, appnként saját regiszterrel.

## Kívül marad

- Adat-**import** (a másik irányba portolás).
- Ütemezett/ismétlődő export.
- A `navigator` app.
- Publisher-oldali (`subscriber`) export.
