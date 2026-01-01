# 🏗️ Transparency.ie - Architecture Diagram

## System Architecture

```
┌─────────────────────────────────────────────────────────────────────┐
│                         USER BROWSER (HTTP)                         │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐  │
│  │ http://localhost:8000/technologies                          │  │
│  │ http://localhost:8000/events                                │  │
│  │ http://localhost:8000/case-studies                          │  │
│  │ http://localhost:8000/campaigns                             │  │
│  │ http://localhost:8000/metrics                               │  │
│  └─────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────┘
                              ↓ HTTP Request
┌─────────────────────────────────────────────────────────────────────┐
│                    Laravel Application (PHP 8.3)                    │
│                                                                     │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │ routes/web.php                                               │  │
│  │ ├─ GET /              → welcome view                         │  │
│  │ ├─ GET /technologies  → PublicController@technologies()      │  │
│  │ ├─ GET /events        → PublicController@events()            │  │
│  │ ├─ GET /case-studies  → PublicController@caseStudies()       │  │
│  │ ├─ GET /campaigns     → PublicController@campaigns()         │  │
│  │ └─ GET /metrics       → PublicController@metrics()           │  │
│  └──────────────────────────────────────────────────────────────┘  │
│                              ↓                                      │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │ app/Http/Controllers/PublicController.php                    │  │
│  │                                                              │  │
│  │  public function technologies() {                           │  │
│  │    $technologies = Technology::all();                       │  │
│  │    return view('public.technologies', compact(...));        │  │
│  │  }                                                          │  │
│  │                                                              │  │
│  │  + 4 more methods (events, caseStudies, campaigns, metrics) │  │
│  └──────────────────────────────────────────────────────────────┘  │
│                              ↓                                      │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │ app/Models/ (Eloquent ORM)                                   │  │
│  │ ├─ Technology                                                │  │
│  │ ├─ Event                                                     │  │
│  │ ├─ CaseStudy                                                 │  │
│  │ ├─ AdvocacyCampaign                                          │  │
│  │ ├─ EnvironmentalMetric                                       │  │
│  │ ├─ SeaLevelProjection                                        │  │
│  │ ├─ Policy                                                    │  │
│  │ ├─ ResearchPaper                                             │  │
│  │ ├─ ImpactComparison                                          │  │
│  │ └─ CompetitionEntry                                          │  │
│  └──────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────┘
                              ↓ SQL Queries
┌─────────────────────────────────────────────────────────────────────┐
│                     PostgreSQL Database (Railway)                    │
│                                                                     │
│  Core Tables (10):                                                  │
│  ├─ technologies          (2 records)                               │
│  ├─ events                (2 records)                               │
│  ├─ case_studies          (1 record)                                │
│  ├─ advocacy_campaigns    (1 record)                                │
│  ├─ environmental_metrics (5 records)                               │
│  ├─ sea_level_projections (1 record)                                │
│  ├─ policies              (1 record)                                │
│  ├─ research_papers       (0 records)                               │
│  ├─ impact_comparisons    (0 records)                               │
│  └─ competition_entries   (0 records)                               │
│                                                                     │
│  System Tables (9):                                                 │
│  ├─ users                 (1 admin record)                          │
│  ├─ cache                 (temporary data)                          │
│  └─ ... (Laravel system tables)                                     │
└─────────────────────────────────────────────────────────────────────┘
                              ↓ Data
┌─────────────────────────────────────────────────────────────────────┐
│            Laravel Application (continued - View Layer)             │
│                                                                     │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │ resources/views/public/ (Blade Templates)                    │  │
│  │ ├─ technologies.blade.php                                    │  │
│  │ ├─ events.blade.php                                          │  │
│  │ ├─ case-studies.blade.php                                    │  │
│  │ ├─ campaigns.blade.php                                       │  │
│  │ └─ metrics.blade.php                                         │  │
│  │                                                              │  │
│  │ All views include:                                           │  │
│  │ ├─ Responsive HTML structure                                │  │
│  │ ├─ Tailwind CSS classes for styling                         │  │
│  │ ├─ @forelse loops to display data                           │  │
│  │ ├─ Empty state handling                                     │  │
│  │ └─ Navigation bar (links to all pages)                      │  │
│  └──────────────────────────────────────────────────────────────┘  │
│                              ↓ HTML + CSS                           │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │ Tailwind CSS (Version 4.0.7)                                 │  │
│  │ ├─ Grid layouts (responsive)                                 │  │
│  │ ├─ Card components (rounded, shadow)                         │  │
│  │ ├─ Progress bars (gradients)                                 │  │
│  │ ├─ Badges and status indicators                              │  │
│  │ ├─ Expandable details sections                               │  │
│  │ └─ Navigation styling                                        │  │
│  └──────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────┘
                              ↓ HTTP Response
┌─────────────────────────────────────────────────────────────────────┐
│                     Rendered HTML Page                              │
│                  (Displayed in User's Browser)                      │
└─────────────────────────────────────────────────────────────────────┘
```

