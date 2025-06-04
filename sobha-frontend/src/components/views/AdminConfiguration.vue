<template>
  <Layout>
    <div class="p-6 space-y-6">
      <h1 class="text-2xl font-bold mb-4">Inspection Configuration</h1>

      <!-- Switch Settings -->
      <div class="bg-white rounded shadow p-6 space-y-6 max-w-2xl">
        <div
          v-for="(setting, index) in switches"
          :key="index"
          class="flex items-center justify-between"
        >
          <div>
            <p class="font-medium">{{ setting.label }}</p>
            <p class="text-sm text-gray-500">{{ setting.description }}</p>
          </div>
          <label class="inline-flex items-center cursor-pointer">
            <input
              type="checkbox"
              class="sr-only"
              v-model="setting.enabled"
            />
            <div
              class="w-11 h-6 bg-gray-300 rounded-full peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 peer dark:bg-gray-700"
              :class="{ 'bg-blue-600': setting.enabled }"
            >
              <div
                class="dot w-5 h-5 bg-white rounded-full shadow transform transition duration-300"
                :class="{ 'translate-x-5': setting.enabled, 'translate-x-1': !setting.enabled }"
              ></div>
            </div>
          </label>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex space-x-4">
        <button
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          @click="saveSettings"
        >
          Save Changes
        </button>
        <button
          class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
          @click="resetSettings"
        >
          Cancel
        </button>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { reactive } from 'vue'

const switches = reactive([
  {
    label: 'Auto-Assign Inspectors',
    description: 'Automatically assign inspectors based on workload.',
    enabled: true
  },
  {
    label: 'Notify via Email',
    description: 'Send automatic email notifications on updates.',
    enabled: false
  },
  {
    label: 'Enable Safety Checks',
    description: 'Include safety compliance in inspections.',
    enabled: true
  }
])

const saveSettings = () => {
  console.log('Saving settings:', JSON.stringify(switches, null, 2))
  alert('Settings saved.')
}

const resetSettings = () => {
  location.reload() // simple reset for now
}
</script>

<style scoped>
.dot {
  position: relative;
  top: 0.5px;
}
</style>
