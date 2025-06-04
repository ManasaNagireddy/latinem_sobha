<template>
  <Layout>
    <div class="p-6 space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Request Details</h1>
      </div>

      <div class="flexcontainer">
          <!-- Request Info -->
          <div class="basis-[35%]">
            <div class="grid grid-cols-2 gap-2">
              <div>
                <p>Floor</p>
                <p class="font-semibold">B-P6</p>
              </div>
              <div>
                <p>Unit</p>
                <p class="font-semibold">B0P083</p>
              </div>
              <div>
                <p>Division</p>
                <p class="font-semibold">Finishing Division</p>
              </div>
              <div>
                <p>Sub Division</p>
                <p class="font-semibold">Tile Division</p>
              </div>
               <div>
                <p>Activity</p>
                <p class="font-semibold">Dry Area Flooring</p>
              </div>
              <div>
                <p>Sub Activity</p>
                <p class="font-semibold">Flooring</p>
              </div>
               <div>
                <p>Technician</p>
                <p class="font-semibold"> Kumar </p>
              </div>
            </div>
            <!-- Documents view-->
             <div class="documentlist mt-10">
              <span>Plan Document</span>
              <button class="view-button">                
                <span class="ml-1 text-sm">View</span>
              </button>
            </div>
             <div class="documentlist">
              <span>Approved Document</span>
              <button class="view-button">                
                <span class="text-sm">View</span>
              </button>
            </div>

          </div>

          <!-- Timeline -->
          <div class="basis-[65%]">
             <!-- TimelineCard start -->
          
              <TimelineCard />
            
             <!-- <TimelineCard /> ended -->
          </div>
      </div><!--Flex Container Close-->


    
     
    </div>

    
  </Layout>
</template>

<script setup>
import TimelineCard from '@/components/views/TimelineCard.vue';

const timeline = [
  { title: 'Request Created', timestamp: '2025-06-01 10:00 AM' },
  { title: 'Submitted for Review', timestamp: '2025-06-02 11:15 AM' },
  { title: 'Pending Inspection', timestamp: '2025-06-03 02:30 PM' }
]
</script>
