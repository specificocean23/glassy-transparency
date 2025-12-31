# Configuration Examples for Transparency.ie

## .env Configuration (Development)

```env
APP_NAME="Transparency.ie"
APP_ENV=local
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=Europe/Dublin

LOG_CHANNEL=single
LOG_LEVEL=debug

# Database Configuration
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=transparency_db
DB_USERNAME=postgres
DB_PASSWORD=your_secure_password
DB_SSLMODE=prefer

# Cache & Session
CACHE_DRIVER=redis
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

# Queue Configuration
QUEUE_CONNECTION=sync
QUEUE_FAILED_DRIVER=database

# Mail Configuration (Optional)
MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@transparency.ie"
MAIL_FROM_NAME="Transparency.ie"

# AWS Configuration (Optional)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=

# Social Authentication
SOCIALITE_FACEBOOK_ID=your_facebook_app_id
SOCIALITE_FACEBOOK_SECRET=your_facebook_app_secret
SOCIALITE_FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/callback/facebook

SOCIALITE_GOOGLE_ID=your_google_client_id
SOCIALITE_GOOGLE_SECRET=your_google_client_secret
SOCIALITE_GOOGLE_REDIRECT_URI=http://localhost:8000/auth/callback/google

# enjoydeise Integration
ENJOYDEISE_CLIENT_ID=
ENJOYDEISE_CLIENT_SECRET=
ENJOYDEISE_REDIRECT_URI=http://localhost:8000/auth/callback/enjoydeise

# Filament Configuration
FILAMENT_DEFAULT_TIMEZONE=Europe/Dublin
FILAMENT_THEME=light
FILAMENT_ASSET_PATH=/assets/filament

# API Rate Limiting
API_RATE_LIMIT=60
API_RATE_LIMIT_WINDOW=60
```

## .env Configuration (Production)

```env
APP_NAME="Transparency.ie"
APP_ENV=production
APP_KEY=base64:YOUR_PRODUCTION_KEY_HERE
APP_DEBUG=false
APP_URL=https://transparency.ie
APP_TIMEZONE=Europe/Dublin

LOG_CHANNEL=stack
LOG_LEVEL=warning

# Database Configuration
DB_CONNECTION=pgsql
DB_HOST=your.database.server
DB_PORT=5432
DB_DATABASE=transparency_prod
DB_USERNAME=prod_user
DB_PASSWORD=very_secure_production_password
DB_SSLMODE=require

# Cache & Session
CACHE_DRIVER=redis
CACHE_PREFIX=transparency_prod_
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

# Queue Configuration
QUEUE_CONNECTION=redis
QUEUE_FAILED_DRIVER=database

# Mail Configuration
MAIL_DRIVER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.your_sendgrid_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@transparency.ie"
MAIL_FROM_NAME="Transparency.ie"

# AWS Configuration
AWS_ACCESS_KEY_ID=your_prod_access_key
AWS_SECRET_ACCESS_KEY=your_prod_secret_key
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=transparency-ie-prod

# Social Authentication
SOCIALITE_FACEBOOK_ID=your_production_facebook_id
SOCIALITE_FACEBOOK_SECRET=your_production_facebook_secret
SOCIALITE_FACEBOOK_REDIRECT_URI=https://transparency.ie/auth/callback/facebook

SOCIALITE_GOOGLE_ID=your_production_google_id
SOCIALITE_GOOGLE_SECRET=your_production_google_secret
SOCIALITE_GOOGLE_REDIRECT_URI=https://transparency.ie/auth/callback/google

# enjoydeise Integration
ENJOYDEISE_CLIENT_ID=production_client_id
ENJOYDEISE_CLIENT_SECRET=production_client_secret
ENJOYDEISE_REDIRECT_URI=https://transparency.ie/auth/callback/enjoydeise

# Filament Configuration
FILAMENT_DEFAULT_TIMEZONE=Europe/Dublin
FILAMENT_THEME=light

# API Rate Limiting
API_RATE_LIMIT=300
API_RATE_LIMIT_WINDOW=60
```

## config/app.php (Timezone & Locale)

