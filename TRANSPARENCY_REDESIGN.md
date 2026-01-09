# 🚀 Transparency.ie - Complete Redesign

## Overview

A comprehensive redesign of the transparency platform focused on exposing government spending with unprecedented clarity. The system now includes powerful data import capabilities, timeline tracking, and detailed spending analysis.

---

## 🎯 Key Features

### 1. **New Homepage** (`/`)
- **Hero Section** with real-time spending statistics
- **4-Year Rolling Budget Charts** showing allocated vs. spent vs. predicted amounts
- **Category Breakdown Pie Chart** for current year spending
- **Questionable Spending Highlights** with public interest scoring
- **Major Events Timeline** with featured and controversial items
- **Revenue Stream Tracking** for government income

### 2. **Excel Data Import System** (`/admin/import`)
- Import four types of data from Excel files:
  - **Budgets**: Annual allocations, spending, and predictions
  - **Spending Items**: Individual transactions and purchases
  - **Revenue Streams**: Government income sources
  - **Timeline Events**: Major spending/income milestones

- **Features**:
  - Downloadable Excel templates with sample data
  - Drag-and-drop upload interface
  - Automatic data parsing and validation
  - Support for .xlsx, .xls, and .csv files
  - Error reporting with line numbers

### 3. **Timeline System** (`/timeline`)
- Chronological view of all major events
- Filter by: All, Expenses, Income, Controversial, Featured
- Visual timeline with interactive cards
- Event categorization and impact levels
- Direct links to source documentation

### 4. **Spending Explorer** (`/spending/explorer`)
- Comprehensive spending item browser
- Real-time search and filtering
- Sort by: Date, Amount, Public Interest
- Filter by category and questionable status
- Public interest scoring (0-100)
- Detailed metadata including vendor, location, justification

---

## 📊 Database Schema

### New Tables

#### `budgets`
```
- year (integer)
- category (string)
- department (string)
- allocated_amount (decimal)
- spent_amount (decimal)
- predicted_amount (decimal)
- status (string: active, completed, overbudget)
- source (string)
- notes (text)
```

#### `timeline_events`
```
- event_date (date)
- title (string)
- description (text)
- event_type (string: income, expense, policy, scandal)
- amount (decimal)
- category (string)
- department (string)
- source_url (string)
- impact_level (string: low, medium, high, critical)
- is_featured (boolean)
- is_controversial (boolean)
- tags (json)
```

#### `spending_items`
```
- date (date)
- title (string)
- description (text)
- amount (decimal)
- category (string)
- department (string)
- vendor (string)
- location (string)
- procurement_method (string)
- status (string)
- justification (text)
- is_questionable (boolean)
- public_interest_score (integer 0-100)
```

#### `revenue_streams`
```
- date (date)
- title (string)
- description (text)
- amount (decimal)
- source_type (string: tax, fine, settlement, grant, investment)
- source_name (string)
- category (string)
- is_recurring (boolean)
- frequency (string: one-time, monthly, quarterly, annual)
```

---

## 🔧 Setup Instructions

### 1. Run Migrations

```bash
php artisan migrate
```

This will create the four new tables: `budgets`, `timeline_events`, `spending_items`, and `revenue_streams`.

### 2. Seed Sample Data

```bash
php artisan db:seed --class=TransparencyDataSeeder
```

This creates:
- 28 budget records (4 years × 7 categories)
- 6 major timeline events (including bike racks, Google/Apple tax settlements)
- 4 questionable spending items
- 2 major revenue streams

### 3. Install PhpSpreadsheet (if not already installed)

```bash
composer require phpoffice/phpspreadsheet
```

This is required for Excel import/export functionality.

---

## 📥 Using the Import System

### Step 1: Access Import Page
Navigate to `/admin/import`

### Step 2: Download Template
Click on any of the four template buttons:
- 💰 Budget Template
- 💸 Spending Template
- 💵 Revenue Template
- 📅 Timeline Template

### Step 3: Fill in Data
Open the downloaded Excel file and:
- Keep the header row unchanged
- Follow the sample row format
- Use consistent date formats (YYYY-MM-DD recommended)
- Format amounts as numbers (€ and commas will be stripped automatically)

### Step 4: Upload
- Select the data type matching your file
- Drag and drop or click to browse
- Click "Import Data"
- Wait for confirmation

---

## 📋 Excel Template Formats

### Budget Template
| Year | Category | Department | Allocated Amount | Spent Amount | Predicted Amount | Status | Source | Notes |
|------|----------|------------|------------------|--------------|------------------|--------|--------|-------|
| 2026 | Health   | HSE        | 25000000         | 15000000     | 24500000         | active | Budget 2026 | Main allocation |

