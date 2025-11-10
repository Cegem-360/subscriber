# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned Features
- Two-factor authentication (2FA)
- Customer self-service portal
- Advanced usage analytics per microservice
- Webhook support for microservices
- Multi-currency support
- Automated invoice retry on Billingo failure
- Subscription analytics dashboard
- Email notification preferences
- API rate limit customization per user
- Webhook replay functionality

---

## [1.0.0] - TBD

### Added

#### Core Features
- Initial project setup with Laravel 12
- Filament 4 admin panel integration
- Stripe payment integration
- Billingo invoicing integration
- Microservice API for subscription validation

#### Database
- Database schema for subscriptions, plans, invoices
- Database schema for microservice permissions
- Database schema for API tokens
- Database schema for usage tracking
- Migrations with proper indexes
- Model factories for testing
- Seeders with default plans

#### Authentication & Authorization
- API token authentication system
- Bearer token-based API access
- Permission-based microservice access
- Plan-based rate limiting
- Laravel Policies for Filament resources

#### Filament Admin Panel
- PlanResource with CRUD operations
- SubscriptionResource with CRUD and custom actions
- InvoiceResource with Billingo sync actions
- UserResource with subscription relations
- MicroservicePermissionResource
- Dashboard widgets:
  - SubscriptionStatsWidget
  - RevenueChartWidget
  - MicroserviceUsageWidget
  - RecentInvoicesWidget

#### Stripe Integration
- Stripe Checkout session creation
- Stripe subscription management
- Webhook handlers:
  - `customer.subscription.created`
  - `customer.subscription.updated`
  - `customer.subscription.deleted`
  - `invoice.payment_succeeded`
  - `invoice.payment_failed`
  - `checkout.session.completed`
- Webhook signature validation
- Automatic subscription sync from Stripe
- Payment retry handling

#### Billingo Integration
- Invoice creation via Billingo API
- Invoice PDF download and storage
- Invoice sync queue jobs
- Automatic invoice generation on payment success
- Invoice email delivery

#### API Endpoints
- `POST /api/v1/auth/token` - Token generation
- `GET /api/v1/auth/tokens` - List user tokens
- `DELETE /api/v1/auth/token/{id}` - Revoke token
- `POST /api/v1/validate` - Validate subscription and permissions
- `GET /api/v1/subscription/status` - Get subscription details
- `GET /api/v1/subscription/permissions` - Get microservice permissions
- `POST /api/v1/usage/track` - Track usage
- `GET /api/v1/usage/stats` - Get usage statistics

#### Queue Jobs
- `SyncSubscriptionFromStripe` - Sync subscription data
- `HandleStripeWebhook` - Process Stripe webhooks
- `SyncInvoiceToBillingo` - Sync invoice to Billingo
- `FetchBillingoInvoiceStatus` - Fetch invoice status
- `SendInvoiceToCustomer` - Email invoice to customer
- `CancelExpiredSubscriptions` - Cleanup expired subscriptions
- `SendExpirationReminders` - Notify expiring subscriptions

#### Events & Listeners
- `SubscriptionCreated` event
- `SubscriptionCanceled` event
- `PaymentSucceeded` event
- `PaymentFailed` event
- `InvoiceCreated` event
- `ActivateMicroservicePermissions` listener
- `SendWelcomeEmail` listener
- `CreateInvoiceFromPayment` listener
- `NotifyAdminOfFailedPayment` listener

#### Middleware
- `ValidateApiToken` - Token validation
- `CheckMicroservicePermission` - Permission check
- `RateLimitBySubscription` - Plan-based rate limiting

#### Services
- `StripeService` - Stripe API wrapper
- `SubscriptionManager` - Subscription lifecycle management
- `PaymentProcessor` - Payment handling
- `BillingoService` - Billingo API wrapper
- `InvoiceGenerator` - Invoice generation
- `InvoiceSyncService` - Billingo sync operations

#### Testing
- Feature tests for subscriptions
- Feature tests for Stripe webhooks
- Feature tests for Billingo sync
- Feature tests for API authentication
- Feature tests for permission validation
- Feature tests for rate limiting
- Unit tests for models
- Unit tests for services
- Filament resource tests

#### Documentation
- [PLAN.md](PLAN.md) - Development plan
- [ARCHITECTURE.md](ARCHITECTURE.md) - System architecture
- [API.md](API.md) - API documentation
- [DEPLOYMENT.md](DEPLOYMENT.md) - Deployment guide
- [SECURITY.md](SECURITY.md) - Security policy
- [README.md](README.md) - Project overview
- [CHANGELOG.md](CHANGELOG.md) - This file

#### Security
- API token SHA-256 hashing
- Stripe webhook signature verification
- CSRF protection
- XSS prevention
- SQL injection prevention (Eloquent ORM)
- HTTPS enforcement in production
- Security headers (X-Frame-Options, X-Content-Type-Options, etc.)
- Encrypted sensitive database fields
- Audit logging for security events

#### Development Tools
- Laravel Pint for code formatting
- Pest for testing
- Laravel Telescope for debugging (dev only)
- Laravel Horizon for queue monitoring

---

## Version History Notes

### Version Numbering
- **Major (X.0.0)**: Breaking changes, major feature releases
- **Minor (1.X.0)**: New features, non-breaking changes
- **Patch (1.0.X)**: Bug fixes, security patches

### Release Schedule
- **Major releases**: Annually or as needed
- **Minor releases**: Monthly or as needed
- **Patch releases**: As needed for bug fixes and security

---

## How to Report Issues

If you find a bug or have a feature request:

1. **Check existing issues**: [GitHub Issues](https://github.com/yourdomain/subscriber/issues)
2. **Create new issue**: Use appropriate template (bug report, feature request)
3. **Security issues**: Email security@yourdomain.com (DO NOT create public issue)

---

## Contributing

See [SECURITY.md](SECURITY.md) for contribution guidelines.

---

**Last Updated**: 2025-11-10
