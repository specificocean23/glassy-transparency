# Setup Guide - Transparency.ie Dashboard

## Quick Start (Development)

### 1. Initial Setup
```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie

# Install dependencies
composer install
npm install

# Generate APP_KEY
php artisan key:generate

# Configure database
cp .env.example .env
# Edit .env with your database credentials
```

### 2. Database Setup
```bash
# Run migrations
php artisan migrate

# (Optional) Seed demo data
php artisan db:seed
```

### 3. Create Admin User
```bash
php artisan make:filament-user
# Follow the prompts to create admin credentials
```

### 4. Build Assets
```bash
# Development with hot reload
npm run dev

# Or production build
npm run build
```

### 5. Start Development Server
```bash
php artisan serve

# In another terminal for asset compilation
npm run dev
```

**Access Points:**
- Public Dashboard: http://localhost:8000
- Admin Panel: http://localhost:8000/admin
- API: http://localhost:8000/api/v1

---

## Database Configuration

### PostgreSQL (Recommended)
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=transparency_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transparency_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### SQLite (For Development)
```env
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database.sqlite
```

---

## Social Authentication Setup

### Facebook
1. Create app at [Facebook Developers](https://developers.facebook.com)
2. Get App ID and Secret
3. Add to `.env`:
```env
SOCIALITE_FACEBOOK_ID=your_app_id
SOCIALITE_FACEBOOK_SECRET=your_app_secret
```

### Google
1. Create project at [Google Cloud Console](https://console.cloud.google.com)
2. Create OAuth 2.0 credentials
3. Add to `.env`:
```env
SOCIALITE_GOOGLE_ID=your_client_id
SOCIALITE_GOOGLE_SECRET=your_client_secret
```

### enjoydeise Custom Platform
Integration configuration will be documented in the main enjoydeise project.

---

## API Usage Examples

### Get Dashboard Statistics
```bash
curl http://localhost:8000/api/v1/dashboard/stats
```

### List All Departments
```bash
curl http://localhost:8000/api/v1/departments
```

### Get Spending by Category
```bash
curl http://localhost:8000/api/v1/dashboard/spending-by-category
```

### Filter Spendings
```bash
curl "http://localhost:8000/api/v1/spendings?month=12&year=2025&green_energy=true"
```

### Get Green Energy Impact
```bash
curl http://localhost:8000/api/v1/dashboard/green-energy
```

### Get Homelessness Initiatives
```bash
curl http://localhost:8000/api/v1/dashboard/homelessness
```

### Get Comprehensive Report
```bash
curl "http://localhost:8000/api/v1/report?year=2025"
```

---

## Project Models Overview

### Department
- Represents city council departments/divisions
- Fields: name, slug, description, head_name, email, phone, annual_budget, is_active

### Budget
- Annual budget allocation by department
- Fields: department_id, fiscal_year, allocated_amount, spent_amount, notes, status

### Spending
- Individual spending records
- Fields: budget_id, department_id, category, vendor_name, amount, transaction_date
- Tags: is_fossil_fuel_related, is_green_energy, supports_homelessness_initiative

### Initiative
- Government programs and projects
- Fields: department_id, name, description, category, budget, spent, status
- Special: irish_workers_employed, outcomes

### ImpactMetric
- Measurable outcomes of initiatives
- Fields: initiative_id, metric_name, metric_type, value, target_value, measurement_date

---

## Filament Admin Panel

### Accessing Admin
1. Navigate to http://localhost:8000/admin
2. Log in with created admin credentials
3. Manage all resources through intuitive UI

### Available Resources
- **Departments** - Manage council departments
- **Budgets** - Track annual budgets and allocations
- **Spendings** - Record and manage spending transactions
- **Initiatives** - Create and track initiatives
- **Impact Metrics** - Record initiative outcomes

### Admin Features
- Create, read, update, delete operations
- Search and filtering
- Bulk actions
- Export to Excel
- Audit trails (with additional configuration)

---

## Development Commands

### Artisan Commands
```bash
# List available commands
php artisan list

# Make a new model with migration
php artisan make:model ModelName -m

# Make a controller
php artisan make:controller ControllerName

# Make a Filament resource
php artisan make:filament-resource ResourceName

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Feature/ApiTest.php

# Generate coverage report
php artisan test --coverage
```

### Code Quality
```bash
# Fix code style issues
./vendor/bin/pint

# Run static analysis
./vendor/bin/phpstan analyse
```

---

## Environment Variables

### Essential
```env
APP_NAME=Transparency.ie
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

APP_KEY=base64:xxxxx
APP_CIPHER=AES-256-CBC
```

### Database
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=transparency
DB_USERNAME=user
DB_PASSWORD=password
```

### Mail (Optional)
```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@transparency.ie
MAIL_FROM_NAME="Transparency.ie"
```

### AWS (Optional)
```env
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=
```

### Filament
```env
FILAMENT_DEFAULT_TIMEZONE=Europe/Dublin
FILAMENT_THEME=light
```

---

## Troubleshooting

### Migrations Error
```bash
# Reset database (careful - deletes all data)
php artisan migrate:reset

# Fresh migration
php artisan migrate:fresh

# Specific migration
php artisan migrate --path=database/migrations/2025_12_31_220931_create_departments_table.php
```

### Permission Issues
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache

# Fix public permissions
chmod -R 755 public
```

### Cache Issues
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Recreate caches
php artisan cache:make
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

### Asset Issues
```bash
# Rebuild assets
npm install
npm run build

# Or with hot reload
npm run dev
```

---

## Production Deployment

### Pre-deployment Checklist
- [ ] Update `.env` for production
- [ ] Set `APP_DEBUG=false`
- [ ] Generate application key: `php artisan key:generate`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Create admin user
- [ ] Build assets: `npm run build`
- [ ] Clear all caches

### Server Requirements
- PHP 8.3+
- Composer
- Node.js 18+
- PostgreSQL 13+ or MySQL 8+
- Redis (recommended for caching)
- Supervisor (for queue processing)

### Optimization Commands
```bash
# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize packages
php artisan package:optimize
```

### Nginx Configuration (Example)
```nginx
server {
    listen 80;
    server_name transparency.ie www.transparency.ie;
    root /var/www/transparency.ie/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
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
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Support & Documentation

- Laravel Docs: https://laravel.com/docs
- Filament Docs: https://filamentphp.com/docs
- Vue 3 Docs: https://vuejs.org/
- API Documentation: `/api/v1` endpoints (documented above)

---

## License & Attribution

This project is open-source and available under the MIT License.

Built for transparency in local government and community engagement.
