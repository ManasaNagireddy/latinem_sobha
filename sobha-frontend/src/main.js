import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './assets/main.css';
import { createPinia } from 'pinia';
import VueECharts from 'vue-echarts'
import * as echarts from 'echarts';

var pinia = createPinia();

const app = createApp(App)
app.component('v-chart', VueECharts) // Register globally
app.use(router)
app.use(pinia)
app.mount('#app');