# Subscriber Rendszer - Fejlesztési Terv

## Projekt Áttekintés

Filament alapú előfizetés-kezelő rendszer Stripe fizetéssel, Billingo számlázással és microservice vezérléssel.

## Fázisok és Ütemezés

### Fázis 1: Alapok és Adatbázis Struktúra (1-2 hét)

#### 1.1 Database Schema
- [ ] Migrations létrehozása
  - [ ] `users` tábla kiterjesztése (ha szükséges)
  - [ ] `plans` tábla - előfizetési csomagok
  - [ ] `subscriptions` tábla - felhasználói előfizetések
  - [ ] `invoices` tábla - számlák
  - [ ] `microservice_permissions` tábla - service jogosultságok
  - [ ] `api_tokens` tábla - API token-ek
  - [ ] `subscription_usage_logs` tábla - használat naplózás

#### 1.2 Models és Relationships
- [ ] `Plan` model
  - [ ] Relationships: `subscriptions()`
  - [ ] Casts: `features`, `microservices` (JSON)
  - [ ] Scopes: `active()`
- [ ] `Subscription` model
  - [ ] Relationships: `user()`, `plan()`, `invoices()`, `permissions()`
  - [ ] Scopes: `active()`, `trial()`, `canceled()`
  - [ ] Methods: `isActive()`, `onTrial()`, `hasAccessTo()`
- [ ] `Invoice` model
  - [ ] Relationships: `user()`, `subscription()`
  - [ ] Methods: `syncToBillingo()`, `downloadPdf()`
- [ ] `MicroservicePermission` model
  - [ ] Relationships: `subscription()`
  - [ ] Scopes: `active()`, `expired()`
- [ ] `ApiToken` model
  - [ ] Relationships: `user()`
  - [ ] Methods: `isValid()`, `hasExpired()`

#### 1.3 Factories és Seeders
- [ ] `PlanFactory` - teszt csomagok
- [ ] `SubscriptionFactory` - teszt előfizetések
- [ ] `InvoiceFactory` - teszt számlák
- [ ] `PlanSeeder` - alapértelmezett csomagok (Basic, Pro, Enterprise)
- [ ] `TestUserSeeder` - fejlesztői teszt felhasználók

---

### Fázis 2: Filament Admin Panel (1-2 hét)

#### 2.1 Resources
- [ ] `PlanResource`
  - [ ] Form: name, slug, description, price, billing_period, stripe_price_id
  - [ ] JSON editor a features és microservices mezőkhöz
  - [ ] Table: name, price, billing_period, active status
  - [ ] Actions: Activate/Deactivate
- [ ] `SubscriptionResource`
  - [ ] Form: user select, plan select, status, trial dates, period dates
  - [ ] Table: user, plan, status, current_period_end
  - [ ] Filters: status, plan, trial
  - [ ] Actions: Cancel, Reactivate, Manual Sync from Stripe
  - [ ] Relation Manager: Invoices, Permissions
- [ ] `InvoiceResource`
  - [ ] Form: user, subscription, amount, status, invoice_number
  - [ ] Table: user, subscription, amount, status, billingo_synced_at
  - [ ] Filters: status, synced status, date range
  - [ ] Actions: Sync to Billingo, Download PDF, Mark as Paid, Void, Resend Email
  - [ ] Bulk Actions: Sync Multiple to Billingo
- [ ] `UserResource` kiterjesztése
  - [ ] Relation Manager: Subscriptions, Invoices, API Tokens
  - [ ] Custom tab: Subscription Overview
- [ ] `MicroservicePermissionResource`
  - [ ] Table: subscription, microservice_name, is_active, expires_at
  - [ ] Filters: microservice, active status
  - [ ] Actions: Grant/Revoke Access

#### 2.2 Widgets
- [ ] `SubscriptionStatsWidget`
  - [ ] Active subscriptions count
  - [ ] Trial subscriptions count
  - [ ] Canceled this month
  - [ ] Churn rate
- [ ] `RevenueChartWidget`
  - [ ] Monthly recurring revenue (MRR)
  - [ ] Revenue trend chart
