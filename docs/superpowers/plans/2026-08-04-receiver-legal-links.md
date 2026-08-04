# Receiver appok jogi linkjei — Implementációs terv

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** A 10 aktív receiver appban minden ÁSZF-, adatvédelmi és cookie-link a `cegem360.eu` központi jogi oldalaira mutasson, és a `crm` saját adatvédelmi oldala 301-gyel odairányítson.

**Architecture:** Beégetett abszolút URL-ek a blade sablonokban — nincs új config, nincs csomag-változás. Appokként egy Pest feature teszt őrzi, hogy a jogi címkék mellett ne maradhasson halott `href="#"`, és hogy mindhárom kanonikus URL jelen legyen. A `crm`-ben a duplikált helyi jogi oldal helyére 301-es redirect kerül.

**Tech Stack:** Laravel 12/13, Blade, Filament v4/v5, Pest v3/v4, Laravel Forge Quick Deploy (zero-downtime).

**Spec:** `docs/superpowers/specs/2026-08-04-receiver-legal-links-design.md` (a `subscriber` repóban)

## Global Constraints

- **Kanonikus URL-ek, betű szerint, mindenhol:**
  - ÁSZF / Terms of Service → `https://cegem360.eu/szolgaltatasi-feltetelek`
  - Adatvédelem / Privacy Policy → `https://cegem360.eu/adatvedelmi-tajekoztato`
  - Cookie szabályzat / Cookie Policy → `https://cegem360.eu/cookie-beallitasok`
- **Csak a `href` attribútum értéke változik.** A `class`, `style` attribútumok, a címkék és a sor behúzása változatlan marad. Nem keletkezik új fordítási kulcs, nem keletkezik új Tailwind osztály.
- **Footer és landing linkek:** `target` attribútum nélkül.
- **Filament regisztrációs oldal linkjei:** `target="_blank" rel="noopener noreferrer"` — a félig kitöltött űrlap ne vesszen el.
- **Hatókör:** 10 repó. Az `anest` és minden inaktív app (`chat`, `data-mind`, `tothpaszomany.*`) **kimarad**.
- **A `mes` footerének Impresszum linkje (`footer.blade.php:92`) szándékosan halott marad** — nincs a scope-ban.
- Minden PHP fájl `declare(strict_types=1);`-tal kezdődik.
- Minden repóban `main` branchre megy a commit, és a push indítja a Forge Quick Deployt. **A tervben egyetlen taszk sem pushol** — a push a záró taszkban, egyben történik, hogy egy hibás edit ne menjen élesbe.
- A négy „dirty" repóban (`controling`, `crm`, `Storage-cms`, `mes`) csak untracked fájlok vannak; **kizárólag szelektív `git add`-et használj**, soha `git add -A`-t.

---

## A transzformáció mintája

Minden link-csere ugyanaz a művelet. Példa a `controling` footerének 123. sorára:

**Előtte:**
```blade
                    <a href="#" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```

**Utána:**
```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```

Példa a `controling` regisztrációs oldalának 22. sorára (itt jön a `target`):

**Előtte:**
```blade
            <a href="#" class="underline" style="color: #059669 !important;">{{ __('Terms of Service') }}</a>
```

**Utána:**
```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #059669 !important;">{{ __('Terms of Service') }}</a>
```

A `target` és a `rel` közvetlenül a `href` után kerül, a `class` elé.

---

## A közös teszt sablonja

Minden taszk ugyanezt a tesztet hozza létre `tests/Feature/LegalLinksTest.php` néven. A teszt a blade fájlok **forrását** vizsgálja, nem renderel — így nem függ DB-től, Livewire-től és Filament panel-kontextustól.

A fájl elején két tömb áll. A `$files` **minden taszkban más** (a saját fájllistája). A `$legalLabels` az alábbi alapértelmezett — **egyedül a Task 10 (`mes`) írja felül**, mert ott magyar címkék vannak.

