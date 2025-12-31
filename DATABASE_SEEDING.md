# Database Seeding Guide

This document explains how to seed your database with sample city council data.

## Overview

The seeding system populates realistic data for:
- **5 Departments** with head officials and contact info
- **15 Budget records** across fiscal years
- **60 Spending transactions** with impact tracking
- **5 Major initiatives** (housing, green energy, transport, etc.)
- **15 Impact metrics** tracking outcomes

## Quick Start

### Development Environment

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie

# Fresh migrations + seeding
php artisan migrate:fresh --seed

# Or separately
php artisan migrate
php artisan db:seed
```

### Production (Railway)

```bash
# Via SSH
railway run php artisan migrate:fresh --seed

# Or through Railway CLI
railway run php artisan db:seed
```

## Seeding Components

### 1. Factory Classes

Located in `database/factories/`, these generate realistic random data:

**DepartmentFactory.php**
- Creates departments with real Irish titles
- Generates contact information
- Random budgets: €500K - €5M annually

**BudgetFactory.php**
- Creates fiscal year allocations
- Tracks allocated vs. spent amounts
- Adds spending notes

**SpendingFactory.php**
- Individual transaction records
- Realistic vendor names
- Flags for:
  - Green energy spending (30% chance)
  - Fossil fuel spending (15% chance)
  - Homelessness initiatives (25% chance)

**InitiativeFactory.php**
- Major council programs
- Links to departments
- Tracks Irish worker employment
- Status: planning, active, or completed

**ImpactMetricFactory.php**
- Measurable outcomes
- Types: numeric, percentage, text
- Target vs. current values
- Various units: tons, kWh, EUR, etc.

### 2. Seeder: DatabaseSeeder.php

Main seeding class that:
1. Creates 5 specific departments
2. Generates budgets for each
3. Creates 12 spending records per department
4. Establishes 5 major initiatives
5. Attaches 3 metrics to each initiative

## Sample Data Overview

### Departments

```
1. Housing & Homelessness Services
   - Head: Dr. Sarah O'Neill
   - Budget: €2.5M annually

2. Environment & Green Energy
   - Head: Michael Byrne
   - Budget: €1.8M annually

3. Parks & Recreation
   - Head: Emma Murphy
   - Budget: €1.2M annually

4. Transportation & Mobility
   - Head: James Sullivan
   - Budget: €3.2M annually

5. Community & Economic Development
   - Head: Patricia Quinn
   - Budget: €1.5M annually
```

### Initiatives

1. **Solar Dublin Initiative**
   - 500+ solar panels on city buildings
   - 45 Irish workers employed
   - Green energy focused

2. **Housing First Programme**
   - Permanent housing + support services
   - 32 workers employed
   - Homelessness focused

3. **Green Energy Transition 2025**
   - Municipal fleet to electric
   - 28 workers employed
   - Green energy focused

4. **Community Support Services**
   - Mental health & addiction support
   - 22 workers employed
   - Homelessness focused

5. **Sustainable Transport Hub**
   - Bike lanes & improved transit
   - 67 workers employed
   - Green energy focused

## Customizing Seeds

### Add More Departments

Edit `database/seeders/DatabaseSeeder.php`:

```php
$departments = [
    [
        'name' => 'Your Department',
        'head_of_department' => 'Name',
        'email' => 'email@city.ie',
        'phone' => '+353 1 234 5678',
        'annual_budget' => 1000000,
        'description' => 'Department description',
    ],
    // ... more departments
];

foreach ($departments as $dept) {
    Department::create($dept);
}
```

### Adjust Budget/Spending Amounts

In factory files, change the `numberBetween` values:

```php
// DepartmentFactory.php
'annual_budget' => fake()->numberBetween(100000, 10000000), // €100K - €10M
```

### Change Initiative Counts

```php
// DatabaseSeeder.php
Initiative::factory(10)->create(); // Create 10 instead of 5
```

### Modify Impact Metrics

```php
// ImpactMetricFactory.php
$initiatives = [
    'CO2 Emissions Reduced (tons)',
    'Solar Panels Installed',
    'Jobs Created for Irish Workers',
    'Families Housed',
    // ... add more
];
```

## Resetting Data

```bash
# Clear everything and reseed
php artisan migrate:fresh --seed

# Just reset to seed (keeps migrations)
php artisan migrate:rollback
php artisan migrate
php artisan db:seed

# Clear without seeding
php artisan migrate:fresh
```

## Verifying Seeds

Check data was created:

```bash
# Via Artisan tinker
php artisan tinker

>>> Department::count() // Should be 5
>>> Budget::count() // Should be ~15
>>> Spending::count() // Should be ~60
>>> Initiative::count() // Should be 5
>>> ImpactMetric::count() // Should be ~15
```

Or check via API:

```bash
curl http://localhost:8000/api/v1/departments
curl http://localhost:8000/api/v1/initiatives
curl http://localhost:8000/api/v1/dashboard/stats
```

## Performance Considerations

Seeding ~100 records takes <5 seconds on modern hardware.

For larger datasets (1000+ records):
- Disable timestamps: `$timestamps = false;` in Model
- Use `DB::insert()` instead of models
- Batch operations in chunks

## Troubleshooting

### "SQLSTATE[HY000]: General error: 1"

**Cause**: SQLite driver not loaded
**Solution**: Use PostgreSQL for production, or install php-sqlite3

```bash
apt-get install php8.3-sqlite3
php artisan migrate:fresh --seed
```

### "Class not found" Error

**Cause**: Composer hasn't loaded factories
**Solution**: 

```bash
composer dump-autoload
php artisan db:seed
```

### Duplicate Key Errors

**Cause**: Re-running seed without fresh migration
**Solution**:

```bash
php artisan migrate:fresh --seed
```

## What's Next

After seeding:

1. **View dashboard**: http://localhost:5173
2. **Explore API**: http://localhost:8000/api/v1/dashboard/stats
3. **Access admin**: http://localhost:8000/admin (requires authentication)
4. **Run tests**: `php artisan test`

## File Locations

```
database/
├── factories/
│   ├── DepartmentFactory.php
│   ├── BudgetFactory.php
│   ├── SpendingFactory.php
│   ├── InitiativeFactory.php
│   └── ImpactMetricFactory.php
├── migrations/
│   ├── create_departments_table.php
│   ├── create_budgets_table.php
│   ├── create_spendings_table.php
│   ├── create_initiatives_table.php
│   └── create_impact_metrics_table.php
└── seeders/
    └── DatabaseSeeder.php
```

## Advanced: Custom Seeders

Create specific seeders for different scenarios:

```bash
php artisan make:seeder GreenEnergySeeder
php artisan make:seeder HomelessnessSeeder
```

Then call in `DatabaseSeeder.php`:

```php
$this->call([
    DepartmentSeeder::class,
    InitiativeSeeder::class,
    GreenEnergySeeder::class,
    HomelessnessSeeder::class,
]);
```

Run specific seeder:

```bash
php artisan db:seed --class=GreenEnergySeeder
```

## Data Privacy

Sample data uses:
- Fictional names (generated by Faker)
- Real Irish formatting (addresses, phone numbers)
- Generic descriptions
- Safe for public repositories

No real personal or financial data is included.