- [ ] `MicroserviceUsageWidget`
  - [ ] Active connections per service
  - [ ] Most used services
- [ ] `RecentInvoicesWidget`
  - [ ] Latest 10 invoices
  - [ ] Quick actions

#### 2.3 Custom Pages
- [ ] Dashboard - összes widget megjelenítése
- [ ] Settings page - Stripe és Billingo konfiguráció ellenőrzés

---

### Fázis 3: Stripe Integráció (1-2 hét)

#### 3.1 Core Services
- [ ] `StripeService` létrehozása
  - [ ] `createCheckoutSession()` - checkout session
  - [ ] `createCustomer()` - customer létrehozás
  - [ ] `createSubscription()` - előfizetés létrehozás
  - [ ] `cancelSubscription()` - előfizetés lemondás
  - [ ] `updateSubscription()` - előfizetés módosítás
  - [ ] `syncSubscription()` - Stripe-ból szinkronizálás
- [ ] `SubscriptionManager` létrehozása
  - [ ] `createFromStripe()` - lokális subscription létrehozás
  - [ ] `syncStatus()` - státusz szinkronizálás
  - [ ] `handleCancellation()` - lemondás kezelés
  - [ ] `activateMicroservices()` - jogosultságok aktiválása
- [ ] `PaymentProcessor` létrehozása
  - [ ] `processPayment()` - fizetés feldolgozás
  - [ ] `createInvoice()` - számla létrehozás
  - [ ] `handlePaymentFailed()` - sikertelen fizetés

#### 3.2 Webhook Handler
- [ ] `StripeWebhookController` létrehozása
- [ ] Event handlers:
  - [ ] `customer.subscription.created`
  - [ ] `customer.subscription.updated`
  - [ ] `customer.subscription.deleted`
  - [ ] `invoice.payment_succeeded`
  - [ ] `invoice.payment_failed`
  - [ ] `checkout.session.completed`
- [ ] Webhook signature validation
- [ ] Queue-ba küldés a feldolgozáshoz

#### 3.3 Jobs
- [ ] `SyncSubscriptionFromStripe` job
- [ ] `HandleStripeWebhook` job
- [ ] `CancelSubscription` job
- [ ] `ProcessStripePayment` job

#### 3.4 Frontend (opcionális)
- [ ] Subscription checkout page (Livewire component)
- [ ] Billing portal link (Stripe Customer Portal)
- [ ] Current subscription display

---

### Fázis 4: Billingo Integráció (1 hét)

#### 4.1 Core Services
- [ ] `BillingoService` létrehozása
  - [ ] `createInvoice()` - számla létrehozás
  - [ ] `getInvoice()` - számla lekérés
  - [ ] `downloadInvoicePdf()` - PDF letöltés
  - [ ] `sendInvoice()` - számla küldés emailben
  - [ ] `voidInvoice()` - számla érvénytelenítés
- [ ] `InvoiceGenerator` létrehozása
  - [ ] `generateFromPayment()` - számla generálás fizetésből
  - [ ] `formatInvoiceData()` - adat formázás Billingo API-hoz
  - [ ] `storeInvoicePdf()` - PDF tárolás lokálisan
- [ ] `InvoiceSyncService` létrehozása
  - [ ] `syncInvoice()` - számla szinkronizálás
  - [ ] `updateInvoiceStatus()` - státusz frissítés
  - [ ] `retryFailedSync()` - újrapróbálkozás

#### 4.2 Jobs
- [ ] `SyncInvoiceToBillingo` job
  - [ ] Számla adatok küldése
  - [ ] billingo_invoice_id mentése
  - [ ] PDF letöltés és tárolás
- [ ] `FetchBillingoInvoiceStatus` job
  - [ ] Státusz lekérdezés
  - [ ] Lokális számla frissítése
- [ ] `SendInvoiceToCustomer` job
  - [ ] Email küldés PDF melléklettel
  - [ ] Notification a felhasználónak

#### 4.3 Notifications
- [ ] `InvoiceCreatedNotification` - számla létrehozva
- [ ] `InvoicePaymentSucceededNotification` - sikeres fizetés
- [ ] `InvoicePaymentFailedNotification` - sikertelen fizetés

