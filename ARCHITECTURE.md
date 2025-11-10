# Subscriber Rendszer - Architektúra Dokumentáció

## Rendszer Áttekintés

A Subscriber rendszer egy Laravel alapú, microservice-orientált előfizetés-kezelő platform, amely Filament admin panelt használ, Stripe-pal integrált fizetési rendszert, Billingo számlázást és API-t biztosít más microservice-ek számára az előfizetés validáláshoz.

```
┌─────────────────────────────────────────────────────────────┐
│                     SUBSCRIBER SYSTEM                        │
│                                                              │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Filament   │  │   Stripe     │  │   Billingo   │      │
│  │     Admin    │  │  Integration │  │ Integration  │      │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘      │
│         │                 │                  │               │
│         └────────┬────────┴──────────────────┘               │
│                  │                                           │
│         ┌────────▼─────────┐                                │
│         │  Core Business   │                                │
│         │      Logic       │                                │
│         └────────┬─────────┘                                │
│                  │                                           │
│         ┌────────▼─────────┐                                │
│         │    Database      │                                │
│         │   (MySQL/Pgsql)  │                                │
│         └──────────────────┘                                │
│                                                              │
│         ┌──────────────────┐                                │
│         │  Public REST API │                                │
│         └────────┬─────────┘                                │
└──────────────────┼──────────────────────────────────────────┘
                   │
                   │ Bearer Token Authentication
                   │
       ┌───────────┼───────────┐
       │           │           │
   ┌───▼────┐  ┌───▼────┐  ┌──▼─────┐
   │Service │  │Service │  │Service │
   │   A    │  │   B    │  │   C    │
   └────────┘  └────────┘  └────────┘
   (Microservices)
```

---

## Technológiai Stack

### Backend Core
- **Framework**: Laravel 12
- **PHP**: 8.4+
- **Database**: MySQL 8.0+ vagy PostgreSQL 15+
- **Cache**: Redis
- **Queue**: Redis
- **Testing**: Pest 3

### Admin Interface
- **Admin Panel**: Filament 4
- **UI Framework**: Livewire 3
- **CSS**: Tailwind CSS 4

### External Services
- **Payment**: Stripe (Checkout, Subscriptions, Webhooks)
- **Invoicing**: Billingo API v3
- **Email**: Laravel Mail (SMTP/SES/Mailgun)

### DevOps
- **Server**: Laravel Herd (dev), Laravel Forge (production)
- **Code Quality**: Laravel Pint
- **Monitoring**: Laravel Telescope (dev), Horizon (queue)

---

## Rétegzett Architektúra

### 1. Presentation Layer (Prezentációs Réteg)

#### Filament Admin Panel
```
app/Filament/
├── Resources/
│   ├── PlanResource.php
│   ├── SubscriptionResource.php
│   ├── InvoiceResource.php
│   ├── UserResource.php
│   └── MicroservicePermissionResource.php
├── Widgets/
│   ├── SubscriptionStatsWidget.php
│   ├── RevenueChartWidget.php
│   └── MicroserviceUsageWidget.php
└── Pages/
    └── Dashboard.php
```

#### Public API
```
app/Http/Controllers/Api/V1/
├── AuthController.php                    # Token management
└── SubscriptionValidationController.php  # Validation endpoint
```

#### Middleware Stack
```
app/Http/Middleware/
├── ValidateApiToken.php            # Token authentication
├── CheckMicroservicePermission.php # Permission check
└── RateLimitBySubscription.php     # Plan-based rate limiting
```

---

### 2. Business Logic Layer (Üzleti Logika Réteg)

