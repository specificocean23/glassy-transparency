<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
    </div>

    <div class="relative z-10">
      <!-- Header -->
      <header class="sticky top-0 z-50 border-b border-slate-800/50 bg-slate-950/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-white">City Council Transparency</h1>
              <p class="text-slate-400 text-sm mt-1">Real-time spending & impact dashboard</p>
            </div>
            <div class="flex items-center gap-4">
              <div class="hidden sm:block">
                <p class="text-slate-400 text-sm">Last Updated: <span class="text-emerald-400 font-mono">{{ lastUpdated }}</span></p>
              </div>
              <button @click="refreshData" :disabled="isLoading" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 disabled:opacity-50 text-white rounded-lg transition-colors font-medium text-sm">
                {{ isLoading ? 'Refreshing...' : 'Refresh' }}
              </button>
            </div>
          </div>
        </div>
      </header>

      <!-- Main Content -->
      <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <!-- Error State -->
        <div v-if="error" class="bg-red-500/10 border border-red-500/20 rounded-lg p-4 text-red-200">
          {{ error }}
        </div>

        <!-- Loading State -->
        <div v-if="isLoading && !stats" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div v-for="i in 4" :key="i" class="h-32 bg-slate-800/50 rounded-xl animate-pulse"></div>
          </div>
        </div>

        <!-- Stats Grid -->
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <StatCard 
            v-for="stat in stats" 
            :key="stat.label"
            :label="stat.label"
            :value="stat.value"
            :icon="stat.icon"
            :color="stat.color"
            :description="stat.description"
          />
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <GlassCard class="p-6" title="Monthly Spending Trend">
            <div class="h-80">
              <canvas ref="monthlyChart"></canvas>
            </div>
          </GlassCard>

          <GlassCard class="p-6" title="Spending by Category">
            <div class="h-80">
              <canvas ref="categoryChart"></canvas>
            </div>
          </GlassCard>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <GlassCard class="p-6" title="Green Energy Impact">
            <div class="h-80">
              <canvas ref="greenChart"></canvas>
            </div>
          </GlassCard>

          <GlassCard class="p-6" title="Homelessness Support">
            <div class="h-80">
              <canvas ref="homelessnessChart"></canvas>
            </div>
          </GlassCard>
        </div>

        <!-- Department Breakdown -->
        <GlassCard class="p-6" title="Department Breakdown">
          <div class="h-80">
            <canvas ref="departmentChart"></canvas>
          </div>
        </GlassCard>

        <!-- Initiatives Table -->
        <GlassCard class="p-6" title="Active Initiatives">
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="border-b border-slate-700">
                <tr class="text-slate-400 font-medium">
                  <th class="text-left py-3 px-4">Initiative</th>
                  <th class="text-left py-3 px-4">Department</th>
                  <th class="text-left py-3 px-4">Budget</th>
                  <th class="text-left py-3 px-4">Status</th>
                  <th class="text-left py-3 px-4">Workers</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-700/50">
                <tr v-for="init in initiatives" :key="init.id" class="hover:bg-slate-800/50 transition-colors">
                  <td class="py-3 px-4 text-white font-medium">{{ init.name }}</td>
                  <td class="py-3 px-4 text-slate-400">{{ init.department_id }}</td>
                  <td class="py-3 px-4 text-emerald-400">€{{ (init.budget_allocated / 1000).toFixed(1) }}k</td>
                  <td class="py-3 px-4">
                    <span :class="getStatusClass(init.status)">{{ init.status }}</span>
                  </td>
                  <td class="py-3 px-4 text-slate-300">{{ init.irish_workers_employed }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </GlassCard>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import Chart from 'chart.js/auto';
import StatCard from './StatCard.vue';
import GlassCard from './GlassCard.vue';

const stats = ref(null);
const initiatives = ref([]);
const isLoading = ref(false);
const error = ref('');
const lastUpdated = ref(new Date().toLocaleTimeString());

const monthlyChart = ref(null);
const categoryChart = ref(null);
const greenChart = ref(null);
const homelessnessChart = ref(null);
const departmentChart = ref(null);

let charts = {};

const API_BASE = 'http://localhost:8000/api/v1';

const getStatusClass = (status) => {
  const classes = {
    'planning': 'px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-medium',
    'active': 'px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-medium',
    'completed': 'px-3 py-1 bg-slate-500/20 text-slate-300 rounded-full text-xs font-medium',
  };
  return classes[status] || classes['planning'];
};

const fetchDashboardData = async () => {
  isLoading.value = true;
  error.value = '';
  
  try {
    const [statsRes, monthlyRes, categoryRes, greenRes, homelessRes, deptRes, initiativesRes] = await Promise.all([
      fetch(`${API_BASE}/dashboard/stats`),
      fetch(`${API_BASE}/dashboard/monthly-spending`),
      fetch(`${API_BASE}/dashboard/spending-by-category`),
      fetch(`${API_BASE}/dashboard/green-energy`),
      fetch(`${API_BASE}/dashboard/homelessness`),
      fetch(`${API_BASE}/dashboard/spending-by-department`),
      fetch(`${API_BASE}/initiatives`),
    ]);

    if (!statsRes.ok) throw new Error('Failed to fetch stats');

    const statsData = await statsRes.json();
    const monthlyData = await monthlyRes.json();
    const categoryData = await categoryRes.json();
    const greenData = await greenRes.json();
    const homelessData = await homelessRes.json();
    const deptData = await deptRes.json();
    const initiativesData = await initiativesRes.json();

    // Process stats
    stats.value = [
      {
        label: 'Total Budget',
        value: `€${(statsData.total_budget / 1000000).toFixed(1)}M`,
        icon: '💰',
        color: 'from-blue-600 to-blue-400',
        description: 'Annual budget allocation'
      },
      {
        label: 'Total Spent',
        value: `€${(statsData.total_spent / 1000000).toFixed(1)}M`,
        icon: '📊',
        color: 'from-emerald-600 to-emerald-400',
        description: 'Year-to-date spending'
      },
      {
        label: 'Green Energy %',
        value: `${statsData.green_energy_percentage.toFixed(1)}%`,
        icon: '🌱',
        color: 'from-green-600 to-green-400',
        description: 'Green initiatives'
      },
      {
        label: 'People Supported',
        value: statsData.homelessness_count,
        icon: '🏠',
        color: 'from-purple-600 to-purple-400',
        description: 'Homelessness initiatives'
      }
    ];

    initiatives.value = initiativesData.data || [];

    lastUpdated.value = new Date().toLocaleTimeString();

    // Setup charts
    setTimeout(() => {
      setupCharts(monthlyData, categoryData, greenData, homelessData, deptData);
    }, 100);

  } catch (err) {
    error.value = `Error loading dashboard: ${err.message}. Make sure the backend is running on port 8000.`;
    console.error(err);
  } finally {
    isLoading.value = false;
  }
};

const setupCharts = (monthlyData, categoryData, greenData, homelessData, deptData) => {
  // Clear existing charts
  Object.values(charts).forEach(chart => {
    if (chart) chart.destroy();
  });
  charts = {};

  const chartConfig = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: { color: '#cbd5e1', font: { size: 11 } }
      }
    },
    scales: {
      x: { ticks: { color: '#94a3b8' }, grid: { color: '#1e293b' } },
      y: { ticks: { color: '#94a3b8' }, grid: { color: '#1e293b' } }
    }
  };

  // Monthly Chart
  if (monthlyChart.value) {
    charts.monthly = new Chart(monthlyChart.value, {
      type: 'line',
      data: {
        labels: monthlyData.data?.map(d => d.month) || [],
        datasets: [{
          label: 'Spending',
          data: monthlyData.data?.map(d => d.amount / 1000) || [],
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: { ...chartConfig, plugins: { ...chartConfig.plugins, legend: { display: false } } }
    });
  }

  // Category Chart
  if (categoryChart.value) {
    charts.category = new Chart(categoryChart.value, {
      type: 'doughnut',
      data: {
        labels: categoryData.data?.map(d => d.category) || [],
        datasets: [{
          data: categoryData.data?.map(d => d.amount / 1000) || [],
          backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899']
        }]
      },
      options: chartConfig
    });
  }

  // Green Energy Chart
  if (greenChart.value) {
    charts.green = new Chart(greenChart.value, {
      type: 'bar',
      data: {
        labels: ['Green Energy', 'Fossil Fuels'],
        datasets: [{
          label: 'Spending (€1000s)',
          data: [greenData.green_spending / 1000, greenData.fossil_spending / 1000],
          backgroundColor: ['#10b981', '#ef4444']
        }]
      },
      options: chartConfig
    });
  }

  // Homelessness Chart
  if (homelessnessChart.value) {
    charts.homelessness = new Chart(homelessnessChart.value, {
      type: 'bar',
      data: {
        labels: ['Allocated', 'Spent'],
        datasets: [{
          label: 'Budget (€1000s)',
          data: [homelessData.allocated / 1000, homelessData.spent / 1000],
          backgroundColor: ['#06b6d4', '#6366f1']
        }]
      },
      options: chartConfig
    });
  }

  // Department Chart
  if (departmentChart.value) {
    charts.department = new Chart(departmentChart.value, {
      type: 'bar',
      data: {
        labels: deptData.data?.map(d => d.name) || [],
        datasets: [{
          label: 'Spending (€1000s)',
          data: deptData.data?.map(d => d.spending / 1000) || [],
          backgroundColor: '#3b82f6'
        }]
      },
      options: chartConfig
    });
  }
};

const refreshData = () => {
  fetchDashboardData();
};

onMounted(() => {
  fetchDashboardData();
});
</script>

<style scoped>
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(15, 23, 42, 0.5);
}

::-webkit-scrollbar-thumb {
  background: rgba(71, 85, 105, 0.5);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(100, 116, 139, 0.7);
}
</style>