---

### Fázis 5: Microservice API (1-2 hét)

#### 5.1 Authentication
- [ ] `ApiToken` generálás és tárolás (hashed)
- [ ] `ValidateApiToken` middleware
  - [ ] Token validálás
  - [ ] User azonosítás
  - [ ] Last used timestamp frissítés
- [ ] Token expiration kezelés

#### 5.2 API Controllers
- [ ] `AuthController`
  - [ ] `POST /api/v1/auth/token` - token generálás
  - [ ] `DELETE /api/v1/auth/token` - token visszavonás
  - [ ] `GET /api/v1/auth/tokens` - user token-ek listája
- [ ] `SubscriptionValidationController`
  - [ ] `POST /api/v1/validate` - teljes validálás (token + permission)
  - [ ] `GET /api/v1/subscription/status` - előfizetés státusz
  - [ ] `GET /api/v1/subscription/permissions` - elérhető microservice-ek
- [ ] `UsageTrackingController`
  - [ ] `POST /api/v1/usage/track` - használat naplózás
  - [ ] `GET /api/v1/usage/stats` - használati statisztika

#### 5.3 Middleware
- [ ] `ValidateApiToken` - token validálás
- [ ] `CheckMicroservicePermission` - jogosultság ellenőrzés
- [ ] `RateLimitBySubscription` - előfizetés alapú rate limiting
  - [ ] Basic: 100 req/min
  - [ ] Pro: 500 req/min
  - [ ] Enterprise: unlimited

#### 5.4 API Resources
- [ ] `SubscriptionResource` - subscription adatok API-hoz
- [ ] `PermissionResource` - permission adatok API-hoz
- [ ] `UserResource` - user adatok API-hoz (minimal)

#### 5.5 API Documentation
- [ ] OpenAPI/Swagger dokumentáció
- [ ] Példa request/response párok
- [ ] Authentication guide
- [ ] Rate limiting információk

---

### Fázis 6: Tesztelés (folyamatos, 1 hét összesített)

#### 6.1 Feature Tests
- [ ] `SubscriptionTest`
  - [ ] Előfizetés létrehozása
  - [ ] Előfizetés lemondása
  - [ ] Előfizetés újraaktiválása
  - [ ] Trial időszak kezelése
  - [ ] Microservice jogosultságok aktiválása
- [ ] `StripeWebhookTest`
  - [ ] Subscription created webhook
  - [ ] Payment succeeded webhook
  - [ ] Payment failed webhook
  - [ ] Webhook signature validation
- [ ] `BillingoSyncTest`
  - [ ] Számla létrehozás
  - [ ] Számla szinkronizálás
  - [ ] PDF letöltés
  - [ ] Sikertelen sync újrapróbálás
- [ ] `ApiAuthenticationTest`
  - [ ] Token generálás
  - [ ] Token validálás
  - [ ] Token expiration
  - [ ] Érvénytelen token elutasítás
- [ ] `PermissionValidationTest`
  - [ ] Jogosultság ellenőrzés
  - [ ] Lejárt előfizetés elutasítás
  - [ ] Nem létező microservice elutasítás
- [ ] `RateLimitingTest`
  - [ ] Előfizetés szintű rate limiting
  - [ ] Limit túllépés elutasítás

#### 6.2 Unit Tests
- [ ] `PlanTest` - model methods
- [ ] `SubscriptionTest` - model methods
- [ ] `InvoiceTest` - model methods
- [ ] `StripeServiceTest` - service methods (mocked)
- [ ] `BillingoServiceTest` - service methods (mocked)

#### 6.3 Filament Tests
- [ ] `PlanResourceTest` - CRUD műveletek
- [ ] `SubscriptionResourceTest` - CRUD és custom actions
- [ ] `InvoiceResourceTest` - CRUD és sync actions

---

### Fázis 7: Biztonsági Audit és Optimalizálás (1 hét)

