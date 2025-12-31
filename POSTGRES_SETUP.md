# PostgreSQL Setup Guide

## Prerequisites

Make sure PostgreSQL is installed and running on your system.

### Check if PostgreSQL is installed:
```bash
psql --version
```

### Start PostgreSQL (if not running):

**Linux:**
```bash
sudo systemctl start postgresql
sudo systemctl status postgresql
```

**Mac (with Homebrew):**
```bash
brew services start postgresql
```

**Windows:**
PostgreSQL should auto-start when installed.

---

## Setup Steps

### 1. Create Database and User

```bash
# Connect to PostgreSQL as default user
sudo -u postgres psql

# Inside PostgreSQL shell, run:
CREATE USER postgres WITH PASSWORD 'postgres';
ALTER USER postgres SUPERUSER;
CREATE DATABASE transparency_ie OWNER postgres;
\q
```

### 2. Test Connection

```bash
psql -U postgres -d transparency_ie -h 127.0.0.1
```

If successful, you should see:
```
transparency_ie=>
```

Type `\q` to exit.

### 3. Run Migrations

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
php artisan migrate
```

This will create all tables:
- departments
- budgets
- initiatives
- spendings
- impact_metrics
- users

### 4. Seed Demo Data (Optional)

If you have a seeder:
```bash
php artisan db:seed
```

---

## Verify Setup

### Check tables were created:

```bash
psql -U postgres -d transparency_ie

# List tables:
\dt

# Check departments table structure:
\d departments

# Check record count:
SELECT COUNT(*) FROM departments;

# Exit:
\q
```

---

## Troubleshooting

### "FATAL: Peer authentication failed for user "postgres""

Solution: Use IP instead of Unix socket:
```bash
psql -U postgres -d transparency_ie -h 127.0.0.1
```

Or edit `/etc/postgresql/.../pg_hba.conf` to change `peer` to `md5` or `trust`.

### "Connection refused"

PostgreSQL might not be running:
```bash
# Start it
sudo systemctl start postgresql

# Or check status
sudo systemctl status postgresql
```

### "Database does not exist"

Create it:
```bash
sudo -u postgres createdb transparency_ie
```

### "ROLE does not exist"

Create the user:
```bash
sudo -u postgres createuser postgres
sudo -u postgres psql -c "ALTER USER postgres WITH PASSWORD 'postgres';"
```

---

## Next Steps

1. ✅ PostgreSQL installed and running
2. ✅ Database created: `transparency_ie`
3. ✅ User created: `postgres` / `postgres`
4. ✅ Tables migrated
5. Next: Import your real data!

---

## Import Data

Once you have data files (CSV, JSON, SQL), you can:

### Import CSV:
```bash
psql -U postgres -d transparency_ie -c "COPY departments(name,slug,description,is_active,created_at,updated_at) FROM '/path/to/departments.csv' WITH (FORMAT csv, HEADER);"
```

### Import SQL dump:
```bash
psql -U postgres -d transparency_ie < /path/to/dump.sql
```

### Use Laravel seeders:
Create seeders in `database/seeders/` and run:
```bash
php artisan db:seed
```

---

## Connection Details for .env

Already set in `.env`:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=transparency_ie
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Change credentials if you used different username/password.

---

## Commands Summary

```bash
# Migrate fresh with seeding
php artisan migrate:fresh --seed

# Just migrate
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Check migration status
php artisan migrate:status

# Connect to database
psql -U postgres -d transparency_ie -h 127.0.0.1

# Backup database
pg_dump -U postgres transparency_ie > backup.sql

# Restore database
psql -U postgres transparency_ie < backup.sql
```

---

You're ready to run the app with real PostgreSQL! 🎉
