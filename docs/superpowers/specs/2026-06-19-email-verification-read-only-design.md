# Megerősítetlen e-mail: belépés + csak olvasás (read-only)

**Dátum:** 2026-06-19
**Állapot:** Jóváhagyott design

## Cél

Jelenleg a `MustVerifyEmail` teljesen kizárja a megerősítetlen e-mailű, belépett
felhasználót minden alkalmazás-oldalról (a `verified` middleware visszadobja a
verification promptra). Az új igény: a belépett, de még meg nem erősített
felhasználó **mindent megtekinthet** olvasásra, de **semmilyen írási műveletet
nem végezhet**, amíg meg nem erősíti az e-mail-címét. Ez vonatkozik az
**ügyfél-felületre** és az **admin (Filament) panelre** is.

## Hatókör

- **Ügyfél-felület** (`routes/web.php` `auth` csoport): `/modules`, `/subscriptions`,
  `/manage-users`, előfizetés-megtekintés/-frissítés/-checkout.
- **Admin panel** (Filament `admin`): belépés + olvasás engedett megerősítés nélkül,
  írás tiltva.

Nem cél: az e-mail-megerősítési folyamat (link, hash) átírása — az változatlan.

## Írási pontok (a tiltandó felület)

Ügyfél-felület (Livewire):
- `SubscriptionController::checkout()` — POST `/subscription/checkout/{plan}`
- `App\Livewire\Page\UpdateModulePage::update()`
- `App\Livewire\Page\CreateModulePage::create()`
- `App\Livewire\ManageUsers::createUser()`, `attachExistingUser()`, és a tábla
  edit/delete/create akciói
- `App\Livewire\SubscrubersSubscriptionsTable` „update" navigációs akció

Admin panel (Filament): minden resource mutáló akciója (create/edit/delete/bulk/
attach/associate/restore/forceDelete) és a Create/Edit oldalak űrlap-mentése.

**Technikai megkötés:** a Livewire/Filament akció-metódusok nem tilthatók
route-middleware-rel (`verified`), mert mind a közös Livewire-végponton mennek át.
Ezeket a komponensen belül és/vagy a Filament akció-láthatóságon keresztül kell
őrizni. Ezért defense-in-depth kell, nem egyetlen middleware-kapcsoló.

## Architektúra

### 1. Központi ellenőrzés — `App\Concerns\RequiresEmailVerification` trait

Egyetlen igazságforrás, amit a backend-guard és az UI is használ.

```php
trait RequiresEmailVerification
{
    public function userEmailVerified(): bool
    {
        return Auth::user()?->hasVerifiedEmail() ?? false;
    }

    // Write-akció elejére. Megerősítetlennél: Filament notification + false.
    protected function guardWrite(): bool
    {
        if ($this->userEmailVerified()) {
            return true;
        }

        Notification::make()
            ->warning()
            ->title(__('Verify your email address'))
            ->body(__('You must verify your email address before performing this action.'))
            ->send();

        return false;
    }
}
```

### 2. Ügyfél-felület (Livewire)

- `routes/web.php`: a `verified` middleware **lekerül** az `['auth', 'verified']`
  csoportról → marad `['auth']`. A megerősítetlen user eléri olvasásra az oldalakat.
- A `verified` middleware **marad** a tiszta POST `subscription.checkout` route-on
  (szerver-oldali backstop az írási belépési ponton).
- A Livewire write-metódusok elejére `if (! $this->guardWrite()) { return; }`:
  `UpdateModulePage::update()`, `CreateModulePage::create()`,
  `ManageUsers::createUser()`, `attachExistingUser()`.
- A ManageUsers tábla create/edit/delete akciói és a `SubscrubersSubscriptionsTable`
  „update" akciója `->visible(fn () => $this->userEmailVerified())`.
- Az űrlap-submit gombok megerősítetlen usernél letiltva (`userEmailVerified()`).

### 3. Admin panel (Filament)

- `AdminPanelServiceProvider`: `->emailVerification(promptAction: EmailVerificationPrompt::class, isRequired: false)`.
  Így a prompt elérhető marad, de a kényszerítő middleware nem kerül fel → belépés
  és olvasás engedett megerősítés nélkül.