#### 7.1 Biztonság
- [ ] API token hash-elés auditálása
- [ ] Webhook signature validation ellenőrzés
- [ ] Rate limiting tesztelése
- [ ] SQL injection védelem ellenőrzés
- [ ] XSS védelem ellenőrzés
- [ ] CSRF védelem API-n (ha alkalmazható)
- [ ] Laravel Policies minden Resource-hoz
- [ ] Sensitive data logging kiszűrése

#### 7.2 Teljesítmény
- [ ] Query optimalizálás (N+1 problémák)
- [ ] Eager loading relationships
- [ ] Database indexek hozzáadása
- [ ] Cache stratégia (subscription status, permissions)
- [ ] Queue worker konfiguráció
- [ ] Redis setup production-höz

#### 7.3 Monitoring
- [ ] Laravel Telescope telepítése (dev)
- [ ] Laravel Horizon telepítése (queue monitoring)
- [ ] Error tracking (Sentry vagy Flare)
- [ ] Webhook failure alerting
- [ ] Payment failure alerting

---

### Fázis 8: Dokumentáció és Deployment (1 hét)

#### 8.1 Dokumentáció
- [x] PLAN.md - ez a fájl
- [ ] ARCHITECTURE.md - rendszer architektúra
- [ ] API.md - API dokumentáció
- [ ] DEPLOYMENT.md - telepítési útmutató
- [ ] .env.example frissítése
- [ ] Inline code dokumentáció (PHPDoc)

#### 8.2 Deployment Előkészítés
- [ ] Environment változók dokumentálása
- [ ] Stripe webhook URL beállítása
- [ ] Queue worker beállítása
- [ ] Cron job beállítása (Laravel scheduler)
- [ ] SSL certificate (HTTPS)
- [ ] Database backup stratégia
- [ ] Rollback terv

#### 8.3 Go Live Checklist
- [ ] Stripe live mode konfiguráció
- [ ] Billingo production API key
- [ ] Database migráció production-ön
- [ ] Alapértelmezett csomagok létrehozása
- [ ] Admin user létrehozása
- [ ] Smoke tests production-ön
- [ ] Monitoring beállítások ellenőrzése

---

## Prioritások

### Must Have (MVP)
1. Alapvető előfizetés kezelés (CRUD)
2. Stripe checkout és webhook kezelés
3. Microservice API authentication és authorization
4. Billingo számla generálás

### Should Have
1. Filament admin dashboard widgets
2. Subscription analytics
3. Email notifications
4. API usage tracking
5. Rate limiting

### Nice to Have
1. Customer self-service portal
2. Detailed usage statistics per microservice
3. Automatic invoice retry on failure
4. Multi-currency support
5. Webhook replay functionality

---

## Kockázatok és Megoldások

| Kockázat | Valószínűség | Hatás | Megoldás |
|----------|-------------|-------|----------|
| Stripe webhook elveszése | Közepes | Magas | Manual sync gomb + cron job szinkronizáláshoz |
| Billingo API timeout | Közepes | Közepes | Job retry logic + manual sync lehetőség |
| Rate limiting túl szigorú | Alacsony | Közepes | Konfigurálható limitek plan alapján |
| Token lejárat közben | Alacsony | Alacsony | Grace period + előzetes notification |
| Microservice down | Közepes | Magas | Timeout handling + fallback mechanism |

---

## Erőforrások

### Fejlesztői Dokumentációk
- [Stripe API Documentation](https://stripe.com/docs/api)
- [Billingo API Documentation](https://www.billingo.hu/api-docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Documentation](https://laravel.com/docs)

### Tooling
- Laravel Pint - code formatting
- Pest - testing
- Laravel Telescope - debugging
- Laravel Horizon - queue monitoring

---

## Következő Lépések

1. **Immediate**: Fázis 1 kezdése - Database schema és models
2. **Week 1**: Migrations, Models, Factories elkészítése
3. **Week 2**: Filament Resources alapok
4. **Week 3-4**: Stripe integráció
5. **Week 5**: Billingo integráció
6. **Week 6-7**: Microservice API
7. **Week 8**: Testing és biztonsági audit
8. **Week 9**: Deployment előkészítés

---

**Frissítve**: 2025-11-10
**Következő felülvizsgálat**: Minden fázis után
