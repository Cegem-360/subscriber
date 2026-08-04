# Receiver appok jogi linkjei a cegem360.eu-ra — Design

**Dátum:** 2026-08-04
**Állapot:** jóváhagyva (implementáció előtt)
**Érintett repók:** 10 aktív receiver app (nem a `subscriber` publisher)

## Cél

A `subscriber` publisherre (`cegem360.eu`) csatlakozó aktív receiver appokban
minden ÁSZF-, adatvédelmi és cookie-link a `cegem360.eu` központi jogi oldalaira
mutasson. Ma ezek túlnyomó része halott `href="#"`, egy app pedig saját,
duplikált adatvédelmi szöveget szolgál ki.

## Döntések (brainstormingból)

- **Kanonikus ÁSZF URL:** `https://cegem360.eu/szolgaltatasi-feltetelek`. Ez a
  valódi, teljes ÁSZF (h1 „Általános Szerződési Feltételek", Preambulum,
  Fogalommeghatározás, Szerződés tárgya…). A publisher
  `/altalanos-szerzodesi-feltetelek` route-ja egy legacy `Route::view`, ami az
  üres `privacy-policy` blade-et adja vissza — **nem** erre linkelünk.
- **Bekötés módja:** beégetett abszolút URL a blade-ekben. Nem készül
  `config/legal.php` és nem bővül a `laravel-user-team-sync` csomag. Indok: ez
  pontosan a 8 appban már meglévő `home.blade.php` jogi sáv gyakorlata, és nem
  igényel csomag-release-t + `composer` kört 10 appon.
- **Saját jogi oldalak:** 301 redirecttel a központi oldalra irányítva, a route
  neve megtartva. Duplikált jogi szöveg nem maradhat az appokban, mert elavulhat
  a központihoz képest.
- **Hatókör:** a `sync_apps` táblában `is_active = 1` appok közül 10. Kimarad az
  `anest` (a felhasználó kérésére) és az összes inaktív app (`chat`, `data-mind`,
  5 db `tothpaszomany.*`).
- **Cookie-linkek is bekerültek** a scope-ba: ugyanabban a footer-blokkban, a
  másik kettő melletti sorban állnak, külön körben dupla munka lenne.
- **Kívül marad:** a `mes` footerének halott Impresszum linkje, és a publisher
  `/altalanos-szerzodesi-feltetelek` csonk-route-ja.

## Cél-URL-ek

| Címke | URL | élő ellenőrizve |
| --- | --- | --- |
| ÁSZF / Terms of Service | `https://cegem360.eu/szolgaltatasi-feltetelek` | 200 |
| Adatvédelem / Privacy Policy | `https://cegem360.eu/adatvedelmi-tajekoztato` | 200 |
| Cookie szabályzat / Cookie Policy | `https://cegem360.eu/cookie-beallitasok` | 200 |

## Link-minta

Két eset, szándékosan eltérő:

- **Footer / landing jogi sáv:** sima abszolút link, `target` nélkül. Ez egyezik
  a 8 appban már meglévő `home.blade.php` jogi sávval, tehát ugyanaz a
  viselkedés az oldal két pontján.
- **Filament regisztrációs oldal** (`filament/pages/auth/register.blade.php`):
  `target="_blank" rel="noopener noreferrer"`. Itt a felhasználó félig kitöltött
  űrlapon áll; az elnavigálás elvesztené a beírt adatait.

