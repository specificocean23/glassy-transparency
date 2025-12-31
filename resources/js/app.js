import './bootstrap';
import { createApp } from 'vue';
import DashboardApp from './components/DashboardApp.vue';

const app = createApp(DashboardApp);
app.mount('#app');
