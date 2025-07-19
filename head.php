<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #b1001a 0%, #ff1744 100%); box-shadow: 0 2px 12px rgba(200,0,0,0.13);">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="home.php" style="font-size: 2rem; letter-spacing: 1px; color: #fff;">BloodX</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if($active=='home') echo 'active'; ?>">
          <a class="nav-link" href="home.php" style="color: #fff; font-weight: 600;">Home</a>
        </li>
        <li class="nav-item <?php if($active=='about') echo 'active'; ?>">
          <a class="nav-link" href="about_us.php" style="color: #fff; font-weight: 600;">About Us</a>
        </li>
        <li class="nav-item <?php if($active=='why') echo 'active'; ?>">
          <a class="nav-link" href="why_donate_blood.php" style="color: #fff; font-weight: 600;">Why Donate Blood</a>
        </li>
        <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item <?php if($active=='donate') echo 'active'; ?>">
          <a class="nav-link" href="donate_blood.php" style="color: #fff; font-weight: 600;">Become A Donor</a>
        </li>
        <li class="nav-item <?php if($active=='need') echo 'active'; ?>">
          <a class="nav-link" href="need_blood.php" style="color: #fff; font-weight: 600;">Need Blood</a>
        </li>
        <li class="nav-item <?php if($active=='contact') echo 'active'; ?>">
          <a class="nav-link" href="contact_us.php" style="color: #fff; font-weight: 600;">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-weight: 600;">
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
          </a>
          <div class="dropdown-menu user-dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="background: linear-gradient(120deg, #fff 80%, #ffe6ea 100%); border-radius: 14px; box-shadow: 0 4px 24px rgba(220,53,69,0.10); border: 1.5px solid #ff1744; min-width: 210px;">
            <a class="dropdown-item" href="change_user_password.php" style="color: #b1001a; font-weight: 600;">Change Password</a>
            <a class="dropdown-item" href="logout.php" style="color: #b1001a; font-weight: 600;">Logout</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size: 1.3em; margin-right: 10px; position:relative;">
            <i class="fa fa-bell"></i>
            <span id="notif-badge" style="display:none;position:absolute;top:2px;right:2px;background:#dc3545;color:#fff;font-size:0.75em;padding:2px 6px;border-radius:50%;font-weight:bold;box-shadow:0 1px 4px rgba(220,53,69,0.18);z-index:10;"></span>
          </a>
          <div class="dropdown-menu notif-dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown" style="background: linear-gradient(120deg, #fff 80%, #ffe6ea 100%); border-radius: 14px; box-shadow: 0 4px 24px rgba(220,53,69,0.10); border: 1.5px solid #ff1744; min-width: 270px; max-height: 350px; overflow-y: auto;">
            <div id="notif-content" style="min-width:220px; padding: 10px 10px 0 10px;">
              <span class="text-muted">Loading notifications...</span>
            </div>
          </div>
        </li>
        <?php else: ?>
        <li class="nav-item <?php if($active=='login') echo 'active'; ?>">
          <a class="nav-link" href="login.php" style="color: #fff; font-weight: 600;">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.user-dropdown-menu .dropdown-item:hover,
.login-dropdown-menu .dropdown-item:hover {
  background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%) !important;
  color: #fff !important;
  border-radius: 8px;
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

  // Add 0.5s delay to Login button in navbar
  $("a.nav-link[href='login.php']").on('click', function(e) {
    e.preventDefault();
    var link = this.href;
    setTimeout(function() {
      window.location.href = link;
    }, 500);
  });
});
</script>
