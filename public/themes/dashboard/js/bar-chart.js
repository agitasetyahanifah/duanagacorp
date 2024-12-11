const ctx = document.getElementById('myChart').getContext('2d');
const getGradient = (ctx, chartArea, start_color, stop_color) => {
  let width, height, gradient;
  const chartWidth = chartArea.right - chartArea.left;
  const chartHeight = chartArea.bottom - chartArea.top;
  if (gradient === null || width !== chartWidth || height !== chartHeight) {
    width = chartWidth;
    height = chartHeight;
    gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
    gradient.addColorStop(0, stop_color);
    gradient.addColorStop(1, start_color);
  }
  return gradient;
}

const myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name'],
    datasets: [{
      label: 'Percentage',
      data: [65, 59, 80, 81, 50, 33, 40, 15, 45, 75, 55, 95, 70, 24, 64, 37, 93, 27],
      backgroundColor: function (context) {
        const chart = context.chart;
        const {
          ctx,
          chartArea
        } = chart;
        if (!chartArea) {
          return null;
        }
        return getGradient(ctx, chartArea, "#FE6B0C", "#FFFFFF");
      },
      categoryPercentage: 0.5,
      barPercentage: 1,
      borderRadius: 4,
    }]
  },

  options: {
    responsive: true,
    maintainAspectRatio: true,
    plugins: {
      legend: {
        display: false
      },
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          callback: function (value, index, values) {
            return value + '%';
          }
        }
      }],
      xAxes: [{
        barThickness: 20
      }]
    },
    tooltips: {
      callbacks: {
        label: function (tooltipItem, data) {
          let label = data.datasets[tooltipItem.datasetIndex].label || '';
          if (label) {
            label += ': ';
          }
          label += Math.round(tooltipItem.yLabel * 100) / 100;
          label += '%';
          return label;
        }
      }
    },
  }
});

