# Központi SSO / identity provider — Design

**Dátum:** 2026-07-31
**Állapot:** jóváhagyva (implementáció előtt)
**Érintett rendszerek:** `subscriber` (IdP) + 16 modul-app + `laravel-user-team-sync` csomag

## Cél

A felhasználó- és csapat-szinkron push-alapú modelljét lecserélni központi
bejelentkezésre (SSO), ahol a modul-appok egyetlen, teljes állapotú válaszból
provizionálnak. Ezzel megszűnik az eseménysorrend-függőség, ami ma tartós
adatromlást okoz: új fiókok rossz csapathoz kötődnek vagy csapat nélkül
maradnak.

## A jelenlegi hiba gyökere

A `laravel-user-team-sync` push-alapú, entitásonként külön HTTP hívással,
sorrend-garancia nélkül. Az egyetlen kereszt-app azonosító a `teams.slug`,
ami változékony. Konkrét, kódból igazolt hibaforrások:

1. **Nincs Team observer.** A csomagban csak `UserSyncObserver` létezik, az is
   kizárólag a User modellt figyeli. Nincs `UpdateTeamJob`, és a team-tagság
   változása sincs szinkronizálva. A csapatok a receivereken **csak létrejönnek,
   soha nem frissülnek**.

   Következmény: átnevezés után a publisher slugja megváltozik
   (`CreateTeamJob::__construct` → `Str::slug($teamName)`), a receiveré nem.
   Minden ezutáni `createUser` a **új** slugot küldi, a receiver
   `attachBySlugs()` nem talál egyezést, `PendingTeamAttachment` sort ír — amit
   csak egy pontosan ilyen slugú `create-team` oldana fel. Az soha nem érkezik
   meg. A user csapat nélkül marad, a `TeamScope` globális scope mindent
   kiszűr, és **üres alkalmazást lát**.

2. **Slug-ütközés a publisheren.** `Register::handleRegistration()` a
   `Str::slug($user->company_name)` értéket egyediség-ellenőrzés nélkül írja a
   `teams` táblába, ahol a `slug` unique. Két azonos cégnevű regisztráció közül
   a második `QueryException`-nel elszáll — a user már létrejött, a team és a
   teljes szinkron elmarad.

3. **A receiverek maguk is gyárthatnak csapatot.** A CRM
   `RegisterTeam::handleRegistration()` tetszőleges slugú Team-et hoz létre.
   Ütközés esetén a bejövő `create-team` a unique constrainten hasal el.

4. **Nincs utólagos helyreállítás.** Ha egy app 3 újrapróbálkozás alatt nem
   érhető el, a felhasználó véglegesen hiányzik onnan. Nincs reconcile parancs.

5. **Körkörös hivatkozás a `team_ids`-ben.** `CreateUserJob` minden apptól
   lekérdezi az owner csapatait (`GET /api/user-teams`), és azt küldi vissza.
   Ha az owner még nincs kiszinkronizálva arra az appra, a válasz `[]` — ami
   megkülönböztethetetlen attól, hogy tényleg nincs csapata. Nincs hibajelzés.

A `PendingTeamAttachment` és `PendingUserActivation` táblák maguk a diagnózis:
kézzel épített, féloldalas eseménysorrend-helyreállítás.

**A felület mérete:** a CRM-ben 25+ modell hordoz `team_id`-t, és a `Team` egyben
Filament tenant (`->tenant(Team::class, slugAttribute: 'slug')`). Ugyanez 16
receiver appban: `crm`, `mes`, `controling`, `workflow`, `worksheet`,
`marketinghub`, `datamind`, `stat-analitics`, `pirometer`, `Storage-cms`,
`crm-and-contacts`, `tothpaszomany-crm`, `tothpaszomany-mes`,
`tothpaszomany-controlling`, `tothpaszomany-supply`.

## Döntések (brainstormingból)

- **Irány:** valódi SSO — a modul-appokon nincs login form, nincs jelszó.
- **Az IdP a `subscriber` maga**, nem külön alkalmazás. Indok: a jogosultsági
  igazság (`User::accessibleAppKeys()`, Stripe, előfizetések) ott születik.