- Globális akció-elrejtés `AppServiceProvider::boot()`-ban, `configureUsing()`-gal a
  mutáló akció-alaposztályokra (`CreateAction`, `EditAction`, `DeleteAction`,
  `DeleteBulkAction`, `AttachAction`, `AssociateAction`, `DetachAction`,
  `DissociateAction`, `ReplicateAction`, `RestoreAction`, `ForceDeleteAction`):
  `->visible(fn () => Auth::user()?->hasVerifiedEmail() ?? false)`.
  A Filament akció-híváskor szerver-oldalon újraellenőrzi a láthatóságot, így ez
  valódi tiltás, nem csak vizuális.
- Új panel-middleware `App\Http\Middleware\BlockWritesWhenUnverified`: megerősítetlen
  usernél a `*.create` és `*.edit` resource-oldal route-okra (a teljes oldalas
  űrlapok) tiltja a hozzáférést → redirect a resource indexére + figyelmeztető
  notification. A nézet/lista oldalak nyitva maradnak. (A panel `authMiddleware`-be
  kerül, a `RedirectNonAdminFromPanel` mellé.)

### 4. Banner + újraküldés

- Közös ügyfél-layout: figyelmeztető sáv megerősítetlen usernél („E-mail nincs
  megerősítve — írás letiltva, amíg meg nem erősíted") + „Megerősítő levél
  újraküldése" gomb.
- Filament: `PanelsRenderHook::BODY_START` render hookra ugyanez a banner.
- Új route: `POST /email/verification-notification`, név `verification.send`,
  middleware `['auth', 'throttle:6,1']`. Meghívja
  `$request->user()->sendEmailVerificationNotification()`, majd vissza
  notification-nel. Mindkét banner ezt használja.

## Adatfolyam

1. User belép → `hasVerifiedEmail()` false.
2. Olvasó oldalak (GET) elérhetők; banner megjelenik.
3. Write próbálkozás:
   - Livewire akció: `guardWrite()` false → notification, nincs DB-változás.
   - Letiltott/elrejtett gombok: a UI nem is engedi.
   - Filament create/edit oldal: middleware redirect + notification.
   - POST checkout: `verified` middleware blokkol.
4. User az újraküldés gombbal kér új levelet (throttle).
5. Megerősítés után (meglévő `EmailVerificationController` változatlan):
   `hasVerifiedEmail()` true → minden írás engedett, banner eltűnik.

## Hibakezelés

- A `guardWrite()` mindig felhasználóbarát notification-t küld, nem dob kivételt.
- Az újraküldés `throttle:6,1` alatt; túllépésnél a standard 429.
- A banner csak belépett + megerősítetlen usernél jelenik meg.

## Tesztelés (Pest, feature)

- **Olvasás engedett:** megerősítetlen user GET `/modules`, `/subscriptions`,
  `/manage-users`, admin dashboard → 200.
- **Írás tiltott (ügyfél):** megerősítetlen user `UpdateModulePage::update()`,
  `CreateModulePage::create()`, `ManageUsers::createUser()`, `attachExistingUser()`
  → nincs DB-változás + notification; POST checkout → redirect a notice-ra.
- **Írás tiltott (admin):** megerősítetlen user a `*.create`/`*.edit` oldalakra →
  redirect indexre; mutáló Filament akció nem hívható.
- **Regresszió:** megerősített user minden fenti írást végrehajthat.
- **Újraküldés:** `verification.send` levelet küld (`Notification::fake()`),
  throttle érvényesül.

## Érintett fájlok

- Új: `app/Concerns/RequiresEmailVerification.php`
- Új: `app/Http/Middleware/BlockWritesWhenUnverified.php`
- Új: banner Blade partial(ek) + `verification.send` controller/closure
- Mód.: `routes/web.php` (verified levétel a csoportról, verification.send route)
- Mód.: `app/Providers/Filament/AdminPanelServiceProvider.php` (isRequired: false,
  middleware, render hook)
- Mód.: `app/Providers/AppServiceProvider.php` (globális action configureUsing)
- Mód.: `UpdateModulePage`, `CreateModulePage`, `ManageUsers`,
  `SubscrubersSubscriptionsTable` (trait + guard + visible)
- Új tesztek a `tests/Feature/` alatt
