# „Új ügyfél" wizard — Design

**Dátum:** 2026-07-03
**Állapot:** jóváhagyva (implementáció előtt)

## Cél

Admin panel wizard, amivel egy menetben, gyorsan létrehozható egy teljes új
ügyfél: egy főfiók (owner user), egy vagy több csomag (plan) mint helyi
előfizetés, opcionálisan egy team, és tetszőleges számú tag-user. A cél a
manuális provizionálás felgyorsítása.

## Döntések (brainstormingból)

- **Fő cél:** teljes új ügyfél (owner + csomag(ok) + tagok) egy folyamatban.
- **Előfizetés módja:** csak lokális DB rekord (manuális provizíció), NINCS
  valós Stripe terhelés.
- **Cross-app sync:** IGEN, teljes provizíció — owner és tagok is létrejönnek a
  modul-appokon és aktiválódnak a csomag alapján a meglévő `UserTeamSync` /
  `AttachSubscriptionMember` / `SubscriptionObserver` logikával.
- **Tagok és csomagok:** minden tag MINDEN létrehozott előfizetéshez hozzáadódik
  (teljes hozzáférés), seat-ellenőrzés csomagonként.
- **UI megközelítés:** dedikált Filament custom Page wizarddal (nem a UserResource
  create oldala, nem modal).

## Architektúra

- **Filament Page:** `app/Filament/Pages/CreateCustomer.php`
  - Nav menüpont: „Új ügyfél" (az Ügyfelek/Users navigációs csoportban).
  - Hozzáférés: csak admin — `public static function canAccess(): bool` és/vagy
    `shouldRegisterNavigation()` → `auth()->user()?->isAdmin()`.
  - A Page vékony: összegyűjti a wizard form state-jét, és átadja a
    `CreateCustomer` akciónak.
- **Akció:** `app/Actions/CreateCustomer.php`
  - Egyetlen `handle(array $data): User` (owner visszaadása), ami a teljes
    provizionálást elvégzi DB tranzakcióban.
  - Újrahasznosítja: `Madbox99\UserTeamSync\Facades\UserTeamSync` (createUser,
    createTeam), `App\Actions\AttachSubscriptionMember`, és a
    `SubscriptionObserver` automatikus owner-aktiválását.

## Wizard lépések (Filament `Wizard`)

1. **Főfiók (Owner)**
   - Mezők: `name`, `email` (unique a `users` táblán), `password`, `role`
     (alap: `UserRole::Manager`), + Cégadatok fieldset: `company_name`,
     `tax_number`, `address`, `city`, `postal_code`, `country`
     (`Country` enum, alap: Hungary). A Register.php mezőit tükrözi.
2. **Csomagok**
   - A `Plan`-ek modul (plan category) szerint csoportosítva jelennek meg.
   - Csomagonként `quantity` (seat, min 1). Legalább 1 csomag kötelező.
   - Adatszerkezet: kiválasztott plan_id-k + hozzájuk tartozó quantity.
3. **Team (opcionális)**
   - Toggle: „Team létrehozása". Ha aktív: `team_name` mező (alap:
     `company_name`).
   - Bekapcsolva: lokális `Team` rekord létrehozása, owner hozzácsatolása,
     `UserTeamSync::createTeam(...)` hívás, és a létrehozott subscription-ök
     `team_id`-ja erre a team-re áll.
4. **Tagok (opcionális)**
   - `Repeater`: `name`, `email` (unique + repeateren belüli ütközés tiltva),
     `password`, `role` (alap: `UserRole::Subscriber`).
   - Élő seat-ellenőrzés: a felvehető tagok száma a csomagok szabad helyeihez
     igazodik (owner = 1 seat foglalás csomagonként).
5. **Összegzés**
   - Read-only áttekintés: owner adatok, kiválasztott csomagok + quantity,
     team, tagok száma. „Létrehozás" gomb.

## Submit / adatfolyam

Egy DB tranzakció; a külső (UserTeamSync / Job) hívások `DB::afterCommit`-ben,
hogy ne provizionáljunk félkész adatnál.

1. Owner `User` létrehozás: jelszó `Hash::make`, `email_verified_at = now()`,
   `role`, cégadatok. A raw jelszót a hash előtt el kell kapni (mint a Register
   `beforeValidate`-je), mert a cross-app createUser-nek szüksége van rá.
2. `UserTeamSync::createUser(email, name, rawPassword, role, ownerEmail: owner
   email)`. Ha a team lépés aktív: lokális `Team` + `UserTeamSync::createTeam(
   teamName, userEmail, userName)`, owner hozzácsatolása a team-hez.
3. Minden kiválasztott Plan-hez `Subscription` létrehozás:
   `user_id` = owner, `plan_id`, `quantity`, `type = SubscriptionType::Default`,
   `stripe_status = SubscriptionStatus::Active`, `stripe_id = 'manual_' . (string)
   Str::uuid()` (egyedi placeholder), `stripe_price` = plan `stripe_price_id`
   (ha van), `team_id` (ha van team).
   - A `SubscriptionObserver::created` automatikusan lefuttatja az owner
     modul-aktiválást (`UserTeamSync::toggleUserActive`) a plan category slug
     alapján.
4. Minden tagnál: `User` létrehozás (hash jelszó, `email_verified_at = now()`,
   `company_name` = owner cégneve), majd MINDEN létrehozott subscription-höz
   `app(AttachSubscriptionMember::class)->handle($subscription, $member,
   $rawMemberPassword)` — seat pivot (`subscription_user`) + modul-appok
   aktiválás.

## Hibakezelés

- **Egyedi email:** owner és minden tag emailje unique a `users` táblán, és a
  wizardon belül sem ütközhet (owner vs tagok, tagok egymással).
- **Seat túllépés:** csomagonként az owner 1 helyet foglal; a tagok száma nem
  lépheti túl a `quantity - 1` szabad helyet egyik kiválasztott csomagnál sem.
  Túllépés → validációs hiba a Tagok lépésen.
- **Atomikusság:** a helyi rekordok (`users`, `subscriptions`,
  `subscription_user`, `teams` pivot) egy tranzakcióban; a UserTeamSync és a
  háttér-jobok csak sikeres commit után futnak.
- **Siker:** Filament siker-notification, majd redirect a létrehozott owner
  User edit oldalára.

## Tesztelés (Pest feature test)

- Admin be tudja tölteni a wizard oldalt; nem-admin nem éri el (403 /
  nav rejtett).
- Teljes flow: `fillForm` owner + csomag(ok) + tag(ok) → submit →
  `assertDatabaseHas` a `users`, `subscriptions`, `subscription_user`
  táblákon; owner subscription létrejön a helyes plan-nel.
- `UserTeamSync` facade mock (`UserTeamSync::shouldReceive/spy`) → `createUser`,
  opc. `createTeam`, és owner `toggleUserActive` hívások assertálása; tagok
  provizionálása az `AttachSubscriptionMember`-en át.
- Seat túllépés → `assertHasFormErrors`.
- Team lépés: bekapcsolva team létrejön és a subscription-ök `team_id`-ja beáll;
  kikapcsolva `team_id` null marad.

## Nem cél (YAGNI)

- Valós Stripe előfizetés / fizetés kezelése.
- Meglévő owner szerkesztése ezen a wizardon (ez új ügyfél létrehozásra való).
- Egyedi team-árak (`team_plan_prices`) beállítása a wizardban — ez a Teams
  resource meglévő relation managerében marad.
