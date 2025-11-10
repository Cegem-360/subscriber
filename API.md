# Subscriber System - API Documentation

## Áttekintés

Ez a dokumentáció a Subscriber rendszer REST API-ját ismerteti, amelyet a microservice-ek használnak az előfizetés validáláshoz és jogosultság ellenőrzéshez.

**Base URL**: `https://subscriber.yourdomain.com/api/v1`

**Authentication**: Bearer Token

**Content-Type**: `application/json`

---

## Gyors Start

### 1. Token Generálás

Először hozz létre egy API token-t a Filament admin panelben, vagy használd az API-t:

```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/auth/token \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ADMIN_TOKEN" \
  -d '{
    "name": "My Microservice Token",
    "abilities": ["access:my-service"]
  }'
```

Response:
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "name": "My Microservice Token",
  "expires_at": "2026-11-10T12:00:00Z"
}
```

**⚠️ Fontos**: A token csak egyszer jelenik meg. Mentsd el biztonságos helyre!

### 2. Validálás Használata

Minden kérés előtt validáld az előfizetést:

```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/validate \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "microservice": "my-service"
  }'
```

### 3. PHP Example (Microservice-ben)

```php
use Illuminate\Support\Facades\Http;

class SubscriberClient
{
    private string $baseUrl;
    private string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.subscriber.url');
        $this->token = config('services.subscriber.token');
    }

    public function validateAccess(string $microservice): bool
    {
        $response = Http::withToken($this->token)
            ->timeout(5)
            ->post("{$this->baseUrl}/api/v1/validate", [
                'microservice' => $microservice,
            ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['authorized'] ?? false;
        }

        return false;
    }

    public function getSubscription(): ?array
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/subscription/status");

        return $response->successful() ? $response->json() : null;
    }
}
```

---

## Authentication

### Bearer Token

Minden kéréshez szükséges a Bearer token az Authorization headerben:

```http
Authorization: Bearer {your_api_token}
```

### Token Típusok

1. **User Token**: Egy felhasználóhoz tartozó token
2. **Service Token**: Microservice-hez tartozó token (recommended)

### Token Lifecycle

- **Creation**: Admin panel vagy API
- **Expiration**: Konfigurálható (default: 1 év)
- **Rotation**: Manual rotation támogatott
- **Revocation**: Azonnali, cache-ből is törlődik

---

## Endpoints

### 1. Authentication

#### 1.1 Create Token

Új API token létrehozása.

**Endpoint**: `POST /api/v1/auth/token`

**Authentication**: Required (admin or user)

**Request Body**:
```json
{
  "name": "string (required, max:255)",
  "abilities": "array (optional)",
  "expires_at": "datetime (optional, default: +1 year)"
}
```

**Example Request**:
```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/auth/token \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Service A Production Token",
    "abilities": ["access:service-a", "read:analytics"],
    "expires_at": "2026-12-31T23:59:59Z"
  }'
```

**Success Response** (201 Created):
```json
{
  "token": "1|eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "name": "Service A Production Token",
  "abilities": ["access:service-a", "read:analytics"],
  "expires_at": "2026-12-31T23:59:59Z",
  "created_at": "2025-11-10T12:00:00Z"
}
```

**Error Responses**:

```json
// 401 Unauthorized
{
  "message": "Unauthenticated."
}

// 422 Validation Error
{
  "message": "The name field is required.",
  "errors": {
    "name": ["The name field is required."]
  }
}
```

---

#### 1.2 List Tokens

Felhasználó token-jeinek listázása.

**Endpoint**: `GET /api/v1/auth/tokens`

**Authentication**: Required

**Query Parameters**:
- `per_page` (optional, default: 15): Oldalanként hány elem

**Example Request**:
```bash
curl -X GET "https://subscriber.yourdomain.com/api/v1/auth/tokens?per_page=20" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Success Response** (200 OK):
```json
{
  "data": [
    {
      "id": 1,
      "name": "Service A Production Token",
      "abilities": ["access:service-a"],
      "last_used_at": "2025-11-10T11:45:00Z",
      "expires_at": "2026-11-10T12:00:00Z",
      "created_at": "2025-11-10T12:00:00Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "total": 1,
    "per_page": 20
  }
}
```

---

#### 1.3 Revoke Token

Token visszavonása (törlés).

**Endpoint**: `DELETE /api/v1/auth/token/{id}`

**Authentication**: Required

