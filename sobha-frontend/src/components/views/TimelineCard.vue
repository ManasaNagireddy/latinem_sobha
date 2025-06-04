<template>
  <ol class="list-none p-0 m-0 space-y-6">
    <li
      v-for="(step, index) in timeline"
      :key="index"
      class="pl-0 relative border-l-2 border-black"
    >
      <!-- Tick Icon -->
      <div
        class="absolute -left-3.5 top-1 w-6 h-6 flex items-center justify-center rounded-full"
        :class="step.status === 1 ? 'bg-green-600' : 'bg-red-600'"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-3 w-3 text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>

      <!-- Card -->
      <div class="bg-gray-100 rounded-lg shadow p-6 max-w-md">
        <!-- Top bar with user + time -->
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center space-x-3">
            <img :src="step.avatar" alt="User Avatar" class="w-8 h-8 rounded-full" />
            <span class="text-sm font-medium text-gray-700">{{ step.name }}</span>
          </div>
          <span class="text-xs text-gray-500">{{ step.timestamp }}</span>
        </div>

        <!-- Status Label -->
       <h3
            class="text-sm font-semibold mb-2"
            :class="{
                'text-green-600': step.status === 1,
                'text-red-600': step.status === 0,
                'text-yellow-500': step.status === 2
            }"
            >
            {{ step.status === 1 ? 'Approved' : step.status === 0 ? 'Rejected' : 'Pending' }}
        </h3>

        <!-- Content -->
        <p class="text-sm text-gray-700 mb-4">{{ step.comment }}</p>

        <!-- Buttons -->
        <template v-if="step.status === 2">
            <div class="flex justify-end space-x-2">
            <button
                class="px-4 py-1.5 bg-green-600 text-white text-xs font-medium uppercase rounded shadow hover:bg-gray-800 transition"
            >
                Approve
            </button>
            <button
                class="px-4 py-1.5 bg-red-600 text-white text-xs font-medium uppercase rounded shadow hover:bg-gray-800 transition"
            >
                Reject
            </button>
            
            </div>
        </template>
        
      </div>
    </li>
  </ol>
</template>


<script setup>
const timeline = [
  {
    name: 'Aravind Kumar',
    title: 'QC Manager',
    comment: 'Yes, the site layout is approved. You can proceed.',
    timestamp: '2025-06-01 10:00 AM',
    status: 1,
    avatar: 'https://i.pravatar.cc/40?u=aravind'
  },
  {
    name: 'Mahesh',
    title: 'Site Engineer',
    comment: 'Foundation inspection completed, all clear.',
    timestamp: '2025-06-02 11:15 AM',
    status: 0,
    avatar: 'https://i.pravatar.cc/40?u=mahesh'
  },
  {
    name: 'Geetha',
    title: 'CTO',
    comment: 'Updated project schedule shared with investors.',
    timestamp: '2025-06-03 02:30 PM',
    status: 2,
    avatar: 'https://i.pravatar.cc/40?u=geetha'
  }
]
</script>
