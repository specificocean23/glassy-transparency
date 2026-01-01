# Irish Energy Futures Initiative - Site Expansion Plan

## 🎯 Vision
Transform transparency.ie from a spending transparency portal into a comprehensive advocacy and education platform combining:
- Government spending transparency
- Environmental impact education
- Clean energy advocacy (gas → renewables)
- Innovation spotlight (energy storage technologies)
- Public engagement (competitions, forums, debates)

---

## 🏗️ Architecture: Four Core Pillars

### Pillar 1: The Transparency Engine (Existing + Enhanced)
**Current State:** Departments, Budgets, Spending, Initiatives
**Enhancements Needed:**
- Tag spending by: fossil fuel subsidies, renewable investments, transport, buildings
- Add "Follow the Money" visualizations
- Track EU Recovery & Transition Fund allocations
- Add subsidy calculator ("How much did we pay for gas this year?")

### Pillar 2: The Environmental Impact Atlas (NEW)
**Purpose:** Make emissions and climate data tangible and local
**Content Types:**
- **Impact Metrics:** CO2 equivalents in Irish terms (football pitches flooded, trees needed)
- **Localised Maps:** Sea level rise projections, flooding risk, biodiversity loss
- **Sector Analysis:** Agriculture, transport, energy, buildings
- **Time Series:** Track Ireland's emissions trajectory vs. targets
- **Comparison Tools:** "Your county vs. national average"

### Pillar 3: The Just Transition Forum (NEW)
**Purpose:** Political advocacy and policy tracking
**Content Types:**
- **Case Studies:** Jobs created, energy security gains, cost savings from renewables
- **Policy Tracker:** Current energy policy, legislation status, EU targets
- **Cost Analysis:** Gas dependency costs vs. renewable pathway
- **Regional Impact:** Local benefits of wind/solar projects
- **Advocacy Campaigns:** Petitions, letter templates, calls to action

### Pillar 4: The Innovation Spotlight (NEW)
**Purpose:** Educate on Grid of the Future technologies
**Content Types:**
- **Technology Explainers:** VRFBs, Li-ion, hydrogen, grid integration
- **Research Hub:** Scientific papers, whitepapers, technical reports
- **Innovation Challenges:** Annual scientific competitions
- **Events:** Public debates, expert panels, livestreams
- **Company Directory:** Irish renewable & storage companies

---

## 📊 New Database Schema

### Environmental Content
```
environmental_metrics
- id
- title (e.g., "Cork Flooding Equivalence")
- metric_type (co2_equivalent, sea_level, biodiversity, etc.)
- value (numeric)
- unit (e.g., "football_pitches", "tonnes_co2")
- reference_year
- data_source
- description
- visual_representation (JSON for chart data)
- region (Ireland-wide, Cork, Dublin, etc.)
- timestamps

impact_comparisons
- id
- title ("Whitegate Power Station Annual Emissions")
- co2_tonnes
- equivalent_cars
- equivalent_trees_needed
- equivalent_area_flooded
- visual_metaphor (text description)
- data_sources
- timestamps

sea_level_projections
- id
- region
- year_2030 (cm)
- year_2050 (cm)
- year_2100 (cm)
- affected_area_km2
- population_at_risk
- economic_value_at_risk
- timestamps
```

### Policy & Advocacy Content
```
policies
- id
- title
- slug
- policy_type (legislation, target, strategy)
- status (proposed, active, abandoned)
- description
- introduced_date
- target_completion_date
- responsible_department_id
- eu_mandate (boolean)
- impact_assessment
- timestamps

case_studies
- id
- title
- slug
- category (jobs, energy_security, cost_savings)
- location
- summary
- full_content (rich text)
- jobs_created
- investment_amount
- co2_reduced
- energy_generated_mwh
- featured_image
- published_at
- timestamps

advocacy_campaigns
- id
- title
- slug
- goal
- description
- status (active, completed, archived)
- petition_count
- target_signatures
- call_to_action
- success_metrics
- start_date
- end_date
- timestamps
```

