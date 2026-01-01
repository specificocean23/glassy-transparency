# 🎯 Alias Guide: Understanding Your Commands

## Quick Answer to Your Questions

### What's `serve`?
**`serve` = Start the backend development server**
- Makes your site accessible at http://localhost:8000
- Runs the PHP code (the "brains" of your site)
- **Does NOT compile CSS/JavaScript** (frontend styling)
- It's a **development server**, not production

### What's `tinker`?
**`tinker` = Interactive console to test code and edit data**
- Like typing commands directly to your database/app
- Can check data, run queries, test code
- More on this below ↓

### Why Do You See a Blank Page?
**Two reasons:**
1. **No homepage route** - You haven't created the page users see at `/`
2. **Frontend assets not compiled** - CSS/JavaScript haven't been built
3. **Filament admin exists** but the public site doesn't yet

---

## All Your Aliases Explained

### 🏠 Navigation
```bash
cdtrans              # Go to project folder
                     # Usage: cdtrans && serve
```

---

### ⚡ Most Important: Artisan Commands
These interact with Laravel's "brain":

#### **`a` = `php artisan` (Your #1 Most-Used Alias)**
```bash
a migrate            # Run database migrations - to postgres?
a tinker             # Open interactive console - ill have to check this out with the cool term
a make:model User    # Create new model - okay make a user thats good
a make:controller    # Create new controller
a serve              # Start server - like a dev server
```
**Translation:** `a` is a shortcut for Laravel's main command tool
**Use it for:** Almost everything in development

#### **`serve` = Start the Backend**
```bash
serve                # Starts PHP server on localhost:8000
```
**What it does:**
- Fires up the development server
- Makes your site accessible at http://localhost:8000
- **Only** runs PHP code
- **Does not** compile CSS/JavaScript
- Stays running until you press Ctrl+C

**When to use:** Every time you start developing

#### **`tinker` = Interactive Console**
```bash
tinker               # Open interactive Laravel shell
>>> $users = User::all();
>>> $users->count();
>>> Department::create(['name' => 'Test']);
>>> exit
```
**What it does:**
- Lets you run Laravel code line by line
- Access your database directly
- Test code before using it in your app
- Like a programming playground

**When to use:** 
- Testing database queries
- Quick data checks
- Running one-off commands

---

### 📊 Database Commands (You'll Use These a Lot)

#### **`fresh` = Nuke & Rebuild Database**
```bash
fresh                # Delete all tables + data, then rebuild
                     # Same as: php artisan migrate:fresh
```
**WARNING:** Deletes ALL data! Only use in development
**Use when:** You mess up schema or want a clean slate

#### **`freshseed` = Rebuild Database + Add Example Data**
```bash
freshseed            # Delete tables + rebuild + add seed data
                     # Same as: php artisan migrate:fresh --seed
```
**Best for:** Getting back to a working state with example data
**Use when:** You want to start over with fresh sample data

#### **`migrate` = Apply Pending Database Changes**
```bash
migrate              # Run any unapplied migrations
```
**Use when:** You've created new migration files and want to apply them

#### **`rollback` = Undo Last Migration**
```bash
rollback             # Reverse the last database migration
```
**Use when:** You made a migration mistake

#### **`seed` = Add Sample Data**
```bash
seed                 # Run seeders to populate database
```
**Use when:** You want to add example data

#### **`dbtest` = Check Database & Redis Connection**
```bash
dbtest               # Tests both PostgreSQL and Redis
                     # Output: DB: Connected ✓ / Redis: Connected ✓
```
**Use when:** Troubleshooting connection issues

---

### 🗑️ Cache Commands (Clear When Things Break)

#### **`cc` = Clear All Caches**
```bash
cc                   # Clear config, cache, and views
```
**Use when:**
- You change `.env` file
- Something isn't updating
- "It worked before" but doesn't now
**Best practice:** Run this after `.env` changes

#### **`co` = Optimize & Cache Everything**
```bash
co                   # Cache config, routes, views for production
```
**Use when:** Preparing for production (speeds things up)
**Not needed for:** Local development

---

### 📈 Quick Data Checks

