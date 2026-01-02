# ⚡ Quick Reference Card - Ports & Phases

## 🚀 START HERE (Copy & Paste)

```bash
# 1. Load aliases
source /home/shay/cyp_wri_code/transparency_dot_ie/.aliases.sh

# 2. Go to project
cdtrans

# 3. Check ports are free
checkports

# 4. Start backend (Terminal 1)
serve

# 5. Start frontend (Terminal 2)
npm run dev

# 6. Open browser
# http://localhost:8001
```

---

## 🔌 Port Reference

| Port | Service | Command | Status |
|------|---------|---------|--------|
| **8001** | Backend | `serve` | ✅ Running |
| **5173** | Frontend HMR | `npm run dev` | ✅ Running |
| **6379** | Redis | (local/Railway) | ℹ️ Config only |
| **5432** | PostgreSQL | (local/Railway) | ℹ️ Config only |

---

## ⚙️ Useful Aliases

```bash
serve              # Start backend (:8001)
npm run dev        # Start frontend (:5173)
start              # Start both services
restart            # Kill :8001 + restart
killports          # Clean all dev ports
checkports         # Show active ports

cdtrans            # Jump to project
a tinker           # Interactive console
fresh              # Reset database
freshseed          # Reset + seed data
cc                 # Clear caches
```

---

## 🎯 9 New Phases at a Glance

| Phase | Title | Time | Difficulty | Blocks |
|-------|-------|------|------------|--------|
| **7** | Admin Interface | 1-2w | Medium | 8-15 |
| **8** | Visualizations | 2-3w | Med-High | - |
| **9** | Real Data APIs | 2-3w | High | 10-14 |
| **10** | User Engagement | 2-3w | High | - |
| **11** | Education | 1-2w | Low-Med | - |
| **12** | Security & Perf | 2-3w | High | Prod |
| **13** | Mobile App | 4-6w | Very High | - |
| **14** | i18n | 1-2w | Low | - |
| **15** | Email & Notifs | 1-2w | Medium | - |

---

## 📚 What to Read

**Right Now (5 min):**
- [PHASE_PLANNING_SUMMARY.md](PHASE_PLANNING_SUMMARY.md)

**Before Starting Phase 7 (20 min):**
- [PHASE_7_ROADMAP.md](PHASE_7_ROADMAP.md) - Phase 7 section

**For Port Help (10 min):**
- [PORT_CONFIGURATION.md](PORT_CONFIGURATION.md)

**Everything At Once (60 min):**
- [COMPLETE_DOCUMENTATION_INDEX.md](COMPLETE_DOCUMENTATION_INDEX.md)

---

## 🚨 If Something's Wrong

```bash
# Check what's running
checkports

# Kill everything
killports

# Try again
serve
```

**Can't access http://localhost:8001?**
→ Make sure `serve` output shows "Server running at"

**Frontend not hot-reloading?**
→ Make sure `npm run dev` is running in another terminal

**Database issues?**
→ Run `freshseed` to reset

---

## 📍 Access Points

```
Main Site:   http://localhost:8001
Admin Panel: http://localhost:8001/admin       (after Phase 7)
API:         http://localhost:8001/api/v1
```

---

## 🎯 Next Steps

### This Hour
- [ ] Source aliases
- [ ] Run `cdtrans && serve`
- [ ] Visit http://localhost:8001

### Today
- [ ] Read [PHASE_PLANNING_SUMMARY.md](PHASE_PLANNING_SUMMARY.md)
- [ ] Understand new port setup
- [ ] Run `checkports` successfully

### This Week
- [ ] Read Phase 7 roadmap
- [ ] Decide next phase
- [ ] Plan sprint

### This Month
- [ ] Complete Phase 7 or 8
- [ ] Ship feature
- [ ] Move to next phase

---

## 💡 Pro Tips

```bash
# Check all ports at once
checkports

# Clean up when done
killports

# Both services with one command
start

# Restart backend only
restart

# Restart everything
killports && start
```

---

## 🗂️ Key Files

| File | What | Edit |
|------|------|------|
| `.aliases.sh` | All aliases | ✅ Updated |
| `vite.config.js` | Frontend config | ✅ Updated |
| `PHASE_7_ROADMAP.md` | Phases 7-15 | ✅ New |
| `PORT_CONFIGURATION.md` | Port setup | ✅ New |

---

## ✅ Phase 7 Overview

**What:** Admin panel for managing all content
**Why:** Makes the site easy to maintain
**Time:** 1-2 weeks
**Next:** Enables Phases 8-15

**Key Tasks:**
1. Fix Filament admin panel
2. Build CRUD for 10 models
3. Add rich text editor
4. Set up user permissions

**Get Started:** [PHASE_7_ROADMAP.md#-phase-7-admin-interface--content-management](PHASE_7_ROADMAP.md)

---

## 🚀 Ready?

```bash
source /home/shay/cyp_wri_code/transparency_dot_ie/.aliases.sh
cdtrans
serve
```

Visit: **http://localhost:8001**

---

**Ports Fixed ✅ | Phases Planned ✅ | Documentation Ready ✅**

All systems go! 🎉
