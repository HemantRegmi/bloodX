<?php
include 'conn.php';

// Get notification counts
$notification_count = 0;
$query_count = 0;
$reservation_count = 0;

// Debug: Add timestamp to prevent caching
$debug_timestamp = time();

// Count unread admin notifications
$notif_sql = "SELECT COUNT(*) as cnt FROM admin_notifications WHERE seen = 0";
$notif_result = mysqli_query($conn, $notif_sql);
if ($notif_result) {
    $notif_row = mysqli_fetch_assoc($notif_result);
    $notification_count = $notif_row['cnt'];
}

// Count unread user queries
$query_sql = "SELECT COUNT(*) as cnt FROM contact_query WHERE query_status = 0";
$query_result = mysqli_query($conn, $query_sql);
if ($query_result) {
    $query_row = mysqli_fetch_assoc($query_result);
    $query_count = $query_row['cnt'];
} else {
    // Debug: Log query error
    error_log("Sidebar query error: " . mysqli_error($conn));
}

// Count pending blood reservations
$reservation_sql = "SELECT COUNT(*) as cnt FROM reservation WHERE status = 'pending'";
$reservation_result = mysqli_query($conn, $reservation_sql);
if ($reservation_result) {
    $reservation_row = mysqli_fetch_assoc($reservation_result);
    $reservation_count = $reservation_row['cnt'];
} else {
    // Debug: Log reservation query error
    error_log("Sidebar reservation query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  /* Modern Admin Sidebar Styling */
  body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    background: #fafafa;
  }

  .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 250px;
    height: 100vh;
    background: #fff;
    box-shadow: 2px 0 8px rgba(0,0,0,0.08);
    border-right: 1px solid rgba(0,0,0,0.05);
    z-index: 999;
    overflow-y: auto;
    padding-top: 80px;
  }

  .sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 1rem;
  }

  .sidebar-title {
    color: #333;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
  }

  .sidebar-nav {
    padding: 0 1rem;
  }

  .sidebar a {
    display: flex;
    align-items: center;
    color: #666;
    font-weight: 500;
    padding: 0.875rem 1rem;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    font-size: 0.95rem;
  }

  .sidebar a:hover {
    background: rgba(220, 53, 69, 0.08);
    color: #dc3545;
    transform: translateX(3px);
  }

  .sidebar a.act {
    background: #dc3545;
    color: #fff !important;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
  }

  .sidebar a.act:hover {
    background: #c82333;
    transform: translateX(3px);
  }

  .sidebar i {
    width: 20px;
    margin-right: 12px;
    font-size: 1rem;
  }

  .sidebar .nav-divider {
    height: 1px;
    background: #f0f0f0;
    margin: 1rem 0;
  }

  /* Notification Badge Styling */
  .notification-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    min-width: 20px;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    animation: pulse 2s infinite;
    z-index: 10;
  }



  @keyframes pulse {
    0% {
      box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    }
    50% {
      box-shadow: 0 2px 8px rgba(220, 53, 69, 0.6);
    }
    100% {
      box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    }
  }

  .sidebar a {
    position: relative;
  }

  /* Content area adjustment */
  .content-wrapper {
    margin-left: 250px;
    padding: 2rem;
    min-height: calc(100vh - 80px);
  }

  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%);
      transition: transform 0.3s ease;
    }
    
    .sidebar.show {
      transform: translateX(0);
    }
    
    .content-wrapper {
      margin-left: 0;
      padding: 1rem;
    }
  }
</style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-header">
    <h6 class="sidebar-title">Admin Panel</h6>
  </div>
  
  <div class="sidebar-nav">
    <a href="dashboard.php" <?php if($active=='dashboard') echo "class='act'"; ?>>
      <i class="fas fa-tachometer-alt"></i>Dashboard
    </a>
    
    <a href="add_donor.php" <?php if($active=='add') echo "class='act'"; ?>>
      <i class="fas fa-user-plus"></i>Add Donor
    </a>
    
    <a href="donor_list.php" <?php if($active=='list') echo "class='act'"; ?>>
      <i class="fas fa-users"></i>Donor List
    </a>
    
    <div class="nav-divider"></div>
    
    <a href="query.php" <?php if($active=='query') echo "class='act'"; ?>>
      <i class="fas fa-comments"></i>User Queries
      <?php if($query_count > 0): ?>
        <span class="notification-badge"><?php echo $query_count; ?></span>
      <?php endif; ?>
      <!-- Debug: Query count = <?php echo $query_count; ?> (<?php echo $debug_timestamp; ?>) -->
    </a>
    
    <a href="hospital.php" <?php if($active=='hospital') echo "class='act'"; ?>>
      <i class="fas fa-hospital"></i>Manage Hospitals
      <?php if($reservation_count > 0): ?>
        <span class="notification-badge"><?php echo $reservation_count; ?></span>
      <?php endif; ?>
      <!-- Debug: Reservation count = <?php echo $reservation_count; ?> (<?php echo $debug_timestamp; ?>) -->
    </a>
    
    <a href="notification.php" <?php if(basename($_SERVER['PHP_SELF'])=='notification.php') echo "class='act'"; ?>>
      <i class="fas fa-bell"></i>Send Notifications
    </a>
    
    <div class="nav-divider"></div>
    
    <a href="reservation_statistics.php" <?php if($active=='statistics') echo "class='act'"; ?>>
      <i class="fas fa-chart-bar"></i>Statistics
    </a>
  </div>
</div>
