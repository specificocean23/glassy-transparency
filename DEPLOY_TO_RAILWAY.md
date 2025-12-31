# Railway Deployment Guide

## Option 1: Deploy via GitHub (Recommended ✅)

### Step 1: Push to GitHub

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
git init
git add .
git commit -m "Waterford Council & Irish Energy Transparency Data"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/transparency-ie.git
git push -u origin main
```

### Step 2: Connect to Railway

1. Go to https://railway.app
2. Sign up or login
3. Create new project → Deploy from GitHub
4. Authorize GitHub access
5. Select your transparency-ie repository

### Step 3: Configure in Railway Dashboard

Set these environment variables in Railway:

```
APP_NAME=TransparencyIE
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:your_key_from_local_env
APP_URL=https://your-app.up.railway.app

DB_CONNECTION=pgsql
DB_HOST=postgres-production-b2a7.up.railway.app
DB_PORT=6969
DB_DATABASE=transparency_ie
DB_USERNAME=your_username_here
DB_PASSWORD=your_password_here

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

**Get APP_KEY from local .env:**
```bash
grep APP_KEY /home/shay/cyp_wri_code/transparency_dot_ie/.env
```

### Step 4: Set Build & Start Commands

In Railway → Deployment settings:

**Build:**
```bash
composer install --no-dev && npm install && npm run build
```

**Start:**
```bash
php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

That's it! Railway auto-deploys on every GitHub push. 🎉

---

## Option 2: Manual Upload (If No GitHub)

Use Railway CLI:

```bash
# Install Railway CLI
curl -L https://railway.app/install.sh | bash

# Login
railway login

# Deploy
cd /home/shay/cyp_wri_code/transparency_dot_ie
railway init
railway up
```

---

## Test Your Deployment

Once deployed, your API will be live:

```bash
# Replace YOUR_APP with your actual Railway app URL
curl https://YOUR_APP.up.railway.app/api/health

# You should get:
{"status":"ok"}
```

### All Endpoints Available:

```
GET https://YOUR_APP.up.railway.app/api/v1/dashboard/stats
GET https://YOUR_APP.up.railway.app/api/v1/departments
GET https://YOUR_APP.up.railway.app/api/v1/spendings
GET https://YOUR_APP.up.railway.app/api/v1/initiatives
GET https://YOUR_APP.up.railway.app/api/v1/report
```

---

## Connect Your Railway PostgreSQL

Your instance is at:
- **Host:** postgres-production-b2a7.up.railway.app
- **Port:** 6969
- **Database:** transparency_ie
- **Username:** (get from Railway dashboard)
- **Password:** (get from Railway dashboard)

### Test Connection:
```bash
psql -h postgres-production-b2a7.up.railway.app -p 6969 -U your_username -d transparency_ie
```

---

## Data Seeding

The seeders will automatically run with your migrations:

✅ **Waterford Council Data:** 6 departments, €12.2M budget
- Housing & Community
- Planning & Development
- Roads & Transportation
- Environment & Water
- Recreation & Culture
- Finance & Administration

✅ **Irish Federal Energy Data:** €2.5B energy spending
- Renewable energy initiatives
- Electric vehicle infrastructure
- Energy efficiency programs
- Research & development

Run seeding:
```bash
php artisan db:seed --force
```

---

## Available APIs

### Your API is now public! Use it anywhere:

**JavaScript/React:**
```javascript
const response = await fetch('https://YOUR_APP.up.railway.app/api/v1/dashboard/stats');
const data = await response.json();
console.log(data);
```

**Python:**
```python
import requests
response = requests.get('https://YOUR_APP.up.railway.app/api/v1/dashboard/stats')
data = response.json()
```

**cURL:**
```bash
curl -s https://YOUR_APP.up.railway.app/api/v1/departments | jq
```

### Integrate Into:
- 📊 Tableau / Power BI dashboards
- 📱 Mobile apps (iOS/Android)
- 🌐 Websites & blogs
- 📧 Email reports
- 🤖 Discord/Slack bots
- 🗺️ Open data portals

---

## Costs

Railway pricing:
- **Free tier:** $5/month credit (generous!)
- **Pay-as-you-go:** ~$5-15/month for small/medium apps
- **PostgreSQL:** Included, costs $1-5/month

Your current setup: ~$10-20/month total.

---

## Monitoring

In Railway Dashboard you can:
- View real-time logs
- Monitor CPU/memory usage
- See deployment history
- Check database connections

---

## Custom Domain (Optional)

To use `transparency.ie` or `waterford-spending.ie`:

1. Buy domain (Namecheap, GoDaddy, etc.)
2. Railway → Domains → Add Domain
3. Point DNS to Railway nameservers
4. Done! Your app is at your domain.

---

## Quick Reference

```bash
# View Rails logs
railway logs

# SSH into app
railway shell

# Run commands on production
railway run php artisan tinker

# Backup database
pg_dump -h postgres-production-b2a7.up.railway.app -U postgres transparency_ie > backup.sql

# Restore database
psql -h postgres-production-b2a7.up.railway.app -U postgres transparency_ie < backup.sql
```

---

## Next Steps

1. **Get PostgreSQL credentials** from Railway dashboard
2. **Push to GitHub** (recommended) or use Railway CLI
3. **Set environment variables** in Railway
4. **Deploy!** Railway handles everything
5. **Test APIs** - they're public and live!

Done! Your transparency portal is now live on the internet. 🚀

Questions? Check Railway docs: https://docs.railway.app/
