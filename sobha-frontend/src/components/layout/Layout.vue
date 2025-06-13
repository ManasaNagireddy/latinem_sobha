<template>
  <div class="flex min-h-screen bg-black-100">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">SOBHA</div>
      <span>Main Menu</span>
      <nav class="menulink">
        <RouterLink
          v-for="route in navRoutes"
          :key="route.path"
          :to="route.path"
          class="nav-link"
          :class="{'nav-link-active': route.path === $route.path }"
        >
          <span>{{ route.meta.icon }}</span> {{ route.meta.title }}
        </RouterLink>
      </nav>
    </aside>

    <!-- Page Content -->
    <main class="flex-1 p-6">
      <Suspense>
        <template #default>
          <router-view v-slot="{ Component }">
            <component :is="Component" />
          </router-view>
        </template>
        <template #fallback>
          <div class="text-center py-10 text-gray-500">Loading...</div>
        </template>
      </Suspense>
    </main>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { computed } from 'vue'

const $route = useRoute()
const router = useRouter()
const navRoutes = computed(() =>
  router.getRoutes().filter(route => !route.path.includes('/:')) // To Avoid Dyanamic routes

)

</script>