---

## Data Flow Diagram (Example: Technologies Page)

```
User visits: http://localhost:8000/technologies
                    ↓
         routes/web.php matches route
                    ↓
    GET /technologies → PublicController@technologies()
                    ↓
         Controller method executes:
    $technologies = Technology::all()
                    ↓
         SQL Query: SELECT * FROM technologies
                    ↓
         PostgreSQL returns data:
         ┌──────────────────────────────┐
         │ id | name  | cost_per_kwh   │
         ├──────────────────────────────┤
         │ 1  | VRFB  | 300.00         │
         │ 2  | Li-ion| 150.00         │
         └──────────────────────────────┘
                    ↓
    Controller passes to view:
    return view('public.technologies', compact('technologies'));
                    ↓
    Blade view renders:
    @forelse($technologies as $technology)
        <div class="card">
            <h2>{{ $technology->name }}</h2>
            <p>€{{ $technology->cost_per_kwh }}/kWh</p>
        </div>
    @endforelse
                    ↓
         Tailwind CSS applies styling
                    ↓
    HTML returned to browser:
    <div class="card">
        <h2>VRFB</h2>
        <p>€300.00/kWh</p>
    </div>
                    ↓
    Browser renders beautiful page ✅
```

---

## Directory Structure

```
transparency_dot_ie/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PublicController.php          ← 5 methods for public pages
│   │
│   └── Models/                               ← 10 Eloquent models
│       ├── Technology.php
│       ├── Event.php
│       ├── CaseStudy.php
│       ├── AdvocacyCampaign.php
│       ├── EnvironmentalMetric.php
│       ├── SeaLevelProjection.php
│       ├── Policy.php
│       ├── ResearchPaper.php
│       ├── ImpactComparison.php
│       └── CompetitionEntry.php
│
├── database/
│   ├── migrations/                           ← 10 new table migrations
│   │   └── 2026_01_01_*.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── IrishEnvironmentalDataSeeder.php
│
├── resources/
│   └── views/
│       ├── welcome.blade.php                 ← Home page (custom)
│       │
│       └── public/                           ← 5 public page templates
│           ├── technologies.blade.php
│           ├── events.blade.php
│           ├── case-studies.blade.php
│           ├── campaigns.blade.php
│           └── metrics.blade.php
│
├── routes/
│   └── web.php                               ← 6 public routes
│
├── public/
│   ├── css/                                  ← Compiled Tailwind
│   └── js/                                   ← Compiled JavaScript
│
├── storage/
│   └── logs/
│       └── laravel.log                       ← Application logs
│
├── vendor/                                   ← Dependencies (composer)
│
├── node_modules/                             ← Dependencies (npm)
│
├── .env                                      ← Configuration
├── composer.json                             ← PHP dependencies
├── package.json                              ← Node dependencies
├── vite.config.js                            ← Build configuration
│
└── DOCUMENTATION FILES:
    ├── PHASE_6_COMPLETION.md                 ← Detailed completion report
    ├── SESSION_6_SUMMARY.md                  ← Session overview
    ├── REFERENCE.md                          ← Quick reference guide
    ├── ALIAS_GUIDE.md                        ← CLI commands
    ├── QUICK_START.md                        ← Getting started
    └── README.md                             ← Project overview
```

---

## Model Relationships

