<template>
  <div class="">
    <!--Row1-->
    <div class="flex items-center justify-between mb-5">
      <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
        CAPA Request Lists
      </h2>

      <div class="relative text-gray-600">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <!-- Search icon (SVG) -->
          <svg
            class="h-5 w-5 text-gray-500"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
          </svg>
        </span>
        <input
          type="search"
          name="search"
          placeholder="Search"
          class="bg-gray-100 h-10 pl-10 pr-4 rounded-full text-sm focus:outline-none"
        />
      </div>
    </div>


    <!--Row1 ended here-->
    <!-- Filters -->
    <div class="grid grid-cols-1 sm:grid-cols-10 gap-1 mb-4">
      <h4 class="p-2 font-bold text-right">Filter By</h4>
        <!-- Projects Filter-->
       <select  v-model="filters.project">
            <option value="">Projects</option>
            <option v-for="project in projects" :key="project.id" :value="project.id">
              {{ project.name }}
            </option>
        </select>
        <!-- Divisions Filter -->
        <select v-model="filters.division"  >
          <option value="">Divisions</option>
          <option v-for="division in divisions" :key="division.id" :value="division.id">
            {{ division.name }}
          </option>
        </select>
         <!-- Sub Divisions Filter -->
        <select v-model="filters.subdivisions"  >
          <option value="">Sub Divisions</option>
          <option v-for="subdivision in subdivisions" :key="subdivision.id" :value="subdivision.id">
            {{ subdivision.name }}
          </option>
        </select>
          <!-- Activity Filter -->
        <select v-model="filters.subdivisions"  >
          <option value="">Activity</option>
          <option v-for="actvity in activites" :key="actvity.id" :value="actvity.id">
            {{ actvity.name }}
          </option>
        </select>
          <!-- Sub Activity Filter -->
        <select v-model="filters.subdivisions"  >
          <option value="">Sub Activity</option>
          <option v-for="subactivity in subactivites" :key="subactivity.id" :value="subactivity.id">
            {{ subactivity.name }}
          </option>
        </select>
         <!-- CAPA Created at Filter -->
       <select v-model="filters.capacreatedat">
          <option value="">Capa Created At</option>
          <option value="today">Today</option>
          <option value="last_7_days">Last 7 Days</option>
          <option value="last_30_days">Last 30 Days</option>
          <option value="this_month">This Month</option>
      </select>
         <!-- Status Filter -->
        <select v-model="filters.subdivisions"  >
          <option value="">Status</option>
          <option v-for="statusItem in status" :key="statusItem.id" :value="statusItem.id">
            {{ statusItem.name }}
          </option>
        </select>

    
  </div>
<!-- Filters Ended here-->
    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="listtable">
        <thead class="bg-gray-200">
          <tr>
            <th>Project</th>
            <th>Tower</th>
            <th>Division</th>
            <th>Activity</th>
            <th>Defect Type</th>
            <th>Defect Count</th>
            <th>Date</th>
            <th>Approver</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredRequests" :key="item.id">
            <td>{{ getProjectName(item.project_id) }}</td>
            <td> {{ getTowerName(item.tower_id) }}</td>
            <td>{{ getDivisionName(item.division_id) }}</td>
            <td>{{  getActivityName(item.activity_id) }}</td>
            <td>{{ item.defect_type }}</td>
            <td>{{ item.defect_count }}</td>
            <td>{{ formatDate(item.created_at) }}</td>
            <td>{{ item.user_name }}</td>
            <td>
              <div class="flex gap-2 p-1 items-center">
                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                  <span>{{ item.status }}</span>
              </div>
               
              
            </td>
            <td>
              <router-link :to="`/inspection-request/${item.id}`"  title="View Capa Request">
                <button class="view-button">View</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- Pagination Starts from here-->
       <div class="text-sm text-gray-600 mt-2">
          Showing {{ (pagination.currentPage - 1) * pagination.limit + 1 }}–
          {{ Math.min(pagination.currentPage * pagination.limit, pagination.total) }} of
          {{ pagination.total }} results
        </div>

        <div class="flex gap-2 mt-4">
          <button @click="pagination.prevPage" :disabled="pagination.currentPage === 1">
            Previous
          </button>

          <button
            v-for="page in totalPagesArray"
            :key="page"
            @click="pagination.goToPage(page)"
            :class="['px-2 py-1 border', { 'bg-blue-500 text-white': page === pagination.currentPage }]"
          >
            {{ page }}
          </button>

          <button @click="pagination.nextPage" :disabled="pagination.currentPage === pagination.totalPages">
            Next
          </button>
        </div>
       <!--Pagination Ends Here-->
    </div>
  </div>