- **Globális azonosító:** `uuid` a `users` és `teams` táblán. A `teams.id` és
  `users.id` **nem változik** (FK-k és Filament tenancy épül rájuk).
- **A `slug` megmarad URL-nek**, de soha többé nem szinkron-kulcs.
- **A modul-appokon megszűnik a lokális csapat-létrehozás** (`tenantRegistration`
  kivezetése). A csapat kizárólag a subscriberben születik.
- **Protokoll:** OAuth2 `authorization_code` + PKCE (Laravel Passport), nem
  szigorú OIDC. Mind a 17 app first-party, confidential client.
- **Revalidáció:** 15 perc. **Türelmi idő IdP-kiesésre:** 24 óra.
- **Csomag:** a `laravel-user-team-sync` **v2.0** szuperhalmazként, benne a régi
  `publisher`/`receiver` mód `legacy` néven és az új `idp`/`client` mód.
- **Pilot app:** `crm`, allowlistes bevezetéssel.

## Architektúra

### Identitásmodell

Minden appban (`subscriber` + 16 modul-app):

| Tábla | Új oszlop | Szerep |
|---|---|---|
| `users` | `uuid` unique | globális, stabil azonosító — sosem változik |
| `teams` | `uuid` unique | globális, stabil azonosító — átnevezés nem érinti |

A `slug` a Filament tenant útvonalhoz (`/admin/{slug}/...`) és emberi
olvashatósághoz marad. Mivel már nem azonosító, ütközés esetén szabadon
utótagozható.

### Token szerződés

A `subscriber` Passportot kap. A tokencsere után a kliens egyszer meghívja a
`GET /api/userinfo` végpontot, ami a **teljes állapotot egy válaszban** adja:

```json
{
  "sub":   "9f3c…",
  "email": "…",
  "name":  "…",
  "role":  "manager",
  "orgs": [
    { "uuid": "b21a…", "name": "Acme Kft.", "slug": "acme-kft" }
  ],
  "apps": ["crm", "mes"],
  "issued_at": 1770000000
}
```

- `sub` — user uuid.
- `orgs` — a felhasználó csapatai globális azonosítóval. Szándékosan nincs benne
  per-csapat szerepkör: ma sem létezik ilyen, a `role` felhasználó-szintű.
- `apps` — `User::accessibleAppKeys()` (meglévő, kész függvény): az aktív
  előfizetések plan-kategória slugjai.

**Az app saját kulcsa** a `config('identity.app_key')` értékből jön, aminek meg
kell egyeznie a `sync_apps.name` mezővel és a hozzá tartozó plan-kategória
slugjával. Ez a három ma is összetartozik; a config csak explicitté teszi.

Három tulajdonság, ami a hibaosztályt megszünteti:

1. **Teljes állapot, nem delta** — nincs mit sorrendbe rakni, nincs mit elveszíteni.
2. **Önjavító** — minden belépés egyben reconcile is.
3. **A jogosultság a tokenben van** — nem kell `is_active` oszlopot 16 helyre
   pusholni.

### Kliens oldali belépés

Minden modul-appon két route:

```
GET /auth/redirect  → átirányítás a subscriberre (authorization_code + PKCE)
GET /auth/callback  → token csere, GET /api/userinfo, provisioning, Auth::login()
```

A Filament panelről a `->login()` lekerül; egy middleware a vendégeket a
`/auth/redirect`-re küldi. Nincs login form, nincs jelszó, nincs „elfelejtett
jelszó" — mind a subscriberben marad.

**Hozzáférés-ellenőrzés a callbackben, provisioning előtt:** ha az app kulcsa
nincs benne a `apps` claimben, a belépés elutasítva, a felhasználó egy „nincs
ehhez a modulhoz előfizetésed" oldalra megy, linkkel a subscriberre.

### A provisioner

`App\Auth\IdentityProvisioner` — egyetlen osztály, egyetlen publikus metódus.
A teljes claim-payloadot kapja, bejelentkeztethető `User`-t ad vissza.