#### Core Services
```
app/Services/
├── Subscription/
│   ├── SubscriptionManager.php      # Subscription lifecycle
│   ├── PlanManager.php              # Plan operations
│   └── PermissionManager.php        # Microservice permissions
├── Stripe/
│   ├── StripeService.php            # Stripe API wrapper
│   ├── WebhookHandler.php           # Webhook processing
│   ├── SubscriptionManager.php      # Stripe subscription ops
│   └── PaymentProcessor.php         # Payment handling
└── Billingo/
    ├── BillingoService.php          # Billingo API wrapper
    ├── InvoiceGenerator.php         # Invoice creation
    └── InvoiceSyncService.php       # Sync operations
```

#### Domain Models
```
app/Models/
├── User.php
├── Plan.php
├── Subscription.php
├── Invoice.php
├── MicroservicePermission.php
└── ApiToken.php
```

#### Jobs (Async Processing)
```
app/Jobs/
├── Stripe/
│   ├── SyncSubscriptionFromStripe.php
│   ├── HandleStripeWebhook.php
│   └── ProcessStripePayment.php
├── Billingo/
│   ├── SyncInvoiceToBillingo.php
│   ├── FetchBillingoInvoiceStatus.php
│   └── SendInvoiceToCustomer.php
└── Subscription/
    ├── CancelExpiredSubscriptions.php
    └── SendExpirationReminders.php
```

#### Events & Listeners
```
app/Events/
├── SubscriptionCreated.php
├── SubscriptionCanceled.php
├── PaymentSucceeded.php
├── PaymentFailed.php
└── InvoiceCreated.php

app/Listeners/
├── ActivateMicroservicePermissions.php
├── SendWelcomeEmail.php
├── CreateInvoiceFromPayment.php
└── NotifyAdminOfFailedPayment.php
```

---

### 3. Data Layer (Adat Réteg)

#### Database Schema

**users** (Laravel default + extensions)
```sql
id, name, email, password,
stripe_customer_id, billingo_partner_id,
email_verified_at, remember_token,
created_at, updated_at
```

**plans**
```sql
id, name, slug, description,
price (decimal), billing_period (enum),
stripe_price_id, stripe_product_id,
features (json), microservices (json),
is_active (boolean), sort_order,
created_at, updated_at
```

**subscriptions**
```sql
id, user_id, plan_id,
stripe_subscription_id, stripe_status,
status (enum: active, canceled, expired, past_due, trialing),
trial_ends_at, current_period_start, current_period_end,
canceled_at, ended_at,
created_at, updated_at

Indexes: user_id, plan_id, status, stripe_subscription_id
```

**invoices**
```sql
id, user_id, subscription_id,
stripe_invoice_id, stripe_payment_intent_id,
billingo_invoice_id, invoice_number,
amount (decimal), currency,
status (enum: draft, open, paid, void, uncollectible),
billingo_synced_at, pdf_path,
created_at, updated_at

Indexes: user_id, subscription_id, status, stripe_invoice_id
```

**microservice_permissions**
```sql
id, subscription_id,
microservice_name, microservice_slug,
is_active (boolean),
activated_at, expires_at,
created_at, updated_at

Indexes: subscription_id, microservice_slug, is_active
```

**api_tokens**
```sql
id, user_id,
name, token (hashed),
abilities (json),
last_used_at, expires_at,
created_at, updated_at

Indexes: token (unique), user_id, expires_at
```

#### Relationships
```
User
├── hasMany(Subscription)
├── hasMany(Invoice)
└── hasMany(ApiToken)

Plan
└── hasMany(Subscription)

Subscription
├── belongsTo(User)
├── belongsTo(Plan)
├── hasMany(Invoice)
└── hasMany(MicroservicePermission)

Invoice
├── belongsTo(User)
└── belongsTo(Subscription)

MicroservicePermission
└── belongsTo(Subscription)

ApiToken
└── belongsTo(User)
```

---

## Integrációs Folyamatok

### 1. Előfizetés Létrehozás Flow

