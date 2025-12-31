# Transparency.ie - Frontend Implementation Guide

## Vue.js 3 Dashboard Setup

### Project Structure

```
resources/
├── js/
│   ├── app.js                          # Main entry point
│   ├── App.vue                         # Root component
│   ├── layouts/
│   │   ├── MainLayout.vue              # Main layout wrapper
│   │   └── AdminLayout.vue             # Admin layout (if needed)
│   ├── pages/
│   │   ├── Home.vue                    # Landing page
│   │   ├── Dashboard.vue               # Main dashboard
│   │   ├── Departments.vue             # Departments list
│   │   ├── Department.vue              # Department detail
│   │   ├── Spending.vue                # Spending records
│   │   ├── Initiatives.vue             # Initiatives list
│   │   ├── Initiative.vue              # Initiative detail
│   │   ├── GreenEnergy.vue             # Green energy metrics
│   │   ├── Homelessness.vue            # Homelessness tracking
│   │   ├── Report.vue                  # Transparency report
│   │   └── NotFound.vue                # 404 page
│   ├── components/
│   │   ├── common/
│   │   │   ├── Header.vue
│   │   │   ├── Footer.vue
│   │   │   ├── Sidebar.vue
│   │   │   ├── Pagination.vue
│   │   │   └── Loading.vue
│   │   ├── dashboard/
│   │   │   ├── StatsCard.vue
│   │   │   ├── StatsSummary.vue
│   │   │   ├── BudgetChart.vue
│   │   │   ├── SpendingChart.vue
│   │   │   ├── MonthlyTrend.vue
│   │   │   └── CategoryBreakdown.vue
│   │   ├── departments/
│   │   │   ├── DepartmentCard.vue
│   │   │   ├── DepartmentTable.vue
│   │   │   └── BudgetProgress.vue
│   │   ├── spending/
│   │   │   ├── SpendingList.vue
│   │   │   ├── SpendingTable.vue
│   │   │   ├── SpendingFilter.vue
│   │   │   └── CategorySelect.vue
│   │   ├── initiatives/
│   │   │   ├── InitiativeCard.vue
│   │   │   ├── InitiativeList.vue
│   │   │   ├── InitiativeMetrics.vue
│   │   │   └── InitiativeStatus.vue
│   │   ├── impact/
│   │   │   ├── GreenEnergyWidget.vue
│   │   │   ├── HomelessnessWidget.vue
│   │   │   ├── EmploymentStats.vue
│   │   │   └── ImpactMetrics.vue
│   │   └── charts/
│   │       ├── BarChart.vue
│   │       ├── LineChart.vue
│   │       ├── DoughnutChart.vue
│   │       ├── PieChart.vue
│   │       └── AreaChart.vue
│   ├── composables/
│   │   ├── useApi.js                   # API calls
│   │   ├── useDashboard.js             # Dashboard logic
│   │   ├── useSpending.js              # Spending filters
│   │   ├── useInitiatives.js           # Initiative logic
│   │   └── useFormatting.js            # Format utilities
│   ├── stores/
│   │   ├── dashboard.js                # Dashboard state (Pinia)
│   │   ├── spending.js                 # Spending state
│   │   ├── departments.js              # Department state
│   │   ├── initiatives.js              # Initiative state
│   │   └── user.js                     # User/auth state
│   ├── router/
│   │   └── index.js                    # Route definitions
│   ├── utils/
│   │   ├── api.js                      # Axios instance
│   │   ├── formatters.js               # Format numbers, dates
│   │   ├── validators.js               # Validation rules
│   │   └── constants.js                # App constants
│   └── css/
│       ├── app.css                     # Main styles
│       ├── tailwind.css                # Tailwind imports
│       └── animations.css              # Custom animations
├── views/
└── layouts/
```

### Dependencies to Install

```bash
npm install vue@3 vue-router@4 pinia axios chart.js vue-chartjs
npm install -D @vitejs/plugin-vue tailwindcss postcss autoprefixer
npm install date-fns numeral lodash
```

