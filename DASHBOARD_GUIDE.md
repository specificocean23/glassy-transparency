# Vue.js Dashboard Guide

Your transparency dashboard is built with Vue 3, featuring a glassy, high-tech aesthetic optimized for both mobile and desktop viewing.

## Dashboard Architecture

### Components

**DashboardApp.vue** - Main container
- Animated gradient background
- Sticky header with refresh functionality
- Responsive grid layouts
- Error and loading states

**StatCard.vue** - Summary statistics
- Four key metrics displayed
- Color-coded (blue, emerald, green, purple)
- Emoji icons for visual appeal
- Hover effects with glassmorphism

**GlassCard.vue** - Data visualization containers
- Frosted glass effect with backdrop blur
- Semi-transparent background
- Smooth hover transitions
- Responsive height

### Features

✨ **Visual Design**
- Dark theme (slate-950 background)
- Glassmorphism with blur effects
- Gradient accents
- Smooth animations and transitions
- Responsive breakpoints (sm, md, lg)

📊 **Data Visualizations**
- Line chart: Monthly spending trends
- Doughnut chart: Spending by category
- Bar charts: Green energy vs. fossil fuels
- Bar chart: Homelessness support
- Bar chart: Department spending breakdown

📱 **Responsive Design**
- Mobile-first approach
- Tablet-optimized grids
- Desktop multi-column layouts
- Touch-friendly buttons

## Getting Started

### 1. View the Dashboard

```bash
# Terminal 1: Backend (already running on 8000)
php artisan serve

# Terminal 2: Frontend (already running on 5173)
npm run dev
```

Visit: http://localhost:5173

### 2. Dashboard Features

**Header**
- Project title
- Last updated timestamp
- Manual refresh button
- Loading indicators

**Statistics Cards (4 metrics)**
- Total Budget
- Total Spent
- Green Energy %
- People Supported (homelessness)

**Charts**
1. Monthly Spending - Line chart showing trends
2. Spending by Category - Doughnut chart breakdown
3. Green Energy Impact - Bar chart comparison
4. Homelessness Support - Budget allocation
5. Department Breakdown - All departments spending

**Initiatives Table**
- Sortable columns
- Initiative name
- Department
- Budget amount
- Status badge (planning/active/completed)
- Irish workers employed

## API Integration

Dashboard fetches from these endpoints:

```
GET /api/v1/dashboard/stats
GET /api/v1/dashboard/monthly-spending
GET /api/v1/dashboard/spending-by-category
GET /api/v1/dashboard/green-energy
GET /api/v1/dashboard/homelessness
GET /api/v1/dashboard/spending-by-department
GET /api/v1/initiatives
```

All endpoints return JSON and are **publicly accessible** (no authentication required).

## Customizing the Dashboard

### Change Colors

Edit `DashboardApp.vue` - StatCard colors:

```vue
<!-- Find this section -->
stats.value = [
  {
    label: 'Total Budget',
    color: 'from-blue-600 to-blue-400',  // Change these
    // ...
  }
];
```

Tailwind color options:
- `from-blue-600 to-blue-400`
- `from-emerald-600 to-emerald-400`
- `from-green-600 to-green-400`
- `from-purple-600 to-purple-400`
- `from-pink-600 to-pink-400`
- `from-indigo-600 to-indigo-400`

### Change Chart Types

In `DashboardApp.vue`:

```javascript
// Line chart example
new Chart(monthlyChart.value, {
  type: 'line',  // 'bar', 'doughnut', 'pie', 'radar'
  data: { ... },
  options: { ... }
});
```

Chart.js types:
- `line` - Trend visualization
- `bar` - Comparison
- `doughnut` - Pie charts
- `pie` - Percentages
- `radar` - Multi-axis comparison
- `bubble` - Correlation data

### Add New Statistics

In `DashboardApp.vue` setup section:

```javascript
// Add to stats.value array
{
  label: 'New Metric',
  value: '123',
  icon: '📈',
  color: 'from-cyan-600 to-cyan-400',
  description: 'Your description'
}
```

### Modify Table Columns

In `DashboardApp.vue` template, adjust table headers/rows:

```vue
<th class="text-left py-3 px-4">New Column</th>
<td class="py-3 px-4">{{ init.new_field }}</td>
```

## Responsive Breakpoints

