import './bootstrap';

import { initializeSidebar } from './sidebar';
import { initializeImageUpload } from './imageUpload';


// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initializeSidebar();
    initializeImageUpload();

    new TomSelect('#category-select', {
        placeholder: 'Select a category',
        allowEmptyOption: true,
        maxOptions: 10,

    });

    new TomSelect('#status-select', {
        placeholder: 'Select a product',
        allowEmptyOption: true,
        maxOptions: 5,
    });
});




//-------------------------charts -----------------------------

// Revenue Overview Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
  type: 'line',
  data: {
    labels: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec',
    ],
    datasets: [
      {
        label: 'This Year',
        data: [65, 59, 80, 81, 56, 55, 40, 84, 64, 89, 74, 98],
        borderColor: '#6366F1',
        tension: 0.4,
        fill: false,
      },
      {
        label: 'Last Year',
        data: [45, 49, 60, 71, 46, 45, 30, 74, 54, 79, 64, 88],
        borderColor: '#93C5FD',
        tension: 0.4,
        fill: false,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          borderDash: [2, 4],
        },
      },
    },
  },
});

// Customer Growth Chart
const customerCtx = document.getElementById('customerChart').getContext('2d');
new Chart(customerCtx, {
  type: 'bar',
  data: {
    labels: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
    datasets: [
      {
        label: 'New Customers',
        data: [120, 160, 140, 180, 210, 240],
        backgroundColor: '#818CF8',
        borderRadius: 6,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          borderDash: [2, 4],
        },
      },
    },
  },
});

// Transactions Growth Chart
const transactionCtx = document
  .getElementById('transactionChart')
  .getContext('2d');
new Chart(transactionCtx, {
  type: 'line',
  data: {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
    datasets: [
      {
        label: 'Transactions',
        data: [1200, 1900, 1700, 2400, 2800, 3200],
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        borderColor: '#6366F1',
        fill: true,
        tension: 0.4,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          borderDash: [2, 4],
        },
      },
    },
  },
});

// Product Sales Chart
const productCtx = document.getElementById('productChart').getContext('2d');
new Chart(productCtx, {
  type: 'doughnut',
  data: {
    labels: ['Electronics', 'Clothing', 'Food', 'Books', 'Others'],
    datasets: [
      {
        data: [35, 25, 20, 15, 5],
        backgroundColor: [
          '#6366F1',
          '#818CF8',
          '#93C5FD',
          '#BFDBFE',
          '#DBEAFE',
        ],
        borderWidth: 0,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          usePointStyle: true,
          padding: 20,
        },
      },
    },
    cutout: '75%',
  },
});