```
Technology
  ├─ has many ImpactComparisons
  └─ metadata: name, cost_per_kwh, lifespan_years, efficiency_percent

Event
  ├─ has many CompetitionEntries
  └─ metadata: title, start_date, end_date, location, max_participants

CaseStudy
  ├─ has many ImpactMetrics
  └─ metadata: title, investment, jobs_created, co2_reduced

AdvocacyCampaign
  └─ metadata: title, petition_count, target_signatures

EnvironmentalMetric
  └─ metadata: metric_name, value, unit, region, reference_year

SeaLevelProjection
  └─ metadata: region, year_2030, year_2050, year_2100

Policy
  └─ metadata: title, implementation_year, affected_sectors

ResearchPaper
  └─ metadata: title, authors, publication_year, url

ImpactComparison
  ├─ belongs to Technology
  └─ metadata: scenario, emissions_avoided

CompetitionEntry
  ├─ belongs to Event
  └─ metadata: title, participant, submission_date
```

---

## Request-Response Cycle

```
STEP 1: User Action
├─ User clicks "Technologies" link
└─ Browser sends: GET /technologies HTTP/1.1

STEP 2: Routing
├─ Laravel receives request
├─ routes/web.php matches pattern
└─ Routes to: PublicController@technologies()

STEP 3: Controller Action
├─ PublicController::technologies() executes
├─ Queries database: Technology::all()
└─ Receives 2 Technology models

STEP 4: View Rendering
├─ Passes data to Blade view
├─ View loops through technologies with @forelse
├─ Renders HTML with Tailwind classes
└─ Applies CSS from compiled Tailwind CSS

STEP 5: Response
├─ Laravel sends HTTP/1.1 200 OK
├─ Sets Content-Type: text/html
├─ Sends complete HTML page
└─ Browser receives response

STEP 6: Browser Rendering
├─ Browser parses HTML
├─ Loads CSS and applies styling
├─ Loads and executes JavaScript (if any)
└─ Displays beautiful page to user ✅
```

---

## Database Schema Summary

```sql
-- Technologies Table
CREATE TABLE technologies (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255),
    category VARCHAR(255),
    cost_per_kwh DECIMAL(8,2),
    lifespan_years INTEGER,
    efficiency_percent INTEGER,
    description TEXT,
    advantages JSON,
    disadvantages JSON,
    irish_applications TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Events Table
CREATE TABLE events (
    id BIGINT PRIMARY KEY,
    slug VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    start_date DATE,
    end_date DATE,
    location VARCHAR(255),
    max_participants INTEGER,
    registration_url VARCHAR(255),
    recording_url VARCHAR(255),
    status VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Case Studies Table
CREATE TABLE case_studies (
    id BIGINT PRIMARY KEY,
    slug VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    location VARCHAR(255),
    investment DECIMAL(15,2),
    jobs_created INTEGER,
    co2_reduced DECIMAL(12,2),
    capacity_mw DECIMAL(8,2),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Advocacy Campaigns Table
CREATE TABLE advocacy_campaigns (
    id BIGINT PRIMARY KEY,
    slug VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    petition_count INTEGER,
    target_signatures INTEGER,
    status VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Environmental Metrics Table
CREATE TABLE environmental_metrics (
    id BIGINT PRIMARY KEY,
    slug VARCHAR(255),
    metric_name VARCHAR(255),
    value DECIMAL(15,2),
    unit VARCHAR(100),
    region VARCHAR(255),
    reference_year INTEGER,
    data_source VARCHAR(255),
    is_featured BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Similar for: sea_level_projections, policies, research_papers, etc.
```

---

## Page Component Tree