### Router Configuration (resources/js/router/index.js)

```javascript
import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Dashboard from '../pages/Dashboard.vue'
import Departments from '../pages/Departments.vue'
import Department from '../pages/Department.vue'
import Spending from '../pages/Spending.vue'
import Initiatives from '../pages/Initiatives.vue'
import Initiative from '../pages/Initiative.vue'
import GreenEnergy from '../pages/GreenEnergy.vue'
import Homelessness from '../pages/Homelessness.vue'
import Report from '../pages/Report.vue'
import NotFound from '../pages/NotFound.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/departments',
    name: 'Departments',
    component: Departments
  },
  {
    path: '/departments/:id',
    name: 'Department',
    component: Department
  },
  {
    path: '/spending',
    name: 'Spending',
    component: Spending
  },
  {
    path: '/initiatives',
    name: 'Initiatives',
    component: Initiatives
  },
  {
    path: '/initiatives/:id',
    name: 'Initiative',
    component: Initiative
  },
  {
    path: '/green-energy',
    name: 'GreenEnergy',
    component: GreenEnergy
  },
  {
    path: '/homelessness',
    name: 'Homelessness',
    component: Homelessness
  },
  {
    path: '/report',
    name: 'Report',
    component: Report
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound
  }
]

export default createRouter({
  history: createWebHistory(),
  routes
})
```

### API Composable (resources/js/composables/useApi.js)

```javascript
import { ref } from 'vue'
import api from '../utils/api'

export function useApi() {
  const loading = ref(false)
  const error = ref(null)

  const fetchDashboardStats = async () => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/dashboard/stats')
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  const fetchDepartments = async (page = 1) => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/departments', { params: { page } })
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  const fetchSpendings = async (filters = {}) => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/spendings', { params: filters })
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  const fetchInitiatives = async (filters = {}) => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/initiatives', { params: filters })
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  const fetchGreenEnergyMetrics = async () => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/dashboard/green-energy')
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  const fetchHomelessnessMetrics = async () => {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/dashboard/homelessness')
      return response.data
    } catch (e) {
      error.value = e.message
      throw e
    } finally {
      loading.value = false
    }
  }

  return {
    loading,
    error,
    fetchDashboardStats,
    fetchDepartments,
    fetchSpendings,
    fetchInitiatives,
    fetchGreenEnergyMetrics,
    fetchHomelessnessMetrics
  }
}
```

### Example Component (resources/js/pages/Dashboard.vue)

```vue
<template>
  <MainLayout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-4xl font-bold mb-8">Council Spending Dashboard</h1>
      
      <div v-if="loading" class="flex justify-center">
        <Loading />
      </div>

      <div v-else-if="error" class="bg-red-100 p-4 rounded mb-4">
        {{ error }}
      </div>

      <div v-else>
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
          <StatsCard
            title="Total Budget"
            :value="`€${formatCurrency(stats.summary.total_allocated_budget)}`"
            icon="budget"
          />
          <StatsCard
            title="Total Spent"
            :value="`€${formatCurrency(stats.summary.total_spent)}`"
            icon="spending"
          />
          <StatsCard
            title="Remaining"
            :value="`€${formatCurrency(stats.summary.remaining_budget)}`"
            icon="remaining"
          />
          <StatsCard
            title="Budget Used"
            :value="`${stats.summary.budget_utilization_percentage}%`"
            icon="percentage"
          />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
          <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Spending by Department</h2>
            <SpendingChart :data="stats" />
          </div>

          <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Monthly Trend</h2>
            <MonthlyTrend />
          </div>
        </div>

        <!-- Impact Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
          <GreenEnergyWidget />
          <HomelessnessWidget />
          <EmploymentStats />
        </div>

        <!-- Recent Initiatives -->
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">Active Initiatives</h2>
          <InitiativeList />
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useApi } from '../composables/useApi'
import { formatCurrency } from '../utils/formatters'
import MainLayout from '../layouts/MainLayout.vue'
import Loading from '../components/common/Loading.vue'
import StatsCard from '../components/dashboard/StatsCard.vue'
import SpendingChart from '../components/dashboard/SpendingChart.vue'
import MonthlyTrend from '../components/dashboard/MonthlyTrend.vue'
import GreenEnergyWidget from '../components/impact/GreenEnergyWidget.vue'
import HomelessnessWidget from '../components/impact/HomelessnessWidget.vue'
import EmploymentStats from '../components/impact/EmploymentStats.vue'
import InitiativeList from '../components/initiatives/InitiativeList.vue'

const { loading, error, fetchDashboardStats } = useApi()
const stats = ref(null)

onMounted(async () => {
  try {
    stats.value = await fetchDashboardStats()
  } catch (e) {
    console.error('Failed to load dashboard:', e)
  }
})
</script>
```