**Example Request**:
```bash
curl -X DELETE https://subscriber.yourdomain.com/api/v1/auth/token/1 \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Success Response** (204 No Content)

**Error Response**:
```json
// 404 Not Found
{
  "message": "Token not found."
}
```

---

### 2. Subscription Validation

#### 2.1 Validate Access

**Ez a fő endpoint amit a microservice-ek használnak.**

Ellenőrzi, hogy a felhasználó előfizetése aktív-e és van-e jogosultsága az adott microservice-hez.

**Endpoint**: `POST /api/v1/validate`

**Authentication**: Required (Bearer Token)

**Request Body**:
```json
{
  "microservice": "string (required)"
}
```

**Example Request**:
```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/validate \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "microservice": "service-a"
  }'
```

**Success Response** (200 OK):
```json
{
  "authorized": true,
  "user": {
    "id": 123,
    "name": "John Doe",
    "email": "john@example.com"
  },
  "subscription": {
    "id": 456,
    "status": "active",
    "plan": {
      "id": 2,
      "name": "Pro",
      "slug": "pro",
      "billing_period": "monthly"
    },
    "trial_ends_at": null,
    "current_period_start": "2025-11-01T00:00:00Z",
    "current_period_end": "2025-12-01T00:00:00Z"
  },
  "permissions": [
    "service-a",
    "service-b",
    "service-c"
  ],
  "rate_limit": {
    "limit": 500,
    "remaining": 487,
    "reset_at": "2025-11-10T12:01:00Z"
  }
}
```

**Error Responses**:

```json
// 401 Unauthorized
{
  "message": "Unauthenticated.",
  "error": "Invalid or expired token"
}

// 402 Payment Required (Subscription Expired)
{
  "authorized": false,
  "error": "Subscription expired",
  "message": "Your subscription has expired. Please renew to continue.",
  "subscription": {
    "status": "expired",
    "expired_at": "2025-10-01T00:00:00Z"
  }
}

// 403 Forbidden (No Permission)
{
  "authorized": false,
  "error": "Insufficient permissions",
  "message": "Your current plan does not include access to service-a",
  "subscription": {
    "status": "active",
    "plan": {
      "name": "Basic",
      "slug": "basic"
    }
  },
  "permissions": ["service-x"],
  "upgrade_url": "https://subscriber.yourdomain.com/upgrade"
}

// 422 Validation Error
{
  "message": "The microservice field is required.",
  "errors": {
    "microservice": ["The microservice field is required."]
  }
}
```

---

#### 2.2 Get Subscription Status

Felhasználó előfizetésének részletes lekérése.

**Endpoint**: `GET /api/v1/subscription/status`

**Authentication**: Required

**Example Request**:
```bash
curl -X GET https://subscriber.yourdomain.com/api/v1/subscription/status \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Success Response** (200 OK):
```json
{
  "id": 456,
  "status": "active",
  "plan": {
    "id": 2,
    "name": "Pro",
    "slug": "pro",
    "price": 29.99,
    "billing_period": "monthly",
    "features": [
      "Unlimited API calls",
      "Priority support",
      "Advanced analytics"
    ]
  },
  "trial_ends_at": null,
  "current_period_start": "2025-11-01T00:00:00Z",
  "current_period_end": "2025-12-01T00:00:00Z",
  "canceled_at": null,
  "created_at": "2024-01-15T10:30:00Z",
  "updated_at": "2025-11-01T00:00:00Z"
}
```

**Error Response**:
```json
// 404 Not Found
{
  "message": "No active subscription found.",
  "error": "User does not have an active subscription"
}
```

---

#### 2.3 Get Microservice Permissions

Felhasználó elérhető microservice-einek listája.

**Endpoint**: `GET /api/v1/subscription/permissions`

**Authentication**: Required