```php
DB::transaction(function () use ($claims) {
    $user = User::updateOrCreate(
        ['uuid' => $claims['sub']],
        ['name' => $claims['name'], 'email' => $claims['email'],
         'password' => '', 'email_verified_at' => now()],
    );

    $teamIds = collect($claims['orgs'])
        ->map(fn (array $org) => $this->resolveTeam($org)->getKey());

    $user->teams()->sync($teamIds);
    $user->syncRoles([$claims['role']]);

    return $user;
});
```

**`resolveTeam()` feloldási sorrendje (adoptáló):**

1. Keresés `uuid` szerint → megvan, név/slug frissítve.
2. Ha nincs: keresés `slug` szerint → **megvan, ráíródik a uuid (adoptálás)**.
3. Ha az sincs: létrehozás. Slug-ütközés esetén utótag (`acme-2`).

Az adoptáló ág két célt szolgál: nem gyárt duplikátumot egy már meglévő csapat
mellé, és a legacy push-sal párhuzamos futás alatt sem tudnak a rendszerek
egymás ellen dolgozni.

**Négy fontos tulajdonság:**

- **`sync()`, nem `syncWithoutDetaching()`.** A token teljes állapot, tehát a
  hiányzás is információ. Ma semmi nem veszi ki a felhasználót egy csapatból.
- **Nincs jelszó.** A `password` üres marad, a `SyncPasswordJob` törölhető.
- **Idempotens és tranzakcionális.** Kétszer futtatva ugyanaz az eredmény.
- **Ugyanez az osztály fut belépéskor és revalidációkor.** A provisioner nem
  belépési logika: ez a reconcile, ami mellesleg belépéskor is lefut.

### Munkamenet, revalidáció, visszavonás

Belépés után normál Laravel session (`SESSION_LIFETIME=120`). A refresh token
titkosítva a sessionben marad, mellette `claims_checked_at`.

Egy middleware minden kérésnél nézi az időbélyeget; **15 percnél régebbi** esetén
újrahívja a `userinfo`-t és lefuttatja a provisionert.

Ebből következik, hogy csapat-átnevezés, új tagság, szerepkör-változás,
előfizetés-bővítés **15 percen belül magától átér mind a 16 appra, push nélkül**.
Nem kell `UpdateTeamJob`, tagság-szinkron vagy reconcile parancs.

**Hibakezelés a revalidációnál — ez dönti el, hogy az SSO javítás-e vagy új
hibapont:**

| `userinfo` válasz | Viselkedés |
|---|---|
| `200` | claims frissítve, provisioner lefut, `claims_checked_at` = most |
| `401` / `invalid_grant` | azonnali kiléptetés — a hozzáférést visszavonták |
| hálózati hiba, 5xx, timeout | **a munkamenet él tovább**, következő kérésnél újrapróbál |

A hálózati hibának 24 órás türelmi ablaka van (`IDENTITY_GRACE_HOURS=24`). Egy
fél órás subscriber-kiesés senkit nem zavar meg, aki már dolgozik — csak az új
belépéseket blokkolja. **Az IdP elérhetetlensége nem azonos a hozzáférés
megvonásával.**

**Azonnali visszavonás:** `POST /api/revoke` a modul-appokra
(`{"uuid": "…", "reason": "subscription_cancelled"}`). A receiver a `sessions`
táblából törli az adott felhasználó sorait. Kiváltó pontok: a `SubscriptionObserver`
mai `toggleUserActive` hívásai.

Ez a push **optimalizáció, nem korrektségi követelmény** — ha elveszik, a 15
perces revalidáció elkapja. A mai rendszer pont fordítva működik.

### Infrastruktúra-előfeltételek (Forge)

- `subscriber`: `SESSION_DRIVER` `file` → `database`. Ma `file`, ezzel a
  „kiléptetés mindenhonnan" a subscriberben magában sem működik.
- Minden modul-app: `SESSION_DRIVER=database` és a `sessions` táblán `user_id`
  index. A CRM-ben ez megvan; appnként ellenőrizendő.
- `QUEUE_CONNECTION`: mind a 17 appban `sync`. Legalább a subscriberben valódi
  queue kell (Redis) — a `revoke` fan-out 16 HTTP hívás, ami inline futva egy
  Stripe webhookot időtúllépésbe vihet.

