# 🚀 Local Development - Quick Reference

## ✅ Setup Complete!

Your local environment is now connected to Railway's production PostgreSQL and Redis databases.

---

## 🌐 Access Your Site

**Local Development:** http://localhost:8000

Your site is running with example Waterford Council data!

---

## 📊 What Data is Available?

- **6 Departments** (Housing, Roads, Environment, Recreation, Planning, Finance)
- **6 Budgets** (2025 fiscal year)
- **4 Initiatives** (Housing First, Sustainable Mobility, River Restoration, Cultural Heritage)
- **25 Spending records**

Access the Filament admin panel at: http://localhost:8000/admin

---

## 🔧 Helpful Aliases

I've created `.aliases.sh` with shortcuts. To use them:

```bash
source .aliases.sh
```

**Or add to your `~/.bashrc` or `~/.zshrc`:**
```bash
echo "source ~/cyp_wri_code/transparency_dot_ie/.aliases.sh" >> ~/.bashrc
source ~/.bashrc
```

### Most Useful Aliases:

```bash
a                # php artisan
serve            # php artisan serve  
fresh            # Fresh migration (no data)
freshseed        # Fresh migration + seed data
cc               # Clear all caches
dbcount          # Show record counts
dbtest           # Test DB & Redis connections
tinker           # Open tinker REPL
logs             # Tail Laravel logs
dev              # npm run dev (compile frontend)
restart          # Kill port 8000 and restart server
```

---

## 🎯 Common Commands

### Start Development
```bash
php artisan serve              # Backend (port 8000)
npm run dev                    # Frontend compilation (separate terminal)
```

### Database Operations
```bash
php artisan migrate:fresh --seed  # Reset & seed data
php artisan db:seed               # Just add seed data
php artisan tinker                # Interactive console
```

### Clear Caches (do this after .env changes)
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### View Data Counts
```bash
php artisan tinker --execute="
echo 'Departments: ' . App\Models\Department::count() . PHP_EOL;
echo 'Budgets: ' . App\Models\Budget::count() . PHP_EOL;
echo 'Initiatives: ' . App\Models\Initiative::count() . PHP_EOL;
echo 'Spending: ' . App\Models\Spending::count() . PHP_EOL;
"
```

### Test Connections
```bash
php artisan tinker --execute="
echo 'DB: Connected ✓' . PHP_EOL;
echo 'Redis: ' . (Illuminate\Support\Facades\Redis::connection()->ping() ? 'Connected ✓' : 'Failed') . PHP_EOL;
"
```

---

## 🎨 Frontend Development

### Compile Assets
```bash
npm run dev      # Development (with hot reload)
npm run build    # Production build
```

### Watch for Changes
```bash
npm run dev      # Automatically recompiles on file changes
```

---

## 📝 About `php artisan serve`

**What it does:**
- Starts PHP's built-in development server
- Serves your Laravel app on http://localhost:8000
- **Does NOT compile frontend assets** (CSS/JS)

**For full development, you need BOTH:**
1. `php artisan serve` - Backend
2. `npm run dev` - Frontend compilation

---

## 🗄️ Database & Redis

**Connected to Railway:**
- **PostgreSQL**: mainline.proxy.rlwy.net:19409
- **Redis**: yamabiko.proxy.rlwy.net:29475

**Sharing with production:** Yes! Same database, so changes here affect production.

**To avoid this:** You could set up a separate Railway environment or use local databases.

---

## 🐛 Troubleshooting

### Port 8000 already in use?
```bash
lsof -ti:8000 | xargs kill -9
php artisan serve
```
Or use alias:
```bash
restart
```

### Redis/DB connection errors?
```bash
php artisan config:clear
php artisan cache:clear
dbtest  # Test connections
```

### Frontend not updating?
```bash
npm run dev     # Make sure this is running
# Check browser console for errors
```

### See Laravel logs
```bash
tail -f storage/logs/laravel.log
# Or use alias:
logs
```

---

## 💡 Tips

1. **Always run `npm run dev`** if you're editing CSS/JS files
2. **Clear config cache** after changing `.env`: `php artisan config:clear`
3. **Use tinker** for quick database queries: `php artisan tinker`
4. **Check logs** when things break: `tail -f storage/logs/laravel.log`
5. **Railway Redis is FREE** - use it instead of Upstash!

---

## 📚 Next Steps

1. **Create admin user** for Filament:
   ```bash
   php artisan tinker
   >>> User::factory()->create(['email' => 'admin@transparency.ie', 'name' => 'Admin'])
   ```

2. **Explore the Filament admin panel**: http://localhost:8000/admin

3. **Add more seed data** by editing:
   - `database/seeders/WaterfordCouncilSeeder.php`
   - `database/seeders/IrishFederalEnergySeeder.php`

4. **Customize** the frontend in `resources/views/`

---

## ❓ Questions Answered

**Q: Do I need Container Tools extension?**  
A: No! You're not using Docker locally. Railway handles containerization.

**Q: Can I use Railway Redis instead of Upstash?**  
A: Absolutely! You're already paying for Railway. Just update your other project's env variables to use Railway's Redis connection string.

**Q: Is this setup identical to production?**  
A: Almost! Same database, Redis, and app code. Only differences:
- Domain (localhost vs railway.app)
- `APP_ENV=local` (vs production)
- `APP_DEBUG=true` (vs false)

---

## 🎉 You're Ready!

Visit **http://localhost:8000** to see your local site!

Need help? Check `RAILWAY_LOCAL_SETUP.md` for detailed setup info.
