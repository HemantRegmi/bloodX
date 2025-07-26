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

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .stats-grid {
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
  </div>
</div>

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