```php
<?php

declare(strict_types=1);

$files = [
    // A taszk saját fájllistája ide kerül.
];

$legalLabels = [
    "{{ __('Terms of Service') }}",
    "{{ __('Privacy Policy') }}",
    "{{ __('Cookie Policy') }}",
];

test('a jogi linkek a cegem360.eu kozponti oldalaira mutatnak', function () use ($files): void {
    foreach ($files as $file) {
        $path = base_path($file);

        expect(file_exists($path))->toBeTrue("Hianyzo fajl: {$file}");

        $contents = file_get_contents($path);

        expect($contents)->toContain('https://cegem360.eu/szolgaltatasi-feltetelek');
        expect($contents)->toContain('https://cegem360.eu/adatvedelmi-tajekoztato');
    }
});

test('nem maradt halott href a jogi cimkek mellett', function () use ($files, $legalLabels): void {
    foreach ($files as $file) {
        $lines = file(base_path($file), FILE_IGNORE_NEW_LINES);

        foreach ($lines as $number => $line) {
            foreach ($legalLabels as $label) {
                if (! str_contains($line, $label)) {
                    continue;
                }

                expect($line)->not->toContain(
                    'href="#"',
                    "Halott jogi link: {$file}:" . ($number + 1),
                );
            }
        }
    }
});
```

A `$files` és a `$legalLabels` a `test()` hívások **előtt** áll, ezért a `use (...)` closure-ökben elérhetők.

---

## Task 1: `controling` (controlling.cegem360.eu)

**Files:**
- Modify: `~/Herd/controling/resources/views/components/layouts/footer.blade.php:123,125,127`
- Modify: `~/Herd/controling/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/controling/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: semmit (első taszk)
- Produces: a `tests/Feature/LegalLinksTest.php` szerkezete, amit a 2–10. taszk ugyanígy másol

- [ ] **Step 1: Írd meg a bukó tesztet**

Hozd létre `~/Herd/controling/tests/Feature/LegalLinksTest.php` néven a „közös teszt sablonja" fejezet tartalmát, a `$legalLabels` alá beszúrva:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/controling && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL — mindkét teszt bukik (hiányzó URL-ek, illetve halott `href="#"` a 123/125/127 és 22/24 sorokon).

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/layouts/footer.blade.php` — mindhárom sorban csak a `href` értéke változik:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #059669 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #059669 !important;">{{ __('Privacy Policy') }}</a>.
```

A második sor végén a pont a `</a>` után marad.

- [ ] **Step 5: Futtasd a tesztet — most át kell mennie**

Run: `cd ~/Herd/controling && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/controling && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/controling
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 2: `marketinghub` (marketinghub.cegem360.eu)

**Files:**
- Modify: `~/Herd/marketinghub/resources/views/components/layouts/footer.blade.php:124,126,128`
- Modify: `~/Herd/marketinghub/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/marketinghub/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/marketinghub/tests/Feature/LegalLinksTest.php`, a sablon szerint, `$files`:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/marketinghub && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/layouts/footer.blade.php`:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — figyelem, itt a szín `#db2777`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #db2777 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #db2777 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/marketinghub && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/marketinghub && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/marketinghub
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 3: `crm` (crm.cegem360.eu) — linkek + 301 redirect

Ez az egyetlen taszk, amelyben PHP is módosul és egy blade fájl törlődik.

**Files:**
- Modify: `~/Herd/crm/resources/views/components/layouts/footer.blade.php:151,153,155`
- Modify: `~/Herd/crm/resources/views/filament/pages/auth/register.blade.php:22,24`
- Modify: `~/Herd/crm/routes/web.php:14`
- Delete: `~/Herd/crm/resources/views/privacy-policy.blade.php`
- Test: `~/Herd/crm/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: a `privacy-policy` nevű route megmarad, de mostantól 301-es külső redirect — minden `route('privacy-policy')` hívó változatlanul működik

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/crm/tests/Feature/LegalLinksTest.php` — a sablon, `$files`-szal, plusz egy harmadik teszt a redirectre:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

A fájl végére, a sablon két tesztje után:

```php
test('az adatkezelesi tajekoztato 301-gyel a kozponti oldalra iranyit', function (): void {
    $response = $this->get('/adatkezelesi-tajekoztato');

    $response->assertStatus(301);
    $response->assertRedirect('https://cegem360.eu/adatvedelmi-tajekoztato');
});
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/crm && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL — a link-tesztek a hiányzó URL-ek miatt, a redirect-teszt pedig 200-at kap 301 helyett.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/layouts/footer.blade.php`. Figyelem: a 153. sor **nem** `href="#"`, hanem `href="{{ route('privacy-policy') }}"` — ezt is abszolút URL-re cseréld.

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#4f46e5`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #4f46e5 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #4f46e5 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Cseréld a route-ot 301-es redirectre**

