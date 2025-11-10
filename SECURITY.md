# Security Policy

## Supported Versions

A következő verziók kapnak biztonsági frissítéseket:

| Version | Supported          |
| ------- | ------------------ |
| 1.x     | :white_check_mark: |

---

## Biztonsági Szempontok

### 1. Authentication & Authorization

#### API Token Security
- **Token Storage**: Minden API token SHA-256 hash-elve van tárolva az adatbázisban
- **Token Display**: Plain-text token csak egyszer jelenik meg, generáláskor
- **Token Rotation**: Manuális token rotation lehetőség
- **Token Expiration**: Konfigurálható lejárati idő (default: 1 év)
- **Token Revocation**: Azonnali visszavonás támogatott

#### User Authentication
- **Password Hashing**: Bcrypt algorithm (Laravel default)
- **Password Requirements**: Minimum 8 karakter (konfigurálható)
- **2FA**: Opcionális kétlépcsős azonosítás (tervezett)
- **Session Management**: Redis-based, biztonságos session handling

### 2. Data Protection

#### Sensitive Data
**Titkosítva tárolt mezők**:
- `stripe_customer_id`
- `billingo_partner_id`
- API tokens (hashed)

**Nem naplózott adatok**:
- Teljes API token-ek
- Credit card információk
- Password-ök
- Session token-ek

#### Database Security
- Separate database user with limited privileges
- No direct database access from web
- Prepared statements (SQL injection védelem)
- Encrypted backups

### 3. API Security

#### Rate Limiting
Plan alapú rate limiting:
- Basic: 100 req/min
- Pro: 500 req/min
- Enterprise: Unlimited

#### Request Validation
- Input validation minden endpoint-on
- CSRF protection (web routes)
- XSS prevention (escaped output)
- SQL injection prevention (Eloquent ORM)

#### Response Security
- Minimal data exposure API responses-ben
- Error messages ne tartalmazzanak sensitive info-t
- Stack traces csak development-ben

### 4. Webhook Security

#### Stripe Webhooks
- **Signature Verification**: Minden webhook aláírás ellenőrzés
- **Timestamp Validation**: 5 perces tolerance replay attack ellen
- **HTTPS Only**: Csak HTTPS endpoint-ok production-ban
- **Idempotency**: Duplicate webhook handling

#### Webhook Endpoints
```
POST /stripe/webhook
├── Verify signature (stripe-signature header)
├── Validate timestamp
├── Process event
└── Return 200 (even on processing errors)
```

### 5. Payment Security

#### PCI Compliance
- **No Card Storage**: Soha nem tárolunk kártyaadatokat
- **Stripe Hosted**: Minden fizetés Stripe Checkout-on keresztül
- **Tokenization**: Stripe token-ek használata
- **SSL/TLS**: HTTPS mindig production-ban

#### Invoice Security
- Invoice PDF-ek védett storage-ban
- Access control invoice letöltéshez
- Billingo secure API kommunikáció

### 6. Infrastructure Security

#### Server Security
- **Firewall**: UFW enabled (22, 80, 443 only)
- **SSH**: Key-based authentication only
- **Updates**: Regular security updates
- **Monitoring**: Failed login attempts monitoring

#### SSL/TLS
- **Certificate**: Let's Encrypt SSL certificate
- **Protocols**: TLS 1.2, TLS 1.3 only
- **Ciphers**: Strong cipher suites
- **HSTS**: HTTP Strict Transport Security enabled

#### Security Headers
```nginx
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Referrer-Policy: no-referrer-when-downgrade
Content-Security-Policy: default-src 'self' https:
```

### 7. Code Security

#### Dependencies
- Regular `composer update` security patches-hez
- `npm audit` fixes
- Laravel security updates prioritization

#### Code Review
- Pull request review kötelező
- Security checklist minden PR-nél
- Automated security scanning (tervezett)

### 8. Logging & Monitoring

#### Security Logging
**Naplózott események**:
- Failed login attempts
- API authentication failures
- Permission denied attempts
- Webhook validation failures
- Database query errors
- Suspicious activity patterns

**Alert Triggers**:
- 5+ failed login attempts / 5 min
- Webhook signature validation failure
- Payment processing errors
- Queue job failures (3+ times)

#### Log Protection
- Logs ne tartalmazzanak sensitive data-t
- Log rotation (max 30 days)
- Restricted log file access

### 9. Backup Security

#### Backup Strategy
- **Frequency**: Daily database backups
- **Encryption**: Encrypted backups
- **Storage**: Offsite storage (S3 compatible)
- **Retention**: 30 days
- **Testing**: Monthly restore tests

#### Access Control
- Backup files restricted access
- Separate backup credentials
- Audit logging for backup access

### 10. Incident Response

#### Security Incident Plan
1. **Detection**: Monitoring, alerts, reports
2. **Containment**: Isolate affected systems
3. **Investigation**: Root cause analysis
4. **Remediation**: Fix vulnerabilities
5. **Communication**: Notify affected users
6. **Post-Mortem**: Document and improve

#### Contact Procedures
- Security incidents: security@yourdomain.com
- Critical: +36 XX XXX XXXX (on-call)
- Response time: < 4 hours for critical

---

## Vulnerability Reporting

### How to Report

Ha biztonsági sebezhetőséget találsz, kérjük **NE** publikus issue-t nyiss!

