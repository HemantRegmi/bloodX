<?php
include 'conn.php';
include 'session.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservation Statistics - BloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .content-wrapper {
      margin-left: 250px;
      padding: 2rem;
      min-height: calc(100vh - 80px);
    }

    .page-header {
      margin-bottom: 2rem;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      color: #666;
      font-size: 1.1rem;
    }

    .stats-overview {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .stat-box {
      background: #fff;
      border-radius: 8px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
      text-align: center;
    }

    .stat-box .number {
      font-size: 2rem;
      font-weight: 900;
      color: #dc3545;
      margin-bottom: 0.5rem;
    }

    .stat-box .label {
      font-size: 0.9rem;
      color: #666;
      font-weight: 500;
    }

    .charts-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .chart-container {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
    }

    .chart-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .chart-canvas {
      position: relative;
      height: 300px;
    }

    .full-width-chart {
      grid-column: 1 / -1;
    }

    .full-width-chart .chart-canvas {
      height: 400px;
    }

    .data-table {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    .table-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .refresh-btn {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .refresh-btn:hover {
      background: #c82333;
      transform: translateY(-1px);
    }

    .auto-refresh {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }

    .auto-refresh input[type="checkbox"] {
      margin: 0;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .charts-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-overview {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "statistics";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="page-header">
    <h1 class="page-title">Reservation Statistics</h1>
    <p class="page-subtitle">Comprehensive analytics and insights for blood reservations</p>
  </div>

  <div class="auto-refresh">
   
    <button class="refresh-btn" onclick="refreshAllData()">
      <i class="fas fa-sync-alt"></i> Refresh Now
    </button>
  </div>

  <div class="stats-overview">
    <div class="stat-box">
      <div class="number" id="totalReservations">-</div>
      <div class="label">Total Reservations</div>
    </div>
    <div class="stat-box">
      <div class="number" id="completedReservations">-</div>
      <div class="label">Completed</div>
    </div>
    <div class="stat-box">
      <div class="number" id="pendingReservations">-</div>
      <div class="label">Pending</div>
    </div>
    <div class="stat-box">
      <div class="number" id="todayReservations">-</div>
      <div class="label">Today</div>
    </div>
    <div class="stat-box">
      <div class="number" id="weekReservations">-</div>
      <div class="label">This Week</div>
    </div>
    <div class="stat-box">
      <div class="number" id="monthReservations">-</div>
      <div class="label">This Month</div>
    </div>
  </div>

  <div class="charts-grid">
    <div class="chart-container">
      <h3 class="chart-title">
        <i class="fas fa-chart-pie text-danger"></i>
        Reservation Status Distribution
      </h3>
      <div class="chart-canvas">
        <canvas id="statusChart"></canvas>
      </div>
    </div>

    <div class="chart-container">
      <h3 class="chart-title">
        <i class="fas fa-tint text-danger"></i>
        Blood Group Distribution
      </h3>
      <div class="chart-canvas">
        <canvas id="bloodGroupChart"></canvas>
      </div>
    </div>

    <div class="chart-container full-width-chart">
      <h3 class="chart-title">
        <i class="fas fa-chart-line text-danger"></i>
        Reservation Trends (Last 30 Days)
      </h3>
      <div class="chart-canvas">
        <canvas id="trendChart"></canvas>
      </div>
    </div>

    <div class="chart-container">
      <h3 class="chart-title">
        <i class="fas fa-hospital text-danger"></i>
        Hospital Performance
      </h3>
      <div class="chart-canvas">
        <canvas id="hospitalChart"></canvas>
      </div>
    </div>

    <div class="chart-container">
      <h3 class="chart-title">
        <i class="fas fa-clock text-danger"></i>
        Hourly Distribution
      </h3>
      <div class="chart-canvas">
        <canvas id="hourlyChart"></canvas>
      </div>
    </div>
  </div>

  <div class="data-table">
    <h3 class="table-title">
      <i class="fas fa-table text-danger"></i>
      Recent Reservations
    </h3>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>User</th>
            <th>Blood Group</th>
            <th>Hospital</th>
            <th>Date</th>
            <th>Status</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody id="recentReservationsTable">
          <tr>
            <td colspan="6" class="text-center">
              <i class="fas fa-spinner fa-spin"></i> Loading...
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
let refreshInterval;
let statusChart, bloodGroupChart, trendChart, hospitalChart, hourlyChart;

document.addEventListener('DOMContentLoaded', function() {
  loadAllData();
  
  // Auto-refresh functionality
  document.getElementById('autoRefresh').addEventListener('change', function() {
    if (this.checked) {
      startAutoRefresh();
    } else {
      stopAutoRefresh();
    }
  });
  
  if (document.getElementById('autoRefresh').checked) {
    startAutoRefresh();
  }
});

function startAutoRefresh() {
  refreshInterval = setInterval(loadAllData, 30000);
}

function stopAutoRefresh() {
  if (refreshInterval) {
    clearInterval(refreshInterval);
  }
}

function refreshAllData() {
  loadAllData();
}

function loadAllData() {
  fetch('get_reservation_stats.php')
    .then(response => response.json())
    .then(data => {
      updateOverviewStats(data.stats);
      updateStatusChart(data.statusData);
      updateBloodGroupChart(data.bloodGroupData);
      updateTrendChart(data.trendData);
      loadHospitalData();
      loadHourlyData();
      loadRecentReservations();
    })
    .catch(error => console.error('Error loading data:', error));
}

function updateOverviewStats(stats) {
  document.getElementById('totalReservations').textContent = stats.total;
  document.getElementById('completedReservations').textContent = stats.completed;
  document.getElementById('pendingReservations').textContent = stats.pending;
  document.getElementById('todayReservations').textContent = stats.today;
  document.getElementById('weekReservations').textContent = stats.week;
  document.getElementById('monthReservations').textContent = stats.month;
}

function updateStatusChart(data) {
  const ctx = document.getElementById('statusChart').getContext('2d');
  
  if (statusChart) {
    statusChart.destroy();
  }
  
  statusChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: data.labels,
      datasets: [{
        data: data.values,
        backgroundColor: [
          '#28a745', // Completed
          '#ffc107', // Pending
          '#dc3545'  // Other
        ],
        borderWidth: 2,
        borderColor: '#fff'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            padding: 20,
            usePointStyle: true
          }
        }
      }
    }
  });
}

function updateBloodGroupChart(data) {
  const ctx = document.getElementById('bloodGroupChart').getContext('2d');
  
  if (bloodGroupChart) {
    bloodGroupChart.destroy();
  }
  
  const labels = data.map(item => item.group);
  const values = data.map(item => item.count);
  
  bloodGroupChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Reservations',
        data: values,
        backgroundColor: 'rgba(220, 53, 69, 0.8)',
        borderColor: '#dc3545',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
}

function updateTrendChart(data) {
  const ctx = document.getElementById('trendChart').getContext('2d');
  
  if (trendChart) {
    trendChart.destroy();
  }
  
  trendChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'New Reservations',
        data: data.values,
        borderColor: '#dc3545',
        backgroundColor: 'rgba(220, 53, 69, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
}

function loadHospitalData() {
  fetch('get_hospital_stats.php')
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById('hospitalChart').getContext('2d');
      
      if (hospitalChart) {
        hospitalChart.destroy();
      }
      
      hospitalChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Reservations',
            data: data.values,
            backgroundColor: 'rgba(40, 167, 69, 0.8)',
            borderColor: '#28a745',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          },
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    })
    .catch(error => console.error('Error loading hospital data:', error));
}

