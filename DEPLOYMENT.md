# Subscriber System - Deployment Guide

## Áttekintés

Ez az útmutató végigvezet a Subscriber rendszer telepítésén, konfigurálásán és production environment-ba történő deployment-jén.

---

## Követelmények

### Szerver Követelmények

#### Minimum (Development)
- **PHP**: 8.4+
- **Database**: MySQL 8.0+ vagy PostgreSQL 15+
- **Redis**: 6.0+
- **Node.js**: 20+
- **Composer**: 2.6+
- **Memory**: 512MB RAM
- **Storage**: 10GB

#### Production (Ajánlott)
- **PHP**: 8.4+
- **Database**: MySQL 8.0+ (vagy PostgreSQL 15+)
  - 4 CPU cores
  - 8GB RAM
  - 100GB SSD
- **Redis**: 7.0+
  - 2GB RAM minimum
- **Web Server**: 2+ instances
  - 2 CPU cores per instance
  - 4GB RAM per instance
- **Queue Workers**: Dedicated server
  - 4 CPU cores
  - 8GB RAM
- **Storage**: 100GB+ SSD

### PHP Extensions
```
php -m | grep -E "bcmath|ctype|fileinfo|json|mbstring|openssl|pdo|pdo_mysql|tokenizer|xml|redis|curl|gd|zip"
```

Szükséges extensionök:
- bcmath
- ctype
- curl
- fileinfo
- gd
- json
- mbstring
- openssl
- pdo
- pdo_mysql (vagy pdo_pgsql)
- redis
- tokenizer
- xml
- zip

---

## Development Setup (Laravel Herd)

### 1. Projekt Klónozása

```bash
cd ~/Herd
git clone git@github.com:yourdomain/subscriber.git
cd subscriber
```

### 2. Dependencies Telepítése

```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Environment Variables

Szerkeszd a `.env` fájlt:

```env
# Application
APP_NAME="Subscriber System"
APP_ENV=local
APP_DEBUG=true
APP_URL=https://subscriber.test
APP_TIMEZONE=Europe/Budapest
APP_LOCALE=hu

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscriber
DB_USERNAME=root
DB_PASSWORD=

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@subscriber.test
MAIL_FROM_NAME="${APP_NAME}"

# Stripe (Test Keys)
STRIPE_KEY=pk_test_your_key
STRIPE_SECRET=sk_test_your_secret
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

# Billingo (Test Account)
BILLINGO_API_KEY=your_test_api_key
BILLINGO_BLOCK_ID=your_block_id

# Queue
QUEUE_CONNECTION=redis

# Session
SESSION_DRIVER=redis
SESSION_LIFETIME=120

# Cache
CACHE_STORE=redis

# API
API_TOKEN_LIFETIME=525600  # 1 year in minutes
```

### 5. Database Setup

```bash
# Create database
mysql -u root -e "CREATE DATABASE subscriber CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed with test data
php artisan db:seed
```

### 6. Storage Setup

```bash
php artisan storage:link
```

### 7. Frontend Build

```bash
# Development
npm run dev

# or watch for changes
npm run dev -- --watch
```

### 8. Queue Worker

```bash
# Start queue worker (separate terminal)
php artisan queue:work redis --tries=3
```

### 9. Scheduler (Cron)

```bash
# Add to crontab (or run manually for testing)
* * * * * cd ~/Herd/subscriber && php artisan schedule:run >> /dev/null 2>&1
```

### 10. Hozzáférés

Nyisd meg a böngészőt: `https://subscriber.test`

Admin belépés (ha seedeltél):
- Email: `admin@subscriber.test`
- Password: `password`

---

## Production Deployment

### 1. Szerver Előkészítés

#### 1.1 Ubuntu 22.04 LTS Setup

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.4
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install -y php8.4-fpm php8.4-cli php8.4-mysql php8.4-redis \
  php8.4-xml php8.4-mbstring php8.4-curl php8.4-zip php8.4-gd \
  php8.4-bcmath php8.4-intl

# Install MySQL
sudo apt install -y mysql-server
sudo mysql_secure_installation

# Install Redis
sudo apt install -y redis-server
sudo systemctl enable redis-server

# Install Nginx
sudo apt install -y nginx
sudo systemctl enable nginx

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 2. Database Setup

```bash
# Login to MySQL
sudo mysql

# Create database and user
CREATE DATABASE subscriber CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'subscriber'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON subscriber.* TO 'subscriber'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 3. Deploy User Setup

```bash
# Create deploy user
sudo adduser deploy
sudo usermod -aG www-data deploy

