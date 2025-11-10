<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Learn how to register as a blood donor at BloodX and get your membership donor card">
  <meta name="author" content="">
  <title>Become a Donor - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <?php 
  $active ='donate';
  include('head.php') ?>

  <div id="page-container">
    <div id="content-wrap">
      
      <!-- Hero Section -->
      <section class="register-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Become</span> <span class="text-dark">a Donor</span></h1>
              <p class="hero-description">
                Become a registered blood donor at BloodX and receive your official membership donor card. Join our community of lifesavers today.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Registration Process Section -->
      <section class="process-section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="section-title text-center">Registration Process</h2>
              <p class="section-subtitle text-center">Follow these simple steps to become an eligible donor</p>
            </div>
          </div>
          
          <div class="row mt-5">
            <!-- Step 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">1</div>
                <div class="step-icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="step-title">Visit Our Office</h3>
                <p class="step-description">
                  Visit the BloodX office during our business hours (Mon-Fri: 9AM-6PM, Sat: 10AM-4PM) at Patandhoka, Lalitpur. No appointment needed for registration.
                </p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">2</div>
                <div class="step-icon">
                  <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="step-title">Complete Registration Form</h3>
                <p class="step-description">
                  Fill out our donor registration form with your personal information, medical history, and contact details. Our staff will assist you throughout the process.
                </p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">3</div>
                <div class="step-icon">
                  <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="step-title">Health Screening</h3>
                <p class="step-description">
                  Undergo a quick health screening including blood pressure check, hemoglobin test, and basic health questionnaire to ensure you're eligible to donate.
                </p>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">4</div>
                <div class="step-icon">
                  <i class="fas fa-id-card"></i>
                </div>
                <h3 class="step-title">Receive Your Donor Card</h3>
                <p class="step-description">
                  Once approved, you'll receive your official BloodX membership donor card. This card contains your unique donor ID and important information.
                </p>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">5</div>
                <div class="step-icon">
                  <i class="fas fa-heart"></i>
                </div>
                <h3 class="step-title">You're Eligible to Donate</h3>
                <p class="step-description">
                  Congratulations! You're now a registered BloodX donor and eligible to donate blood. You'll be added to our donor database for matching.
                </p>
              </div>
            </div>

            <!-- Step 6 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="process-card">
                <div class="step-number">6</div>
                <div class="step-icon">
                  <i class="fas fa-bell"></i>
                </div>
                <h3 class="step-title">Get Notified</h3>
                <p class="step-description">
                  When recipients need your blood type, you'll receive notifications through our system. You can choose to respond and help save a life.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Requirements Section -->
      <section class="requirements-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="requirements-card">
                <h3 class="card-title">
                  <i class="fas fa-check-circle text-danger"></i> Eligibility Requirements
                </h3>
                <ul class="requirements-list">
                  <li><i class="fas fa-check text-success"></i> Age between 18-65 years</li>
                  <li><i class="fas fa-check text-success"></i> Weight at least 50 kg</li>
                  <li><i class="fas fa-check text-success"></i> Good general health</li>
                  <li><i class="fas fa-check text-success"></i> Hemoglobin level: 12.5 g/dL (men) or 12.0 g/dL (women)</li>
                  <li><i class="fas fa-check text-success"></i> No recent illness or infection</li>
                  <li><i class="fas fa-check text-success"></i> No high-risk behaviors</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="requirements-card">
                <h3 class="card-title">
                  <i class="fas fa-file-alt text-danger"></i> What to Bring
                </h3>
                <ul class="requirements-list">
                  <li><i class="fas fa-id-card text-info"></i> Valid government-issued ID (Citizenship, License, or Passport)</li>
                  <li><i class="fas fa-phone text-info"></i> Contact information (phone number and email)</li>
                  <li><i class="fas fa-map-marker-alt text-info"></i> Complete address with location details</li>
                  <li><i class="fas fa-history text-info"></i> Medical history (if applicable)</li>
                  <li><i class="fas fa-clock text-info"></i> About 30-45 minutes of your time</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Benefits Section -->
      <section class="benefits-section">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="section-title">Benefits of Being a Registered Donor</h2>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="benefit-card">
                <i class="fas fa-heartbeat benefit-icon"></i>
                <h4>Free Health Check</h4>
                <p>Regular health screenings and blood tests at no cost</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="benefit-card">
                <i class="fas fa-certificate benefit-icon"></i>
                <h4>Official Donor Card</h4>
                <p>Receive your membership card as proof of registration</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="benefit-card">
                <i class="fas fa-users benefit-icon"></i>
                <h4>Join a Community</h4>
                <p>Become part of a network of lifesavers making a difference</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="benefit-card">
                <i class="fas fa-gift benefit-icon"></i>
                <h4>Recognition</h4>
                <p>Get recognized for your contributions to saving lives</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="contact-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="contact-card">
                <h3 class="contact-title">
                  <i class="fas fa-map-marker-alt text-danger"></i> Visit Our Office
                </h3>
                <div class="contact-info">
                  <p><strong>Address:</strong> Patandhoka, Lalitpur</p>
                  <p><strong>Phone:</strong> +977 9866717332</p>
                  <p><strong>Email:</strong> legal@bloodx.org.np</p>
                  <p><strong>Hours:</strong> Mon-Fri: 9AM-6PM, Sat: 10AM-4PM</p>
                </div>
                <div class="contact-buttons mt-4">
                  <a href="contact_us.php" class="btn btn-outline-danger btn-lg">
                    <i class="fas fa-envelope"></i> Contact Us
                  </a>
                  <a href="eligibility.php" class="btn btn-danger btn-lg">
                    <i class="fas fa-info-circle"></i> Check Eligibility
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <?php include 'footer.php' ?>
  </div>

