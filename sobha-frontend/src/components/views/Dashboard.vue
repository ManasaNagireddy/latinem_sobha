<template>
  <BigChart />
  <v-chart class="chart" :option="chartOptions" autoresize />
  <Donutchart/>
</template>

<script setup>
import { ref } from 'vue'
import Donutchart from './Donutchart.vue';
import BigChart from './BigChart.vue';

const chartOptions = ref({
  title: {
    text: 'Defects by Type'
  },
  tooltip: {},
  legend: {
    data: ['Defects']
  },
  xAxis: {
    data: ['Crack', 'Leak', 'Discoloration', 'Misalignment', 'Other']
  },
  yAxis: {},
  series: [
    {
      name: 'Defects',
      type: 'bar',
      data: [23, 45, 31, 12, 9],
      itemStyle: {
        color: '#4CAF50'
      }
    }
  ]
})
</script>

<style scoped>
.chart {
  height: 400px;
  width: 100%;
}
</style>
