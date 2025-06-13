<template>
  <div class="chart-container">
    <h2>Defect Type Donut Chart</h2>

    <!-- Dropdowns -->
    <div class="filters">
      <label>Project:</label>
      <select v-model="selectedProject" @change="updateChart">
        <option :value="null">All</option>
        <option v-for="p in projectOptions" :key="p.id" :value="p.id">{{ p.name }}</option>
      </select>

      <label>Division:</label>
      <select v-model="selectedDivision" @change="updateChart">
        <option :value="null">All</option>
        <option v-for="d in divisionOptions" :key="d" :value="d">{{ d }}</option>
      </select>
    </div>

    <!-- Chart -->
    <div ref="chartRef" class="chart"></div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import * as echarts from 'echarts'
import axiosInstance from '@/axios';

// Sample defect data
const rawData = ref([])

axiosInstance.get('donutchart',{}).then(
  (response) => {
      rawData.value = response.data.data;
  }
).catch((error) => {
    console.log("unable to get the data");
  }
);

const selectedProject = ref(null)
const selectedDivision = ref(null)
const chartRef = ref(null)
let chartInstance = null

// Dropdown options
const projectOptions = computed(() =>{
   const map = new Map();
    rawData.value.forEach(d => {
      if (!map.has(d.project_id)) {
        map.set(d.project_id, {
          id: d.project_id,
          name: d.projectname // or d.name if that's how it's named
        });
      }
    })
    return Array.from(map.values());
});



const divisionOptions = computed(() =>
  [...new Set(rawData.value.map(d => d.division_id))])

// Filtered data
const filteredData = computed(() => {
  return rawData.value.filter(d => {
    return (!selectedProject.value || d.project_id === selectedProject.value) &&
           (!selectedDivision.value || d.division_id === selectedDivision.value)
  })
})

// Group and map to chart format
const chartData = computed(() => {
  const grouped = {}
  filteredData.value.forEach(d => {
    grouped[d.defect_type] = (grouped[d.defect_type] || 0) + d.defect_count
  })
  return Object.entries(grouped).map(([name, value]) => ({ name, value }))
})

// Render ECharts donut chart
const renderChart = () => {
  if (!chartInstance && chartRef.value) {
    chartInstance = echarts.init(chartRef.value)
  }
  chartInstance.setOption({
    title: {
      text: 'Defect Types',
      left: 'center'
    },
    tooltip: {
      trigger: 'item'
    },
    legend: {
      bottom: '0%',
      left: 'center'
    },
    series: [
      {
        name: 'Defect Count',
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
          borderRadius: 10,
          borderColor: '#fff',
          borderWidth: 2
        },
        label: {
          show: false,
          position: 'center'
        },
        emphasis: {
          label: {
            show: true,
            fontSize: 18,
            fontWeight: 'bold'
          }
        },
        labelLine: {
          show: false
        },
        data: chartData.value
      }
    ]
  })
}

// Hooks
onMounted(() => {

  renderChart()
})

watch(chartData, () => {
  renderChart()
})

const updateChart = () => {
  renderChart()
}
</script>

<style scoped>
.chart-container {
  padding: 20px;
  max-width: 800px;
  margin: auto;
}
.filters {
  margin-bottom: 15px;
}
select {
  margin-right: 15px;
  padding: 5px;
}
.chart {
  width: 100%;
  height: 400px;
}
</style>
