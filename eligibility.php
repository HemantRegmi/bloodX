<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Eligibility - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .eligibility-hero-section, .eligibility-header, .section-title {
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
      <section class="eligibility-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Blood Donation</span> <span class="text-dark">Eligibility</span></h1>
              <p class="hero-description">
                Learn about the requirements and criteria for blood donation. Your health and safety are our top priorities.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Basic Requirements -->
      <section class="requirements-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="requirement-card">
                <h3 class="requirement-title">Basic Requirements</h3>
                <div class="requirement-item">
                  <i class="fas fa-birthday-cake"></i>
                  <div class="requirement-content">
                    <h4>Age</h4>
                    <p>18-65 years old (16-17 with parental consent)</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-weight"></i>
                  <div class="requirement-content">
                    <h4>Weight</h4>
                    <p>At least 110 pounds (50 kg)</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-heartbeat"></i>
                  <div class="requirement-content">
                    <h4>Health</h4>
                    <p>In good general health and feeling well</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-calendar-alt"></i>
                  <div class="requirement-content">
                    <h4>Frequency</h4>
                    <p>Wait 56 days between whole blood donations</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="requirement-card">
                <h3 class="requirement-title">Health Screening</h3>
                <div class="requirement-item">
                  <i class="fas fa-thermometer-half"></i>
                  <div class="requirement-content">
                    <h4>Temperature</h4>
                    <p>Normal body temperature (98.6°F/37°C)</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-tachometer-alt"></i>
                  <div class="requirement-content">
                    <h4>Blood Pressure</h4>
                    <p>Systolic: 90-180 mmHg, Diastolic: 50-100 mmHg</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-tint"></i>
                  <div class="requirement-content">
                    <h4>Hemoglobin</h4>
                    <p>At least 12.5 g/dL for females, 13.0 g/dL for males</p>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="fas fa-pulse"></i>
                  <div class="requirement-content">
                    <h4>Pulse</h4>
                    <p>Regular pulse between 50-100 beats per minute</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Temporary Deferrals -->
      <section class="deferrals-section">
        <div class="container">
          <h2 class="section-title text-center">Temporary Deferrals</h2>
          <p class="section-description text-center">
            Some conditions may temporarily prevent you from donating. Here are common reasons:
          </p>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="deferral-card">
                <div class="deferral-icon">
                  <i class="fas fa-pills"></i>
                </div>
                <h4>Medications</h4>
                <ul>
                  <li>Antibiotics (wait until finished)</li>
                  <li>Blood thinners (consult doctor)</li>
                  <li>Accutane (wait 1 month)</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="deferral-card">
                <div class="deferral-icon">
                  <i class="fas fa-plane"></i>
                </div>
                <h4>Travel</h4>
                <ul>
                  <li>Malaria-endemic areas (wait 3 months)</li>
                  <li>Zika virus areas (wait 4 weeks)</li>
                  <li>COVID-19 travel restrictions</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="deferral-card">
                <div class="deferral-icon">
                  <i class="fas fa-cut"></i>
                </div>
                <h4>Procedures</h4>
                <ul>
                  <li>Dental work (wait 24-72 hours)</li>
                  <li>Minor surgery (wait 1 week)</li>
                  <li>Major surgery (wait 6 months)</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Permanent Deferrals -->
      <section class="permanent-deferrals">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="permanent-card">
                <h3 class="permanent-title">Permanent Deferrals</h3>
                <p class="permanent-description">
                  Some conditions permanently prevent blood donation to ensure recipient safety:
                </p>
                <div class="permanent-list">
                  <div class="permanent-item">
                    <i class="fas fa-times-circle text-danger"></i>
                    <span>HIV/AIDS or risk factors</span>
                  </div>
                  <div class="permanent-item">
                    <i class="fas fa-times-circle text-danger"></i>
                    <span>Hepatitis B or C</span>
                  </div>
                  <div class="permanent-item">
                    <i class="fas fa-times-circle text-danger"></i>
                    <span>Certain cancers</span>
                  </div>
                  <div class="permanent-item">
                    <i class="fas fa-times-circle text-danger"></i>
                    <span>Creutzfeldt-Jakob disease</span>
                  </div>
                  <div class="permanent-item">
                    <i class="fas fa-times-circle text-danger"></i>
                    <span>Babesiosis or Chagas disease</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Check Eligibility -->
      <section class="check-eligibility">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="check-title">Not Sure About Your Eligibility?</h2>
              <p class="check-description">
                Our medical staff will conduct a thorough screening before your donation. 
                When in doubt, contact us or visit a donation center for a consultation.
              </p>
              <div class="check-buttons">
                <a href="contact_us.php" class="btn btn-outline-danger btn-lg">
                  <i class="fas fa-phone"></i> Contact Us
                </a>
                <a href="register_donor.php" class="btn btn-danger btn-lg">
                  <i class="fas fa-heart"></i> Become a Donor
                </a>
              </div>
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
.eligibility-hero {
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

/* Requirements Section */
.requirements-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.requirement-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  height: 100%;
}

.requirement-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 25px;
  text-align: center;
}

