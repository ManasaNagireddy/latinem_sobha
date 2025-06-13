<template>
  <div ref="chartRef" style="width: 100%; height: 400px;"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import * as echarts from 'echarts';
import { use } from 'echarts/core';
import {
  TitleComponent,
  TooltipComponent,
  GridComponent,
  DataZoomComponent,
  LegendComponent,
  ToolboxComponent
} from 'echarts/components';
import { CanvasRenderer } from 'echarts/renderers';    // ✅ CORRECT


use([
  TitleComponent,
  TooltipComponent,
  GridComponent,
  DataZoomComponent,
  LegendComponent,
  ToolboxComponent,
  CanvasRenderer
]);

const chartRef = ref(null);

const data = {
  xAxis: ['2020-01-01', '2020-02-01', '2020-03-01', '2020-04-01', '2020-05-01'],
  series: [120, 132, 101, 134, 90]
};

onMounted(() => {
  const chart = echarts.init(chartRef.value);
  chart.setOption({
    title: {
      text: '5-Year Data Overview'
    },
    tooltip: {
      trigger: 'axis'
    },
    dataZoom: [
      {
        type: 'slider',
        start: 0,
        end: 100
      },
      {
        type: 'inside',
        start: 0,
        end: 100
      }
    ],
    xAxis: {
      type: 'category',
      data: data.xAxis
    },
    yAxis: {
      type: 'value'
    },
    series: [
      {
        data: data.series,
        type: 'line',
        smooth: true,
        sampling: 'average'
      }
    ]
  });
});
</script>