#### **`dbcount` = See How Much Data You Have**
```bash
dbcount              # Shows count of departments, budgets, etc.
                     # Output:
                     # Departments: 6
                     # Budgets: 6
                     # Initiatives: 4
                     # Spending: 25
```
**Use when:** You want to verify your database is populated

---

### 📝 Logs (Debugging)

#### **`logs` = Watch Error Messages Live**
```bash
logs                 # Shows Laravel error log in real-time
                     # Press Ctrl+C to stop
```
**Use when:** Something crashes and you need to see the error

#### **`logsclr` = Delete All Log Messages**
```bash
logsclr              # Clears the log file
```
**Use when:** Logs are too cluttered

---

### 📦 Package Managers (Installing Dependencies)

#### **`ci` = Install Dependencies**
```bash
ci                   # composer install
```
**Use when:** 
- First time setting up project
- After adding new packages to composer.json

#### **`cu` = Update Packages**
```bash
cu                   # composer update
```
**Use when:** You want latest package versions (rarely needed)

#### **`cr` = Install New Package**
```bash
cr illuminate/broadcasting    # Installs a new package
```
**Use when:** You need a new dependency

#### **`cda` = Rebuild Class Map**
```bash
cda                  # Rebuilds autoloader
```
**Use when:** New classes aren't being recognized

#### **`ni` = Install Frontend Packages**
```bash
ni                   # npm install
```
**Use when:** First setup or after adding npm packages

---

### 🎨 Frontend (CSS/JavaScript)

#### **`dev` = Compile & Watch Frontend**
```bash
dev                  # Compiles CSS/JS + watches for changes
                     # Stays running. Press Ctrl+C to stop
```
**What it does:**
- Compiles Tailwind CSS
- Bundles JavaScript (Vite)
- **Watches for changes** and recompiles automatically
- Shows hot-reload in browser

**IMPORTANT:** You need THIS RUNNING to see styling!

**When to use:** 
- Whenever you're developing frontend
- **In a separate terminal** from `serve`
- Essential for seeing CSS/styling

#### **`build` = Build for Production**
```bash
build                # Creates optimized production assets
```
**Use when:** Deploying to production

---

### 🔀 Git (Version Control)

#### **`gs` = Git Status**
```bash
gs                   # See what files changed
```

#### **`ga` = Stage All Changes**
```bash
ga                   # Mark all files for commit
```

#### **`gc` = Commit Changes**
```bash
gc "message"         # gc "Added new feature"
```

#### **`gp` = Push to Remote**
```bash
gp                   # Upload to GitHub/GitLab
```

#### **`gl` = Pull Latest**
```bash
gl                   # Download latest from GitHub
```

---

### 🚀 Convenience Commands

#### **`start` = Start Everything**
```bash
start                # Runs: serve & dev (both simultaneously)
```
**Use when:** You want backend + frontend running at once

#### **`restart` = Kill & Restart Server**
```bash
restart              # Kills port 8000, then restarts serve
```
**Use when:** Server hangs or won't respond

---

## Your Daily Workflow

### 🌅 Morning: Starting Development
```bash
cdtrans                    # Go to project
freshseed                  # Fresh data (if needed)
start                      # OR: serve & (in new terminal) dev
```

### 💻 During Development
```bash
# In terminal 1:
serve                      # Backend server (stays running)

# In terminal 2:
dev                        # Frontend compilation (stays running)

# In terminal 3 (when needed):
a migrate                  # Run migrations
a tinker                   # Test something
dbtest                     # Check connections
logs                       # See errors
```

### 🔧 Troubleshooting
```bash
cc                         # If something won't update
dbcount                    # Check if data exists
logs                       # See the error
dbtest                     # Check database connection
```

### 🧹 Cleanup
```bash
freshseed                  # Reset everything with fresh data
cc && restart              # Clear cache & restart server
```

---

## The Most Important Aliases (Your Top 10)

In order of how often you'll use them:

