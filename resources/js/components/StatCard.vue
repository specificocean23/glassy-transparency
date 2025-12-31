<template>
  <div :class="['glass-card', colorClasses]">
    <div class="flex items-center gap-3 mb-4">
      <span class="text-4xl">{{ icon }}</span>
      <div>
        <p class="text-slate-400 text-sm font-medium">{{ label }}</p>
        <p class="text-xs text-slate-500">{{ description }}</p>
      </div>
    </div>
    <div class="text-3xl font-bold text-white">{{ value }}</div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

defineProps({
  label: String,
  value: [String, Number],
  icon: String,
  color: String,
  description: String,
});

const colorClasses = computed(() => {
  const colors = {
    'from-blue-600 to-blue-400': 'bg-gradient-to-br from-blue-600/20 to-blue-400/10 border-blue-500/20',
    'from-emerald-600 to-emerald-400': 'bg-gradient-to-br from-emerald-600/20 to-emerald-400/10 border-emerald-500/20',
    'from-green-600 to-green-400': 'bg-gradient-to-br from-green-600/20 to-green-400/10 border-green-500/20',
    'from-purple-600 to-purple-400': 'bg-gradient-to-br from-purple-600/20 to-purple-400/10 border-purple-500/20',
  };
  return colors[this.$props.color] || colors['from-blue-600 to-blue-400'];
});
</script>

<style scoped>
.glass-card {
  backdrop-filter: blur(20px);
  border: 1px solid rgba(71, 85, 105, 0.3);
  padding: 1.5rem;
  border-radius: 0.75rem;
  transition: all 0.3s ease;
}

.glass-card:hover {
  border-color: rgba(71, 85, 105, 0.5);
  transform: translateY(-2px);
}
</style>