**Example Request**:
```bash
curl -X GET https://subscriber.yourdomain.com/api/v1/subscription/permissions \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Success Response** (200 OK):
```json
{
  "subscription_id": 456,
  "plan": {
    "name": "Pro",
    "slug": "pro"
  },
  "permissions": [
    {
      "microservice_name": "Service A",
      "microservice_slug": "service-a",
      "is_active": true,
      "activated_at": "2024-01-15T10:30:00Z",
      "expires_at": null
    },
    {
      "microservice_name": "Service B",
      "microservice_slug": "service-b",
      "is_active": true,
      "activated_at": "2024-01-15T10:30:00Z",
      "expires_at": null
    }
  ]
}
```

---

### 3. Usage Tracking

#### 3.1 Track Usage

Microservice használat naplózása (opcionális, analytics célra).

**Endpoint**: `POST /api/v1/usage/track`

**Authentication**: Required

**Request Body**:
```json
{
  "microservice": "string (required)",
  "endpoint": "string (optional)",
  "request_count": "integer (optional, default: 1)",
  "response_time": "integer (optional, milliseconds)",
  "metadata": "object (optional)"
}
```

**Example Request**:
```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/usage/track \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "microservice": "service-a",
    "endpoint": "/api/v1/process",
    "request_count": 1,
    "response_time": 150,
    "metadata": {
      "action": "document_processing",
      "document_size": 1024
    }
  }'
```

**Success Response** (201 Created):
```json
{
  "logged": true,
  "message": "Usage tracked successfully"
}
```

---

#### 3.2 Get Usage Statistics

Használati statisztikák lekérdezése (opcionális).

**Endpoint**: `GET /api/v1/usage/stats`

**Authentication**: Required

**Query Parameters**:
- `from` (optional): Start date (Y-m-d)
- `to` (optional): End date (Y-m-d)
- `microservice` (optional): Filter by microservice

**Example Request**:
```bash
curl -X GET "https://subscriber.yourdomain.com/api/v1/usage/stats?from=2025-11-01&to=2025-11-10&microservice=service-a" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Success Response** (200 OK):
```json
{
  "period": {
    "from": "2025-11-01",
    "to": "2025-11-10"
  },
  "total_requests": 15432,
  "by_microservice": [
    {
      "microservice": "service-a",
      "request_count": 10234,
      "avg_response_time": 145
    },
    {
      "microservice": "service-b",
      "request_count": 5198,
      "avg_response_time": 230
    }
  ],
  "daily_breakdown": [
    {
      "date": "2025-11-01",
      "requests": 1543
    }
  ]
}
```

---

## Rate Limiting

### Rate Limit Headers

Minden válasz tartalmazza a rate limit információkat:

```http
X-RateLimit-Limit: 500
X-RateLimit-Remaining: 487
X-RateLimit-Reset: 1699632060
```

### Rate Limit by Plan

| Plan       | Requests/min | Daily Limit |
|------------|--------------|-------------|
| Basic      | 100          | 10,000      |
| Pro        | 500          | 100,000     |
| Enterprise | Unlimited    | Unlimited   |

### 429 Too Many Requests Response

```json
{
  "message": "Too Many Requests",
  "error": "Rate limit exceeded",
  "retry_after": 60,
  "limit": 500,
  "remaining": 0,
  "reset_at": "2025-11-10T12:01:00Z"
}
```

**Retry Strategy**:
1. Wait for `retry_after` seconds
2. Use exponential backoff: 1s, 2s, 4s, 8s
3. Maximum 5 retries

---

## Error Handling

### Error Response Format

Minden hiba válasz az alábbi formátumot követi:

```json
{
  "message": "Human readable error message",
  "error": "Machine readable error code",
  "details": {} // Optional additional information
}
```

### HTTP Status Codes

| Code | Description | Usage |
|------|-------------|-------|
| 200  | OK | Successful request |
| 201  | Created | Resource created successfully |
| 204  | No Content | Successful deletion |
| 400  | Bad Request | Invalid request format |
| 401  | Unauthorized | Invalid or missing token |
| 402  | Payment Required | Subscription expired |
| 403  | Forbidden | Insufficient permissions |
| 404  | Not Found | Resource not found |
| 422  | Unprocessable Entity | Validation error |
| 429  | Too Many Requests | Rate limit exceeded |
| 500  | Internal Server Error | Server error |
| 503  | Service Unavailable | Temporary unavailable |

---

## Best Practices

### 1. Caching Validation Results

Az előfizetés validációt érdemes cache-elni a microservice oldalon:

```php
use Illuminate\Support\Facades\Cache;

public function validateAccess(string $microservice): bool
{
    $cacheKey = "subscriber:validated:{$this->userId}:{$microservice}";

    return Cache::remember($cacheKey, 300, function () use ($microservice) {
        $response = Http::withToken($this->token)
            ->post("{$this->baseUrl}/api/v1/validate", [
                'microservice' => $microservice,
            ]);

        return $response->successful()
            && ($response->json()['authorized'] ?? false);
    });
}
```

