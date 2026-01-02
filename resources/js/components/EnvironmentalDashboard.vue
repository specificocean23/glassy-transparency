<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Header -->
      <div class="mb-12">
        <div class="flex items-center gap-4 mb-4">
          <div class="p-3 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
            </svg>
          </div>
          <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
            Environmental Transparency Dashboard
          </h1>
        </div>
        <p class="text-slate-400 text-lg">Real-time environmental data, policies, and climate impact metrics for Ireland</p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div v-for="i in 8" :key="i" class="h-32 bg-slate-800 rounded-xl animate-pulse"></div>
      </div>

      <!-- Stats Grid -->
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Card: Technologies -->
        <div class="group relative bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-blue-500/50 transition-all duration-300">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-cyan-500/0 group-hover:from-blue-500/10 group-hover:to-cyan-500/10 rounded-xl transition-all duration-300"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-slate-300 font-semibold">Clean Technologies</h3>
              <div class="p-2 bg-blue-500/20 rounded-lg">
                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M8.16 5.314l4.897-4.897a1 1 0 011.415 0l4.894 4.897a1 1 0 01-1.415 1.415L13 3.828V9.5a1 1 0 11-2 0V3.828l-3.793 3.793a1 1 0 01-1.415-1.415zM11.5 13a1 1 0 011 1v5.672l3.793-3.793a1 1 0 111.415 1.415l-4.897 4.897a1 1 0 01-1.415 0l-4.894-4.897a1 1 0 111.415-1.415L10 20.172V14a1 1 0 011-1z"></path>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ stats.technologies?.total || 0 }}</p>
            <p class="text-slate-400 text-sm mt-2">Active renewable technologies</p>
          </div>
        </div>

        <!-- Card: Case Studies -->
        <div class="group relative bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-green-500/50 transition-all duration-300">
          <div class="absolute inset-0 bg-gradient-to-br from-green-500/0 to-emerald-500/0 group-hover:from-green-500/10 group-hover:to-emerald-500/10 rounded-xl transition-all duration-300"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-slate-300 font-semibold">Case Studies</h3>
              <div class="p-2 bg-green-500/20 rounded-lg">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.172 3.172a2 2 0 012.828 0l4.243 4.243V1.586l4.243 4.243a2 2 0 010 2.828l-4.243 4.243h10.246l-4.243-4.243a2 2 0 010-2.828l-4.243-4.243a2 2 0 00-2.828 0L3.172 3.172z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ stats.case_studies?.total || 0 }}</p>
            <p class="text-slate-400 text-sm mt-2">Documented implementations</p>
          </div>
        </div>

        <!-- Card: Policies -->
        <div class="group relative bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-purple-500/50 transition-all duration-300">
          <div class="absolute inset-0 bg-gradient-to-br from-purple-500/0 to-pink-500/0 group-hover:from-purple-500/10 group-hover:to-pink-500/10 rounded-xl transition-all duration-300"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-slate-300 font-semibold">Policies</h3>
              <div class="p-2 bg-purple-500/20 rounded-lg">
                <svg class="w-5 h-5 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ stats.policies?.total || 0 }}</p>
            <p class="text-slate-400 text-sm mt-2">Active regulations</p>
          </div>
        </div>

        <!-- Card: Research Papers -->
        <div class="group relative bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-orange-500/50 transition-all duration-300">
          <div class="absolute inset-0 bg-gradient-to-br from-orange-500/0 to-red-500/0 group-hover:from-orange-500/10 group-hover:to-red-500/10 rounded-xl transition-all duration-300"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-slate-300 font-semibold">Research Papers</h3>
              <div class="p-2 bg-orange-500/20 rounded-lg">
                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H3a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1V7a1 1 0 00-1-1h-1a1 1 0 000 2v10H4V5z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ stats.research_papers?.total || 0 }}</p>
            <p class="text-slate-400 text-sm mt-2">Published studies</p>
          </div>
        </div>
      </div>

      <!-- Impact Metrics -->
      <div v-if="impact" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="group relative bg-gradient-to-br from-green-900/30 to-emerald-900/30 backdrop-blur-xl rounded-xl p-8 border border-green-500/30 hover:border-green-400/50 transition-all duration-300">
          <div class="flex items-start justify-between mb-4">
            <div>
              <p class="text-green-400 text-sm font-semibold mb-2">TOTAL JOBS CREATED</p>
              <p class="text-4xl font-bold text-white">{{ formatNumber(impact.total_jobs_created) }}</p>
            </div>
            <div class="p-3 bg-green-500/20 rounded-lg">
              <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
              </svg>
            </div>
          </div>
          <p class="text-green-400/70 text-sm">Across all case studies</p>
        </div>

        <div class="group relative bg-gradient-to-br from-blue-900/30 to-cyan-900/30 backdrop-blur-xl rounded-xl p-8 border border-blue-500/30 hover:border-blue-400/50 transition-all duration-300">
          <div class="flex items-start justify-between mb-4">
            <div>
              <p class="text-blue-400 text-sm font-semibold mb-2">TOTAL INVESTMENT</p>
              <p class="text-4xl font-bold text-white">€{{ formatNumber(impact.total_investment) }}</p>
            </div>
            <div class="p-3 bg-blue-500/20 rounded-lg">
              <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.16 5.314l4.897-4.897a1 1 0 011.415 0l4.894 4.897a1 1 0 01-1.415 1.415L13 3.828V9.5a1 1 0 11-2 0V3.828l-3.793 3.793a1 1 0 01-1.415-1.415zM11.5 13a1 1 0 011 1v5.672l3.793-3.793a1 1 0 111.415 1.415l-4.897 4.897a1 1 0 01-1.415 0l-4.894-4.897a1 1 0 111.415-1.415L10 20.172V14a1 1 0 011-1z"></path>
              </svg>
            </div>
          </div>
          <p class="text-blue-400/70 text-sm">Mobilized capital</p>
        </div>

        <div class="group relative bg-gradient-to-br from-orange-900/30 to-red-900/30 backdrop-blur-xl rounded-xl p-8 border border-orange-500/30 hover:border-orange-400/50 transition-all duration-300">
          <div class="flex items-start justify-between mb-4">
            <div>
              <p class="text-orange-400 text-sm font-semibold mb-2">CO₂ REDUCTION</p>
              <p class="text-4xl font-bold text-white">{{ formatNumber(impact.total_co2_reduced) }}</p>
            </div>
            <div class="p-3 bg-orange-500/20 rounded-lg">
              <svg class="w-6 h-6 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a1 1 0 001 1h12a1 1 0 001-1V6a2 2 0 00-2-2H4zm12 12H4v2a2 2 0 002 2h8a2 2 0 002-2v-2z" clip-rule="evenodd"></path>
              </svg>
            </div>
          </div>
          <p class="text-orange-400/70 text-sm">Tons prevented annually</p>
        </div>
      </div>

      <!-- Data Tables Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Technologies Table -->
        <div v-if="stats.technologies?.list" class="bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-slate-600/50 transition-all duration-300">
          <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
            <span class="p-2 bg-blue-500/20 rounded-lg">
              <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.16 5.314l4.897-4.897a1 1 0 011.415 0l4.894 4.897a1 1 0 01-1.415 1.415L13 3.828V9.5a1 1 0 11-2 0V3.828l-3.793 3.793a1 1 0 01-1.415-1.415z"></path>
              </svg>
            </span>
            Leading Technologies
          </h2>
          <div class="space-y-3">
            <div v-for="tech in stats.technologies.list" :key="tech.id" class="p-4 bg-slate-700/30 rounded-lg border border-slate-600/30 hover:border-blue-500/30 transition-all">
              <div class="flex justify-between items-start mb-2">
                <h3 class="font-semibold text-white">{{ tech.name }}</h3>
                <span class="text-xs px-2 py-1 bg-blue-500/20 text-blue-300 rounded-full">{{ tech.category }}</span>
              </div>
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <p class="text-slate-400">Efficiency</p>
                  <p class="text-green-400 font-semibold">{{ tech.efficiency_percent || 'N/A' }}%</p>
                </div>
                <div>
                  <p class="text-slate-400">Cost/kWh</p>
                  <p class="text-blue-400 font-semibold">€{{ tech.cost_per_kwh || 'N/A' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Events Table -->
        <div v-if="stats.events?.list" class="bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-slate-600/50 transition-all duration-300">
          <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
            <span class="p-2 bg-purple-500/20 rounded-lg">
              <svg class="w-5 h-5 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M6 2a1 1 0 000 2h8a1 1 0 100-2H6zM4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"></path>
              </svg>
            </span>
            Recent Events
          </h2>
          <div class="space-y-3">
            <div v-for="event in stats.events.list" :key="event.id" class="p-4 bg-slate-700/30 rounded-lg border border-slate-600/30 hover:border-purple-500/30 transition-all">
              <h3 class="font-semibold text-white mb-2">{{ event.title }}</h3>
              <div class="flex items-center justify-between text-sm">
                <span class="text-slate-400">{{ formatDate(event.datetime) }}</span>
                <span class="px-2 py-1 bg-purple-500/20 text-purple-300 rounded text-xs">{{ event.event_type }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sea Level Projections -->
      <div v-if="stats.sea_level_projections?.list" class="mt-8 bg-slate-800/50 backdrop-blur-xl rounded-xl p-6 border border-slate-700/50 hover:border-slate-600/50 transition-all duration-300">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
          <span class="p-2 bg-red-500/20 rounded-lg">
            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.4 14.4l8.8-8.8a1 1 0 011.4 0l8.8 8.8a1 1 0 11-1.4 1.4L13 8.4v9.6a1 1 0 11-2 0V8.4l-7.8 7.8a1 1 0 01-1.4-1.4z" clip-rule="evenodd"></path>
            </svg>
          </span>
          Climate Projections for Ireland
        </h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-600/50">
                <th class="text-left py-3 px-4 text-slate-400 font-semibold">Region</th>
                <th class="text-left py-3 px-4 text-slate-400 font-semibold">Year</th>
                <th class="text-left py-3 px-4 text-slate-400 font-semibold">Projected Rise</th>
                <th class="text-left py-3 px-4 text-slate-400 font-semibold">Confidence</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="proj in stats.sea_level_projections.list" :key="proj.id" class="border-b border-slate-700/30 hover:bg-slate-700/20 transition-all">
                <td class="py-3 px-4 text-white font-medium">{{ proj.region }}</td>
                <td class="py-3 px-4 text-slate-300">{{ proj.year }}</td>
                <td class="py-3 px-4"><span class="text-red-400 font-semibold">{{ proj.projected_rise_mm }}mm</span></td>
                <td class="py-3 px-4"><span class="px-2 py-1 bg-slate-700 text-slate-300 rounded text-xs">{{ proj.confidence_level }}</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
.animation-delay-4000 {
  animation-delay: 4s;
}
</style>

<script>
export default {
  name: 'EnvironmentalDashboard',
  data() {
    return {
      stats: {},
      impact: null,
      loading: true,
    };
  },
  mounted() {
    this.fetchDashboardData();
  },
  methods: {
    async fetchDashboardData() {
      try {
        const [statsRes, impactRes] = await Promise.all([
          fetch('/api/v1/environmental/stats'),
          fetch('/api/v1/environmental/impact'),
        ]);

        const statsData = await statsRes.json();
        const impactData = await impactRes.json();

        if (statsData.data) this.stats = statsData.data;
        if (impactData.data) this.impact = impactData.data;
      } catch (error) {
        console.error('Error fetching dashboard data:', error);
      } finally {
        this.loading = false;
      }
    },
    formatNumber(num) {
      if (!num) return '0';
      return new Intl.NumberFormat('en-IE', {
        notation: num > 1000000 ? 'compact' : 'standard',
        maximumFractionDigits: 1,
      }).format(num);
    },
    formatDate(date) {
      if (!date) return 'N/A';
      return new Intl.DateTimeFormat('en-IE', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
      }).format(new Date(date));
    },
  },
};
</script>