```
┌──────┐                    ┌──────────┐                    ┌─────────┐
│ User │                    │ Subscriber│                    │ Stripe  │
└───┬──┘                    └────┬─────┘                    └────┬────┘
    │                            │                               │
    │ 1. Csomag kiválasztás      │                               │
    ├───────────────────────────>│                               │
    │                            │                               │
    │                            │ 2. Create Checkout Session   │
    │                            ├──────────────────────────────>│
    │                            │                               │
    │                            │ 3. Session URL                │
    │                            │<──────────────────────────────┤
    │                            │                               │
    │ 4. Redirect to Stripe      │                               │
    │<───────────────────────────┤                               │
    │                            │                               │
    │ 5. Fizetés                 │                               │
    ├───────────────────────────────────────────────────────────>│
    │                            │                               │
    │                            │ 6. Webhook: checkout.completed│
    │                            │<──────────────────────────────┤
    │                            │                               │
    │                            │ 7. Create Subscription        │
    │                            ├──────────────────────────────>│
    │                            │                               │
    │                            │ 8. Subscription Data          │
    │                            │<──────────────────────────────┤
    │                            │                               │
    │                            │ 9. Store locally              │
    │                            │ 10. Activate permissions      │
    │                            │ 11. Create invoice            │
    │                            │ 12. Queue Billingo sync       │
    │                            │ 13. Send welcome email        │
    │                            │                               │
    │ 14. Redirect to success    │                               │
    │<───────────────────────────┤                               │
```

### 2. Webhook Processing Flow

```
Stripe Webhook
      │
      ▼
ValidateWebhookSignature
      │
      ▼
DispatchToQueue (HandleStripeWebhook Job)
      │
      ▼
┌─────┴─────┬─────────────┬──────────────┐
│           │             │              │
▼           ▼             ▼              ▼
subscription  invoice    customer     payment
.created    .succeeded   .updated     .failed
│           │             │              │
▼           ▼             ▼              ▼
Create      Create        Update         Notify
Subscription Invoice      User Data      Admin
│           │             │              │
▼           ▼             ▼              ▼
Activate    Queue to      Update         Update
Permissions Billingo      Stripe ID      Status
```

### 3. Billingo Sync Flow

```
Payment Succeeded Event
        │
        ▼
Create Invoice Record (local)
        │
        ▼
Dispatch SyncInvoiceToBillingo Job
        │
        ▼
┌───────┴───────┐
│ Format Data   │ (Billingo format)
└───────┬───────┘
        │
        ▼
┌───────┴───────┐
│ POST /invoices│ (Billingo API)
└───────┬───────┘
        │
    ┌───┴───┐
    │Success│
    └───┬───┘
        │
        ▼
Store billingo_invoice_id
        │
        ▼
Download PDF
        │
        ▼
Store PDF locally
        │
        ▼
Queue SendInvoiceToCustomer Job
        │
        ▼
Email with PDF attachment
```

### 4. Microservice Validation Flow

```
Microservice Request
        │
        ▼
Extract Bearer Token
        │
        ▼
ValidateApiToken Middleware
        │
    ┌───┴───┐
    │ Valid?│
    └───┬───┘
        │
   ┌────┴────┐
   │         │
  Yes       No
   │         │
   │         └──> 401 Unauthorized
   │
   ▼
Load User & Active Subscription
   │
   ▼
CheckMicroservicePermission Middleware
   │
   ├──> Check subscription active?
   ├──> Check microservice in plan?
   ├──> Check permission not expired?
   │
   ▼
RateLimitBySubscription Middleware
   │
   ├──> Get plan rate limit
   ├──> Check current usage
   │
   ▼
┌──┴──┐
│Pass?│
└──┬──┘
   │
┌──┴──┐
│     │
Yes   No
│     │
│     └──> 429 Too Many Requests
│
▼
Process Request
│
▼
200 Response + Subscription Data
```

---

## API Design

### Authentication
Minden microservice kérés Bearer Token-t használ:
```http
Authorization: Bearer {api_token}
```

### Endpoints

