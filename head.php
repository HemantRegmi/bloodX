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
        <li class="nav-item <?php if($active=='donate') echo 'active'; ?>">
          <a class="nav-link" href="donate_blood.php" style="color: #fff; font-weight: 600;">Become A Donor</a>
        </li>
        <li class="nav-item <?php if($active=='need') echo 'active'; ?>">
          <a class="nav-link" href="need_blood.php" style="color: #fff; font-weight: 600;">Need Blood</a>
        </li>
        <li class="nav-item <?php if($active=='contact') echo 'active'; ?>">
          <a class="nav-link" href="contact_us.php" style="color: #fff; font-weight: 600;">Contact Us</a>
        </li>
        <li class="nav-item <?php if($active=='login') echo 'active'; ?>">
          <a class="nav-link" href="http://localhost/Blood-Bank-And-Donation-Management-System-master/admin/login.php" style="color: #fff; font-weight: 600;">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
