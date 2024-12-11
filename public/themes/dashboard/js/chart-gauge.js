const ctxgauge = document.getElementById("gaugeChart");
const labels = ["", "#D9D9D9"]
const randomNumber = (Math.random() * 100).toFixed(2);
function updateStatus() {
  const percentElement = document.getElementById("percentage");
  const typeElement = document.getElementById("text-chart-type");
  const bgTypeElement = document.getElementById("bg-chart-type");
  percentElement.textContent = randomNumber + '%';
  bgTypeElement.classList.remove('bg-bronze', 'bg-silver', 'bg-gold', 'bg-platinum');

  if (randomNumber <= 49.9) {
    typeElement.textContent = 'BRONZE';
    bgTypeElement.classList.add('bg-bronze');
    labels[0] = "#CD7F31"
  } else if (randomNumber <= 69.9) {
    typeElement.textContent = 'SILVER';
    bgTypeElement.classList.add('bg-silver');
    labels[0] = "#AAA9AD"
  } else if (randomNumber <= 89.9) {
    typeElement.textContent = 'GOLD';
    bgTypeElement.classList.add('bg-gold');
    labels[0] = "#D8B807"
  } else {
    typeElement.textContent = 'PLATINUM';
    bgTypeElement.classList.add('bg-platinum');
    labels[0] = "#2B3E50"
  }
}

document.addEventListener('DOMContentLoaded', updateStatus);

const gaugeChart = new Chart(ctxgauge, {
  type: 'doughnut',
  data: {
    labels: [" points", " rest"],
    datasets: [{
      data: [randomNumber, 100 - randomNumber],
      backgroundColor: labels,
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