#### 1. Token Management
```http
POST /api/v1/auth/token
Content-Type: application/json

{
  "name": "Service A Token",
  "abilities": ["access:service-a"]
}

Response 201:
{
  "token": "plain-text-token-only-shown-once",
  "name": "Service A Token",
  "expires_at": "2026-11-10T12:00:00Z"
}
```

#### 2. Validation Endpoint (Primary)
```http
POST /api/v1/validate
Authorization: Bearer {token}
Content-Type: application/json

{
  "microservice": "service-a"
}

Response 200:
{
  "authorized": true,
  "subscription": {
    "id": 123,
    "plan": {
      "name": "Pro",
      "slug": "pro"
    },
    "status": "active",
    "current_period_end": "2025-12-10T00:00:00Z"
  },
  "permissions": [
    "service-a",
    "service-b"
  ],
  "rate_limit": {
    "limit": 500,
    "remaining": 487,
    "reset": "2025-11-10T12:01:00Z"
  }
}

Response 403 (No permission):
{
  "authorized": false,
  "error": "Subscription does not include access to service-a",
  "subscription": {
    "status": "active",
    "plan": "basic"
  }
}

Response 402 (Subscription expired):
{
  "authorized": false,
  "error": "Subscription expired",
  "subscription": {
    "status": "expired",
    "expired_at": "2025-10-10T00:00:00Z"
  }
}
```

### Error Responses

#### 401 Unauthorized
```json
{
  "message": "Unauthenticated.",
  "error": "Invalid or expired token"
}
```

#### 403 Forbidden
```json
{
  "message": "Forbidden.",
  "error": "Subscription does not include access to requested microservice"
}
```

#### 429 Too Many Requests
```json
{
  "message": "Too Many Requests",
  "retry_after": 60,
  "limit": 500,
  "remaining": 0
}
```

---

## Rate Limiting Strategy

### Plan-based Limits
```php
'basic' => [
    'requests_per_minute' => 100,
    'daily_limit' => 10000,
],
'pro' => [
    'requests_per_minute' => 500,
    'daily_limit' => 100000,
],
'enterprise' => [
    'requests_per_minute' => null, // unlimited
    'daily_limit' => null,
],
```

### Implementation
- Redis-based token bucket algorithm
- Per-user tracking via `user_id`
- Response headers:
  - `X-RateLimit-Limit`
  - `X-RateLimit-Remaining`
  - `X-RateLimit-Reset`

---

## Security Considerations

### 1. API Token Security
- **Storage**: Hash tokens using SHA-256 (similar to Laravel Sanctum)
- **Display**: Plain-text token shown only once during creation
- **Rotation**: Support for manual token rotation
- **Expiration**: Configurable expiration (default: 1 year)

### 2. Webhook Security
- **Stripe**: Verify webhook signature using `stripe-signature` header
- **Replay Protection**: Timestamp validation (5-minute tolerance)
- **HTTPS Only**: Reject non-HTTPS webhooks in production

### 3. Data Protection
- **Sensitive Data**: Never log credit card info, full tokens
- **Database**: Encrypt `stripe_customer_id`, `billingo_partner_id`
- **API Responses**: Minimal user data exposure
- **Audit Log**: Track all subscription changes

### 4. Authorization
- **Filament**: Laravel Policies for every Resource
- **API**: Middleware stack validation
- **Microservices**: Permission-based access control

---

## Caching Strategy

### What to Cache
1. **Active Subscriptions**: `subscription:{user_id}` (TTL: 5 min)
2. **Microservice Permissions**: `permissions:{subscription_id}` (TTL: 10 min)
3. **Plan Details**: `plan:{plan_id}` (TTL: 1 hour)
4. **Rate Limit Counters**: `ratelimit:{user_id}` (TTL: 1 min)

### Cache Invalidation
- On subscription update: Clear `subscription:{user_id}`
- On plan update: Clear all `plan:*`
- On permission change: Clear `permissions:{subscription_id}`