1. **`serve`** - Start backend server (use constantly)
2. **`dev`** - Compile frontend assets (use constantly)
3. **`a`** - Run artisan commands (use constantly)
4. **`cc`** - Clear caches (use when things break)
5. **`tinker`** - Test code interactively (use regularly)
6. **`logs`** - See errors (use when debugging)
7. **`freshseed`** - Reset database (use occasionally)
8. **`dbtest`** - Test connections (use when troubleshooting)
9. **`dbcount`** - Check data (use to verify)
10. **`gs/ga/gc`** - Git commands (use daily for version control)

---

## Understanding: Why You See a Blank Page

### What's Happening:

**Step 1: You run `serve`**
```bash
serve
# Output: INFO  Server running on [http://127.0.0.1:8000]
```
✅ Backend is ready

**Step 2: You visit http://localhost:8000**
✅ Your browser requests the page
✅ Backend receives request
✅ Backend looks for route at `/` (homepage)

**Step 3: What Happens Next?**

Currently, there's **no homepage route defined**!

Your site structure:
```
/                     ← You visit here
├── /admin            ← Filament admin exists here
└── routes/web.php    ← Needs homepage route defined
```

### How to Fix It:

Add to `routes/web.php`:
```php
Route::get('/', function () {
    return view('welcome');
});
```

Then create `resources/views/welcome.blade.php`:
```html
<h1>Welcome to Transparency.ie</h1>
<p>Government spending transparency for Ireland</p>
```

OR visit the admin panel instead:
```
http://localhost:8000/admin
```

---

## Important Distinction

### `serve` (Backend) vs `dev` (Frontend)

**Backend (`serve`):**
- Runs PHP code
- Accesses database
- Processes requests
- **You must run this**

**Frontend (`dev`):**
- Compiles CSS (Tailwind)
- Bundles JavaScript
- Watches for changes
- **You must also run this** (in separate terminal)

**Without `dev` running:**
- Site loads but looks broken (no CSS)
- JavaScript features don't work
- You see unstyled HTML

**That's why `start` runs both!**

---

## Pro Tips

### Tip 1: Open Two Terminals
```bash
# Terminal 1:
cdtrans && serve

# Terminal 2 (new window):
cdtrans && dev
```

Both stay running. You code in your editor.

### Tip 2: Use `tinker` for Quick Tests
Instead of writing code then running it:
```bash
tinker
>>> $dept = Department::first();
>>> $dept->name;
>>> $dept->update(['name' => 'New Name']);
>>> exit
```

### Tip 3: `cc` is Your Friend
If something weird happens:
```bash
cc              # Clear everything
restart         # Restart server
```

Often fixes mysterious issues.

### Tip 4: Watch the Logs
In a third terminal:
```bash
logs            # See errors as they happen
```

When something breaks, you'll see it here.

---

## Quick Reference Card

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🚀 START DEVELOPMENT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
serve                   Start backend (Terminal 1)
dev                     Start frontend (Terminal 2)
  OR
start                   Start both (but in background)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🗄️  DATABASE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
freshseed              Reset DB + add sample data
migrate                Apply pending migrations
tinker                 Interactive console
dbtest                 Test DB/Redis connection
dbcount                Show data counts

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🛠️  TROUBLESHOOTING
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
cc                     Clear caches (try first!)
logs                   See error messages
restart                Kill & restart server
dbtest                 Check connections

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📦 PACKAGES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ci                     Install dependencies
ni                     Install npm packages
cr package-name        Add new dependency

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📝 GENERAL ARTISAN
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
a [command]            Run any artisan command
a make:model           Create model
a make:controller      Create controller
a make:migration       Create migration
```

---

## You Now Understand! 

The key insight:
- **`serve`** = Backend (PHP, database)
- **`dev`** = Frontend (CSS, JavaScript)
- **`a`** = Do things in Laravel
- **`tinker`** = Test code interactively
- **`cc`** = Fix weird errors
- **`tinker`** = Everything together!

You'll mostly use: **`serve`**, **`dev`**, **`a`**, **`tinker`**, **`cc`**

The blank page issue is solved by:
1. Creating a homepage route
2. Making sure `dev` is running (for styling)
3. The /admin panel works already if you visit it

**You've got this!** 🚀