**Cache TTL**: 5 perc (300 másodperc)

### 2. Graceful Degradation

Ha a Subscriber API nem elérhető, használj fallback mechanizmust:

```php
public function validateAccess(string $microservice): bool
{
    try {
        return $this->subscriberClient->validateAccess($microservice);
    } catch (ConnectionException $e) {
        Log::error('Subscriber API unavailable', [
            'error' => $e->getMessage(),
        ]);

        // Fallback: allow access for 5 minutes
        return Cache::remember(
            "subscriber:fallback:{$this->userId}",
            300,
            fn() => true
        );
    }
}
```

### 3. Timeout Beállítás

Mindig állíts be timeout-ot a HTTP kérésekhez:

```php
Http::withToken($token)
    ->timeout(5) // 5 seconds
    ->retry(3, 100) // 3 attempts, 100ms delay
    ->post($url, $data);
```

### 4. Error Logging

Naplózd a validációs hibákat:

```php
if (!$response->successful()) {
    Log::warning('Subscriber validation failed', [
        'user_id' => $this->userId,
        'microservice' => $microservice,
        'status' => $response->status(),
        'error' => $response->json('error'),
    ]);
}
```

### 5. Middleware Pattern

Használj middleware-t a microservice-ben:

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SubscriberClient;

class ValidateSubscription
{
    public function __construct(
        private SubscriberClient $subscriber
    ) {}

    public function handle(Request $request, Closure $next, string $microservice)
    {
        if (!$this->subscriber->validateAccess($microservice)) {
            return response()->json([
                'message' => 'Subscription required',
                'upgrade_url' => config('services.subscriber.upgrade_url'),
            ], 402);
        }

        return $next($request);
    }
}
```

Használat route-ban:
```php
Route::middleware(['auth', 'validate.subscription:service-a'])
    ->group(function () {
        Route::get('/api/process', [ProcessController::class, 'process']);
    });
```

---

## SDKs & Libraries

### PHP SDK (Recommended)

Készítettünk egy PHP SDK-t a könnyebb integrációhoz:

```bash
composer require yourdomain/subscriber-sdk
```

```php
use YourDomain\Subscriber\SubscriberClient;

$client = new SubscriberClient(
    baseUrl: config('services.subscriber.url'),
    token: config('services.subscriber.token'),
);

// Simple validation
if ($client->canAccess('service-a')) {
    // Process request
}

// Get full subscription details
$subscription = $client->getSubscription();

// Track usage
$client->trackUsage('service-a', [
    'endpoint' => '/api/process',
    'response_time' => 150,
]);
```

### JavaScript/Node.js SDK

```bash
npm install @yourdomain/subscriber-sdk
```

```javascript
const { SubscriberClient } = require('@yourdomain/subscriber-sdk');

const client = new SubscriberClient({
  baseUrl: process.env.SUBSCRIBER_URL,
  token: process.env.SUBSCRIBER_TOKEN,
});

// Validate access
const canAccess = await client.validateAccess('service-a');

// Get subscription
const subscription = await client.getSubscription();
```

---

## Webhook Support (Future)

**Tervezett funkció**: Webhook support, hogy a microservice-ek értesítést kapjanak előfizetés változásokról.

Események:
- `subscription.created`
- `subscription.updated`
- `subscription.canceled`
- `subscription.expired`
- `permission.granted`
- `permission.revoked`

---

## Testing

### Test Tokens

Development környezetben használd a test token-eket:

```
Test Token: test_1234567890abcdef
User ID: 1
Plan: Pro (all permissions)
```

### Sandbox Mode

A subscriber rendszer támogatja a sandbox mode-ot:

```bash
# .env
SUBSCRIBER_SANDBOX_MODE=true
```

Sandbox mode-ban:
- Minden validáció sikeres
- Nincs rate limiting
- Stripe test mode

---

## Support & Contact

**Documentation**: https://docs.yourdomain.com/subscriber
**API Status**: https://status.yourdomain.com
**Support Email**: support@yourdomain.com
**GitHub Issues**: https://github.com/yourdomain/subscriber/issues

---

## Changelog

### v1.0.0 (2025-11-10)
- Initial API release
- Authentication endpoints
- Validation endpoints
- Usage tracking endpoints
- Rate limiting

---

**API Version**: v1
**Last Updated**: 2025-11-10
**Next Review**: Quarterly
