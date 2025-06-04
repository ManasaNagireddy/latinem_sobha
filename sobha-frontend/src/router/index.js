import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/components/views/CapaRequestList.vue'),
    meta: { title: 'Dashboard', icon: '🏠' }
  },
   {
    path: '/capa-workflow',
    component: () => import('@/components/views/CapaRequestList.vue'),
    meta: { title: 'CAPA Workflow', icon: '🧩' }
  },
  {
    path: '/inspection-request/:id',
    component: () => import('@/components/views/InspectionRequest.vue'),
    meta: { title: 'Inspection Request', icon: '📋' }
  },
  {
    path: '/admin-configuration',
    component: () => import('@/components/views/AdminConfiguration.vue'),
    meta: { title: 'Configuration', icon: '⚙️' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router