.requirement-item {
  display: flex;
  align-items: flex-start;
  gap: 15px;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #f0f0f0;
}

.requirement-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.requirement-item i {
  font-size: 1.5rem;
  color: #dc3545;
  margin-top: 5px;
  flex-shrink: 0;
}

.requirement-content h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 5px;
}

.requirement-content p {
  color: #666;
  margin: 0;
  line-height: 1.5;
}

/* Deferrals Section */
.deferrals-section {
  background: #fff;
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

.deferral-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
  height: 100%;
  transition: transform 0.3s ease;
}

.deferral-card:hover {
  transform: translateY(-5px);
}

.deferral-icon {
  font-size: 2.5rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.deferral-card h4 {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.deferral-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
  text-align: left;
}

.deferral-card li {
  padding: 8px 0;
  color: #666;
  border-bottom: 1px solid #f0f0f0;
  position: relative;
  padding-left: 20px;
}

.deferral-card li:before {
  content: "•";
  color: #dc3545;
  font-weight: bold;
  position: absolute;
  left: 0;
}

.deferral-card li:last-child {
  border-bottom: none;
}

/* Permanent Deferrals */
.permanent-deferrals {
  background: #f8f9fa;
  padding: 80px 0;
}

.permanent-card {
  background: #fff;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
}

.permanent-title {
  font-size: 2rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
}

.permanent-description {
  font-size: 1.1rem;
  color: #666;
  margin-bottom: 30px;
}

.permanent-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.permanent-item {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 15px;
  background: #f8f9fa;
  border-radius: 8px;
  text-align: left;
}

.permanent-item i {
  font-size: 1.2rem;
  flex-shrink: 0;
}

.permanent-item span {
  color: #333;
  font-weight: 500;
}

/* Check Eligibility */
.check-eligibility {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  color: #fff;
  padding: 80px 0;
  text-align: center;
}

.check-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #fff;
}

.check-description {
  font-size: 1.2rem;
  margin-bottom: 40px;
  opacity: 0.9;
}

.check-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.check-buttons .btn {
  padding: 15px 30px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.check-buttons .btn-outline-danger {
  color: #fff;
  border: 2px solid #fff;
  background: transparent;
}

.check-buttons .btn-outline-danger:hover {
  background: #fff;
  color: #dc3545;
  transform: translateY(-2px);
}

.check-buttons .btn-danger {
  background: #fff;
  color: #dc3545;
  border: 2px solid #fff;
}

.check-buttons .btn-danger:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .check-title {
    font-size: 2rem;
  }
  
  .check-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .check-buttons .btn {
    width: 100%;
    max-width: 300px;
  }
}
</style>

</body>
</html> 