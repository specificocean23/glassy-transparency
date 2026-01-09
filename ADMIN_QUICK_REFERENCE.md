# Quick Reference: Adding Transparency Data

## 🚀 Quick Start for Admins

### Access the Admin Panel
1. Go to `http://your-domain/admin`
2. Login with your admin credentials
3. Look for **"Transparency"** section in the left sidebar

---

## 📊 Adding Financial Data (3 Easy Steps)

### Step 1: Navigate to Spending Records
- Click **Transparency** → **Spending Records**
- Click **New Spending Record** button

### Step 2: Fill the Form
| Field | Example | Notes |
|-------|---------|-------|
| **County** | Waterford | Choose from dropdown |
| **Financial Category** | Wind Energy Projects | Choose category |
| **Year** | 2027 | Enter the year |
| **Amount** | 25000000 | Enter in euros (25M = 25000000) |
| **Notes** (optional) | Offshore wind farm development | Add context |

### Step 3: Save
- Click **Create** button
- Data appears on dashboard immediately! ✨

---

## 💡 Common Amount Values

| Display | Amount to Enter |
|---------|----------------|
| €1 Million | 1000000 |
| €10 Million | 10000000 |
| €50 Million | 50000000 |
| €100 Million | 100000000 |
| €1 Billion | 1000000000 |
| €3 Billion | 3000000000 |

---

## 🗺️ Adding a New County

1. Go to **Transparency** → **Counties**
2. Click **New County**
3. Fill in:
   - **Name**: County name (e.g., "Galway")
   - **Slug**: Auto-generated (e.g., "galway")
   - **Federal Level**: Leave OFF (only for "All (Federal)")
   - **Sort Order**: Number (lower = appears first)

---

## 💰 Adding a New Spending Category

1. Go to **Transparency** → **Financial Categories**
2. Click **New Financial Category**
3. Fill in:
   - **Name**: e.g., "Electric Vehicle Charging Stations"
   - **Slug**: Auto-generated
   - **Description**: Brief explanation
   - **Icon**: Add an emoji (e.g., 🔌 ⚡ 🚗)
   - **Chart Color**: Pick a color from the color picker
   - **Classification Toggles**:
     - ✅ **Good for Environment** if eco-friendly
     - ✅ **Bad for Environment** if harmful
     - ✅ **New Housing** if building new homes
     - ✅ **Current Housing** if maintaining existing
   - **Sort Order**: Display order (1, 2, 3...)

---

## 📚 Linking Case Studies to Counties

1. Go to **Case Studies** (in main menu)
2. Edit existing or create new
3. Find the **County** dropdown
4. Select county (or leave empty for federal/all)
5. Save

Now the case study appears when users select that county on `/transparency`!

---

## 🎯 Tips for Great Data Entry

### For Accurate Dashboards
- ✅ Use consistent year formatting (2024, 2025, 2026)
- ✅ Double-check amounts (it's in euros, not millions)
- ✅ Add notes for context
- ✅ Keep categories consistent

### For Better User Experience
- 🎨 Use distinct colors for categories
- 🎭 Choose appropriate emoji icons
- 📊 Add data for multiple years for comparison
- 🗺️ Complete data for at least federal + major counties

### For Highlighting Issues
- Want to show "No new housing in 10 years"?
  - Create records with amount: **0** for New Housing category
  - Legend will show €0.0M, making the issue visible

---

## 🔍 Finding Data

### View All Spending Records
- **Transparency** → **Spending Records**
- Use filters at top:
  - Filter by Year
  - Filter by County
  - Filter by Category
- Search by any field
- Sort by columns
- See **Total** at bottom

### Quick Checks
- **By Year**: Filter to 2026 to see current budget
- **By County**: Filter to Waterford to see county-specific spending
- **By Category**: Filter to "Wind Energy" to see all green investments

---

## 🎨 Customizing Colors

Good color choices for categories:
- 🔴 Red (#ef4444): Fossil fuels, negative environmental
- 🟢 Green (#10b981, #22c55e): Renewable energy, positive environmental
- 🔵 Blue (#3b82f6): Law enforcement, water
- 🟡 Yellow (#eab308): Solar energy
- 🟠 Orange (#f59e0b): Housing
- ⚫ Gray (#64748b): Infrastructure, roads
- 🟣 Purple (#8b5cf6): Transport

---

## ⚡ Pro Tips

1. **Bulk Import**: For lots of data, consider creating a CSV import (future feature)
2. **Backup**: Download spending records table before major changes
3. **Testing**: Use Sort Order to control what appears first
4. **Consistency**: Use the same category names across all years
5. **Validation**: The system prevents duplicate entries (same category + county + year)

---

## 📱 View Your Work

After adding data:
1. Visit `/transparency` on your site
2. Select the county you added data for
3. Choose the year
4. Watch your data appear in the beautiful pie chart! 🎉

---

## 🆘 Troubleshooting

**Data not appearing?**
- Check you selected the right county/year combination
- Verify the amount is greater than 0
- Ensure the category exists and is active

**Chart looks wrong?**
- Check category colors aren't too similar
- Verify amounts are in euros (not millions)
- Try refreshing the page (Ctrl+F5)

**Can't find dropdown option?**
- Make sure county/category is created first
- Check sort order (might be at bottom of list)

---

Need help? Check `TRANSPARENCY_DASHBOARD_GUIDE.md` for full technical details!