A `class` és `style` attribútumok, valamint a címkék (`{{ __('Terms of Service') }}`,
`{{ __('Privacy Policy') }}`, `{{ __('Cookie Policy') }}`, illetve a `mes`-ben a
hardcoded „ÁSZF" / „Adatvédelem" / „Cookie szabályzat") **változatlanok maradnak**.
Kizárólag a `href` értéke cserélődik. Új fordítási kulcs nem keletkezik.

## Érintett helyek apponként

A sorszámok a jelenlegi `main` állapotra vonatkoznak. Minden felsorolt link ma
`href="#"`, kivéve ahol külön jelezve van.

| App (repó) | Fájl | Sorok | Linkek |
| --- | --- | --- | --- |
| `controling` | `components/layouts/footer.blade.php` | 123, 125, 127 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `marketinghub` | `components/layouts/footer.blade.php` | 124, 126, 128 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `crm` | `components/layouts/footer.blade.php` | 151, **153**, 155 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| | `routes/web.php` | 14 | saját route → 301 |
| `crm-and-contacts` | `home.blade.php` | 1157, 1159, 1161 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `stat-analitics` | `components/layouts/footer.blade.php` | 114, 116, 118 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `workflow` | `components/layouts/footer.blade.php` | 121, 123, 125 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `Storage-cms` | `components/layouts/footer.blade.php` | 89, 90, 91 (lista) | ÁSZF, adatvédelem, cookie |
| | `components/layouts/footer.blade.php` | 123, 125, 127 (alsó sáv) | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `worksheet` | `components/landing/footer.blade.php` | 126, 128, 130 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `pirometer` | `components/landing/footer.blade.php` | 126, 128, 130 | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |
| `mes` | `components/layouts/footer.blade.php` | 89, 90, 91 (lista) | ÁSZF, adatvédelem, cookie |
| | `components/layouts/footer.blade.php` | 123, 125, 127 (alsó sáv) | ÁSZF, adatvédelem, cookie |
| | `filament/pages/auth/register.blade.php` | 22, 24 | ÁSZF, adatvédelem |

**Összesen 56 link** cseréje (44 ÁSZF/adatvédelem + 12 cookie). Új link nem
keletkezik, minden érintett hely már létezik.

### Két kivétel a `href="#"` mintából

- `crm` footer:153 — ma `{{ route('privacy-policy') }}`, tehát a helyi oldalra
  mutat. Ezt is abszolút URL-re cseréljük.
- `crm-and-contacts` — nincs külön footer komponens, a lábléc a
  `home.blade.php`-ba van beágyazva.

## `crm` — 301 redirect

`crm/routes/web.php:14` jelenleg:

```php
Route::get('/adatkezelesi-tajekoztato', fn (): Factory|View => view('privacy-policy'))->name('privacy-policy');
```

Helyette:

```php
Route::redirect('/adatkezelesi-tajekoztato', 'https://cegem360.eu/adatvedelmi-tajekoztato', 301)
    ->name('privacy-policy');
```

A route neve megmarad, így semmilyen `route('privacy-policy')` hívás nem törik el.
A `crm/resources/views/privacy-policy.blade.php` törlődik. A `routes/web.php`
tetején feleslegessé váló `Factory` / `View` importokat el kell távolítani, ha
más route nem használja őket.

Ez az egyetlen receiver, amelyben duplikált jogi szöveg volt.

## Ami már rendben van — nem módosul

8 app `home.blade.php`-jában a jogi sáv már pontosan az ÁSZF és az adatvédelmi
URL-re mutat
(`crm` 849/851, `marketinghub` 992/994, `crm-and-contacts` 1030/1032,
`stat-analitics` 867/869, `workflow` 1161/1163, `Storage-cms` 738/740,
`worksheet` 1055/1057, `mes` 1006/1008). Ezek a minta, nem nyúlunk hozzájuk.

Figyelem: a `crm-and-contacts`-ban a `home.blade.php` **két külön** jogi blokkot
tartalmaz — az 1030/1032 sávot (már jó) és az 1157–1161 láblécet (javítandó).

## Ellenőrzés

Statikus, appon belül:

1. `grep -rn 'href="#"' resources/views --include="*.blade.php"` a jogi címkék
   mellett **0 találat** legyen (kivéve a `mes` footer:92 Impresszum, ami
   szándékosan kimarad).
2. `vendor/bin/pint --dirty --format agent` a `crm`-ben, mert ott PHP is módosul.
3. A `crm`-ben Pest feature teszt: `/adatkezelesi-tajekoztato` 301-et ad a
   `https://cegem360.eu/adatvedelmi-tajekoztato` címre.

Deploy után, élesben:

4. Mind a 10 domain kezdőlapján `curl` + `grep`: mindhárom abszolút URL
   megjelenik a HTML-ben. (9 appban a footer komponensen keresztül —
   `<x-layouts.footer />` vagy `<x-landing.footer />` —, a `crm-and-contacts`-ban
   a `home.blade.php`-ba ágyazott láblécből.)
5. `curl -sI https://crm.cegem360.eu/adatkezelesi-tajekoztato` → `301` +
   helyes `Location`.

## Kiszállítás

Repónként egy commit a `main`-en, csak a jogi fájlok stage-elve. A négy
„dirty" repóban (`controling`, `crm`, `Storage-cms`, `mes`) kizárólag
**untracked** fájlok vannak — nincs félkész, tracked módosítás, tehát a
szelektív `git add` biztonságos. A `crm` `.worktrees/sso-phase-3` worktree-jéhez
nem nyúlunk.

Push → Forge Quick Deploy, zero-downtime. A blade-változások nem igényelnek
`npm run build`-ot, mert nem keletkezik új Tailwind osztály — minden használt
class már szerepel a szomszédos linkeken.
