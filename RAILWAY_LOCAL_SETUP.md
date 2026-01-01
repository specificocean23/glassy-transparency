# Local Development with Railway Services

## Current Setup ✅

Your local environment is now configured to connect to Railway's PostgreSQL database:

- **Environment**: `local` (with debug enabled)
- **Database**: Railway PostgreSQL (mainline.proxy.rlwy.net:19409)
- **Cache/Session/Queue**: Redis (needs setup)
- **URL**: http://localhost:8000

## Redis Setup on Railway

### Step 1: Deploy Redis on Railway

1. Open your Railway project dashboard
2. Click **"+ New"** button
3. Select **"Database"** → **"Add Redis"**
4. Railway will deploy Redis and generate connection variables

### Step 2: Get Redis Variables

After deploying, click on your Redis service and go to the **"Variables"** tab. You'll see:

```
REDIS_URL=redis://default:PASSWORD@HOST:PORT
REDIS_PRIVATE_URL=redis://default:PASSWORD@redis.railway.internal:6379
```

### Step 3: Update Your .env

Replace the placeholder values in `.env`:

```env
REDIS_CLIENT=phpredis
REDIS_HOST=your-redis-host.railway.app  # Extract from REDIS_URL
REDIS_PASSWORD=your-redis-password      # Extract from REDIS_URL
REDIS_PORT=12345                        # Extract from REDIS_URL
```

**Or use the simpler URL format:**

```env
REDIS_URL=redis://default:YOUR_PASSWORD@your-host.railway.app:PORT
```

Laravel will automatically parse this URL format.

## Starting Local Development

1. **Install dependencies** (if not done):
   ```bash
   composer install
   npm install
   ```

2. **Clear config cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Run migrations** (if needed):
   ```bash
   php artisan migrate
   ```

4. **Start the server**:
   ```bash
   php artisan serve
   ```

5. **In another terminal, compile assets**:
   ```bash
   npm run dev
   ```

6. **Visit**: http://localhost:8000

## Verifying Connections

Test PostgreSQL connection:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
# Should show PDO object without errors
```

Test Redis connection (after setup):
```bash
php artisan tinker
>>> Illuminate\Support\Facades\Redis::connection()->ping();
# Should return "PONG"
```

## About Redis vs Upstash

**Yes, you can use Railway's Redis instead of Upstash!** 

### Benefits:
- ✅ Centralized billing (you're already paying for Railway)
- ✅ Lower latency (all services in one platform)
- ✅ Simpler management
- ✅ Built-in metrics and monitoring

### To switch from Upstash to Railway Redis:

1. Deploy Redis on Railway (as shown above)
2. Get the connection credentials
3. Update your project's environment variables to use Railway's Redis instead
4. Same configuration format - just different host/password

Railway's Redis is a full Redis instance, perfect for:
- Session storage
- Cache
- Queue management
- Rate limiting
- Real-time features

## Container Tools Extension

**You don't need it** since:
- You're deploying directly to Railway (not using local Docker)
- Railway handles containerization for you
- Your local dev connects to Railway services directly

Only install it if you plan to:
- Test Docker builds locally
- Debug containerization issues
- Work with Docker Compose

## Production Variables on Railway

Make sure your Railway deployment has these variables set:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
DB_CONNECTION=pgsql
DB_HOST=postgres.railway.internal
DB_PORT=5432
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=<from Railway>
REDIS_HOST=redis.railway.internal
REDIS_PORT=6379
REDIS_PASSWORD=<from Railway>
SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

Note: Production uses **internal** URLs (`.railway.internal`) for lower latency within Railway's network.

## Troubleshooting

### Can't connect to PostgreSQL
- Verify credentials match Railway's public URL
- Check if your IP needs whitelisting (Railway usually doesn't require this)
- Ensure port 19409 isn't blocked by firewall

### Redis connection fails
- Make sure Redis service is deployed on Railway
- Verify credentials are from the public URL (not internal)
- Check that phpredis extension is installed: `php -m | grep redis`

### Install phpredis if needed
```bash
# Ubuntu/Debian
sudo apt-get install php-redis

# Mac (Homebrew)
brew install php
pecl install redis
```

Then restart your PHP server.