`routes/web.php` 14. sora jelenleg:

```php
Route::get('/adatkezelesi-tajekoztato', fn (): Factory|View => view('privacy-policy'))->name('privacy-policy');
```

Helyette:

```php
Route::redirect('/adatkezelesi-tajekoztato', 'https://cegem360.eu/adatvedelmi-tajekoztato', 301)
    ->name('privacy-policy');
```

- [ ] **Step 6: Töröld a feleslegessé vált nézetet és importokat**

```bash
cd ~/Herd/crm
git rm resources/views/privacy-policy.blade.php
```

Ezután nézd meg a `routes/web.php` `use` sorait: ha az `Illuminate\Contracts\View\Factory` vagy az `Illuminate\Contracts\View\View` importot **egyetlen** másik route sem használja a fájlban, töröld őket. Ellenőrzés:

```bash
grep -nE "Factory|View" ~/Herd/crm/routes/web.php
```

Ha a `use` sorokon kívül nincs más találat, a két importot töröld.

- [ ] **Step 7: Futtasd a tesztet**

Run: `cd ~/Herd/crm && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 3 teszt.

- [ ] **Step 8: Formázd a módosított PHP-t**

Run: `cd ~/Herd/crm && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba; ha átformázta a `routes/web.php`-t vagy a tesztet, az rendben van.

- [ ] **Step 9: Futtasd újra a tesztet a formázás után**