<style>
/* Page Isolation */
#page-container {
  position: relative;
  z-index: 1;
}

#content-wrap {
  position: relative;
  z-index: 1;
}

/* Basic page styling */
body {
  background: #fff;
  color: #333;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

/* Hide unwanted sections from home.css */
.hero-section,
.mission-section,
.features-section,
.how-it-works-section,
.find-blood-section,
.testimonials-section,
.hospitals-section,
.stats-section {
  display: none !important;
}

/* Hero Section */
.register-hero {
  background: #fff;
  color: #333;
  padding: 80px 0;
  text-align: center;
  position: relative;
  z-index: 1;
}

.hero-title {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #333;
  margin-top: 4rem !important;
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

/* Process Section */
.process-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.section-subtitle {
  font-size: 1.1rem;
  color: #666;
}

.process-card {
  background: #fff;
  border-radius: 12px;
  padding: 40px 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  transition: transform 0.3s ease;
  text-align: center;
  height: 100%;
  position: relative;
}

.process-card:hover {
  transform: translateY(-5px);
}

.step-number {
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%);
  background: #dc3545;
  color: #fff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1.2rem;
  box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
}

.step-icon {
  font-size: 3rem;
  color: #dc3545;
  margin: 20px 0 20px 0;
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
  font-size: 0.95rem;
}

/* Requirements Section */
.requirements-section {
  background: #fff;
  padding: 80px 0;
}

.requirements-card {
  background: #f8f9fa;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  height: 100%;
}

.card-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 25px;
}

.requirements-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.requirements-list li {
  padding: 12px 0;
  border-bottom: 1px solid #e9ecef;
  color: #666;
  font-size: 1rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.requirements-list li:last-child {
  border-bottom: none;
}

.requirements-list li i {
  font-size: 1.1rem;
}

/* Benefits Section */
.benefits-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.benefit-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
  transition: transform 0.3s ease;
  height: 100%;
}

.benefit-card:hover {
  transform: translateY(-5px);
}

.benefit-icon {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.benefit-card h4 {
  font-size: 1.2rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.benefit-card p {
  color: #666;
  line-height: 1.6;
  font-size: 0.95rem;
}

/* Contact Section */
.contact-section {
  background: #fff;
  padding: 80px 0;
}

.contact-card {
  background: #f8f9fa;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
}

.contact-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 30px;
}

.contact-info {
  text-align: left;
  max-width: 500px;
  margin: 0 auto;
}

.contact-info p {
  color: #666;
  font-size: 1rem;
  margin-bottom: 15px;
  line-height: 1.6;
}

.contact-info strong {
  color: #333;
}

.contact-buttons {
  display: flex;
  gap: 15px;
  justify-content: center;
  flex-wrap: wrap;
}

.btn {
  padding: 12px 30px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-danger {
  background: #dc3545;
  border: none;
  color: #fff;
}

.btn-danger:hover {
  background: #c82333;
  transform: translateY(-2px);
  color: #fff;
}

.btn-outline-danger {
  border: 2px solid #dc3545;
  color: #dc3545;
  background: transparent;
}

.btn-outline-danger:hover {
  background: #dc3545;
  color: #fff;
  border-color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .process-card,
  .requirements-card,
  .benefit-card,
  .contact-card {
    padding: 30px 20px;
  }
  
  .contact-buttons {
    flex-direction: column;
  }
  
  .contact-buttons .btn {
    width: 100%;
  }
}
</style>

</body>
</html>

