import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/main.css'
import axiosInstance from './axios';
import { createPinia } from 'pinia';

var pinia = createPinia();
createApp(App)
  .use(router)
  .use(pinia)
  .mount('#app');