</template>
<script setup>
import { ref, computed,onMounted , watch } from 'vue'
import axiosInstance from '@/axios';
import { storeToRefs } from 'pinia'
import { usePaginationStore } from '@/components/stores/pagination'

const pagination = usePaginationStore()
const { currentPage, limit } = storeToRefs(pagination)


const filters = ref({
  project: '',
  division: '',
  towers : '',
  activites : '',
  subactivites : '',
  subdivisions : '',
  status : '',
  capacreatedat: '',
})
const status = ref([
  {id : 1 , name : "open"},
  {id : 2 , name : "close"},
  {id : 3 , name : "rejected"}
])
const projects = ref([])
const divisions = ref([])
const towers = ref([])  
const activites = ref([])
const subactivites = ref([])
const subdivisions = ref([])
const caparequests = ref([])

  const getPreFetchData = () => {
        const projectsPromise = axiosInstance.get("projects?limit=1000");
        const divisionsPromise = axiosInstance.get("divisions?limit=1000");
        const activitesPromise = axiosInstance.get("activities?limit=1000");
        const subactivitiesPromise = axiosInstance.get("subactivities?limit=1000");
        const subdivisionsPromise = axiosInstance.get("subdivisions?limit=1000");
        const towersPromise = axiosInstance.get("towers?limit=1000");
     
        Promise.all([
            projectsPromise,
            divisionsPromise,
            towersPromise,
            activitesPromise,
            subactivitiesPromise,
            subdivisionsPromise
        ]).then(
            ([
                projectResponse,
                divisionResponse,
                towersResponse,
                activitesResponse,
                subactivitiesResponse,
                subdivisionsResponse           
            ]) => {
                projects.value = projectResponse.data;
                divisions.value = divisionResponse.data;
                towers.value = towersResponse.data;
                activites.value = activitesResponse.data;
                subactivites.value = subactivitiesResponse.data;
                subdivisions.value = subdivisionsResponse.data;
            }
        ).catch(error => {
        console.error('Error fetching projects:', error)
      })
    };

    const fetchCapaRequests = () => {
      const offsetValue = (pagination.currentPage - 1) * limit.value;

      axiosInstance
        .get("caparequests", {
          params: { limit: limit.value, offset: offsetValue },
        })
        .then((response) => {
          caparequests.value = response.data.data;
          pagination.setTotal(response.data.total);
        })
        .catch((error) => {
          console.error("Error fetching CAPA requests:", error);
        });
    };

// Fetch when current page changes
watch(() => pagination.currentPage, () =>{ fetchCapaRequests() })
/*On First time page loads*/
onMounted(() => {
  getPreFetchData();
  fetchCapaRequests();
});

function getTowerName(towerId) {
  const tower = towers.value.find(t => t.id === towerId);
  return tower ? tower.name : '';
}

function getDivisionName(divisionId) {
  const division = divisions.value.find(t => t.id === divisionId);
  return division ? division.name : '';
}
function getProjectName(projectId) {
  const project = projects.value.find(t => t.id === projectId);
  return project ? project.name : '';
}
function getActivityName(activityId) {
  const activity = activites.value.find(t => t.id === activityId);
  return activity ? activity.name : '';
}
// Computed array for page numbers
const totalPagesArray = computed(() => {
  const pages = []
  for (let i = 1; i <= pagination.totalPages; i++) {
    pages.push(i)
  }
  return pages
})

const filteredRequests = computed(() => {
  return caparequests.value.filter(req => {
    return (
      (!filters.value.project || req.project_id === filters.value.project) &&
      (!filters.value.division || req.division_id === filters.value.division) &&
      (!filters.value.tower || req.tower_id === filters.value.tower) &&
      (!filters.value.activity || req.activity_id === filters.value.activity) &&
      (!filters.value.subactivity || req.sub_activity_id === filters.value.subactivity) &&
      (!filters.value.status || req.status.toLowerCase() === filters.value.status.toLowerCase()) 
    )
  });


})


function formatDate(dateStr) {
   const options = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true,
  };
  const date = new Date(dateStr);
  const formatted = date.toLocaleString('en-US', options);
  return formatted.replace(',', ' |'); // Insert pipe between date and time
}

function statusClass(status) {
  switch (status) {
    case 'open': return 'bg-yellow-500'
    case 'closed': return 'bg-green-600'
    case 'rejected': return 'bg-red-500'
    default: return 'bg-gray-500'
  }
}
</script>