```php
return [
    'name' => env('APP_NAME', 'Transparency.ie'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'asset_url' => env('ASSET_URL'),

    'timezone' => 'Europe/Dublin',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_IE',

    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'providers' => [
        // ...
        Filament\FilamentServiceProvider::class,
        Laravel\Socialite\SocialiteServiceProvider::class,
    ],

    'aliases' => [
        // ...
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
    ],
];
```

## config/database.php (PostgreSQL Setup)

```php
'default' => env('DB_CONNECTION', 'pgsql'),

'connections' => [
    'pgsql' => [
        'driver' => 'pgsql',
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '5432'),
        'database' => env('DB_DATABASE', 'transparency'),
        'username' => env('DB_USERNAME', 'postgres'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => env('DB_SSLMODE', 'prefer'),
    ],
],
```

## config/services.php (Social Auth)

```php
'socialite' => [
    'facebook' => [
        'client_id' => env('SOCIALITE_FACEBOOK_ID'),
        'client_secret' => env('SOCIALITE_FACEBOOK_SECRET'),
        'redirect' => env('SOCIALITE_FACEBOOK_REDIRECT_URI'),
    ],
    'google' => [
        'client_id' => env('SOCIALITE_GOOGLE_ID'),
        'client_secret' => env('SOCIALITE_GOOGLE_SECRET'),
        'redirect' => env('SOCIALITE_GOOGLE_REDIRECT_URI'),
    ],
    'enjoydeise' => [
        'client_id' => env('ENJOYDEISE_CLIENT_ID'),
        'client_secret' => env('ENJOYDEISE_CLIENT_SECRET'),
        'redirect' => env('ENJOYDEISE_REDIRECT_URI'),
        'host' => env('ENJOYDEISE_HOST', 'https://enjoydeise.ie'),
    ],
],

'aws' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'bucket' => env('AWS_BUCKET'),
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => false,
],
```

## config/cache.php (Redis Caching)

```php
'default' => env('CACHE_DRIVER', 'file'),

'stores' => [
    'redis' => [
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
    ],
],

'redis' => [
    'client' => env('REDIS_CLIENT', 'phpredis'),
    'default' => [
        'scheme' => 'tcp',
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_CACHE_DB', 1),
    ],
],
```

## nginx Configuration

```nginx
server {
    listen 80;
    server_name transparency.ie www.transparency.ie;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name transparency.ie www.transparency.ie;

    ssl_certificate /etc/letsencrypt/live/transparency.ie/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/transparency.ie/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    root /var/www/transparency.ie/public;
    index index.php index.html index.htm;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 50M;

    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml text/javascript application/json application/javascript application/xml+rss;
}
```

## Docker Compose (Optional)

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: transparency_app
    restart: unless-stopped
    working_dir: /app
    volumes:
      - ./:/app
    ports:
      - "8000:8000"
    environment:
      - APP_ENV=local
      - APP_DEBUG=true
    depends_on:
      - db
      - redis

  db:
    image: postgres:15
    container_name: transparency_db
    restart: unless-stopped
    environment:
      POSTGRES_DB: ${DB_DATABASE}
      POSTGRES_USER: ${DB_USERNAME}
      POSTGRES_PASSWORD: ${DB_PASSWORD}
    volumes:
      - pgdata:/var/lib/postgresql/data
    ports:
      - "5432:5432"

  redis:
    image: redis:7-alpine
    container_name: transparency_redis
    restart: unless-stopped
    ports:
      - "6379:6379"
    volumes:
      - redisdata:/data

volumes:
  pgdata:
  redisdata:
```

## GitHub Actions CI/CD

```yaml
name: CI/CD Pipeline

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main, develop ]

jobs:
  test:
    runs-on: ubuntu-latest

    services:
      postgres:
        image: postgres:15
        env:
          POSTGRES_DB: transparency_test
          POSTGRES_USER: postgres
          POSTGRES_PASSWORD: password
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
        ports:
          - 5432:5432

    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.3'
        extensions: curl,dom,exif,intl,json,mbstring,openssl,pdo,pdo_pgsql,tokenizer,zip

    - name: Install dependencies
      run: composer install --prefer-dist --no-progress --no-suggest

    - name: Generate key
      run: php artisan key:generate --env=testing

    - name: Run migrations
      run: php artisan migrate --env=testing

    - name: Run tests
      run: php artisan test

    - name: Run linting
      run: ./vendor/bin/pint --test
```
