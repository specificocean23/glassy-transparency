<template>
  <div class="glass-card">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-white font-semibold text-lg">{{ title }}</h3>
      <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
    </div>
    <slot></slot>
  </div>
</template>

<script setup>
defineProps({
  title: String,
});
</script>

<style scoped>
.glass-card {
  backdrop-filter: blur(20px);
  background: rgba(30, 41, 59, 0.4);
  border: 1px solid rgba(71, 85, 105, 0.3);
  padding: 1.5rem;
  border-radius: 1rem;
  transition: all 0.3s ease;
}

.glass-card:hover {
  background: rgba(30, 41, 59, 0.6);
  border-color: rgba(71, 85, 105, 0.5);
}
</style>