### Innovation & Events
```
technologies
- id
- name (VRFB, Li-ion Battery, etc.)
- category (storage, generation, grid)
- description
- technical_specs (JSON)
- advantages
- disadvantages
- irish_applications (text)
- cost_per_kwh
- lifespan_years
- efficiency_percent
- featured_image
- timestamps

research_papers
- id
- title
- authors
- publication_date
- journal_name
- abstract
- pdf_url
- doi
- keywords (JSON array)
- technology_id
- citations_count
- timestamps

events
- id
- title
- slug
- event_type (competition, debate, conference, webinar)
- description
- start_date
- end_date
- location (physical/virtual)
- registration_url
- recording_url
- max_participants
- status (upcoming, live, completed)
- featured_speakers (JSON)
- timestamps

competition_entries
- id
- competition_id (FK to events)
- team_name
- institution
- lead_researcher
- contact_email
- project_title
- abstract
- submission_url
- status (submitted, under_review, winner, finalist)
- score
- timestamps
```

---

## 🎨 Frontend Structure

### New Routes
```
/transparency (existing departments/budgets/spending)
/environmental-atlas
  /metrics
  /sea-level-rise
  /emissions-tracker
  /county/{county}
/just-transition
  /case-studies
  /policy-tracker
  /campaigns
  /take-action
/innovation
  /technologies
  /research
  /competitions
  /events
/about
/blog
```

### Key Interactive Features
1. **Budget Explorer:** Interactive sankey diagram showing money flows
2. **Emissions Calculator:** Personal/business carbon footprint
3. **Map Viewer:** Leaflet maps showing projections and projects
4. **Comparison Tool:** VRFB vs Li-ion side-by-side
5. **Timeline:** Policy and climate target progress
6. **News Feed:** Latest updates across all pillars

---

## 🚀 Implementation Phases

### Phase 1: Foundation (Week 1-2) ✅ DONE
- ✅ Basic spending transparency (existing)
- ✅ Railway PostgreSQL & Redis setup
- ✅ Filament admin panel
- ✅ Basic seeding

### Phase 2: Database Expansion (Week 3)
- [ ] Create all new migrations
- [ ] Build new models with relationships
- [ ] Create factories for testing
- [ ] Build comprehensive seeders with Irish data

### Phase 3: Admin CMS (Week 4)
- [ ] Filament resources for all new content types
- [ ] Rich text editors for case studies
- [ ] Media library integration
- [ ] Import tools for CSV/API data

### Phase 4: Environmental Atlas (Week 5-6)
- [ ] Metrics dashboard
- [ ] Chart.js/ApexCharts visualizations
- [ ] Map integration (Leaflet)
- [ ] County-specific pages
- [ ] API integration (EPA, SEAI data)

### Phase 5: Just Transition Forum (Week 7-8)
- [ ] Case study pages with templates
- [ ] Policy tracker with status updates
- [ ] Campaign management system
- [ ] Email integration for advocacy

### Phase 6: Innovation Spotlight (Week 9-10)
- [ ] Technology comparison pages
- [ ] Research repository
- [ ] Competition submission portal
- [ ] Event management & registration
- [ ] Video streaming integration

### Phase 7: Polish & Launch (Week 11-12)
- [ ] SEO optimization
- [ ] Performance tuning
- [ ] Content population
- [ ] Social media integration
- [ ] Analytics setup
- [ ] Public launch campaign

---

## 📈 Data Sources to Integrate

### Government/Official
- [ ] CSO (Central Statistics Office)
- [ ] EPA (Environmental Protection Agency)
- [ ] SEAI (Sustainable Energy Authority Ireland)
- [ ] Department of Environment, Climate and Communications
- [ ] EirGrid (grid data)
- [ ] Met Éireann (climate data)

### EU Sources
- [ ] EU Recovery and Resilience Facility tracker
- [ ] Eurostat emissions data
- [ ] Copernicus Climate Change Service

### Research
- [ ] Irish universities (TCD, UCD, UCC research)
- [ ] SFI (Science Foundation Ireland) funded projects
- [ ] ESRI (Economic & Social Research Institute)

---