**Email**: security@yourdomain.com

**Tartalom**:
1. Sebezhetőség leírása
2. Érintett komponensek/verziók
3. Reprodukálási lépések
4. Potential impact
5. Proof of concept (ha van)
6. Javasolt megoldás (opcionális)

### Response Timeline

- **Acknowledgment**: 24 órán belül
- **Initial Assessment**: 72 órán belül
- **Status Update**: Hetente, amíg nincs fix
- **Fix Release**: Severity szerint
  - Critical: 1-3 nap
  - High: 1 hét
  - Medium: 2 hét
  - Low: 1 hónap

### Responsible Disclosure

Kérünk:
- Adj időt a fix elkészítésére (90 nap)
- Ne exploitáld a sebezhetőséget
- Ne class disclosure előtt nyilvánosan

Elismerés:
- Credit a security page-en (ha kéred)
- Bug bounty (ha van program)

---

## Security Best Practices (Developers)

### 1. Input Validation

**Always validate and sanitize user input**:

```php
// Good
$request->validate([
    'email' => 'required|email|max:255',
    'amount' => 'required|numeric|min:0',
]);

// Bad
$email = $_POST['email']; // No validation
```

### 2. SQL Injection Prevention

**Use Eloquent or Query Builder**:

```php
// Good
User::where('email', $email)->first();

// Bad
DB::select("SELECT * FROM users WHERE email = '$email'");
```

### 3. XSS Prevention

**Blade templates auto-escape**:

```blade
{{-- Good (escaped) --}}
{{ $user->name }}

{{-- Bad (unescaped) --}}
{!! $user->name !!}
```

### 4. CSRF Protection

**Use @csrf in forms**:

```blade
<form method="POST" action="/subscription">
    @csrf
    <!-- form fields -->
</form>
```

### 5. Mass Assignment Protection

**Define fillable or guarded**:

```php
class User extends Model
{
    protected $fillable = ['name', 'email'];
    // or
    protected $guarded = ['id', 'is_admin'];
}
```

### 6. Authorization Checks

**Use policies and gates**:

```php
// Good
$this->authorize('update', $subscription);

// Bad
if ($subscription->user_id === auth()->id()) {
    // Update subscription
}
```

### 7. Secure Configuration

**Never commit secrets**:

```php
// Good
$apiKey = config('services.stripe.secret');

// Bad
$apiKey = 'sk_live_xxx'; // Hardcoded
```

### 8. API Rate Limiting

**Apply rate limiting**:

```php
Route::middleware(['auth:api', 'throttle:60,1'])
    ->group(function () {
        // Routes
    });
```

---

## Security Checklist

### Development

- [ ] Input validation minden form-nál
- [ ] CSRF token minden POST request-nél
- [ ] SQL injection prevention (Eloquent használat)
- [ ] XSS prevention (escaped output)
- [ ] Authorization checks minden action-nél
- [ ] Secure password storage (Bcrypt)
- [ ] API token proper hashing
- [ ] No secrets in code/commits

### Pre-Production

- [ ] Security audit completed
- [ ] Dependency vulnerabilities fixed
- [ ] SSL certificate installed
- [ ] Security headers configured
- [ ] Webhook signature validation
- [ ] Rate limiting configured
- [ ] Error messages sanitized
- [ ] Logs don't contain sensitive data

### Production

- [ ] `APP_DEBUG=false`
- [ ] Firewall enabled and configured
- [ ] SSH key-based auth only
- [ ] Database user privileges limited
- [ ] Redis password set
- [ ] Backup encryption enabled
- [ ] Monitoring and alerting active
- [ ] Incident response plan in place

---

## Compliance

### GDPR (General Data Protection Regulation)

#### Data Collection
- Csak szükséges adatok gyűjtése
- Explicit consent szükséges
- Clear privacy policy

#### User Rights
- **Right to Access**: User data export funkció
- **Right to Erasure**: Account deletion funkció
- **Right to Rectification**: Profile update funkció
- **Right to Portability**: Data export JSON/CSV formátumban

#### Data Protection
- Encrypted data storage (sensitive fields)
- Secure data transmission (HTTPS)
- Regular security audits
- Breach notification (72 hours)

### PCI DSS (Payment Card Industry Data Security Standard)

#### Level 4 Compliance (< 1M transactions/year)
- **No Card Data Storage**: Stripe handles all card data
- **SAQ A**: Self-Assessment Questionnaire A
- **SSL/TLS**: HTTPS for all payment pages
- **Network Security**: Firewall, access control

---

## Security Contacts

**Security Team**: security@yourdomain.com
**Emergency Contact**: +36 XX XXX XXXX
**GPG Key**: [security-team-public-key.asc]

---

## Security Updates

Subscribe to security updates:
- **Email**: Subscribe at https://yourdomain.com/security/subscribe
- **RSS**: https://yourdomain.com/security/feed
- **GitHub**: Watch this repository for security advisories

---

## Acknowledgments

Köszönjük a következő security researchers-nek, akik segítettek a rendszer biztonságosabbá tételében:

- [Name] - [Vulnerability Description] - [Date]

*(Lista frissül ahogy beérkeznek a reports)*

---

**Version**: 1.0
**Last Updated**: 2025-11-10
**Next Review**: Quarterly