```css
/* Tailwind breakpoints used */
sm: 640px   /* Mobile landscape */
md: 768px   /* Tablet */
lg: 1024px  /* Desktop */
xl: 1280px  /* Large desktop */
2xl: 1536px /* Ultra-wide */
```

Example: `lg:grid-cols-2` = 2 columns on large screens

## Performance Optimization

### Data Loading

- Parallel API requests (Promise.all)
- Lazy chart initialization (setTimeout)
- Error handling with fallbacks
- Loading skeleton screens

### Frontend

- Tree-shaking with Vite
- Lazy component loading
- CSS purging with Tailwind
- Optimized image assets

### Caching

Add Redis caching to API:

```php
// In DashboardController
return cache()->remember('dashboard:stats', 3600, function () {
    return [...];
});
```

## Mobile Optimization

Dashboard is fully responsive:

**Mobile (< 768px)**
- Single column layouts
- Full-width charts
- Vertical scrolling
- Large touch targets
- Optimized font sizes

**Tablet (768px - 1024px)**
- Two column layouts
- 50/50 chart splits
- Balanced spacing

**Desktop (> 1024px)**
- Multi-column grids
- Side-by-side comparisons
- Full visual hierarchy

## Accessibility

- Semantic HTML structure
- ARIA labels on interactive elements
- Sufficient color contrast
- Keyboard navigation support
- Screen reader friendly

## Build & Deployment

### Development

```bash
npm run dev
# Hot module reload enabled
# Changes reflected instantly
```

### Production

```bash
npm run build
# Creates optimized dist/ folder
# Automatically deployed to Railway
```

### Configuration

File: `vite.config.js`

```javascript
export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue(),
  ],
});
```

## Troubleshooting

### Dashboard Not Loading

**Issue**: Blank page, no errors
**Solution**:
1. Check browser console (F12)
2. Verify backend running: `http://localhost:8000/api/v1/dashboard/stats`
3. Check API response format

### Charts Not Rendering

**Issue**: Chart containers empty
**Solution**:
1. Verify Chart.js installed: `npm list chart.js`
2. Check canvas element has ref: `ref="monthlyChart"`
3. Look for console errors

### Styling Broken

**Issue**: Missing Tailwind classes
**Solution**:
1. Rebuild CSS: `npm run dev`
2. Clear browser cache (Ctrl+Shift+Delete)
3. Check `resources/css/app.css` includes Tailwind

### API 404 Errors

**Issue**: "Cannot GET /api/v1/..."
**Solution**:
1. Verify routes: `php artisan route:list`
2. Check backend running on 8000
3. Verify endpoint exists in routes/api.php

## Browser Support

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile Safari (iOS 14+)
- Chrome Mobile

Uses ES6+ features (no IE11 support).

## Further Development

### Add Export to PDF

```bash
npm install jspdf html2canvas
```

```javascript
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';

const exportPDF = async () => {
  const canvas = await html2canvas(document.body);
  const pdf = new jsPDF();
  pdf.addImage(canvas, 'PNG', 0, 0);
  pdf.save('dashboard.pdf');
};
```

### Add Email Reports

Create email component that sends dashboard snapshots weekly:

```php
// In routes/api.php
Route::post('/dashboard/email-report', function () {
    Mail::send(new DashboardReport());
    return response()->json(['success' => true]);
});
```

### Add User Preferences

Save chart preferences to localStorage:

```javascript
const savePreferences = () => {
  localStorage.setItem('dashboard-prefs', JSON.stringify({
    chartType: 'bar',
    theme: 'dark',
    refreshInterval: 60
  }));
};
```

### Real-time Updates

Replace polling with WebSockets (Laravel Echo):

```bash
npm install laravel-echo pusher-js
```

```javascript
Echo.channel('dashboard')
  .listen('SpendingUpdated', (e) => {
    refreshData();
  });
```

## File Structure

```
resources/
├── js/
│   ├── app.js (entry point)
│   ├── bootstrap.js (axios config)
│   └── components/
│       ├── DashboardApp.vue (main)
│       ├── StatCard.vue
│       └── GlassCard.vue
├── css/
│   └── app.css (Tailwind)
└── views/
    └── dashboard.blade.php (HTML container)
```

## Resources

- Vue 3 Docs: https://vuejs.org
- Tailwind CSS: https://tailwindcss.com
- Chart.js: https://www.chartjs.org
- Vite: https://vitejs.dev