# Setup SSH key for deploy user
sudo su - deploy
mkdir -p ~/.ssh
chmod 700 ~/.ssh
# Add your public key to ~/.ssh/authorized_keys
```

### 4. Application Deployment

```bash
# As deploy user
cd /var/www
git clone git@github.com:yourdomain/subscriber.git
cd subscriber

# Install dependencies (production)
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Set permissions
sudo chown -R deploy:www-data /var/www/subscriber
sudo chmod -R 755 /var/www/subscriber
sudo chmod -R 775 /var/www/subscriber/storage
sudo chmod -R 775 /var/www/subscriber/bootstrap/cache
```

### 5. Environment Configuration

```bash
# Create .env file
cp .env.example .env
nano .env
```

Production `.env`:

```env
# Application
APP_NAME="Subscriber System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://subscriber.yourdomain.com
APP_TIMEZONE=Europe/Budapest
APP_LOCALE=hu

# Security
APP_KEY=base64:your_generated_key_here

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscriber
DB_USERNAME=subscriber
DB_PASSWORD=your_strong_password

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=your_redis_password
REDIS_PORT=6379
REDIS_CLIENT=phpredis

# Mail (Production)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Stripe (Live Keys)
STRIPE_KEY=pk_live_your_key
STRIPE_SECRET=sk_live_your_secret
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

# Billingo (Production)
BILLINGO_API_KEY=your_production_api_key
BILLINGO_BLOCK_ID=your_block_id

# Queue
QUEUE_CONNECTION=redis

# Session
SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

# Cache
CACHE_STORE=redis

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=warning
LOG_SLACK_WEBHOOK_URL=your_slack_webhook

# Monitoring
TELESCOPE_ENABLED=false
```

### 6. Application Setup

```bash
# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Link storage
php artisan storage:link

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimize
php artisan optimize
```

### 7. Nginx Configuration

```bash
sudo nano /etc/nginx/sites-available/subscriber
```

```nginx
# /etc/nginx/sites-available/subscriber

