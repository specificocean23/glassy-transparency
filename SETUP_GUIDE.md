# Complete Setup & Troubleshooting Guide

## ✅ System Status

Your application is now fully configured and ready to run without any database setup!

### What's Fixed:

1. ✅ **No SQLite Driver Required** - Removed database dependencies from all controllers
2. ✅ **Demo Data Included** - 5 departments, 5 initiatives, and 5 spending records
3. ✅ **Vite Hot Reload Ready** - Frontend will auto-refresh during development
4. ✅ **API Endpoints Working** - All endpoints return demo data instantly

---

## 🚀 Quick Start (Copy-Paste Ready)

### Step 1: Install Dependencies
```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie
composer install
npm install
```

### Step 2: Terminal 1 - Start Laravel Server
```bash
php artisan serve
```
✅ Server will run at `http://localhost:8000`

### Step 3: Terminal 2 - Start Vite Dev Server
```bash
npm run dev
```
✅ Vite will run at `http://localhost:5173` with hot reload enabled

### Step 4: Open Browser
Navigate to `http://localhost:8000` - You should see the dashboard!

---

## 📊 API Endpoints (All Working Now!)

### Health Check
```
GET http://localhost:8000/api/health
```
Response: `{"status": "ok"}`

### Dashboard Stats
```
GET http://localhost:8000/api/v1/dashboard/stats
```

### All Departments
```
GET http://localhost:8000/api/v1/departments
```

### Single Department
```
GET http://localhost:8000/api/v1/departments/1
```

### All Spending
```
GET http://localhost:8000/api/v1/spendings
```

### All Initiatives
```
GET http://localhost:8000/api/v1/initiatives
```

### Full Report
```
GET http://localhost:8000/api/v1/report
```

Test these in your browser or use curl/Postman!

---

## 🔧 Troubleshooting

### Issue: "Connection refused" or "Cannot connect to localhost:8000"
**Solution:** Make sure PHP server is running with `php artisan serve` in Terminal 1

### Issue: "Vite manifest not found" error on page
**Solution:** Make sure Vite dev server is running with `npm run dev` in Terminal 2

### Issue: "Port 8000 already in use"
**Solution:** Use a different port:
```bash
php artisan serve --port=8001
```
Then access the app at `http://localhost:8001`

### Issue: "Port 5173 already in use"
**Solution:** Vite will find the next available port. Check the terminal output for which port it's using.

### Issue: Module not found errors in browser console
**Solution:** 
1. Stop Vite (Ctrl+C in Terminal 2)
2. Delete `node_modules` folder
3. Run `npm install` again
4. Run `npm run dev` again

### Issue: Assets not loading (CSS/JS missing)
**Solution:** This happens when you open the page before Vite starts. Simply refresh the browser once Vite is running.

---

## 📁 Key Project Files

### Controllers (Demo Data Sources)
- **[app/Http/Controllers/Api/DashboardController.php](app/Http/Controllers/Api/DashboardController.php)** - Dashboard metrics
- **[app/Http/Controllers/Api/TransparencyController.php](app/Http/Controllers/Api/TransparencyController.php)** - Transparency endpoints
- **[app/Http/Controllers/Api/DemoController.php](app/Http/Controllers/Api/DemoController.php)** - Additional demo data

### Routes
- **[routes/api.php](routes/api.php)** - API route definitions

### Frontend
- **[resources/views/dashboard.blade.php](resources/views/dashboard.blade.php)** - Main page template
- **[resources/js/app.js](resources/js/app.js)** - Vue app entry point
- **[resources/css/app.css](resources/css/app.css)** - Tailwind styles

### Configuration
- **[.env](.env)** - Environment variables (already configured)
- **[vite.config.js](vite.config.js)** - Vite build config
- **[tailwind.config.js](tailwind.config.js)** - Tailwind CSS config

---

## 🎯 Demo Data Overview

### Departments (5 total)
1. Housing & Homelessness Services - €1.25M budget
2. Environment & Green Energy - €1.1M budget
3. Transportation & Mobility - €890K budget
4. Parks & Recreation - €650K budget
5. Community & Economic Development - €810K budget

### Initiatives (5 total)
- Housing First Program - Helps homeless individuals
- Green Dublin 2030 - Carbon neutrality initiative
- Sustainable Mobility Program - Public transport expansion
- Community Green Spaces - Parks development
- Dublin Jobs Initiative - Employment creation

### Spending Records (5 total)
- Emergency shelter operations
- Solar panel installations
- Bus fleet maintenance
- Housing program support
- Park equipment upgrades

All data is returned as JSON from the API endpoints.

---

## 🔄 Development Workflow

### Making Changes to Controllers

If you want to modify the demo data:

1. Edit the controller file (e.g., `app/Http/Controllers/Api/TransparencyController.php`)
2. Modify the `getDepartments()`, `getSpendings()`, or `getInitiatives()` methods
3. Save the file - Laravel will automatically reload it
4. Refresh your browser to see the changes

### Making Changes to Frontend

1. Edit Vue components in `resources/js/components/`
2. Edit styles in `resources/css/app.css`
3. Vite will automatically hot-reload the page in your browser

### Building for Production

```bash
npm run build
```

This creates optimized assets in `public/build/` that don't require the Vite dev server.

---

## 📱 Frontend Structure

### Available Components
Check `resources/js/components/` for Vue components:
- Dashboard overview
- Department browser
- Spending tracker
- Initiative viewer
- Charts and graphs

### State Management
Using Pinia store at `resources/js/stores/` for application state

### Styling
Tailwind CSS utility classes throughout, configured in `tailwind.config.js`

---

## 🔐 Security Notes

- Application key is already generated in `.env`
- CSRF protection is enabled by default
- No sensitive data in demo mode
- API endpoints are public (add authentication when deploying)

---

## 📦 Useful Commands

```bash
# List all API routes
php artisan route:list

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Debug mode (interactive shell)
php artisan tinker

# Install additional packages
composer require package-name
npm install package-name

# Update dependencies
composer update
npm update
```

---

## 🎬 Next Steps

1. ✅ Get the app running with the quick start above
2. 📝 Explore the API endpoints using your browser or Postman
3. 💻 Check the Vue components in `resources/js/components/`
4. 🎨 Customize the demo data in the controllers
5. 🚀 When ready, run `npm run build` for production deployment

---

## 📞 Quick Reference

| Task | Command |
|------|---------|
| Install dependencies | `composer install && npm install` |
| Start PHP server | `php artisan serve` |
| Start Vite dev | `npm run dev` |
| Build for production | `npm run build` |
| Clear caches | `php artisan cache:clear` |
| List routes | `php artisan route:list` |

---

**Ready to go!** Both servers should be running now. Open http://localhost:8000 to see your dashboard! 🎉
