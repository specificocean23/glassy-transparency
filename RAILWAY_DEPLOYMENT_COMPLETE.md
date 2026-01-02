# 🚀 Railway Deployment Guide - Transparency.ie

> **Last Updated:** January 2, 2026  
> **Status:** Production Ready

## Overview

This guide walks you through deploying Transparency.ie to Railway with all features including:
- ✅ PostgreSQL Database
- ✅ Redis Cache & Session Management
- ✅ Asset Building (Vite)
- ✅ Environment Configuration
- ✅ Enjoydeise OAuth Integration
- ✅ Waterford Green Theme

---

## Prerequisites

1. **Railway Account** - Sign up at [railway.app](https://railway.app)
2. **GitHub Repository** - Code pushed to GitHub
3. **Environment Variables** - Prepared locally
4. **Domain Name** (optional) - For custom domain

---

## Step 1: Connect Repository to Railway

### 1a. Create New Project on Railway

```bash
# Go to railway.app/dashboard
# Click "New Project" → "Deploy from GitHub"
# Select your transparency_dot_ie repository
# Authorize Railway to access GitHub
```

### 1b. Railway automatically detects:
- ✅ Dockerfile
- ✅ railway.json
- ✅ package.json (Node.js)
- ✅ composer.json (PHP)

---

## Step 2: Configure PostgreSQL Database

### 2a. Add PostgreSQL Service

```bash
# In Railway Dashboard:
# 1. Click "+ Add"
# 2. Select "PostgreSQL"
# 3. Railway creates database automatically
```

### 2b. Connection Variables

Railway automatically generates:
```
DATABASE_URL=postgresql://user:pass@host:port/dbname
```

Which breaks down to:
```
DB_CONNECTION=pgsql
DB_HOST=your-railway-postgres-host
DB_PORT=5432
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=your-secure-password
```

---

## Step 3: Configure Redis Cache

### 3a. Add Redis Service

```bash
# In Railway Dashboard:
# 1. Click "+ Add"
# 2. Select "Redis"
# 3. Configure as needed
```

### 3b. Redis Connection

Railway provides:
```
REDIS_URL=redis://:password@host:port
```

Maps to:
```
REDIS_HOST=your-railway-redis-host
REDIS_PORT=6379
REDIS_PASSWORD=your-secure-password
REDIS_CLIENT=phpredis
```

---

## Step 4: Environment Variables

### 4a. Add to Railway Dashboard

Go to **Variables** tab in Railway project:

```
# Application
APP_NAME=Transparency.ie
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_EXISTING_KEY_FROM_.env

# URLs
APP_URL=https://transparency-ie.up.railway.app
# Or your custom domain:
# APP_URL=https://transparency.ie

# Database (Railway auto-fills)
DB_CONNECTION=pgsql
DB_HOST=${{ Postgres.PGHOST }}
DB_PORT=${{ Postgres.PGPORT }}
DB_DATABASE=${{ Postgres.PGDATABASE }}
DB_USERNAME=${{ Postgres.PGUSER }}
DB_PASSWORD=${{ Postgres.PGPASSWORD }}

# Redis (Railway auto-fills)
REDIS_HOST=${{ Redis.REDIS_HOST }}
REDIS_PORT=${{ Redis.REDIS_PORT }}
REDIS_PASSWORD=${{ Redis.REDIS_PASSWORD }}
CACHE_STORE=redis
QUEUE_CONNECTION=redis

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Mail (optional - using log driver for now)
MAIL_MAILER=log

# Enjoydeise OAuth
ENJOYDEISE_CLIENT_ID=your-client-id
ENJOYDEISE_CLIENT_SECRET=your-client-secret
ENJOYDEISE_AUTHORIZATION_ENDPOINT=https://enjoydeise.ie/oauth/authorize
ENJOYDEISE_TOKEN_ENDPOINT=https://enjoydeise.ie/oauth/token
ENJOYDEISE_RESOURCE_ENDPOINT=https://enjoydeise.ie/api/user

# Optional: AWS S3 for file storage
# AWS_ACCESS_KEY_ID=
# AWS_SECRET_ACCESS_KEY=
# AWS_DEFAULT_REGION=eu-west-1
# AWS_BUCKET=your-bucket-name
# FILESYSTEM_DISK=s3
```

### 4b. Retrieve Your APP_KEY

```bash
# From your local .env file:
cat .env | grep APP_KEY

# It should look like:
# APP_KEY=base64:3yzvl7OD2khrKSR+naTlfyZgc1ZaO48odndJ8+GFQWY=
```

---

## Step 5: Configure Database Migrations

### 5a. Automatic Migrations

The `railway.json` includes:
```json
"startCommand": "php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT"
```

This automatically:
1. Runs migrations on startup
2. Seeds database if seeders exist
3. Starts the Laravel dev server

### 5b. Manual Migration (if needed)

```bash
# In Railway Shell:
php artisan migrate:fresh --seed
```

---

## Step 6: Build & Deploy

### 6a. Trigger Deployment

```bash
# Option 1: Auto-deploy on push
git push origin main
# Railway detects push and auto-deploys

# Option 2: Manual redeploy in Railway Dashboard
# Click "Deploy" button
```

### 6b. Monitor Deployment

Railway Dashboard shows:
- 📦 Build logs
- 📋 Deploy logs
- 🔴 Errors (if any)
- ✅ Success status

---

## Step 7: Verify Deployment

### 7a. Check Logs

```bash
# In Railway Dashboard:
# Click service → "Logs" tab
# Look for: "Application running on [0.0.0.0:PORT]"
```

### 7b. Test Application

```bash
# Visit your deployment URL
https://transparency-ie.up.railway.app

# Test key pages:
https://transparency-ie.up.railway.app/waterford-spending
https://transparency-ie.up.railway.app/metrics
https://transparency-ie.up.railway.app/events
```

### 7c. Test Database Connection

```bash
# In Railway Shell:
php artisan tinker

# Run:
DB::connection()->getPdo();
# Should return: object(PDO)

# Check users:
User::count();
```

### 7d. Test Redis

```bash
# In Railway Shell:
php artisan tinker

# Run:
Cache::put('test', 'works');
Cache::get('test');
# Should return: "works"
```

---

## Step 8: Custom Domain (Optional)

### 8a. Add Custom Domain

```bash
# In Railway Dashboard:
# 1. Go to Settings → Domains
# 2. Click "Add Custom Domain"
# 3. Enter: transparency.ie
# 4. Railway provides CNAME records
```

### 8b. Update DNS Records

```bash
# With your domain registrar:
# Add CNAME record:
# transparency.ie → railway-provided-cname.railway.app

# Update .env APP_URL:
APP_URL=https://transparency.ie
```

---

## Step 9: Enjoydeise OAuth Setup

### 9a. Register Application with Enjoydeise

1. Go to Enjoydeise Developer Console
2. Create New Application
3. Set Redirect URI: `https://transparency-ie.up.railway.app/auth/enjoydeise/callback`
4. Get `Client ID` and `Client Secret`

### 9b. Add to Railway Variables

```
ENJOYDEISE_CLIENT_ID=your-client-id
ENJOYDEISE_CLIENT_SECRET=your-client-secret
```

### 9c. Test OAuth Flow

```bash
# Visit login button
https://transparency-ie.up.railway.app
# Click "🔐 Login" → Should redirect to Enjoydeise
```

---

## Step 10: Production Configuration

### 10a. Optimize Configuration

```bash
# In Railway Shell:
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 10b. Enable HTTPS Redirects

Update `.env`:
```
APP_URL=https://transparency.ie
SESSION_SECURE_COOKIES=true
```

---

## Troubleshooting

### Issue: Database Connection Error

```bash
# Check database variables in Railway Dashboard
# Verify DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD

# Test connection in Railway Shell:
php artisan db:show
```

### Issue: Redis Connection Error

```bash
# Check Redis variables
# Verify REDIS_HOST, REDIS_PORT, REDIS_PASSWORD

# Test in Railway Shell:
php artisan tinker
Cache::put('test', 'works');
```

### Issue: Assets Not Loading (CSS/JS)

```bash
# Rebuild frontend assets:
npm run build

# Push changes:
git add -A
git commit -m "Rebuild assets"
git push origin main
```

### Issue: Sessions Not Persisting

```bash
# In railway.json, change to database sessions:
SESSION_DRIVER=database

# Run migration:
php artisan session:table
php artisan migrate --force
```

---

## Scaling & Performance

### 10a. Scale Backend

```bash
# In Railway Dashboard:
# 1. Select service
# 2. Scale tab
# 3. Increase RAM/CPU as needed
# Typical: 512MB RAM for small-medium load
```

### 10b. Enable Caching

Variables already configured:
```
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

---

## Backup & Recovery

### 11a. PostgreSQL Backups

Railway automatically backs up:
- Daily snapshots
- 30-day retention
- Available in Dashboard

### 11b. Manual Backup

```bash
# In Railway Shell:
pg_dump $DATABASE_URL > backup.sql

# Download backup from Railway dashboard
```

---

## Monitoring & Alerts

### 12a. Enable Monitoring

Railway provides:
- Resource usage (CPU, RAM)
- Network I/O
- Deployment history
- Error tracking

### 12b. Set Up Alerts (Pro)

```bash
# In Railway Dashboard:
# Settings → Alerts
# Configure thresholds for:
# - CPU usage > 80%
# - Memory usage > 80%
# - Deployment failures
```

---

## Quick Reference Commands

```bash
# Deploy
git push origin main

# View Logs
# (in Railway Dashboard)

# Shell Access
# (in Railway Dashboard → Service → Terminal)

# Database Commands
php artisan db:show
php artisan migrate:status
php artisan tinker

# Clear Caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## Rollback Procedure

If deployment fails:

```bash
# In Railway Dashboard:
# 1. Go to Deployments
# 2. Click previous successful deployment
# 3. Click "Redeploy"
# Application reverts to previous version
```

---

## Post-Deployment Checklist

- [ ] Database connected and migrated
- [ ] Redis cache working
- [ ] Assets (CSS/JS) loading correctly
- [ ] Navigation menu displaying
- [ ] Waterford spending page loads
- [ ] Login button functional
- [ ] Enjoydeise OAuth configured
- [ ] Custom domain pointing correctly
- [ ] Monitoring enabled
- [ ] Backups configured

---

## Support & Documentation

- **Railway Docs:** https://docs.railway.app
- **Laravel Deployment:** https://laravel.com/docs/deployment
- **Troubleshooting:** Check Railway Dashboard Logs

---

**🎉 Your Transparency.ie instance is now live on Railway!**

For questions or issues, check the Railway Dashboard logs first, then consult this guide.