server {
    listen 80;
    listen [::]:80;
    server_name subscriber.yourdomain.com;

    # Redirect HTTP to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name subscriber.yourdomain.com;

    root /var/www/subscriber/public;
    index index.php;

    charset utf-8;

    # SSL Configuration (Let's Encrypt)
    ssl_certificate /etc/letsencrypt/live/subscriber.yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/subscriber.yourdomain.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';" always;

    # Logging
    access_log /var/log/nginx/subscriber-access.log;
    error_log /var/log/nginx/subscriber-error.log;

    # Max upload size
    client_max_body_size 100M;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml text/javascript application/json application/javascript application/xml+rss application/rss+xml font/truetype font/opentype application/vnd.ms-fontobject image/svg+xml;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;

        # Increase timeout for long-running requests
        fastcgi_read_timeout 300;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/subscriber /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 8. SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Get certificate
sudo certbot --nginx -d subscriber.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### 9. PHP-FPM Configuration

```bash
sudo nano /etc/php/8.4/fpm/pool.d/www.conf
```

Optimalizálás:
```ini
[www]
user = www-data
group = www-data
listen = /var/run/php/php8.4-fpm.sock
listen.owner = www-data
listen.group = www-data

pm = dynamic
pm.max_children = 50
pm.start_servers = 10
pm.min_spare_servers = 5
pm.max_spare_servers = 20
pm.max_requests = 500

php_admin_value[memory_limit] = 256M
php_admin_value[upload_max_filesize] = 100M
php_admin_value[post_max_size] = 100M
php_admin_value[max_execution_time] = 300
```

Restart:
```bash
sudo systemctl restart php8.4-fpm
```

### 10. Queue Worker (Systemd)

```bash
sudo nano /etc/systemd/system/subscriber-worker.service
```

```ini
[Unit]
Description=Subscriber Queue Worker
After=network.target redis.service

[Service]
Type=simple
User=deploy
Group=www-data
Restart=always
RestartSec=5s
ExecStart=/usr/bin/php /var/www/subscriber/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600 --max-jobs=1000
StandardOutput=journal
StandardError=journal

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo systemctl daemon-reload
sudo systemctl enable subscriber-worker
sudo systemctl start subscriber-worker
sudo systemctl status subscriber-worker
```

### 11. Laravel Horizon (Optional, Better Queue Management)

```bash
# Install Horizon
composer require laravel/horizon

# Publish config
php artisan horizon:install

# Systemd service
sudo nano /etc/systemd/system/subscriber-horizon.service
```

```ini
[Unit]
Description=Subscriber Horizon
After=network.target redis.service

[Service]
Type=simple
User=deploy
Group=www-data
Restart=always
RestartSec=5s
ExecStart=/usr/bin/php /var/www/subscriber/artisan horizon
StandardOutput=journal
StandardError=journal

[Install]
WantedBy=multi-user.target
```

```bash
sudo systemctl daemon-reload
sudo systemctl enable subscriber-horizon
sudo systemctl start subscriber-horizon
```

### 12. Scheduler (Cron)

```bash
sudo crontab -e -u deploy
```

Add:
```cron
* * * * * cd /var/www/subscriber && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

### 13. Firewall Setup

```bash
# UFW
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'
sudo ufw enable
sudo ufw status
```

### 14. Monitoring Setup (Optional)

```bash
# Install Laravel Telescope (only if needed)
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

---

## Stripe Configuration

### 1. Stripe Account Setup

1. Lépj be: https://dashboard.stripe.com
2. Menj a **Developers** > **API keys**
3. Másold ki:
   - **Publishable key** → `STRIPE_KEY`
   - **Secret key** → `STRIPE_SECRET`

### 2. Stripe Products & Prices

Hozz létre csomagokat a Stripe Dashboard-ban:

```
Product: Basic Plan
├── Price: $9.99/month
└── Price ID: price_xxx123 → DB: plans.stripe_price_id

Product: Pro Plan
├── Price: $29.99/month
└── Price ID: price_xxx456 → DB: plans.stripe_price_id

Product: Enterprise Plan
├── Price: $99.99/month
└── Price ID: price_xxx789 → DB: plans.stripe_price_id
```

### 3. Webhook Setup

1. Menj a **Developers** > **Webhooks**
2. Add endpoint: `https://subscriber.yourdomain.com/stripe/webhook`
3. Select events:
   - `customer.subscription.created`
   - `customer.subscription.updated`
   - `customer.subscription.deleted`
   - `invoice.payment_succeeded`
   - `invoice.payment_failed`
   - `checkout.session.completed`
4. Másold ki a **Signing secret** → `STRIPE_WEBHOOK_SECRET`

### 4. Test Webhooks

```bash
# Install Stripe CLI
brew install stripe/stripe-cli/stripe

# Login
stripe login

# Forward webhooks to local
stripe listen --forward-to https://subscriber.test/stripe/webhook
```

---

## Billingo Configuration

### 1. Billingo Account Setup

1. Lépj be: https://www.billingo.hu
2. Menj a **Beállítások** > **API kulcs**
3. Generálj új API kulcsot → `BILLINGO_API_KEY`
4. Jegyzd fel a Block ID-t → `BILLINGO_BLOCK_ID`

### 2. Partner (Customer) Setup

A rendszer automatikusan létrehozza a Billingo partner rekordokat, amikor első számla generálódik.

Szükséges user mezők:
- `name`
- `email`
- Billing address (opcionális, de ajánlott)

### 3. Test Mode

Billingo nem rendelkezik kifejezett test mode-dal, ezért ajánlott:
1. Teszt céges fiók használata
2. Vagy vásárolj **Billingo Sandbox** hozzáférést

---

## Post-Deployment Checklist

### Security

- [ ] SSL certificate telepítve és automatikus megújítás
- [ ] Firewall konfigurálva (csak 80, 443, 22)
- [ ] `APP_DEBUG=false` production-ban
- [ ] Strong passwords mindenhol
- [ ] SSH key-based authentication
- [ ] Database user limited privileges
- [ ] Redis password set
- [ ] `.env` file permissions (600)
- [ ] Storage directory permissions correct

### Configuration

- [ ] Stripe live mode keys configured
- [ ] Billingo production API key set
- [ ] Email service configured and tested
- [ ] Webhook URLs updated in Stripe
- [ ] Domain DNS records pointing correctly
- [ ] SMTP credentials working
- [ ] Rate limiting configured
- [ ] Session configured for Redis
- [ ] Cache configured for Redis

### Application

- [ ] Database migrations run
- [ ] Default plans created (seeders)
- [ ] Admin user created
- [ ] Storage linked
- [ ] Caches cleared and optimized
- [ ] Queue worker running
- [ ] Scheduler (cron) running
- [ ] Logs directory writable

### Testing

- [ ] Homepage loads correctly
- [ ] Admin panel accessible
- [ ] Login/logout works
- [ ] Stripe checkout flow works
- [ ] Webhook processing works (test payment)
- [ ] Email delivery works
- [ ] Billingo invoice creation works
- [ ] API validation endpoint works
- [ ] Rate limiting works

### Monitoring

- [ ] Application logs configured
- [ ] Error tracking setup (Sentry/Flare)
- [ ] Queue monitoring (Horizon dashboard)
- [ ] Uptime monitoring (Pingdom/UptimeRobot)
- [ ] Performance monitoring
- [ ] Backup automated and tested

---

## Backup Strategy

### 1. Database Backup

```bash
# Daily backup script
sudo nano /usr/local/bin/backup-subscriber-db.sh
```

```bash
#!/bin/bash

BACKUP_DIR="/var/backups/subscriber/db"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="subscriber"
DB_USER="subscriber"
DB_PASS="your_password"

mkdir -p $BACKUP_DIR

# Create backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/subscriber_$DATE.sql.gz

# Keep only last 30 days
find $BACKUP_DIR -name "subscriber_*.sql.gz" -mtime +30 -delete

# Upload to S3 (optional)
# aws s3 cp $BACKUP_DIR/subscriber_$DATE.sql.gz s3://your-bucket/backups/
```

```bash
sudo chmod +x /usr/local/bin/backup-subscriber-db.sh
```

Add to cron:
```bash
sudo crontab -e
```

```cron
0 2 * * * /usr/local/bin/backup-subscriber-db.sh >> /var/log/subscriber-backup.log 2>&1
```

### 2. File Backup

```bash
# Backup storage directory
sudo nano /usr/local/bin/backup-subscriber-files.sh
```

```bash
#!/bin/bash

BACKUP_DIR="/var/backups/subscriber/files"
DATE=$(date +%Y%m%d_%H%M%S)
APP_DIR="/var/www/subscriber/storage/app"

mkdir -p $BACKUP_DIR

# Create backup
tar -czf $BACKUP_DIR/storage_$DATE.tar.gz -C /var/www/subscriber storage/app

# Keep only last 7 days
find $BACKUP_DIR -name "storage_*.tar.gz" -mtime +7 -delete
```

---

## Rollback Plan

### Quick Rollback

```bash
cd /var/www/subscriber

# Pull previous version
git fetch --all
git checkout <previous_commit_hash>

# Update dependencies
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Re-cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart services
sudo systemctl restart php8.4-fpm
sudo systemctl restart subscriber-worker
sudo systemctl restart nginx
```

### Database Rollback

```bash
# Restore from backup
gunzip < /var/backups/subscriber/db/subscriber_20251110_020000.sql.gz | mysql -u subscriber -p subscriber
```

---

## Maintenance Mode

### Enable Maintenance

```bash
php artisan down --secret="your-secret-key"
```

Access via: `https://subscriber.yourdomain.com/your-secret-key`

### Disable Maintenance

```bash
php artisan up
```

---

## Troubleshooting

### Queue Not Processing

```bash
# Check queue worker status
sudo systemctl status subscriber-worker

# Restart queue worker
sudo systemctl restart subscriber-worker

# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all
```

### Webhooks Not Working

```bash
# Check webhook logs
tail -f storage/logs/laravel.log | grep webhook

# Test webhook manually
stripe trigger customer.subscription.created
```

### Performance Issues

```bash
# Check PHP-FPM status
sudo systemctl status php8.4-fpm

# Check slow queries
sudo tail -f /var/log/mysql/slow-query.log

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### High CPU Usage

```bash
# Check running processes
top -c

# Check queue workload
php artisan queue:monitor

# Scale workers if needed
sudo systemctl start subscriber-worker@2
```

---

## Scaling

### Horizontal Scaling (Multiple Web Servers)

1. **Load Balancer** setup (nginx or AWS ELB)
2. **Shared Storage** for `storage/app` (S3 or NFS)
3. **Centralized Redis** for cache, session, queue
4. **Database Read Replicas**

### Vertical Scaling

1. Upgrade server resources (CPU, RAM)
2. Tune PHP-FPM workers
3. Optimize MySQL configuration
4. Increase Redis memory

---

## Updates & Maintenance

### Regular Updates

```bash
# Pull latest code
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Run migrations
php artisan migrate --force

# Clear and re-cache
php artisan optimize:clear
php artisan optimize

# Restart services
sudo systemctl restart php8.4-fpm
sudo systemctl restart subscriber-worker
```

### Security Updates

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Update PHP packages
sudo apt install --only-upgrade php8.4-*

# Update Composer dependencies
composer update --no-dev
```

---

## Support Contacts

**DevOps Team**: devops@yourdomain.com
**Backend Team**: backend@yourdomain.com
**On-Call**: +36 XX XXX XXXX

---

**Version**: 1.0
**Last Updated**: 2025-11-10
**Next Review**: Quarterly