```
welcome.blade.php
├─ <header>
│  ├─ Logo "Transparency.ie"
│  └─ Navigation menu
├─ <main>
│  ├─ <h1>Transparency.ie</h1>
│  ├─ 4-Pillar Overview
│  │  ├─ Transparency Engine
│  │  ├─ Environmental Atlas
│  │  ├─ Just Transition Forum
│  │  └─ Innovation Spotlight
│  └─ Links to pages
└─ <footer>

technologies.blade.php
├─ Navigation bar
├─ Page header "Technologies"
├─ Grid container
│  ├─ Technology card (VRFB)
│  │  ├─ Title
│  │  ├─ Category
│  │  ├─ Cost/kWh
│  │  ├─ Lifespan
│  │  ├─ Efficiency
│  │  └─ [Expand for details]
│  │
│  └─ Technology card (Li-ion)
│     └─ [Same structure]
│
└─ Footer

events.blade.php
├─ Navigation bar
├─ Page header "Events"
├─ Grid container
│  ├─ Event card
│  │  ├─ Title
│  │  ├─ Date range
│  │  ├─ Location
│  │  ├─ Capacity
│  │  ├─ Status badge
│  │  ├─ Registration link
│  │  └─ Recording link
│  │
│  └─ More event cards
│
└─ Footer

case-studies.blade.php
├─ Navigation bar
├─ Page header "Case Studies"
├─ Grid container
│  ├─ Case study card
│  │  ├─ Title
│  │  ├─ Short description
│  │  ├─ Metrics grid
│  │  │  ├─ Investment
│  │  │  ├─ Jobs created
│  │  │  ├─ CO2 reduced
│  │  │  └─ Capacity
│  │  └─ [Expand for full details]
│  │
│  └─ More case study cards
│
└─ Footer

campaigns.blade.php
├─ Navigation bar
├─ Page header "Campaigns"
├─ Grid container
│  ├─ Campaign card
│  │  ├─ Title
│  │  ├─ Description
│  │  ├─ Progress bar
│  │  │  └─ Percentage (12,450/25,000)
│  │  ├─ Status badge
│  │  └─ [Sign petition →]
│  │
│  └─ More campaign cards
│
└─ Footer

metrics.blade.php
├─ Navigation bar
├─ Page header "Environmental Metrics"
├─ Grid container
│  ├─ Metric card
│  │  ├─ Metric name
│  │  ├─ Value
│  │  ├─ Unit
│  │  ├─ Region
│  │  ├─ Reference year
│  │  └─ Data source
│  │
│  └─ More metric cards
│
└─ Footer
```

---

## Technology Stack Diagram

```
┌─────────────────────────────────────┐
│      Client Side (Browser)          │
│                                     │
│  HTML + Tailwind CSS + JavaScript   │
└─────────────────────────────────────┘
           ↓ HTTP ↑
┌─────────────────────────────────────┐
│   Server Side (PHP via Laravel)     │
│                                     │
│  ├─ PHP 8.3.6                       │
│  ├─ Laravel 12.44.0                 │
│  ├─ Eloquent ORM                    │
│  ├─ Blade Templating                │
│  └─ Tailwind CSS 4.0.7 (compiled)   │
└─────────────────────────────────────┘
           ↓ SQL ↑
┌─────────────────────────────────────┐
│   Database (PostgreSQL on Railway)  │
│                                     │
│  ├─ 19 tables total                 │
│  ├─ 10 content tables (new)         │
│  ├─ 9 system tables (Laravel)       │
│  └─ ~70 seeded records              │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│   Cache (Redis on Railway)          │
│                                     │
│  ├─ Session storage                 │
│  ├─ Cache data                      │
│  └─ Queue jobs (future)             │
└─────────────────────────────────────┘
```

---

## Development Workflow

```
Developer's Computer
│
├─ Terminal 1: serve
│  └─ Starts PHP development server on http://localhost:8000
│
├─ Terminal 2: dev
│  └─ Watches for CSS/JS changes, compiles with Vite
│
├─ Editor (VS Code)
│  └─ Edit Blade files, models, controllers, routes
│
└─ Browser
   ├─ Visit http://localhost:8000/technologies
   ├─ See rendered page
   ├─ Refresh to see changes (auto-compiled CSS)
   └─ Open DevTools (F12) for debugging

All requests go to Railway PostgreSQL & Redis
(not local database)
```

---

## Deployment Pipeline (Future)

```
Local Development
       ↓ git push
GitHub Repository
       ↓ Connected to Railway
Railway Platform
       ├─ Runs docker build (from Dockerfile)
       ├─ Deploys PHP application
       ├─ PostgreSQL database (managed)
       └─ Redis cache (managed)
       ↓
https://transparency-ie.railway.app
       ↓
Users access from anywhere
```

---

## Summary

This architecture provides:
✅ Clean separation of concerns (MVC)
✅ Scalable database design
✅ Responsive user interface
✅ Fast data retrieval (Eloquent + PostgreSQL)
✅ Reliable session/cache (Redis)
✅ Easy to extend with new pages/models
✅ Production-ready on Railway