Run: `cd ~/Herd/crm && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 3 teszt.

- [ ] **Step 10: Commit (push nélkül)**

```bash
cd ~/Herd/crm
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php routes/web.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu-ra, sajat adatvedelmi oldal 301-gyel atiranyitva"
```

A `git rm` már stage-elte a törölt blade fájlt, ezért nem kell külön hozzáadni.

---

## Task 4: `crm-and-contacts` (sales.cegem360.eu)

Ebben az appban **nincs** külön footer komponens — a lábléc a `home.blade.php`-ba van ágyazva. A `home.blade.php` 1030/1032 sorában lévő jogi sáv **már helyes**, ahhoz ne nyúlj; csak az 1157–1161 közötti láblécet javítsd.

**Files:**
- Modify: `~/Herd/crm-and-contacts/resources/views/home.blade.php:1157,1159,1161`
- Modify: `~/Herd/crm-and-contacts/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/crm-and-contacts/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/crm-and-contacts/tests/Feature/LegalLinksTest.php`, a sablon szerint, `$files`:

```php
$files = [
    'resources/views/home.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

Figyelem: az első teszt (URL-jelenlét) a `home.blade.php`-ra már most is átmenne, mert az 1030/1032 sor tartalmazza a két URL-t. A második teszt (halott link) az, ami itt bukik — ez elegendő piros lépés.

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/crm-and-contacts && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL — a „nem maradt halott href" teszt elbukik a `home.blade.php:1157` és a `register.blade.php:22` miatt.

- [ ] **Step 3: Cseréld ki a lábléc három linkjét**

`resources/views/home.blade.php` — figyelem, itt a behúzás **24 szóköz**, nem 20, mert a lábléc eggyel mélyebben van:

```blade
                        <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                        <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                        <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#EF4444`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #EF4444 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #EF4444 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/crm-and-contacts && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/crm-and-contacts && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/crm-and-contacts
git add resources/views/home.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 5: `stat-analitics` (seo.cegem360.eu)

**Files:**
- Modify: `~/Herd/stat-analitics/resources/views/components/layouts/footer.blade.php:114,116,118`
- Modify: `~/Herd/stat-analitics/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/stat-analitics/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/stat-analitics/tests/Feature/LegalLinksTest.php`, `$files`:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/stat-analitics && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/layouts/footer.blade.php`:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#059669`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #059669 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #059669 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/stat-analitics && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/stat-analitics && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/stat-analitics
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 6: `workflow` (workflow.cegem360.eu)

**Files:**
- Modify: `~/Herd/workflow/resources/views/components/layouts/footer.blade.php:121,123,125`
- Modify: `~/Herd/workflow/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/workflow/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/workflow/tests/Feature/LegalLinksTest.php`, `$files`:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/workflow && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/layouts/footer.blade.php`:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#7c3aed`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #7c3aed !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #7c3aed !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/workflow && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/workflow && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/workflow
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 7: `Storage-cms` (supply.cegem360.eu) — két jogi blokk

Ebben az appban a footer **két külön** jogi blokkot tartalmaz: egy `<li>`-s listát (89–91) és egy alsó sávot (123–127). Mindkettőt javítsd.

**Files:**
- Modify: `~/Herd/Storage-cms/resources/views/components/layouts/footer.blade.php:89,90,91,123,125,127`
- Modify: `~/Herd/Storage-cms/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/Storage-cms/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/Storage-cms/tests/Feature/LegalLinksTest.php`, `$files`:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/Storage-cms && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a lista-blokk három linkjét (89–91)**

`resources/views/components/layouts/footer.blade.php` — ezek `<li>`-be ágyazottak, `text-inherit!` osztállyal:

```blade
                    <li><a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="text-inherit! hover:text-amber-600! transition-colors">{{ __('Terms of Service') }}</a></li>
```
```blade
                    <li><a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="text-inherit! hover:text-amber-600! transition-colors">{{ __('Privacy Policy') }}</a></li>
```
```blade
                    <li><a href="https://cegem360.eu/cookie-beallitasok" class="text-inherit! hover:text-amber-600! transition-colors">{{ __('Cookie Policy') }}</a></li>
```

- [ ] **Step 4: Cseréld ki az alsó sáv három linkjét (123, 125, 127)**

Ugyanabban a fájlban, más osztállyal:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 5: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — itt nincs `style`, Tailwind osztály van:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline text-amber-600 hover:text-amber-700">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline text-amber-600 hover:text-amber-700">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 6: Futtasd a tesztet**

Run: `cd ~/Herd/Storage-cms && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 7: Formázd az új tesztfájlt**

Run: `cd ~/Herd/Storage-cms && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 8: Commit (push nélkül)**

```bash
cd ~/Herd/Storage-cms
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 8: `worksheet` (field.cegem360.eu)

Itt a footer a `components/landing/` alatt van, nem a `components/layouts/` alatt.

**Files:**
- Modify: `~/Herd/worksheet/resources/views/components/landing/footer.blade.php:126,128,130`
- Modify: `~/Herd/worksheet/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/worksheet/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/worksheet/tests/Feature/LegalLinksTest.php`, `$files`:

```php
$files = [
    'resources/views/components/landing/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/worksheet && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/landing/footer.blade.php`:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#10b981`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #10b981 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #10b981 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/worksheet && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/worksheet && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/worksheet
git add resources/views/components/landing/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 9: `pirometer` (pirometer.cegem360.eu)

**Files:**
- Modify: `~/Herd/pirometer/resources/views/components/landing/footer.blade.php:126,128,130`
- Modify: `~/Herd/pirometer/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/pirometer/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/pirometer/tests/Feature/LegalLinksTest.php`, `$files`:

```php
$files = [
    'resources/views/components/landing/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];
```

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/pirometer && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a footer három linkjét**

`resources/views/components/landing/footer.blade.php`. Figyelem: ebben a fájlban több más halott `href="#"` is van (Contact, Help center, Knowledge base, közösségi ikonok) — **azokhoz ne nyúlj**, csak a 126/128/130 sorhoz.

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">{{ __('Terms of Service') }}</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">{{ __('Privacy Policy') }}</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">{{ __('Cookie Policy') }}</a>
```

- [ ] **Step 4: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — szín `#10b981`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline" style="color: #10b981 !important;">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline" style="color: #10b981 !important;">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 5: Futtasd a tesztet**

Run: `cd ~/Herd/pirometer && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 6: Formázd az új tesztfájlt**

Run: `cd ~/Herd/pirometer && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 7: Commit (push nélkül)**

```bash
cd ~/Herd/pirometer
git add resources/views/components/landing/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 10: `mes` (mes.cegem360.eu) — magyar címkék, két blokk

Ez az egyetlen app, ahol a footer címkéi **hardcoded magyarok**, nem `__()` kulcsok. A teszt `$legalLabels` tömbjét ezért felül kell írni. A footer 92. sorában lévő halott „Impresszum" link **szándékosan marad** — ne javítsd.

**Files:**
- Modify: `~/Herd/mes/resources/views/components/layouts/footer.blade.php:89,90,91,123,125,127`
- Modify: `~/Herd/mes/resources/views/filament/pages/auth/register.blade.php:22,24`
- Test: `~/Herd/mes/tests/Feature/LegalLinksTest.php`

**Interfaces:**
- Consumes: a Task 1-ben rögzített teszt-szerkezet
- Produces: semmit

- [ ] **Step 1: Írd meg a bukó tesztet**

`~/Herd/mes/tests/Feature/LegalLinksTest.php` — a sablon, de a `$legalLabels` tömb **eltér**, mert a footer magyar címkéket használ, a regisztrációs oldal viszont angol kulcsokat:

```php
$files = [
    'resources/views/components/layouts/footer.blade.php',
    'resources/views/filament/pages/auth/register.blade.php',
];

$legalLabels = [
    '>ÁSZF<',
    '>Adatvédelem<',
    '>Cookie szabályzat<',
    "{{ __('Terms of Service') }}",
    "{{ __('Privacy Policy') }}",
];
```

A `>` és `<` határolók fontosak: az „Impresszum" így nem kerül a listába, és a `>Adatvédelem<` nem illeszkedik véletlenül más szövegre sem.

- [ ] **Step 2: Futtasd, és győződj meg róla, hogy bukik**

Run: `cd ~/Herd/mes && php artisan test --compact --filter=LegalLinksTest`
Expected: FAIL.

- [ ] **Step 3: Cseréld ki a lista-blokk három linkjét (89–91)**

`resources/views/components/layouts/footer.blade.php` — a 92. sor Impresszum linkjét **hagyd változatlanul**:

```blade
                    <li><a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="text-inherit! hover:text-teal-600! transition-colors">ÁSZF</a></li>
```
```blade
                    <li><a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="text-inherit! hover:text-teal-600! transition-colors">Adatvédelem</a></li>
```
```blade
                    <li><a href="https://cegem360.eu/cookie-beallitasok" class="text-inherit! hover:text-teal-600! transition-colors">Cookie szabályzat</a></li>
```

- [ ] **Step 4: Cseréld ki az alsó sáv három linkjét (123, 125, 127)**

Ugyanabban a fájlban:

```blade
                    <a href="https://cegem360.eu/szolgaltatasi-feltetelek" class="hover:text-gray-700 transition-colors">ÁSZF</a>
```
```blade
                    <a href="https://cegem360.eu/adatvedelmi-tajekoztato" class="hover:text-gray-700 transition-colors">Adatvédelem</a>
```
```blade
                    <a href="https://cegem360.eu/cookie-beallitasok" class="hover:text-gray-700 transition-colors">Cookie szabályzat</a>
```

- [ ] **Step 5: Cseréld ki a regisztrációs oldal két linkjét**

`resources/views/filament/pages/auth/register.blade.php` — Tailwind osztály, nincs `style`:

```blade
            <a href="https://cegem360.eu/szolgaltatasi-feltetelek" target="_blank" rel="noopener noreferrer" class="underline text-teal-600 hover:text-teal-700">{{ __('Terms of Service') }}</a>
```
```blade
            <a href="https://cegem360.eu/adatvedelmi-tajekoztato" target="_blank" rel="noopener noreferrer" class="underline text-teal-600 hover:text-teal-700">{{ __('Privacy Policy') }}</a>.
```

- [ ] **Step 6: Ellenőrizd, hogy az Impresszum link érintetlen**

Run: `grep -n 'Impresszum' ~/Herd/mes/resources/views/components/layouts/footer.blade.php`
Expected: a 92. sor továbbra is `href="#"` — ez a helyes állapot.

- [ ] **Step 7: Futtasd a tesztet**

Run: `cd ~/Herd/mes && php artisan test --compact --filter=LegalLinksTest`
Expected: PASS, 2 teszt.

- [ ] **Step 8: Formázd az új tesztfájlt**

Run: `cd ~/Herd/mes && vendor/bin/pint --dirty --format agent`
Expected: nincs hiba.

- [ ] **Step 9: Commit (push nélkül)**

```bash
cd ~/Herd/mes
git add resources/views/components/layouts/footer.blade.php resources/views/filament/pages/auth/register.blade.php tests/Feature/LegalLinksTest.php
git commit -m "feat: jogi linkek a cegem360.eu kozponti oldalaira"
```

---

## Task 11: Összesített ellenőrzés, push és éles verifikáció

Ez a taszk nem módosít kódot — ellenőriz, majd kiszállít.

**Files:**
- Modify: semmi

**Interfaces:**
- Consumes: a Task 1–10 commitjai mind a 10 repóban
- Produces: 10 élesbe deployolt app

- [ ] **Step 1: Ellenőrizd, hogy mind a 10 repóban pontosan egy új commit van, és nincs félrement fájl**

```bash
for d in controling marketinghub crm crm-and-contacts stat-analitics workflow Storage-cms worksheet pirometer mes; do
  echo "=== $d"
  git -C ~/Herd/$d log --oneline -1
  git -C ~/Herd/$d show --stat --oneline HEAD | tail -n +2
done
```

Expected: minden repóban a jogi commit a HEAD. A fájllista csak a footer/home/register blade-eket, a `LegalLinksTest.php`-t tartalmazza — a `crm`-ben ezen felül a `routes/web.php`-t és a törölt `privacy-policy.blade.php`-t. Ha bármelyik repóban más fájl is szerepel, állj meg és jelezd.

- [ ] **Step 2: Statikus ellenőrzés — nem maradt halott jogi link**

```bash
for d in controling marketinghub crm crm-and-contacts stat-analitics workflow Storage-cms worksheet pirometer mes; do
  printf "%-18s " "$d"
  grep -rn 'href="#"' ~/Herd/$d/resources/views --include="*.blade.php" 2>/dev/null \
    | grep -E "ÁSZF|Adatvédelem|Cookie|Privacy|Terms|szabályzat" \
    | grep -v Impresszum | wc -l | tr -d ' '
  echo
done
```

Expected: minden repónál `0`.

- [ ] **Step 3: Futtasd le mind a 10 repó jogi tesztjét egyben**

```bash
for d in controling marketinghub crm crm-and-contacts stat-analitics workflow Storage-cms worksheet pirometer mes; do
  echo "=== $d"
  (cd ~/Herd/$d && php artisan test --compact --filter=LegalLinksTest)
done
```

Expected: mind a 10 zöld.

- [ ] **Step 4: Push mind a 10 repóban**

```bash
for d in controling marketinghub crm crm-and-contacts stat-analitics workflow Storage-cms worksheet pirometer mes; do
  echo "=== $d"
  git -C ~/Herd/$d push origin main
done
```

- [ ] **Step 5: Várd meg a Forge Quick Deployt, majd ellenőrizd élesben a linkeket**

Adj a deploynak nagyjából két percet, majd:

```bash
for h in controlling marketinghub crm sales seo workflow supply field pirometer mes; do
  printf "%-14s " "$h"
  html=$(curl -s "https://$h.cegem360.eu/")
  for u in szolgaltatasi-feltetelek adatvedelmi-tajekoztato cookie-beallitasok; do
    if echo "$html" | grep -q "cegem360.eu/$u"; then printf "%s=OK " "$u"; else printf "%s=HIANYZIK " "$u"; fi
  done
  echo
done
```

Expected: mind a 30 ellenőrzés `OK`. Ha valamelyik `HIANYZIK`, előbb nézd meg a Forge deploy logot — lehet, hogy a deploy még fut.

- [ ] **Step 6: Ellenőrizd élesben a `crm` 301-es redirectjét**

```bash
curl -sI https://crm.cegem360.eu/adatkezelesi-tajekoztato | grep -iE "^HTTP|^location"
```

Expected: `HTTP/2 301` és `location: https://cegem360.eu/adatvedelmi-tajekoztato`.

- [ ] **Step 7: Ellenőrizd, hogy a három cél-URL él**

```bash
for u in szolgaltatasi-feltetelek adatvedelmi-tajekoztato cookie-beallitasok; do
  printf "%-28s " "$u"
  curl -s -o /dev/null -w "%{http_code}\n" "https://cegem360.eu/$u"
done
```

Expected: mindhárom `200`.
