# Subscriber System

> Laravel-based subscription management system with Filament admin panel, Stripe payments, Billingo invoicing, and microservice API integration.

## Áttekintés

A Subscriber System egy modern előfizetés-kezelő platform, amely:

- 📊 **Filament Admin Panel** - Átlátható adminisztrációs felület
- 💳 **Stripe Integration** - Biztonságos fizetési rendszer
- 🧾 **Billingo Integration** - Automatikus számlázás
- 🔐 **Microservice API** - REST API előfizetés validáláshoz
- 📈 **Analytics & Reporting** - Előfizetés és bevétel elemzés
- ⚡ **Real-time Updates** - Webhook-based szinkronizáció

## Technológiai Stack

- **Backend**: Laravel 12, PHP 8.4+
- **Admin**: Filament 4, Livewire 3
- **Frontend**: Tailwind CSS 4, Alpine.js
- **Database**: MySQL 8.0+ / PostgreSQL 15+
- **Cache & Queue**: Redis
- **Testing**: Pest 3
- **Payments**: Stripe
- **Invoicing**: Billingo API v3

## Gyors Start

### Követelmények

- PHP 8.4+
- Composer 2.6+
- Node.js 20+
- MySQL 8.0+ vagy PostgreSQL 15+
- Redis 6.0+
- Laravel Herd (development)

### Telepítés

```bash
# Dependencies telepítése
composer install
npm install

# Environment konfiguráció
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Storage link
php artisan storage:link

# Frontend build
npm run dev

# Queue worker (külön terminálban)
php artisan queue:work
```

### Elérés

Development: `https://subscriber.test`

Admin login:
- Email: `admin@subscriber.test`
- Password: `password`

## Dokumentáció

- 📋 [**PLAN.md**](PLAN.md) - Fejlesztési terv és ütemezés
- 🏗️ [**ARCHITECTURE.md**](ARCHITECTURE.md) - Rendszer architektúra
- 🔌 [**API.md**](API.md) - API dokumentáció microservice-ekhez
- 🚀 [**DEPLOYMENT.md**](DEPLOYMENT.md) - Telepítési útmutató
- 🔒 [**SECURITY.md**](SECURITY.md) - Biztonsági szabályzat

## Főbb Funkciók

### 1. Előfizetés Kezelés

- ✅ Többszintű előfizetési csomagok (Basic, Pro, Enterprise)
- ✅ Trial period támogatás
- ✅ Automatikus megújítás
- ✅ Lemondás és újraaktiválás
- ✅ Prorated upgrades/downgrades
- ✅ Grace period expired előfizetéseknél

### 2. Fizetési Rendszer

- 💳 Stripe Checkout integráció
- 🔄 Webhook-based szinkronizáció
- 💰 Automatikus payment retry
- 📧 Payment sikeres/sikertelen értesítések
- 🔐 PCI compliant (Stripe hosted)

### 3. Számlázás

- 🧾 Billingo integráció
- 📄 Automatikus számla generálás
- 📨 Számla küldés emailben
- 💾 PDF tárolás és letöltés
- 🔄 Automatic sync on payment success

### 4. Microservice API

- 🔐 Bearer token authentication
- ✅ Előfizetés validálás endpoint
- 📊 Usage tracking
- ⚡ Plan-based rate limiting
- 🎯 Permission-based access control

### 5. Admin Panel

- 👥 Felhasználó kezelés
- 📦 Csomag kezelés
- 📊 Előfizetés áttekintés
- 🧾 Számla kezelés
- 🔑 API token management
- 📈 Dashboard widgets (MRR, churn, analytics)

## API Példa

### Előfizetés Validálás

```bash
curl -X POST https://subscriber.yourdomain.com/api/v1/validate \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"microservice": "service-a"}'
```

### Response

```json
{
  "authorized": true,
  "subscription": {
    "status": "active",
    "plan": {
      "name": "Pro",
      "slug": "pro"
    },
    "current_period_end": "2025-12-01T00:00:00Z"
  },
  "permissions": ["service-a", "service-b"],
  "rate_limit": {
    "limit": 500,
    "remaining": 487
  }
}
```

Részletes API dokumentáció: [API.md](API.md)

## Fejlesztés

### Code Style

```bash
# PHP formatting (Laravel Pint)
./vendor/bin/pint

# Check without fixing
./vendor/bin/pint --test
```

### Testing

```bash
# Összes teszt futtatása
php artisan test

# Egy fájl tesztelése
php artisan test tests/Feature/SubscriptionTest.php

# Szűrés név alapján
php artisan test --filter=testUserCanSubscribe

# Coverage
php artisan test --coverage
```

### Database

```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Rollback
php artisan migrate:rollback

# Create new migration
php artisan make:migration create_something_table
```

### Queue

```bash
# Queue worker
php artisan queue:work

# Failed jobs
php artisan queue:failed
php artisan queue:retry all
```

## Deployment

### Production Setup

```bash
# Optimize for production
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run migrations
php artisan migrate --force
```

Részletes deployment útmutató: [DEPLOYMENT.md](DEPLOYMENT.md)

## Környezeti Változók

Főbb environment változók:

```env
# Application
APP_ENV=production
APP_DEBUG=false
APP_URL=https://subscriber.yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=subscriber
DB_USERNAME=subscriber
DB_PASSWORD=your_password

# Redis
REDIS_HOST=127.0.0.1

# Stripe
STRIPE_KEY=pk_live_your_key
STRIPE_SECRET=sk_live_your_secret
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

# Billingo
BILLINGO_API_KEY=your_api_key
BILLINGO_BLOCK_ID=your_block_id

# Queue
QUEUE_CONNECTION=redis
```

Teljes lista: [DEPLOYMENT.md](DEPLOYMENT.md)

## Project Structure

```
subscriber/
├── app/
│   ├── Filament/           # Filament Resources, Widgets, Pages
│   ├── Http/
│   │   ├── Controllers/    # API Controllers
│   │   └── Middleware/     # Custom Middleware
│   ├── Models/             # Eloquent Models
│   ├── Services/           # Business Logic Services
│   │   ├── Stripe/        # Stripe Integration
│   │   └── Billingo/      # Billingo Integration
│   ├── Jobs/              # Queue Jobs
│   ├── Events/            # Events
│   └── Listeners/         # Event Listeners
├── database/
│   ├── migrations/        # Database Migrations
│   ├── factories/         # Model Factories
│   └── seeders/           # Database Seeders
├── tests/
│   ├── Feature/           # Feature Tests
│   └── Unit/              # Unit Tests
├── routes/
│   ├── web.php           # Web Routes
│   ├── api.php           # API Routes
│   └── console.php       # Console Routes
├── PLAN.md               # Development Plan
├── ARCHITECTURE.md       # Architecture Documentation
├── API.md                # API Documentation
├── DEPLOYMENT.md         # Deployment Guide
└── SECURITY.md           # Security Policy
```

## Security

Ha biztonsági sebezhetőséget találsz, kérjük NE nyiss publikus issue-t!

Email: **security@yourdomain.com**

Részletek: [SECURITY.md](SECURITY.md)

## Changelog

Az összes változás dokumentálva van a [CHANGELOG.md](CHANGELOG.md) fájlban.

## License

This project is proprietary software. All rights reserved.

## Support

- 📧 Email: support@yourdomain.com
- 🐛 Issues: [GitHub Issues](https://github.com/yourdomain/subscriber/issues)
- 📚 Docs: [Documentation](https://docs.yourdomain.com)

---

Made with ❤️ by [Your Company Name]