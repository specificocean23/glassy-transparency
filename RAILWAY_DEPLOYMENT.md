# Railway Deployment Guide

This guide walks you through deploying the City Council Transparency Dashboard to Railway.

## Overview

Railway is a modern cloud platform that automates deployment, scaling, and monitoring. It's perfect for Laravel applications with zero configuration needed.

## Prerequisites

1. Railway account (free at [railway.app](https://railway.app))
2. GitHub account with this repository
3. Basic familiarity with Git

## Step 1: Push to GitHub

```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
git init
git add .
git commit -m "Initial commit: City Council Transparency Dashboard"
git branch -M main
git remote add origin https://github.com/yourusername/transparency-dashboard.git
git push -u origin main
```

## Step 2: Connect to Railway

1. Go to [railway.app](https://railway.app)
2. Sign up or log in with GitHub
3. Click "New Project"
4. Select "Deploy from GitHub repo"
5. Authorize Railway to access your GitHub account
6. Select the `transparency-dashboard` repository
7. Railway will automatically detect it as a Laravel project

## Step 3: Configure Environment Variables

In Railway dashboard, go to "Variables" and add:

```
APP_NAME=City Council Transparency
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-project.railway.app
APP_KEY=base64:3yzvl7OD2khrKSR+naTlfyZgc1ZaO48odndJ8+GFQWY=

DB_CONNECTION=pgsql
DB_HOST=${{ Postgres.PGHOST }}
DB_PORT=${{ Postgres.PGPORT }}
DB_DATABASE=${{ Postgres.PGDATABASE }}
DB_USERNAME=${{ Postgres.PGUSER }}
DB_PASSWORD=${{ Postgres.PGPASSWORD }}

CACHE_STORE=redis
REDIS_HOST=${{ Redis.REDIS_HOST }}
REDIS_PORT=${{ Redis.REDIS_PORT }}
REDIS_PASSWORD=${{ Redis.REDIS_PASSWORD }}

SESSION_DRIVER=cookie
SESSION_ENCRYPT=true
```

## Step 4: Add PostgreSQL Database

1. In Railway dashboard, click "Add Service"
2. Select "PostgreSQL"
3. Railway automatically connects it to your project
4. Variables are auto-populated (see step 3)

## Step 5: Add Redis Cache

1. Click "Add Service" again
2. Select "Redis"
3. This provides fast caching and session storage

## Step 6: Deploy

Railway watches your GitHub repo. Every push to `main` triggers automatic deployment:

```bash
git add .
git commit -m "Update deployment config"
git push origin main
```

Monitor progress in Railway dashboard:
- View logs in real-time
- See build and deploy status
- Check environment health

## Step 7: Run Migrations

After first deployment:

1. Go to Railway dashboard
2. Click your project → Deployments
3. Click the latest deployment
4. Click "Logs"
5. In the terminal, you'll see the migrate command ran automatically (configured in `railway.json`)

## Step 8: Access Your Dashboard

Your app is live at: `https://your-project.railway.app`

## Database Seeding

To populate sample data:

1. In Railway dashboard, find your PostgreSQL service
2. Click "Connect"
3. Use the connection string to connect with a PostgreSQL client (or Railway's built-in CLI)
4. Run: `php artisan db:seed`

Or connect via SSH:

```bash
railway run php artisan db:seed
```

## Environment Variables Explained

| Variable | Purpose |
|----------|---------|
| `APP_KEY` | Laravel encryption key (generate with `php artisan key:generate`) |
| `APP_ENV` | Set to `production` for live deployment |
| `APP_DEBUG` | Set to `false` in production |
| `DB_CONNECTION` | Use `pgsql` for Railway PostgreSQL |
| `CACHE_STORE` | Set to `redis` for performance |
| `SESSION_DRIVER` | Set to `cookie` for stateless sessions |

## Monitoring & Scaling

Railway provides:

- **Auto-scaling**: Automatically scales based on load
- **Logs**: Real-time streaming logs
- **Metrics**: CPU, memory, and response time monitoring
- **Rollback**: One-click rollback to previous deployments

## Custom Domain

1. Go to Project Settings
2. Add custom domain
3. Update DNS records (Railway provides instructions)
4. Update `APP_URL` in environment variables

## Troubleshooting

### Build Fails
- Check logs for specific errors
- Ensure all dependencies are in `composer.json`
- Verify PHP version is 8.3+

### Database Connection Error
- Confirm PostgreSQL service is running
- Check variable names match exactly
- Ensure database user has correct permissions

### High Memory Usage
- Check for N+1 queries in code
- Consider using Redis caching
- Review recent code changes

## API Health Check

Test the API is working:

```bash
curl https://your-project.railway.app/api/v1/dashboard/stats
```

Should return JSON with dashboard statistics.

## Disaster Recovery

Railway automatically:
- Backs up PostgreSQL database daily
- Keeps 10 previous deployments
- Provides point-in-time recovery options

## Cost Optimization

- **Free tier**: $5/month credit
- **PostgreSQL**: $12/month
- **Redis**: $12/month
- **Total**: ~$24/month for hobby tier
- Upgrade as you grow

## Support

- Railway docs: https://docs.railway.app
- Laravel docs: https://laravel.com/docs
- This project's API: `/api/v1` endpoints
