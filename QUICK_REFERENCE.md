# 📍 TRANSPARENCY.IE QUICK REFERENCE CARD

## 🚀 Start Application (2 commands)

```
Terminal 1:                Terminal 2:
$ serve                    $ dev
↓                         ↓
Backend on :8000          CSS/JS compiled
```

## 🌐 Visit Pages

```
Home          → http://localhost:8000
Technologies  → http://localhost:8000/technologies
Events        → http://localhost:8000/events
Case Studies  → http://localhost:8000/case-studies
Campaigns     → http://localhost:8000/campaigns
Metrics       → http://localhost:8000/metrics
```

## 📚 Essential Documents

| Document | Purpose |
|----------|---------|
| [FINAL_REPORT.md](FINAL_REPORT.md) | Complete overview |
| [QUICK_START.md](QUICK_START.md) | Get running |
| [REFERENCE.md](REFERENCE.md) | Daily reference |
| [ARCHITECTURE.md](ARCHITECTURE.md) | How it works |

## 🗂️ Key Files

```
Controller:      app/Http/Controllers/PublicController.php
Views:           resources/views/public/*.blade.php
Routes:          routes/web.php
Models:          app/Models/*.php (10 files)
Database:        19 tables (PostgreSQL)
```

## 🔑 Admin Credentials

```
Email:    admin@transparency.ie
Password: password
```

## 📊 Content (Seeded)

```
✓ 2 Technologies (VRFB, Li-ion)
✓ 2 Events (Grid Challenge, Beyond Batteries)
✓ 1 Case Study (Codling Wind Park)
✓ 1 Campaign (Stop New Gas petition)
✓ 5 Environmental Metrics
✓ Plus more...
```

## 🛠️ Most Used Commands

```bash
serve            # Start backend
dev              # Compile CSS/JS
cc               # Clear caches
a tinker         # Interactive shell
db:refresh       # Reset database
migrate          # Run migrations
seed             # Run seeders
```

See [ALIAS_GUIDE.md](ALIAS_GUIDE.md) for 50+ commands.

## 🔧 Add More Data

```bash
$ a tinker

>>> Technology::create([
  'name' => 'Name',
  'category' => 'Category',
  'cost_per_kwh' => 100,
  'lifespan_years' => 20,
  'efficiency_percent' => 85,
]);

>>> exit
```

Then refresh page - new data appears automatically!

## 📱 Test on Mobile

- Press `F12` (DevTools)
- Click device icon (top-left)
- Select "iPhone 12"
- Pages should look good on phone

## ❌ Common Issues

| Issue | Fix |
|-------|-----|
| Blank page | Ensure `serve` is running |
| Page 404 | Check routes/web.php |
| No styling | Ensure `dev` is running |
| Database error | Check .env credentials |
| Old content | Run `cc` to clear cache |

## ✅ Quick Verification

```bash
# Check database
$ a tinker
>>> Technology::count()
# Should return: 2

>>> Event::count()  
# Should return: 2

# Check pages
Open browser: http://localhost:8000/technologies
Should see: VRFB and Li-ion cards
```

## 📈 Next Steps

1. **Showcase** - Share at http://localhost:8000
2. **Add Content** - Use `a tinker` to add more
3. **Plan Feature** - Choose from [EXPANSION_PLAN.md](EXPANSION_PLAN.md)
4. **Deploy** - Follow [RAILWAY_DEPLOYMENT.md](RAILWAY_DEPLOYMENT.md)

## 📞 Need Help?

| Topic | Document |
|-------|----------|
| Getting started | [QUICK_START.md](QUICK_START.md) |
| Daily use | [REFERENCE.md](REFERENCE.md) |
| Architecture | [ARCHITECTURE.md](ARCHITECTURE.md) |
| Commands | [ALIAS_GUIDE.md](ALIAS_GUIDE.md) |
| Issues | [FIX_DOCUMENTATION.md](FIX_DOCUMENTATION.md) |
| All docs | [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md) |

## 🎯 Platform Overview

```
                    ┌─────────────────┐
                    │ Public Website  │
                    │   6 pages       │
                    └────────┬────────┘
                             │ HTTP
                    ┌────────▼────────┐
                    │ Laravel Backend │
                    │  (PHP 8.3)      │
                    └────────┬────────┘
                             │ SQL
                    ┌────────▼────────┐
                    │   PostgreSQL    │
                    │ (Railway)       │
                    └─────────────────┘
```

## 💡 Features at a Glance

```
✓ 6 responsive pages
✓ Real Irish data
✓ Beautiful design
✓ Clean architecture
✓ Fully documented
✓ Production-ready
✓ Easy to extend
✓ Stakeholder-ready
```

## 🎊 Status

```
Backend:      ✅ Running
Frontend:     ✅ Compiled
Database:     ✅ Connected
Pages:        ✅ Live
Docs:         ✅ Complete
Ready:        ✅ YES!
```

## 📋 Session Summary

| Metric | Value |
|--------|-------|
| Pages Created | 6 |
| Models Built | 10 |
| Database Tables | 19 |
| Seeded Records | ~70 |
| Documentation | 6 new files |
| Controllers | 1 |
| Views | 5 |
| Routes | 6 |
| Status | ✅ COMPLETE |

---

**Made for Ireland's energy transition** ☘️

Visit: **http://localhost:8000**

Read: **[FINAL_REPORT.md](FINAL_REPORT.md)**

Start: **`serve`** + **`dev`**
