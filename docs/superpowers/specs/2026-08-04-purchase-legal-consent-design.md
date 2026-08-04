# Vásárlási oldal — ÁSZF és adatvédelmi elfogadás — Design

**Dátum:** 2026-08-04
**Állapot:** jóváhagyva (implementáció előtt)

## Cél

A `/module-order` vásárlási wizard utolsó lépésében a megrendelő két külön,
kötelező checkboxszal fogadja el az Általános Szerződési Feltételeket és az
Adatvédelmi tájékoztatót. Az elfogadás ténye — a dokumentum verziójával, IP
címmel és user agenttel együtt — auditálható módon adatbázisba kerül. Ezzel
párhuzamosan a jogi dokumentumok hatályossági dátuma 2026. 05. 27.-re változik.

## Döntések (brainstormingból)

- **Érintett oldal:** kizárólag a `CreateModulePage` Filament-wizard
  (`/module-order`). A `subscription.checkout` POST route legacy, nincs
  frontend hívója, ezért érintetlen marad.
- **Tárolás:** külön `legal_acceptances` audit-tábla, vásárlásonként új sorral —
  nem a `users` táblán lévő oszlopok, mert azok csak a legutolsó elfogadást
  őrzik és nem köthetők konkrét megrendeléshez.
- **Dátumok:** ÁSZF és adatvédelmi tájékoztató egyaránt 2026. 05. 27. A
  cookie-beállítások oldal érintetlen marad.
- **Dátum forrása:** `config/legal.php`, hogy a megjelenített és az auditba írt
  hatályossági dátum ne csúszhasson el egymástól.

## Architektúra

### `config/legal.php`

```php
return [
    'terms'   => ['effective_at' => '2026-05-27'],
    'privacy' => ['effective_at' => '2026-05-27'],
];
```

A jogi blade-ek innen olvassák és formázzák a hatályossági dátumot, és ugyanez
az érték kerül az audit-rekord `document_effective_at` mezőjébe.

### `legal_acceptances` tábla

| oszlop | típus | megjegyzés |
| --- | --- | --- |
| `id` | id | |
| `user_id` | foreignId → users | cascade delete |
| `document` | string | `LegalDocument` enum értéke |
| `document_effective_at` | date | melyik verziót fogadta el |
| `context` | string | `module_order` |
| `accepted_at` | timestamp | |
| `ip_address` | string(45), nullable | |
| `user_agent` | text, nullable | |
| `timestamps` | | |

Index: `(user_id, document)`.

### Enum, model, reláció

- `App\Enums\LegalDocument` — `TermsOfService = 'terms_of_service'`,
  `PrivacyPolicy = 'privacy_policy'`. `label()` a magyar megnevezéshez,
  `effectiveAt()` a hozzá tartozó config-értékhez.
- `App\Models\LegalAcceptance` — casts: `document` → enum,
  `document_effective_at` → date, `accepted_at` → datetime. Factory is készül.
- `User::legalAcceptances(): HasMany`.

### `App\Actions\RecordLegalAcceptance`

Egyetlen `handle(User $user, array $documents, string $context, ?string $ip, ?string $userAgent): void`
metódus, ami dokumentumonként egy sort ír, a `document_effective_at` mezőt az
enum `effectiveAt()` értékéből véve. A wizard hívja, a Stripe-redirect előtt.

### `CreateModulePage` módosítás

A `Time Period` lépés végére új `Section` két `Checkbox` mezővel:

- `accepts_terms` — `HtmlString` label linkkel a
  `route('legal.szolgaltatasi-feltetelek')` címre, `target="_blank"`,
  `rel="noopener"`.
- `accepts_privacy` — ugyanígy `route('legal.adatvedelmi-tajekoztato')`.

Mindkettő `->accepted()->required()`. A `create()` már ma is
`$this->form->getState()`-tel validál, így bepipálatlan checkbox esetén a
Stripe-redirect automatikusan elmarad.

A `create()`-ben, a meglévő billing-period és Stripe-price ellenőrzések után,
közvetlenül a `$checkout` létrehozása előtt fut a `RecordLegalAcceptance`. A
hozzájárulás a megrendelés pillanatában keletkezik, függetlenül attól, hogy a
fizetés végül sikeres-e.

## Adatfolyam

```
Wizard 3. lépés → checkbox bepipálva → create()
  → form->getState() (accepted() validáció)
  → billing period / stripe price ellenőrzés
  → RecordLegalAcceptance::handle() → 2 sor a legal_acceptances táblába
  → Stripe Checkout redirect
```

## Hibakezelés

- Bepipálatlan checkbox: Filament mezőszintű validációs hiba, a wizard nem lép
  tovább, nincs DB-írás és nincs redirect.
- Nem egyező elszámolási időszak vagy hiányzó Stripe price: a meglévő
  `Notification` ág fut le — ilyenkor elfogadás **nem** kerül mentésre, mert a
  rögzítés ezen ellenőrzések után történik.

## Tesztelés

- `tests/Feature/CreateModulePageTest.php`
  - bepipálatlan checkboxokkal `assertHasFormErrors(['accepts_terms', 'accepts_privacy'])`,
    nincs redirect, nincs `legal_acceptances` sor.
- `tests/Feature/RecordLegalAcceptanceTest.php`
  - két sor keletkezik helyes `document`, `document_effective_at`, `context`,
    `ip_address` és `user_agent` értékekkel.
- `tests/Feature/LegalPagesTest.php` (vagy meglévő jogi oldal teszt bővítése)
  - az ÁSZF és az adatvédelmi oldal a 2026. 05. 27. hatályossági dátumot mutatja.

A Stripe Checkout hívást egyik teszt sem érinti.

## Érintett jogi szövegek

- `resources/views/livewire/legal/szolgaltatasi-feltetelek-page.blade.php` —
  fejléc „Hatályos", záró „Budapest, …", és a szövegtörzs két
  „2025. május 27." hivatkozása.
- `resources/views/livewire/legal/adatvedelmi-tajekoztato-page.blade.php` —
  fejléc és lábléc hatályossági dátuma; a fordítási kulcs paraméteressé válik
  (`Effective from: :date`), új `lang/hu.json` bejegyzéssel.
