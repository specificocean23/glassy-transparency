# 🚀 Quick Start Guide - Transparency.ie Redesign

## 3-Minute Setup

```bash
# 1. Install dependencies
composer require phpoffice/phpspreadsheet

# 2. Run migrations
php artisan migrate

# 3. Seed sample data
php artisan db:seed --class=TransparencyDataSeeder

# 4. Start server
php artisan serve
```

## 📍 Important Pages

| Page | URL | Purpose |
|------|-----|---------|
| **Homepage** | `/` | New transparency-focused design with charts |
| **Import Data** | `/admin/import` | Upload Excel files with spending data |
| **Timeline** | `/timeline` | View all major events chronologically |
| **Spending Explorer** | `/spending/explorer` | Browse and search all spending items |
| **Dashboard** | `/transparency` | Original transparency dashboard |

## 📥 Import Data in 3 Steps

1. **Download template** from `/admin/import`
2. **Fill in your data** (keep headers unchanged)
3. **Upload** and select data type

## 📊 Data Types You Can Import

| Type | What It Tracks | Example |
|------|----------------|---------|
| **Budgets** | Annual allocations & spending | €25M allocated to Health in 2026 |
| **Spending Items** | Individual transactions | €140k for two bike racks in Dublin |
| **Revenue** | Government income | €15M Google tax settlement |
| **Timeline Events** | Major milestones | Children's Hospital €200M overrun |

## 🎯 Key Features

### Homepage
- 4-year rolling budget chart (actual vs predicted)
- Category breakdown pie chart
- Questionable spending highlights
- Major events timeline
- Revenue tracking

### Import System
- Drag-and-drop Excel upload
- Pre-formatted templates
- Automatic data parsing
- Error reporting

### Timeline
- Chronological event view
- Filter by type (expense/income)
- Controversial/featured flags
- Impact level indicators

### Spending Explorer
- Search all items
- Filter by category
- Sort by amount/date/interest
- Public interest scoring

## 📝 Sample Data Included

Real Irish government examples:
- ✅ €140k Dublin bike racks
- ✅ €13.1B Apple tax windfall
- ✅ €15M Google settlement
- ✅ €200M hospital overrun
- ✅ €50M COVID fraud
- ✅ RTÉ expenses scandal

## 🎨 Design Colors

- **Red** (#dc2626): Alerts, questionable items
- **Orange** (#f97316): Warnings, featured
- **Green** (#16a34a): Revenue, positive
- **Gray** (#f8fafc): Background

## 🔧 Files Created

### Controllers
- `DataImportController.php` - Excel import logic

### Views
- `welcome-transparency.blade.php` - New homepage
- `admin/import.blade.php` - Import interface
- `timeline/index.blade.php` - Timeline view
- `spending/explorer.blade.php` - Spending browser

### Models
- `Budget.php` - Annual budgets
- `TimelineEvent.php` - Major events
- `SpendingItem.php` - Individual transactions
- `RevenueStream.php` - Income sources

### Migrations
- `create_budgets_table`
- `create_timeline_events_table`
- `create_spending_items_table`
- `create_revenue_streams_table`

## 💡 Pro Tips

### Data Entry
- Use YYYY-MM-DD for dates
- Plain numbers for amounts (no € or commas needed)
- "yes"/"true"/"1" for boolean fields
- Leave optional fields blank

### For Best Results
- Mark questionable items with high interest scores (70+)
- Use consistent categories
- Add detailed descriptions
- Include source URLs when available
- Set impact levels appropriately (high/critical for major items)

## 🚨 Common Issues

**Migration Error?**
```bash
php artisan migrate:fresh
php artisan db:seed --class=TransparencyDataSeeder
```

**Import Not Working?**
- Check PhpSpreadsheet is installed
- Verify file format (.xlsx, .xls, .csv)
- Ensure headers match template exactly

**Charts Not Showing?**
- Check browser console for errors
- Ensure Chart.js CDN is loading
- Verify data exists in database

## 📚 Documentation

- **Full Details**: `TRANSPARENCY_REDESIGN.md`
- **Complete Summary**: `COMPLETE_REDESIGN_SUMMARY.md`
- **This Guide**: `QUICK_START_TRANSPARENCY.md`

## 🎯 What You Get

✅ Transparency-focused homepage  
✅ 4-year budget visualization  
✅ Excel import system  
✅ Timeline tracking  
✅ Spending explorer  
✅ Sample data  
✅ Complete documentation  

## 🚀 Go Live Checklist

- [ ] Run migrations
- [ ] Seed or import data
- [ ] Test all pages
- [ ] Add authentication to /admin routes
- [ ] Configure production database
- [ ] Set up backups
- [ ] Test Excel imports
- [ ] Review sample data
- [ ] Customize branding
- [ ] Deploy!

---

**That's it! You're ready to expose government spending with radical transparency.** 🔥

Need more details? Check `TRANSPARENCY_REDESIGN.md`
