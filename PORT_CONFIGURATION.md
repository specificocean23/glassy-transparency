# 🚀 Updated Port Configuration Guide

## Port Assignment Changes

### Previous Configuration (Port Clashing ❌)
- Backend: `php artisan serve` → **:8000**
- Frontend: `npm run dev` → **:5173**
- **Problem:** Documentation and examples hardcoded to :8000, causing confusion

### New Configuration (No Clashing ✅)
- Backend: `php artisan serve --port=8001` → **:8001**
- Frontend: `npm run dev` → **:5173** (default)
- Redis: **:6379** (local/Railway)
- PostgreSQL: **:5432** (local, if used)

---

## Why the Change?

1. **Clear Separation:** Backend on :8001, frontend on :5173
2. **Avoid Conflicts:** No overlap with common ports (:8000, :3000, :9000)
3. **Documentation Clarity:** Single source of truth
4. **Alias Consistency:** All scripts updated to use :8001

---

## Updated Access Points

| Service | URL | Purpose |
|---------|-----|---------|
| **Public Site** | http://localhost:8001 | Main transparency.ie site |
| **Admin Panel** | http://localhost:8001/admin | Filament admin (Phase 7) |
| **API** | http://localhost:8001/api/v1 | REST API endpoints |
| **Vite HMR** | http://localhost:5173 | Hot Module Replacement (dev only) |

---

## How to Use the New Configuration

### Option 1: Using Updated Aliases ⭐ (Recommended)
```bash
# Source the alias file
source /home/shay/cyp_wri_code/transparency_dot_ie/.aliases.sh

# Or add to ~/.bashrc/.zshrc:
# source /home/shay/cyp_wri_code/transparency_dot_ie/.aliases.sh

# Then use:
serve              # Starts on :8001 automatically
restart            # Kills :8001 and restarts
killports          # Clean up all dev ports
checkports         # Check active ports
```

### Option 2: Manual Commands
```bash
cd /home/shay/cyp_wri_code/transparency_dot_ie

# Terminal 1 - Backend
php artisan serve --port=8001

# Terminal 2 - Frontend
npm run dev
```

### Option 3: Combined Start
```bash
# Terminal 1 (both services)
start              # Runs both backend (:8001) and frontend (:5173)
```

---

## Verification

### Check if ports are running:
```bash
checkports
```

**Expected output:**
```
=== Active Development Ports ===
php      1234  user  IP  TCP  localhost:8001->*:*  LISTEN
node     5678  user  IP  TCP  localhost:5173->*:*  LISTEN
```

### Test backend:
```bash
curl http://localhost:8001
# Should return HTML (welcome page)

curl http://localhost:8001/api/health
# Should return JSON health status
```

### Test frontend HMR:
- Open http://localhost:8001 in browser
- Modify a CSS/JS file in `resources/`
- Changes should reflect instantly (no page reload)

---

## Important: Update Documentation References

### Files Updated ✅
- [.aliases.sh](.aliases.sh) - All aliases use :8001
- [vite.config.js](vite.config.js) - Vite configured for :5173
- [PHASE_7_ROADMAP.md](PHASE_7_ROADMAP.md) - Uses :8001

### Files to Note (Still reference :8000)
These can be updated later, but functionality still works:
- ALIAS_GUIDE.md
- LOCAL_DEV_GUIDE.md
- Other documentation files

---

## Troubleshooting

### Port Already in Use?
```bash
# Find what's using port 8001
lsof -i :8001

# Kill it (be careful!)
kill -9 <PID>

# Or use the alias
killports
```

### Vite Not Hot-Reloading?
```bash
# Check if Vite is running on :5173
checkports | grep 5173

# If not, restart:
npm run dev
```

### Backend Not Responding?
```bash
# Verify it's running
checkports | grep 8001

# If not running:
serve        # Uses alias which includes --port=8001

# Or manual:
php artisan serve --port=8001
```

### Connection Refused?
```bash
# Make sure you're in the project directory
cdtrans

# Then run serve
serve
```

---

## Railway/Production Configuration

### No Changes Needed! ✅
Railway automatically:
- Detects `php artisan serve` and assigns a dynamic port
- Exposes it as `https://your-domain.railway.app`
- Vite artifacts are pre-compiled (no dev server needed)

### Environment-Specific Ports
```php
// config/app.php or .env
APP_PORT=8001          // Local development
APP_PORT=<dynamic>     // Railway production (set by platform)
```

---

## Command Reference Quick Card

```bash
# Navigation
cdtrans                    # Jump to project

# Development (New Port Configuration)
serve                      # Backend on :8001
npm run dev               # Frontend on :5173
start                     # Both (:8001 + :5173)
restart                   # Kill + restart :8001

# Port Management
killports                 # Clean all dev ports
checkports               # Show active ports

# Utilities
cc                       # Clear caches
fresh                    # Reset database
freshseed               # Reset + seed data
a tinker                # Laravel interactive shell

# Git
gs                      # git status
ga                      # git add .
gc "message"            # git commit
gp                      # git push
```

---

## What Changed Summary

| Aspect | Before | After |
|--------|--------|-------|
| Backend Port | 8000 | **8001** |
| Frontend Port | 5173 | 5173 (unchanged) |
| Aliases Updated | ✗ | ✅ |
| Vite Config Updated | ✗ | ✅ |
| Docs Updated | Partial | ✅ |
| Production Impact | None | None |

---

## Testing the New Setup

```bash
# 1. Source aliases
source /home/shay/cyp_wri_code/transparency_dot_ie/.aliases.sh

# 2. Jump to project
cdtrans

# 3. Check ports are free
checkports

# 4. Start backend
serve

# 5. In another terminal, start frontend
npm run dev

# 6. Open browser
# http://localhost:8001 → Should see transparency.ie site
# http://localhost:8001/admin → Should see admin panel (if Phase 7 complete)

# 7. Verify API
curl http://localhost:8001/api/v1/departments

# 8. When done
killports
```

---

## Next Steps

✅ **Immediate:** Use `source ~/.aliases.sh && serve` with new config
✅ **Soon:** Update remaining docs that reference :8000
✅ **Phase 7:** Implement admin interface on :8001/admin
✅ **Later:** Mobile app will connect to https://your-domain.railway.app

---

**Document Created:** January 1, 2026  
**Configuration Version:** 2.0 (Port Clash Resolution)