### Spending Template
| Date       | Title              | Description        | Amount | Category        | Department | Vendor    | Location | Status    | Questionable | Interest Score |
|------------|--------------------|--------------------|--------|-----------------|------------|-----------|----------|-----------|--------------|----------------|
| 2025-01-01 | Bike Racks Dublin  | Two bike racks     | 140000 | Infrastructure  | Transport  | ABC Ltd   | Dublin   | completed | yes          | 95             |

### Revenue Template
| Date       | Title              | Description        | Amount   | Source Type | Source Name | Category      | Recurring | Frequency |
|------------|--------------------|--------------------|----------|-------------|-------------|---------------|-----------|-----------|
| 2024-06-15 | Google Settlement  | Back taxes         | 15000000 | settlement  | Google      | Corporate Tax | no        | one-time  |

### Timeline Template
| Date       | Title              | Description        | Event Type | Amount | Category        | Department | Impact Level | Featured | Controversial |
|------------|--------------------|--------------------|------------|--------|-----------------|------------|--------------|----------|---------------|
| 2025-12-01 | Bike Rack Issue    | Excessive spending | expense    | 140000 | Infrastructure  | Transport  | high         | yes      | yes           |

---

## 🎨 Design Philosophy

### Transparency First
- **Red/Orange color scheme** signifies urgency and importance
- **Large, bold numbers** make spending immediately visible
- **Flagging system** highlights questionable items
- **Public interest scoring** quantifies concern level

### User Experience
- **Responsive design** works on all devices
- **Interactive charts** using Chart.js
- **Real-time filtering** for instant results
- **Intuitive navigation** between related data

---

## 🚀 New Routes

```php
// Homepage (redesigned)
GET /

// Timeline pages
GET /timeline

// Spending explorer
GET /spending/explorer

// Admin import system
GET /admin/import
POST /admin/import/upload
GET /admin/import/template/{type}
```

---

## 📈 Sample Data Included

The seeder includes real examples based on actual Irish government events:

**Major Events:**
- €140,000 Dublin bike racks (2025)
- €15M Google tax settlement (2024)
- €13.1B Apple tax windfall (2024)
- €200M Children's Hospital overrun (2025)
- €50M COVID fraud (2025)
- RTÉ expenses scandal (2025)

**Categories Tracked:**
- Health, Education, Infrastructure
- Social Welfare, Justice, Defence
- Environment, Transport, Media

---

## 💡 Pro Tips

### For Data Entry:
1. **Dates**: Use Excel date format or YYYY-MM-DD text
2. **Amounts**: Plain numbers work best (100000 not €100,000)
3. **Booleans**: Use "yes", "true", "1" for true values
4. **Optional fields**: Leave blank if no data available

### For Analysis:
1. **Public Interest Score**: 70+ is considered high interest
2. **Questionable Flag**: Manually set for suspicious items
3. **Impact Level**: Use "high" or "critical" for major events
4. **Categories**: Keep consistent for better filtering

### For Performance:
1. Import in batches of <1000 rows for best performance
2. Use templates to ensure correct format
3. Validate data before importing
4. Check error messages for failed rows

---

## 🔐 Security Notes

- Import functionality should be protected by authentication
- Add middleware to `/admin/*` routes in production
- Validate all uploaded files
- Sanitize data to prevent XSS
- Use CSRF protection (already included)

---

## 🎯 Future Enhancements

Suggested additions:
- [ ] API endpoints for programmatic data access
- [ ] Comparison tools (year-over-year, department-to-department)
- [ ] Export functionality (PDF reports, CSV extracts)
- [ ] Email alerts for new questionable items
- [ ] Public voting/commenting system
- [ ] Advanced analytics dashboard
- [ ] Real-time notifications for imports
- [ ] Bulk edit functionality
- [ ] Data validation rules customization
- [ ] Integration with official government APIs

---

## 📞 Support

For questions or issues:
1. Check the import instructions on `/admin/import`
2. Review sample data in the templates
3. Examine seeder file for data structure examples
4. Check Laravel logs for detailed error messages

---

## 🎉 Success Metrics

The new system tracks:
- ✅ Total spending across all items
- ✅ Number of questionable items flagged
- ✅ Budget utilization percentages
- ✅ Timeline event count and categorization
- ✅ Revenue vs. Expense comparisons
- ✅ Department-level breakdowns
- ✅ Year-over-year trends

---

**Built with transparency in mind. Making government spending so transparent, they wish it wasn't.** 🔥
