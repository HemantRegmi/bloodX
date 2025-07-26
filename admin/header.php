<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Modern Admin Header Styling */
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .admin-navbar {
      background: #fff !important;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
      border-bottom: 1px solid rgba(0,0,0,0.05) !important;
      padding: 0.8rem 2rem !important;
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      width: 100% !important;
      z-index: 9999 !important;
    }
    
    .admin-navbar .navbar-brand {
      color: #dc3545 !important;
      font-size: 2rem !important;
      font-weight: 900 !important;
      letter-spacing: 1px !important;
      transition: all 0.3s ease !important;
    }
    
    .admin-navbar .navbar-brand:hover {
      color: #c82333 !important;
      transform: scale(1.02);
    }
    
    .admin-navbar .nav-link {
      color: #333 !important;
      font-weight: 500 !important;
      font-size: 1rem !important;
      padding: 0.5rem 1rem !important;
      border-radius: 6px !important;
      transition: all 0.3s ease !important;
      margin: 0 0.2rem !important;
    }
    
    .admin-navbar .nav-link:hover {
      color: #dc3545 !important;
      background: rgba(220, 53, 69, 0.08) !important;
    }
    
    .admin-navbar .dropdown-menu {
      background: #fff !important;
      border: none !important;
      border-radius: 8px !important;
      box-shadow: 0 8px 32px rgba(0,0,0,0.1) !important;
      min-width: 200px !important;
      margin-top: 0.5rem !important;
      padding: 0.5rem 0 !important;
    }
    
    .admin-navbar .dropdown-item {
      color: #333 !important;
      font-weight: 500 !important;
      padding: 0.75rem 1.5rem !important;
      transition: all 0.3s ease !important;
    }
    
    .admin-navbar .dropdown-item:hover {
      background: #f8f9fa !important;
      color: #dc3545 !important;
    }
    
    .admin-navbar .dropdown-item i {
      margin-right: 0.75rem !important;
      color: #666 !important;
      width: 16px !important;
    }
    
    .user-info {
      display: flex !important;
      align-items: center !important;
      gap: 0.5rem !important;
      color: #333 !important;
      font-weight: 600 !important;
    }
    
    .user-avatar {
      width: 32px !important;
      height: 32px !important;
      background: #dc3545 !important;
      border-radius: 50% !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #fff !important;
      font-weight: bold !important;
      font-size: 0.9rem !important;
    }

    /* Hide default Bootstrap dropdown arrow */
    .admin-navbar .dropdown-toggle::after {
      display: none !important;
    }
    
    /* Add margin to content wrapper to prevent it being hidden under navbar */
    .content-wrapper {
      margin-top: 80px;
    }
    
    @media (max-width: 768px) {
      .admin-navbar {
        padding: 0.5rem 1rem !important;
      }
      
      .admin-navbar .navbar-brand {
        font-size: 1.5rem !important;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light admin-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">
      <i class="fas fa-heartbeat text-danger"></i> BloodX
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown">
            <div class="user-info">
              <div class="user-avatar">
                <?php
                include 'conn.php';
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM admin_info WHERE admin_username='$username'";
                $result = mysqli_query($conn, $sql) or die("query failed.");
                $row = mysqli_fetch_assoc($result);
                echo strtoupper(substr($row['admin_name'], 0, 1));
                ?>
              </div>
              <span><?php echo $row['admin_name']; ?></span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="change_password.php">
              <i class="fas fa-key"></i>Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">
              <i class="fas fa-sign-out-alt"></i>Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body></html>
