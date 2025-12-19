<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Donation Process - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .donation-hero-section, .donation-header, .section-title {
      margin-top: 4rem;
    }
  </style>
</head>

<body>
  <?php 
  $active ='donate';
  include('head.php') ?>

  <div id="page-container">
    <div id="content-wrap">
      
      <!-- Hero Section -->
      <section class="process-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Donation</span> <span class="text-dark">Process</span></h1>
              <p class="hero-description">
                Learn about our simple, safe, and efficient blood donation process. Your donation can save up to three lives.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Process Steps -->
      <section class="process-steps">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="step-card">
                <div class="step-icon">
                  <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="step-title">1. Registration</h3>
                <p class="step-description">
                  Complete a brief registration form with your personal information and medical history.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="step-card">
                <div class="step-icon">
                  <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="step-title">2. Screening</h3>
                <p class="step-description">
                  Quick health check including blood pressure, temperature, and hemoglobin test.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="step-card">
                <div class="step-icon">
                  <i class="fas fa-tint"></i>
                </div>
                <h3 class="step-title">3. Donation</h3>
                <p class="step-description">
                  Comfortable donation process that takes about 8-10 minutes to collect one unit.
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="step-card">
                <div class="step-icon">
                  <i class="fas fa-cookie-bite"></i>
                </div>
                <h3 class="step-title">4. Recovery</h3>
                <p class="step-description">
                  Rest and refreshments provided. You can resume normal activities after 24 hours.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- What to Expect -->
      <section class="expectations-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="expectation-card">
                <h3 class="expectation-title">Before Donation</h3>
                <ul class="expectation-list">
                  <li>Get a good night's sleep</li>
                  <li>Eat a healthy meal 3 hours before</li>
                  <li>Drink plenty of fluids</li>
                  <li>Bring a valid ID</li>
                  <li>Avoid alcohol 24 hours before</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="expectation-card">
                <h3 class="expectation-title">After Donation</h3>
                <ul class="expectation-list">
                  <li>Rest for 10-15 minutes</li>
                  <li>Drink extra fluids for 24 hours</li>
                  <li>Avoid heavy lifting for 5 hours</li>
                  <li>Keep the bandage on for 4-5 hours</li>
                  <li>Eat iron-rich foods</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Safety Information -->
      <section class="safety-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="section-title">Your Safety is Our Priority</h2>
              <p class="section-description">
                We follow strict safety protocols to ensure your donation experience is safe and comfortable.
              </p>
              <div class="safety-features">
                <div class="row">
                  <div class="col-md-4">
                    <div class="safety-item">
                      <i class="fas fa-shield-alt"></i>
                      <h4>Sterile Equipment</h4>
                      <p>All equipment is sterile and single-use only</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="safety-item">
                      <i class="fas fa-user-md"></i>
                      <h4>Professional Staff</h4>
                      <p>Trained medical professionals supervise every donation</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="safety-item">
                      <i class="fas fa-certificate"></i>
                      <h4>Quality Standards</h4>
                      <p>We meet all national and international safety standards</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="cta-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="cta-title">Ready to Save Lives?</h2>
              <p class="cta-description">
                Join thousands of donors who are making a difference in their community.
              </p>
              <a href="register_donor.php" class="btn btn-danger btn-lg cta-btn">
                <i class="fas fa-heart"></i> Become a Donor
              </a>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
  <?php include 'footer.php' ?>

<style>
/* Basic page styling */
body {
  background: #fff;
  color: #333;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

/* Hero Section */
.process-hero {
  background: #fff;
  color: #333;
  padding: 80px 0;
  text-align: center;
}

.hero-title {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #333;
}

.hero-title .text-danger {
  color: #dc3545 !important;
}

.hero-title .text-dark {
  color: #333 !important;
}

.hero-description {
  font-size: 1.2rem;
  color: #666;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Process Steps */
.process-steps {
  background: #f8f9fa;
  padding: 80px 0;
}

.step-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  transition: transform 0.3s ease;
  text-align: center;
  height: 100%;
}

.step-card:hover {
  transform: translateY(-5px);
}

.step-icon {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.step-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.step-description {
  color: #666;
  line-height: 1.6;
  margin: 0;
}

/* Expectations Section */
.expectations-section {
  background: #fff;
  padding: 80px 0;
}

.expectation-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  height: 100%;
}

.expectation-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

.expectation-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.expectation-list li {
  padding: 10px 0;
  color: #666;
  border-bottom: 1px solid #f0f0f0;
  position: relative;
  padding-left: 25px;
}

.expectation-list li:before {
  content: "✓";
  color: #dc3545;
  font-weight: bold;
  position: absolute;
  left: 0;
}

.expectation-list li:last-child {
  border-bottom: none;
}

/* Safety Section */
.safety-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
}

.section-description {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 50px;
}

.safety-item {
  text-align: center;
  margin-bottom: 30px;
}

.safety-item i {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.safety-item h4 {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.safety-item p {
  color: #666;
  line-height: 1.6;
}

/* CTA Section */
.cta-section {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  color: #fff;
  padding: 80px 0;
  text-align: center;
}

.cta-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #fff;
}

.cta-description {
  font-size: 1.2rem;
  margin-bottom: 30px;
  opacity: 0.9;
}

.cta-btn {
  background: #fff;
  color: #dc3545;
  border: none;
  padding: 15px 30px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.cta-btn:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255,255,255,0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .cta-title {
    font-size: 2rem;
  }
}
</style>

</body>
</html> 