function loadHourlyData() {
  fetch('get_hourly_stats.php')
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById('hourlyChart').getContext('2d');
      
      if (hourlyChart) {
        hourlyChart.destroy();
      }
      
      hourlyChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Reservations',
            data: data.values,
            backgroundColor: 'rgba(255, 193, 7, 0.8)',
            borderColor: '#ffc107',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          },
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    })
    .catch(error => console.error('Error loading hourly data:', error));
}

function loadRecentReservations() {
  fetch('get_recent_reservations.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('recentReservationsTable');
      
      if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No reservations found</td></tr>';
        return;
      }
      
      tbody.innerHTML = data.map(reservation => `
        <tr>
          <td>${reservation.user_name}</td>
          <td><span class="badge badge-danger">${reservation.blood_group}</span></td>
          <td>${reservation.hospital_name}</td>
          <td>${reservation.reservation_date}</td>
          <td>
            <span class="badge badge-${reservation.status === 'completed' ? 'success' : 'warning'}">
              ${reservation.status}
            </span>
          </td>
          <td>${reservation.created_at}</td>
        </tr>
      `).join('');
    })
    .catch(error => {
      console.error('Error loading recent reservations:', error);
      document.getElementById('recentReservationsTable').innerHTML = 
        '<tr><td colspan="6" class="text-center text-danger">Error loading data</td></tr>';
    });
}
</script>

</body>
</html>

<?php
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Access Denied - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .access-denied {
      background: #fff;
      border-radius: 12px;
      padding: 3rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
    }
    
    .access-denied i {
      font-size: 4rem;
      color: #dc3545;
      margin-bottom: 1rem;
    }
    
    .access-denied h2 {
      color: #333;
      margin-bottom: 1rem;
    }
    
    .access-denied p {
      color: #666;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <div class="access-denied">
    <i class="fas fa-lock"></i>
    <h2>Access Denied</h2>
    <p>Please login first to access the admin portal.</p>
    <a href="../login.php" class="btn btn-danger">
      <i class="fas fa-sign-in-alt"></i> Go to Login
    </a>
  </div>
</body>
</html>
<?php
}
?>
