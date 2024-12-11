const ctx1 = document.getElementById("gaugeChart1");
const ctx2 = document.getElementById("gaugeChart2");
const ctx3 = document.getElementById("gaugeChart3");
const constantlabels = ["#52B57C", "#D9D9D9"]
const randomNumber1 = (Math.random() * 100).toFixed(2);
const randomNumber2 = (Math.random() * 100).toFixed(2);
const randomNumber3 = (Math.random() * 100).toFixed(2);
const percentElement1 = document.getElementById("percentage1");
const percentElement2 = document.getElementById("percentage2");
const percentElement3 = document.getElementById("percentage3");
percentElement1.textContent = randomNumber1 + '%';
percentElement2.textContent = randomNumber2 + '%';
percentElement3.textContent = randomNumber3 + '%';

const gaugeChart1 = new Chart(ctx1, {
  type: 'doughnut',
  data: {
    labels: [" points", " rest"],
    datasets: [{
      data: [randomNumber1, 100 - randomNumber1],
      backgroundColor: constantlabels,
      rotation: 270,
      circumference: 180,
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      },
    },
    cutout: 60
  }
});

const gaugeChart2 = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: [" points", " rest"],
    datasets: [{
      data: [randomNumber2, 100 - randomNumber2],
      backgroundColor: constantlabels,
      rotation: 270,
      circumference: 180,
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      },
    },
    cutout: 60
  }
});

const gaugeChart3 = new Chart(ctx3, {
  type: 'doughnut',
  data: {
    labels: [" points", " rest"],
    datasets: [{
      data: [randomNumber3, 100 - randomNumber3],
      backgroundColor: constantlabels,
      rotation: 270,
      circumference: 180,
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      },
    },
    cutout: 60
  }
});