### Tailwind CSS Configuration

```javascript
// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.{vue,js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#3B82F6',
        secondary: '#10B981',
        danger: '#EF4444',
        success: '#10B981',
        warning: '#F59E0B',
        info: '#3B82F6',
      },
      fontFamily: {
        sans: ['Inter var', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
```

---

## Key Frontend Features to Implement

### 1. Real-time Dashboard
- Live budget utilization
- Spending trends
- Department comparisons
- Interactive charts

### 2. Advanced Filtering
- Filter by date range
- Filter by category
- Filter by department
- Search functionality

### 3. Data Visualization
- Bar charts for comparisons
- Line charts for trends
- Pie charts for breakdowns
- Progress bars for budgets

### 4. Data Export
- Export to PDF
- Export to CSV
- Export to Excel
- Print functionality

### 5. Responsive Design
- Mobile-first approach
- Tablet optimization
- Desktop experience
- Dark mode (future)

---

## Build & Deploy Frontend

```bash
# Development
npm run dev

# Production build
npm run build

# Preview production build
npm run preview

# Lint
npm run lint

# Format code
npm run format
```

---

## Performance Optimization

### Code Splitting
```javascript
const Dashboard = () => import('../pages/Dashboard.vue')
const Departments = () => import('../pages/Departments.vue')
```

### Lazy Loading Images
```vue
<img v-lazy="imageUrl" alt="description" />
```

### API Caching
```javascript
const cache = new Map()
const getCachedData = async (url, ttl = 5 * 60 * 1000) => {
  if (cache.has(url)) return cache.get(url).data
  const data = await api.get(url)
  cache.set(url, { data, timestamp: Date.now() })
  return data
}
```

---

## Testing

```bash
# Install test dependencies
npm install -D vitest @testing-library/vue @testing-library/user-event

# Run tests
npm run test

# Test coverage
npm run test:coverage
```

---

## Accessibility (A11y)

- Use semantic HTML
- Add ARIA labels
- Ensure keyboard navigation
- Maintain color contrast
- Add alt text for images

---

## SEO Optimization

- Meta tags for pages
- Schema markup
- Sitemap generation
- Robots.txt configuration
- Open Graph tags

---

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

---

## Common Component Usage Examples

### Using Charts
```vue
<SpendingChart :departments="departments" />
```

### Using Filters
```vue
<SpendingFilter @filter="handleFilter" />
```

### Using Pagination
```vue
<Pagination 
  :current="page" 
  :total="totalPages" 
  @change="changePage"
/>
```

---

## Next Steps

1. Create component library
2. Set up routing
3. Implement API calls
4. Build dashboard pages
5. Add charts and visualizations
6. Implement filtering
7. Add export functionality
8. Optimize performance
9. Test and debug
10. Deploy to production

---

## Support

For frontend development questions, refer to:
- Vue 3 Documentation: https://vuejs.org/
- Vite Documentation: https://vitejs.dev/
- Tailwind CSS: https://tailwindcss.com/
- Chart.js: https://www.chartjs.org/
