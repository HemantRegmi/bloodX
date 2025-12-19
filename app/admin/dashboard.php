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
  <title>Admin Dashboard - BloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Modern Dashboard Styling */
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

    .dashboard-header {
      margin-bottom: 2rem;
    }

    .dashboard-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
      color: #666;
      font-size: 1.1rem;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }

    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: #fff;
      margin-bottom: 1rem;
    }

    .stat-icon.donors {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }

    .stat-icon.queries {
      background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }

    .stat-icon.hospitals {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }

    .stat-icon.reservations {
      background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }

    .stat-icon.completed {
      background: linear-gradient(135deg, #20c997 0%, #1ea085 100%);
    }

    .stat-icon.pending {
      background: linear-gradient(135deg, #fd7e14 0%, #e55a00 100%);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 900;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .stat-label {
      font-size: 1rem;
      color: #666;
      font-weight: 500;
      margin-bottom: 1rem;
    }

    .stat-btn {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
    }

    .stat-btn:hover {
      background: #c82333;
      color: #fff;
      text-decoration: none;
      transform: translateY(-1px);
    }

    .welcome-section {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: #fff;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 16px rgba(220, 53, 69, 0.3);
    }

    .welcome-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .welcome-text {
      font-size: 1rem;
      opacity: 0.9;
    }

    .charts-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .chart-card {
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

    .chart-container {
      position: relative;
      height: 300px;
    }

    .recent-activity {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    .activity-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .activity-item {
      display: flex;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      font-size: 0.9rem;
      color: #fff;
    }

    .activity-icon.new {
      background: #28a745;
    }

    .activity-icon.completed {
      background: #20c997;
    }

    .activity-icon.pending {
      background: #ffc107;
    }

    .activity-content {
      flex: 1;
    }

    .activity-text {
      font-weight: 500;
      color: #333;
      margin-bottom: 0.25rem;
    }

    .activity-time {
      font-size: 0.85rem;
      color: #666;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .stats-grid {
        grid-template-columns: 1fr;
      }
      
      .charts-section {
        grid-template-columns: 1fr;
      }
      
      .dashboard-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "dashboard";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="dashboard-header">
    <h1 class="dashboard-title">Dashboard</h1>
    <p class="dashboard-subtitle">Welcome to the BloodX Admin Panel</p>
  </div>

  <div class="welcome-section">
    <h2 class="welcome-title">Welcome back, <?php echo $row['admin_name']; ?>!</h2>
    <p class="welcome-text">Here's an overview of your Blood Donation Management System.</p>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon donors">
        <i class="fas fa-users"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT * FROM donor_details";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        echo mysqli_num_rows($result);
        ?>
      </div>
      <div class="stat-label">Total Donors</div>
      <a href="donor_list.php" class="stat-btn">View Details</a>
    </div>

    <div class="stat-card">
      <div class="stat-icon queries">
        <i class="fas fa-comments"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT * FROM contact_query";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        echo mysqli_num_rows($result);
        ?>
      </div>
      <div class="stat-label">User Queries</div>
      <a href="query.php" class="stat-btn">View Details</a>
    </div>

    <div class="stat-card">
      <div class="stat-icon hospitals">
        <i class="fas fa-hospital"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT * FROM hospitals";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        echo mysqli_num_rows($result);
        ?>
      </div>
      <div class="stat-label">Partner Hospitals</div>
      <a href="hospital.php" class="stat-btn">View Details</a>
    </div>

    <div class="stat-card">
      <div class="stat-icon reservations">
        <i class="fas fa-calendar-check"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT COUNT(*) as total FROM reservation";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        $row = mysqli_fetch_assoc($result);
        echo $row['total'];
        ?>
      </div>
      <div class="stat-label">Total Reservations</div>
      <a href="hospital.php" class="stat-btn">View Details</a>
    </div>

    <div class="stat-card">
      <div class="stat-icon completed">
        <i class="fas fa-check-circle"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT COUNT(*) as completed FROM reservation WHERE status='completed'";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        $row = mysqli_fetch_assoc($result);
        echo $row['completed'];
        ?>
      </div>
      <div class="stat-label">Completed Reservations</div>
      <a href="hospital.php" class="stat-btn">View Details</a>
    </div>

    <div class="stat-card">
      <div class="stat-icon pending">
        <i class="fas fa-clock"></i>
      </div>
      <div class="stat-number">
        <?php
        $sql = "SELECT COUNT(*) as pending FROM reservation WHERE status='pending'";
        $result = mysqli_query($conn, $sql) or die("query failed.");
        $row = mysqli_fetch_assoc($result);
        echo $row['pending'];
        ?>
      </div>
      <div class="stat-label">Pending Reservations</div>
      <a href="hospital.php" class="stat-btn">View Details</a>
    </div>
  </div>

  <div class="charts-section">
    <div class="chart-card">
      <h3 class="chart-title">
        <i class="fas fa-chart-pie text-danger"></i>
        Reservation Status Distribution
      </h3>
      <div class="chart-container">
        <canvas id="reservationStatusChart"></canvas>
      </div>
    </div>

    <div class="chart-card">
      <h3 class="chart-title">
        <i class="fas fa-chart-line text-danger"></i>
        Reservations Over Time (Last 7 Days)
      </h3>
      <div class="chart-container">
        <canvas id="reservationTrendChart"></canvas>
      </div>
    </div>
  </div>

  <div class="charts-section">
    <div class="chart-card">
      <h3 class="chart-title">
        <i class="fas fa-hospital text-danger"></i>
        Hospital Performance
      </h3>
      <div class="chart-container">
        <canvas id="hospitalPerformanceChart"></canvas>
      </div>
    </div>
  </div>

  <div class="recent-activity">
    <h3 class="activity-title">
      <i class="fas fa-history text-danger"></i>
      Recent Activity
    </h3>
    <div id="recentActivity">
      <div class="text-center text-muted">
        <i class="fas fa-spinner fa-spin"></i> Loading recent activity...
      </div>
    </div>
  </div>

  <div class="text-center mt-4">
    <a href="reservation_statistics.php" class="btn btn-danger btn-lg">
      <i class="fas fa-chart-bar"></i> View Detailed Statistics
    </a>
  </div>
</div>

<script>
// Initialize charts
document.addEventListener('DOMContentLoaded', function() {
  loadReservationStats();
  loadHospitalPerformance();
  loadRecentActivity();
  
  // Refresh data every 30 seconds
  setInterval(function() {
    loadReservationStats();
    loadHospitalPerformance();
    loadRecentActivity();
  }, 30000);
});

function loadReservationStats() {
  fetch('get_reservation_stats.php')
    .then(response => response.json())
    .then(data => {
      updateStatusChart(data.statusData);
      updateTrendChart(data.trendData);
    })
    .catch(error => console.error('Error loading stats:', error));
}

function loadHospitalPerformance() {
  fetch('get_hospital_stats.php')
    .then(response => response.json())
    .then(data => {
      updateHospitalChart(data);
    })
    .catch(error => console.error('Error loading hospital stats:', error));
}

function updateHospitalChart(data) {
  const ctx = document.getElementById('hospitalPerformanceChart').getContext('2d');
  
  if (window.hospitalChart) {
    window.hospitalChart.destroy();
  }
  
  window.hospitalChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'Total Reservations',
        data: data.values,
        backgroundColor: 'rgba(220, 53, 69, 0.8)',
        borderColor: '#dc3545',
        borderWidth: 1
      }]
    },
    options: {
      indexAxis: 'y',
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
}

function updateStatusChart(data) {
  const ctx = document.getElementById('reservationStatusChart').getContext('2d');
  
  if (window.statusChart) {
    window.statusChart.destroy();
  }
  
  window.statusChart = new Chart(ctx, {
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

function updateTrendChart(data) {
  const ctx = document.getElementById('reservationTrendChart').getContext('2d');
  
  if (window.trendChart) {
    window.trendChart.destroy();
  }
  
  window.trendChart = new Chart(ctx, {
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

function loadRecentActivity() {
  fetch('get_recent_activity.php')
    .then(response => response.json())
    .then(data => {
      const activityContainer = document.getElementById('recentActivity');
      
      // Check if data is valid array
      if (!Array.isArray(data)) {
        console.error('Invalid data received:', data);
        activityContainer.innerHTML = '<div class="text-center text-danger">Error loading activity</div>';
        return;
      }
      
      if (data.length === 0) {
        activityContainer.innerHTML = '<div class="text-center text-muted">No recent activity</div>';
        return;
      }
      
      activityContainer.innerHTML = data.map(activity => `
        <div class="activity-item">
          <div class="activity-icon ${activity.type}">
            <i class="fas ${activity.icon}"></i>
          </div>
          <div class="activity-content">
            <div class="activity-text">${activity.text}</div>
            <div class="activity-time">${activity.time}</div>
          </div>
        </div>
      `).join('');
    })
    .catch(error => {
      console.error('Error loading activity:', error);
      document.getElementById('recentActivity').innerHTML = '<div class="text-center text-danger">Error loading activity</div>';
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