### Ami törlődik

Modul-appokról: `create-user`, `create-team`, `sync-user`, `sync-password`,
`toggle-user-active`, `user-teams` végpontok; `ValidateSyncApiKey` middleware;
`EnsureUserHasActiveSubscription` middleware; `pending_team_attachments` és
`pending_user_activations` táblák. Marad **egy** bejövő végpont: `POST /api/revoke`.

Publisher oldalról: a jelszó-replikáció (16-szoros támadási felület ugyanarra a
bcrypt hashre), a körkörös `GET /api/user-teams` hívás, a `toggle-user-active`
push, és a `password_hash` mező minden payloadból.

Meglévő lokális userek **nem törlődnek** — FK-znak rájuk a saját rekordjaik.
Egyszerűen nem tudnak belépni, amíg nem kapnak uuid-t a backfillből.

## Csomagstratégia

A `laravel-user-team-sync` **v2.0** szuperhalmaz:

- `IDENTITY_MODE=legacy` — a mai `publisher`/`receiver` viselkedés, változatlanul.
- `IDENTITY_MODE=idp` — Passport auth server + `userinfo` (subscriber).
- `IDENTITY_MODE=client` — OAuth kliens + provisioner (modul-appok).

Két további kapcsoló a `client` módhoz, kizárólag az átmenet idejére:

| Kapcsoló | Hatás |
|---|---|
| `IDENTITY_LEGACY_RECEIVER=true` | a régi receiver végpontok is aktívak maradnak |
| `IDENTITY_SSO_ALLOWLIST=a@b.hu,…` | csak ezek az e-mailek mennek SSO-n; üresen hagyva mindenki |

Ha az allowlist nem üres, a nem szereplő felhasználók a régi login formot kapják,
és őket a legacy push szolgálja ki. Mindkét kapcsoló a 4. fázis végén,
appnként kerül ki.

Az átállás így két független lépésre esik:

1. Mind a 17 app felmegy v2-re, `legacy` módban indulva — viselkedésben azonos,
   kockázatmentes `composer update`.
2. Appnként átbillen a config: `legacy` → `client`.

Egy app sosem futtat két csomagverziót, mégis mindkét világ elérhető az átmenet
alatt. A legacy kód a **v3.0**-ban törlődik, amikor az utolsó app is átállt.

A `sync_apps` tábla (meglévő, `url` + titkosított `api_key`) bővül
`client_id` / `client_secret` / `redirect_uri` oszlopokkal — az app-nyilvántartás
ott marad, ahol ma van.

## Fázisok

Az alapelv: **minden fázis után működő rendszer marad**, és a régi szinkron
addig él, amíg az utolsó app is át nem állt. Nincs „nagy kapcsoló".

Ez a spec a teljes végállapotot írja le, de **implementációs terv csak a 0. és
1. fázisra készül elsőként** — a 0. fázis `identity:audit` eredménye érdemben
befolyásolhatja a későbbieket (pl. mennyi kézi rendezés kell a backfill előtt).

### 0. fázis — sürgősségi javítás és felmérés

Az egyetlen rész, ami azonnal hasznot hoz, mert a migráció hetekig tart.

- **Slug-ütközés javítása most.** `Register::handleRegistration()` →
  `firstOrCreate` + sorszámozott utótag. Pár soros, azonnal kiadható, a későbbi
  migrációt nem befolyásolja.
- **`identity:audit` parancs.** Végigkérdezi a 16 appot és listázza: publisheren
  létező, receiveren hiányzó csapatok; receiver-lokális csapatok publisher-pár
  nélkül; ütköző slugok; hiányzó felhasználók; felgyűlt
  `pending_team_attachments` sorok.
- **A jelentést kézzel kell rendezni.** Nem automatizálható: csak ember tudja
  eldönteni, hogy a CRM-ben kézzel felvett „acme" ugyanaz-e, mint a subscriber
  „acme"-je.

### 1. fázis — UUID mindenhová, viselkedés-változás nélkül

