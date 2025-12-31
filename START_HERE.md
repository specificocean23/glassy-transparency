# 🚀 Complete Setup for PostgreSQL Backend

## What Changed

✅ **Switched from SQLite to PostgreSQL** - Better for real data  
✅ **Controllers now use real database** - Not hardcoded demo data  
✅ **Ready for data import** - Prepared to accept your real data  
✅ **Vue dependencies fixed** - npm reinstall completed  

---

## Prerequisites (One Time Setup)

### 1. Install PostgreSQL

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install postgresql postgresql-contrib
```

**Mac (Homebrew):**
```bash
brew install postgresql@15
brew services start postgresql@15
```

**Windows:**
Download and install from https://www.postgresql.org/download/windows/

### 2. Create Database and User

```bash
# Open PostgreSQL shell
sudo -u postgres psql

# Copy and paste these commands:
CREATE USER postgres WITH PASSWORD 'postgres';
ALTER USER postgres SUPERUSER;
CREATE DATABASE transparency_ie OWNER postgres;
\q
```

### 3. Verify Connection

```bash
psql -U postgres -d transparency_ie -h 127.0.0.1
```

You should see the prompt. Type `\q` to exit.

---

## Run the Application

### 1. Install Node Dependencies (Done! ✅)

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
# npm install already completed
```

### 2. Run Migrations to Create Tables

```bash
php artisan migrate
```

Output should show:
```
Migrating: 2025_12_31_220931_create_departments_table
Migrated: 2025_12_31_220931_create_departments_table
...
```

### 3. Start Backend (Terminal 1)

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
php artisan serve
```

Output should show:
```
Starting Laravel development server: http://127.0.0.1:8000
```

### 4. Start Frontend (Terminal 2)

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
npm run dev
```

Output should show:
```
  ➜  Local:   http://localhost:5173/
  ➜  press h to show help
```

### 5. Open in Browser

Visit: **http://localhost:8000**

---

## Import Your Data

Once you have data files, use PostgreSQL tools:

### If you have CSV files:

1. Place files in your project
2. Create seeders in `database/seeders/`
3. Run `php artisan db:seed`

### If you have SQL dump:

```bash
psql -U postgres -d transparency_ie < your_dump.sql
```

### If you have JSON data:

Create a Laravel seeder to parse and insert it.

---

## Database Schema

Tables automatically created by migrations:

```
departments
├── id (primary key)
├── name
├── slug
├── description
├── budget (decimal)
├── is_active (boolean)
└── timestamps

budgets
├── id
├── department_id
├── allocated_amount
├── fiscal_year
└── timestamps

spendings
├── id
├── department_id
├── category
├── description
├── amount
├── transaction_date
├── vendor
├── is_green_energy
├── is_fossil_fuel_related
├── supports_homelessness_initiative
└── timestamps

initiatives
├── id
├── department_id
├── title
├── slug
├── description
├── category
├── status
├── budget
├── spent
├── people_impacted
├── irish_workers_employed
└── timestamps

impact_metrics
├── id
├── initiative_id
├── metric_name
├── metric_value
├── measurement_date
└── timestamps
```

---

## API Endpoints (All Database Connected)

Test these URLs in your browser:

```
GET http://localhost:8000/api/health
→ {"status": "ok"}

GET http://localhost:8000/api/v1/dashboard/stats
→ Returns stats from database

GET http://localhost:8000/api/v1/departments
→ Lists all departments (with pagination)

GET http://localhost:8000/api/v1/spendings
→ Lists spending records

GET http://localhost:8000/api/v1/initiatives
→ Lists initiatives
```

---

## Useful Commands

```bash
# Check database
psql -U postgres -d transparency_ie -h 127.0.0.1

# List tables
\dt

# Count records
SELECT COUNT(*) FROM departments;

# View specific record
SELECT * FROM departments LIMIT 1;

# Exit
\q
```

---

## Troubleshooting

### "php artisan migrate" fails

Make sure PostgreSQL is running:
```bash
sudo systemctl start postgresql  # Linux
brew services start postgresql@15  # Mac
```

### "connection refused" at localhost:8000

Ensure `php artisan serve` is running in Terminal 1

### "Failed to resolve 'vue'" error

Already fixed! ✅ npm dependencies reinstalled

### Assets not loading

Make sure `npm run dev` is running in Terminal 2

---

## Next Steps

1. ✅ Install PostgreSQL
2. ✅ Create database and user
3. ✅ Run migrations: `php artisan migrate`
4. Start servers (see above)
5. Visit http://localhost:8000
6. Import your data when ready

---

## Full Postgres Setup Reference

See [POSTGRES_SETUP.md](POSTGRES_SETUP.md) for detailed PostgreSQL instructions.

---

**Ready to go!** Let me know when you have your data and I'll help you import it. 🎉