## 🎓 Scientific Competition Structure

### "The Irish Grid Storage Challenge" - Annual Event

**Categories:**
1. **Undergraduate Research** (€2,000 prize)
2. **Postgraduate Research** (€5,000 prize)
3. **Industry Innovation** (€10,000 prize)

**Focus Areas:**
- VRFB optimization for Irish conditions
- Novel electrolyte chemistries
- Grid integration modeling
- Circular economy (vanadium from waste)
- Cost reduction strategies
- Hybrid storage systems

**Timeline:**
- **Jan:** Announcement & open submissions
- **Apr:** Submission deadline
- **May:** Expert review panel
- **Jun:** Public debate event + winner announcement
- **Jul:** Website publication of findings

**Partners to Approach:**
- Science Foundation Ireland (SFI)
- SEAI
- Irish Universities
- EirGrid
- VRFB companies (Invinity, Rongke, etc.)

---

## 🎤 Public Event Series

### "Energy Futures Ireland" - Quarterly Events

**Event 1: "Beyond Batteries: Storing Ireland's Renewable Future"**
- Panel: VRFB company, Li-ion integrator, EirGrid, economist, community energy
- Topics: Technology comparison, grid needs, policy gaps, costs
- Format: 2-hour debate + Q&A
- Livestream + archive

**Event 2: "The True Cost of Gas Dependency"**
- Financial analysis of continued gas investment
- Health impacts (air quality)
- Climate commitments vs. reality
- Case studies from other countries

**Event 3: "Just Transition: Who Benefits?"**
- Regional economic impacts
- Job creation in renewables
- Community ownership models
- Addressing concerns (e.g., wind farm aesthetics)

**Event 4: "The Science of Climate Action"**
- Latest IPCC findings for Ireland
- Sea level projections
- Agricultural adaptation
- Biodiversity protection

---

## 💻 Technical Implementation Notes

### Tech Stack Additions
- **Charts:** ApexCharts / Chart.js
- **Maps:** Leaflet.js with Irish OSM tiles
- **Videos:** Vimeo/YouTube API integration
- **Forms:** Filament + custom validation
- **Email:** Laravel Notifications for campaigns
- **Analytics:** Plausible (privacy-friendly)
- **Search:** Laravel Scout + Meilisearch

### Performance Considerations
- Cache environmental data (updates daily/weekly)
- CDN for media (Cloudflare/Bunny)
- Database indexing for searches
- Lazy loading for charts/maps
- API rate limiting for data imports

---

## 🎯 Success Metrics (6 months post-launch)

### Engagement
- [ ] 50,000+ unique visitors/month
- [ ] 500+ newsletter subscribers
- [ ] 10+ media mentions
- [ ] 5,000+ petition signatures

### Content
- [ ] 100+ spending records analyzed
- [ ] 50+ environmental metrics published
- [ ] 20+ case studies featured
- [ ] 10+ policies tracked

### Impact
- [ ] 3+ speaking invitations (conferences/podcasts)
- [ ] 2+ academic partnerships
- [ ] 1+ policy change influenced
- [ ] Competition launched with 20+ submissions

---

## 🚨 Critical Success Factors

1. **Data Accuracy:** All claims must be rigorously sourced
2. **Political Balance:** Advocate strongly but base everything on evidence
3. **Visual Excellence:** Complex data must be beautifully presented
4. **Mobile First:** Most users will be on phones
5. **SEO/Discoverability:** Rank for "Ireland energy transition", "climate action Ireland"
6. **Community Building:** Email list + social media presence
7. **Regular Updates:** Fresh content weekly (minimum)
8. **Partnerships:** Academic & NGO credibility crucial

---

## 🔜 Next Immediate Steps

1. ✅ **This document** - Planning complete
2. **Create migrations** - All new tables
3. **Build models** - With relationships and validation
4. **Seed data** - Irish-specific environmental & policy data
5. **Filament resources** - Admin CMS for all content
6. **Homepage redesign** - Showcase all four pillars
7. **Environmental Atlas MVP** - First pillar to launch

Let's build this! 🇮🇪⚡🌱