- Migráció mind a 17 appban: `uuid` a `users` és `teams` táblára,
  `nullable()->unique()`.
- A subscriber generál, egy egyszeri parancs appnként átküldi a leképezést,
  **email és slug alapján párosítva** — ez az utolsó alkalom, amikor ez a
  párosítás használható.
- A régi szinkron változatlanul fut, kiegészülve annyival, hogy az új entitások
  már születésükkor kapnak uuid-t.
- Ha itt megállnánk, semmi nem romlana el.

### 2. fázis — IdP a subscriberben

- Passport telepítése, `/api/userinfo` végpont.
- Appnként OAuth kliens regisztráció a bővített `sync_apps` táblában.
- Egyetlen modul-app sem használja még.

### 3. fázis — pilot a `crm`-en, allowlistes bevezetéssel

A `crm` a legnagyobb felület (25+ `team_id`-s modell, Filament tenancy), ezért
nem teljesíti a „kevés felhasználó" kritériumot. Három kompenzáció:

- **Konfiguráció:** `IDENTITY_MODE=client` + `IDENTITY_LEGACY_RECEIVER=true` +
  szűk `IDENTITY_SSO_ALLOWLIST`. Az allowliston kívüliek a régi login formon
  mennek, őket a legacy push szolgálja ki változatlanul.
- **Adoptáló `resolveTeam()`** (lásd fent) — a két rendszer párhuzamos futása
  alatt sem gyárt duplikátumot.
- **Az allowlist fokozatos bővítése**, majd a két átmeneti kapcsoló kivétele.

**Ismert hatás az allowlistes felhasználókon:** a provisioner `sync()`-je a
token szerinti állapotra állítja a tagságokat. Ha egy allowlistes felhasználó ma
olyan csapatban van a CRM-ben, ami a subscriberben nincs nála, azt az első SSO
belépés **leválasztja**. Ez szándékos — a token az igazság —, de az allowlist
első köre pont ezért legyen belsős, ellenőrizhető felhasználókból.

A `tenantRegistration` (`RegisterTeam`) kivezetése is ebben a fázisban történik.

### 4. fázis — a maradék 15 app

Kockázat szerint növekvő sorrendben, appnként ugyanaz a lépéssor.

### 5. fázis — bontás

Az utolsó app átállása után a törlendő elemek (lásd „Ami törlődik") eltávolítása,
a csomag v3.0-ra emelése.

## Tesztelés

Pest, a provisionerre koncentrálva — az az egyetlen hely, ahol állapot keletkezik.

| Eset | Elvárás |
|---|---|
| Idempotencia | kétszer futtatva ugyanaz az eredmény |
| **Csapat átnevezése** | a slug megváltozik, a felhasználó bent marad — *a mai hiba* |
| Slug-ütközés lokális csapattal | utótagot kap, nem dob kivételt |
| Adoptálás | slug-egyezés esetén a meglévő csapat kapja meg a uuid-t, nem jön létre új |
| Tagság megszűnése | `sync()` leválasztja — ma egyáltalán nem történik meg |
| Hiányzó `apps` claim | belépés elutasítva |
| `userinfo` 5xx | munkamenet életben marad |
| `userinfo` 401 | azonnali kiléptetés |
| Türelmi idő lejárta | kiléptetés |
| Backfill | szándékosan divergens fixture-ön helyes párosítás |

Ezen felül architektúra-teszt, ami tiltja a törölt szinkron-végpontok
hivatkozását — így egy app sem maradhat félúton.

## Ami szándékosan kimarad (YAGNI)

- **Szigorú OIDC (`id_token`, discovery).** Mind a 17 app first-party és
  szerver-oldali; az `access_token` + `userinfo` funkcionálisan ugyanaz. Ha
  később kell külső integráció (pl. Microsoft-fiókkal belépés), az id_token
  ugyanerre az alapra utólag ráépíthető.
- **Külön reconcile parancs.** A 15 perces revalidáció ellátja. Az
  `identity:audit` felügyeleti eszközként megmarad.
- **Front-channel single logout.** A `revoke` webhook + a 15 perces ciklus
  lefedi a valós igényt.
