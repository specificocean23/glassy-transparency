# Quick Reference Card 🎯

## You Have Everything Ready

✅ Waterford Council data seeder
✅ Irish federal energy data seeder  
✅ PostgreSQL configured for Railway
✅ API endpoints all working
✅ Deployment scripts ready
✅ Complete documentation

---

## 3-Step Setup

### Step 1: Connect Your Railway PostgreSQL

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
bash setup-railway.sh
```
**You will be prompted for:**
- DB Host (default: postgres-production-b2a7.up.railway.app)
- DB Port (default: 6969)
- Username (from Railway dashboard)
- Password (from Railway dashboard)

### Step 2: Run Local Servers

**Terminal 1:**
```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
php artisan serve
```

**Terminal 2:**
```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
npm run dev
```

### Step 3: Open Browser

Visit: **http://localhost:8000**

---

## Test the APIs

```bash
# Health check
curl http://localhost:8000/api/health

# Waterford Council stats
curl http://localhost:8000/api/v1/dashboard/stats

# Irish energy spending
curl "http://localhost:8000/api/v1/spendings?green_energy=true" | jq

# All initiatives
curl http://localhost:8000/api/v1/initiatives | jq

# Generate report
curl http://localhost:8000/api/v1/report | jq
```

---

## Deploy to Railway (GitHub Auto-Deploy)

```bash
# Step 1: Create repo
git init
git add .
git commit -m "Waterford Council & Irish Energy Transparency"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/transparency-ie.git
git push -u origin main

# Step 2: Go to railway.app
# - Sign up
# - Create project
# - Connect GitHub
# - Set environment variables
# - Done! Auto-deploys on each git push

# Step 3: Push updates anytime
git add .
git commit -m "Update: new data"
git push
# Railway auto-deploys 🚀
```

---

## Demo Data Summary

### Waterford Council (€12.2M)
- 6 departments
- 4 major initiatives
- 20+ spending records
- 152 Irish workers employed
- 145 people housed (homelessness initiative)

### Irish Federal Energy (€2.5B)
- 5 major initiatives
- Renewable energy investments
- Electric vehicle infrastructure
- Energy efficiency programs
- 43,000+ workers employed

---

## Database Commands

```bash
# Connect to database
psql -h postgres-production-b2a7.up.railway.app -p 6969 -U postgres -d transparency_ie

# Check tables
\dt

# Count records
SELECT COUNT(*) FROM departments;
SELECT COUNT(*) FROM spendings;
SELECT COUNT(*) FROM initiatives;

# List all data
SELECT * FROM departments;
SELECT * FROM initiatives ORDER BY budget DESC;
SELECT SUM(amount) as total FROM spendings;

# Export to CSV
\copy (SELECT * FROM spendings) TO 'spendings.csv' CSV HEADER
\copy (SELECT * FROM initiatives) TO 'initiatives.csv' CSV HEADER

# Exit
\q
```

---

## File Locations

```
transparency_dot_ie/
├── setup-railway.sh              ← Run this first!
├── COMPLETE_SETUP.md             ← Complete guide
├── DEPLOY_TO_RAILWAY.md          ← Railway deployment
├── API_DOCUMENTATION.md          ← API reference
├── POSTGRES_SETUP.md             ← Database help
│
├── database/seeders/
│   ├── DatabaseSeeder.php        ← Main seeder
│   ├── WaterfordCouncilSeeder.php ← Waterford data
│   └── IrishFederalEnergySeeder.php ← Energy data
│
├── app/Http/Controllers/Api/
│   ├── DashboardController.php   ← Stats endpoint
│   ├── TransparencyController.php ← Main API
│   └── DemoController.php         ← Additional endpoints
│
├── .env                          ← Configuration
├── routes/api.php                ← API routes
└── public/index.php              ← Entry point
```

---

## Endpoints Quick Reference

| Endpoint | Purpose |
|----------|---------|
| `GET /api/health` | Health check |
| `GET /api/v1/dashboard/stats` | Summary statistics |
| `GET /api/v1/dashboard/green-energy` | Green energy data |
| `GET /api/v1/dashboard/homelessness` | Homelessness stats |
| `GET /api/v1/departments` | List departments |
| `GET /api/v1/departments/{id}` | Single department |
| `GET /api/v1/spendings` | List spending (filterable) |
| `GET /api/v1/initiatives` | List initiatives |
| `GET /api/v1/initiatives/{id}` | Single initiative |
| `GET /api/v1/report` | Full transparency report |

---

## Filtering Examples

```bash
# Green energy spending only
curl "http://localhost:8000/api/v1/spendings?green_energy=true"

# Housing department only
curl "http://localhost:8000/api/v1/spendings?department_id=1"

# Active initiatives only
curl "http://localhost:8000/api/v1/initiatives?status=active"

# Homelessness-related spending
curl "http://localhost:8000/api/v1/spendings?homelessness=true"

# Pagination
curl "http://localhost:8000/api/v1/departments?page=2"
```

---

## Environment Variables

Your `.env` should have:

```
APP_NAME=TransparencyIE
APP_ENV=production  # or local
APP_DEBUG=false     # or true for local
APP_KEY=base64:xxxx (from local)

DB_CONNECTION=pgsql
DB_HOST=postgres-production-b2a7.up.railway.app
DB_PORT=6969
DB_DATABASE=transparency_ie
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

---

## Troubleshooting Quick Fixes

```bash
# "Cannot connect to PostgreSQL"
→ Check credentials in .env
→ Verify Railway instance is running
→ Check IP whitelist on Railway

# "Laravel won't start"
→ Kill existing process: lsof -ti:8000 | xargs kill -9
→ Use different port: php artisan serve --port=8001

# "Vite not compiling"
→ npm install (fresh install)
→ npm run dev (restart)

# "Database error"
→ Check migrations: php artisan migrate:status
→ Fresh start: php artisan migrate:fresh --seed

# API returns nothing
→ Check database has data: SELECT COUNT(*) FROM departments;
→ Check server logs: tail -f storage/logs/laravel.log
```

---

## Next Actions

- [ ] Get PostgreSQL credentials from Railway
- [ ] Run `bash setup-railway.sh`
- [ ] Start local servers (2 terminals)
- [ ] Test http://localhost:8000
- [ ] Test APIs with curl
- [ ] Push to GitHub (optional)
- [ ] Deploy to Railway (optional)
- [ ] Share transparency portal!

---

## Get Help

1. **Setup issues?** → See [COMPLETE_SETUP.md](COMPLETE_SETUP.md)
2. **Railway questions?** → See [DEPLOY_TO_RAILWAY.md](DEPLOY_TO_RAILWAY.md)
3. **API questions?** → See [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
4. **PostgreSQL help?** → See [POSTGRES_SETUP.md](POSTGRES_SETUP.md)
5. **Railway docs?** → https://docs.railway.app

---

**You're ready to go! 🚀**

Just provide your Railway PostgreSQL credentials and everything works!
