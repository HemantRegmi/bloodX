<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .about-hero-section {
      margin-top: 4rem;
    }
  </style>
</head>
<body>

<?php 
$active ='about';
include('head.php');
?>

<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      
      <!-- About Hero Section -->
      <section class="about-hero-section">
        <div class="text-center">
          <h1 class="section-title">About BloodX</h1>
          <p class="about-description">
            bloodX is a community-driven platform connecting blood donors with recipients and hospitals to ensure timely access to life-saving blood donations.
          </p>
        </div>
      </section>

      <!-- Statistics Section -->
      <section class="stats-section">
        <div class="row">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-number">10K+</div>
              <div class="stat-label">Blood Donors</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-number">25K+</div>
              <div class="stat-label">Lives Saved</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-number">100+</div>
              <div class="stat-label">Partner Hospitals</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our Mission Section -->
      <section class="mission-section">
        <h2 class="section-title text-center">Our Mission</h2>
        <p class="mission-text text-center">
          To create a world where no one dies due to lack of access to blood, 
          by building the largest community of voluntary blood donors and connecting 
          them seamlessly to those in need.
        </p>
      </section>

      <!-- Features Section -->
      <section class="features-section">
        <div class="row">
          <div class="col-md-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fas fa-check-circle text-danger"></i>
              </div>
              <h3 class="feature-title">Fast & Safe</h3>
              <p class="feature-description">
                Our donation process is quick, safe, and follows all health standards.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fas fa-heart text-danger"></i>
              </div>
              <h3 class="feature-title">Save Lives</h3>
              <p class="feature-description">
                Your single donation can save up to three lives in critical need.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fas fa-users text-danger"></i>
              </div>
              <h3 class="feature-title">Community</h3>
              <p class="feature-description">
                Join our community of donors making a difference every day.
              </p>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
  <?php include('footer.php') ?>
</div>

<style>
.about-hero-section {
  padding: 80px 0 60px 0;
  background: #fff;
  text-align: center;
}

.about-description {
  font-size: 1.2rem;
  color: #666;
  max-width: 800px;
  margin: 0 auto 40px auto;
  line-height: 1.8;
}

.about-hero-section .section-title {
  margin-bottom: 30px;
}
</style>

</body>
</html>
