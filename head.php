<nav class="navbar navbar-expand-lg navbar-light bg-white" style="box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-bottom: 1px solid rgba(0,0,0,0.05);">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="home.php" style="font-size: 2rem;">
      <span style="color: #dc3545;">Blood</span><span style="color: #ff1744; font-weight: 900;">X</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item <?php if($active=='home') echo 'active'; ?>">
          <a class="nav-link" href="home.php" style="color: #333; font-weight: 500; margin-right: 20px;">Home</a>
        </li>
        <li class="nav-item <?php if($active=='about') echo 'active'; ?>">
          <a class="nav-link" href="about_us.php" style="color: #333; font-weight: 500; margin-right: 20px;">About</a>
        </li>
        <li class="nav-item <?php if($active=='need') echo 'active'; ?>">
          <a class="nav-link" href="need_blood.php" style="color: #333; font-weight: 500; margin-right: 20px;">Find Blood</a>
        </li>
        <li class="nav-item <?php if($active=='contact') echo 'active'; ?>">
          <a class="nav-link" href="contact_us.php" style="color: #333; font-weight: 500; margin-right: 20px;">Contact</a>
        </li>
        <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #333; font-weight: 500; margin-right: 15px;">
            <?php 
            $displayName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Account';
            echo htmlspecialchars($displayName);
            ?>
          </a>
                      <div class="dropdown-menu user-dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: 1px solid #eee; min-width: 200px;">
              <a class="dropdown-item" href="change_user_password.php" style="color: #333; font-weight: 500; padding: 10px 20px;">
                <i class="fas fa-key" style="margin-right: 10px; color: #666;"></i>Change Password
              </a>
              <a class="dropdown-item" href="logout.php" style="color: #333; font-weight: 500; padding: 10px 20px;">
                <i class="fas fa-sign-out-alt" style="margin-right: 10px; color: #666;"></i>Logout
              </a>
            </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #333; font-size: 1.2em; margin-right: 15px; position:relative;">
            <i class="fas fa-bell"></i>
            <span id="notif-badge" style="display:none;position:absolute;top:-5px;right:-5px;background:#dc3545;color:#fff;font-size:0.7em;padding:2px 6px;border-radius:50%;font-weight:bold;"></span>
          </a>
          <div class="dropdown-menu notif-dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown" style="background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: 1px solid #eee; min-width: 300px; max-height: 400px; overflow-y: auto;">
            <div id="notif-content" style="padding: 15px;">
              <span class="text-muted">Loading notifications...</span>
            </div>
          </div>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="btn btn-outline-secondary" href="login.php" style="border: 1px solid #ddd; color: #333; font-weight: 500; margin-right: 10px; border-radius: 6px; padding: 8px 20px;">Login</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger" href="signup.php" style="background: #dc3545; border: none; color: #fff; font-weight: 500; border-radius: 6px; padding: 8px 20px;">Register</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* Navbar separation effect */
.navbar {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  width: 100% !important;
  z-index: 1000;
  background: #fff !important;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
  border-bottom: 1px solid rgba(0,0,0,0.05) !important;
}

/* Add subtle background to body to enhance separation */
body {
  background: #fafafa;
  margin-top: 80px;
}

/* Main content wrapper to create separation */
#page-container {
  background: #fff;
  margin-top: 0;
  box-shadow: 0 0 0 rgba(0,0,0,0);
}

.navbar-nav .nav-link:hover {
  color: #dc3545 !important;
}
.navbar-nav .nav-item.active .nav-link {
  background: #dc3545 !important;
  color: #fff !important;
  font-weight: 600 !important;
  border-radius: 6px;
  padding: 8px 16px !important;
}
.user-dropdown-menu .dropdown-item:hover {
  background: #f8f9fa !important;
  color: #dc3545 !important;
}
.btn-outline-secondary:hover {
  background: #f8f9fa !important;
  border-color: #dc3545 !important;
  color: #dc3545 !important;
}
.btn-danger:hover {
  background: #c82333 !important;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(220,53,69,0.3);
}
</style>

<script>
$(document).ready(function(){
  function updateNotifBadge() {
    $.get('notifications.php?count=1', function(data){
      var count = parseInt(data, 10);
      if (!isNaN(count) && count > 0) {
        $('#notif-badge').text(count).show();
      } else {
        $('#notif-badge').hide();
      }
    });
  }
  // Update badge on page load
  updateNotifBadge();
  // Optionally, update every 60s
  setInterval(updateNotifBadge, 60000);

  $('#notifDropdown').on('click', function(e){
    e.preventDefault();
    $.get('notifications.php', function(data){
      $('#notif-content').html(data);
      // After opening, mark all as seen
      $.get('notifications.php?mark_seen=1', function(){
        updateNotifBadge();
      });
    });
  });
});
</script>