### Cache Keys
```php
Cache::remember("subscription:{$userId}", 300, fn() =>
    Subscription::with('plan')->where('user_id', $userId)->first()
);
```

---

## Queue Strategy

### Queues
- `default`: General jobs
- `webhooks`: Stripe/Billingo webhooks (high priority)
- `emails`: Email notifications
- `sync`: Billingo sync operations

### Workers
```bash
# Production
php artisan queue:work redis --queue=webhooks,default,sync,emails --tries=3 --timeout=90
```

### Failed Jobs
- Automatic retry: 3 attempts
- Exponential backoff: 30s, 2min, 10min
- Manual retry via Horizon UI
- Alert admin after 3 failures

---

## Monitoring & Logging

### Metrics to Track
1. **Business Metrics**
   - Active subscriptions count
   - Monthly Recurring Revenue (MRR)
   - Churn rate
   - Average Revenue Per User (ARPU)

2. **Technical Metrics**
   - API response time (p50, p95, p99)
   - API error rate
   - Queue job processing time
   - Failed job count
   - Webhook success/failure rate

3. **Integration Health**
   - Stripe API latency
   - Billingo API latency
   - Webhook delivery success rate

### Logging
```php
// Structured logging
Log::info('subscription.created', [
    'user_id' => $user->id,
    'plan_id' => $plan->id,
    'stripe_subscription_id' => $stripeSubscription->id,
]);

Log::error('billingo.sync.failed', [
    'invoice_id' => $invoice->id,
    'error' => $exception->getMessage(),
]);
```

---

## Deployment Architecture

### Development (Laravel Herd)
```
https://subscriber.test
├── PHP 8.4
├── MySQL 8.0
├── Redis (local)
└── Queue worker (local)
```

### Production
```
┌─────────────────────────────────────────┐
│         Load Balancer (SSL)             │
└─────────────┬───────────────────────────┘
              │
      ┌───────┴────────┐
      │                │
┌─────▼─────┐    ┌─────▼─────┐
│  Web      │    │  Web      │
│  Server 1 │    │  Server 2 │
└─────┬─────┘    └─────┬─────┘
      │                │
      └───────┬────────┘
              │
    ┌─────────▼──────────┐
    │  Database (MySQL)  │
    │  + Read Replicas   │
    └────────────────────┘

    ┌────────────────────┐
    │  Redis (Cache +    │
    │  Queue + Session)  │
    └────────────────────┘

    ┌────────────────────┐
    │  Queue Workers     │
    │  (Separate Server) │
    └────────────────────┘
```

---

## Backup & Disaster Recovery

### Database Backups
- **Frequency**: Daily full backup, hourly incremental
- **Retention**: 30 days
- **Location**: S3-compatible storage (encrypted)
- **Testing**: Monthly restore test

### Application Backups
- **Code**: Git repository (GitHub/GitLab)
- **Config**: .env in secure vault
- **Uploaded Files**: S3 daily backup

### Recovery Time Objective (RTO)
- Critical: 1 hour
- High: 4 hours
- Normal: 24 hours

### Recovery Point Objective (RPO)
- Critical data: 1 hour
- Normal data: 24 hours

---

## Scaling Considerations

### Horizontal Scaling
- **Web Servers**: Load balanced PHP-FPM servers
- **Queue Workers**: Multiple worker servers
- **Database**: Read replicas for reporting

### Vertical Scaling
- **Database**: Upgrade to larger instance
- **Redis**: Separate cache and queue Redis instances
- **Workers**: More CPU cores for parallel processing

### Performance Optimization
1. **Database**: Proper indexing, query optimization
2. **Caching**: Aggressive caching strategy
3. **CDN**: Static assets via CDN
4. **Queue**: Async processing for heavy operations
5. **API**: Response caching for read-heavy endpoints

---

**Verzió**: 1.0
**Utolsó frissítés**: 2025-11-10
**Következő felülvizsgálat**: Implementáció közben folyamatos
