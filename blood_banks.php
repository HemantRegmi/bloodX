<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Blood Banks - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .bloodbank-hero-section, .bloodbank-header, .section-title {
      margin-top: 4rem;
    }
  </style>
</head>

<body>
  <?php 
  $active ='need';
  include('head.php') ?>

  <div id="page-container">
    <div id="content-wrap">
      
      <!-- Hero Section -->
      <section class="banks-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Blood</span> <span class="text-dark">Banks</span></h1>
              <p class="hero-description">
                Find trusted blood banks and partner hospitals across Nepal. Connect with facilities that maintain blood supplies and coordinate donations.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Search Section -->
      <section class="search-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="search-card">
                <h3 class="search-title">Find Blood Banks Near You</h3>
                <form class="search-form" id="searchForm">
                  <div class="search-form-row">
                    <div class="form-group flex-grow-1">
                      <select class="form-control" id="location" required>
                        <option value="">Select Location...</option>
                        <option value="kathmandu">Kathmandu</option>
                        <option value="lalitpur">Lalitpur</option>
                        <option value="bhaktapur">Bhaktapur</option>
                        <option value="pokhara">Pokhara</option>
                        <option value="biratnagar">Biratnagar</option>
                        <option value="dharan">Dharan</option>
                        <option value="butwal">Butwal</option>
                        <option value="nepalgunj">Nepalgunj</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-danger search-btn">
                      <i class="fas fa-search"></i> Search
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Search Results Section -->
      <section class="search-results" id="searchResults" style="display: none;">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="results-header">
                <h3 class="results-title">Blood Banks in <span id="selectedLocation"></span></h3>
                <button class="btn btn-outline-secondary btn-sm" onclick="showAllBanks()">
                  <i class="fas fa-times"></i> Clear Search
                </button>
              </div>
              <div class="results-content" id="resultsContent">
                <!-- Results will be populated here -->
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Featured Blood Banks -->
      <section class="featured-banks">
        <div class="container">
          <h2 class="section-title text-center">Featured Blood Banks</h2>
          <div class="row">
            <div class="col-lg-6 mb-4">
              <div class="bank-card featured">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h3 class="bank-name">Nepal Red Cross Society Blood Bank</h3>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available 24/7</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>The largest blood bank in Nepal, operated by Nepal Red Cross Society. Provides blood to hospitals across the country and maintains emergency blood supplies.</p>
                  <div class="bank-stats">
                    <div class="stat-item">
                      <span class="stat-number">10,000+</span>
                      <span class="stat-label">Units Stored</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">50+</span>
                      <span class="stat-label">Hospitals Served</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">24/7</span>
                      <span class="stat-label">Emergency Service</span>
                    </div>
                  </div>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-1-4270650</span>
                    </div>
                    <div class="contact-item">
                      <i class="fas fa-envelope"></i>
                      <span>bloodbank@nrcs.org.np</span>
                    </div>
                  </div>
                  <a href="tel:+97714270650" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-phone"></i> Call Now
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="bank-card featured">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h3 class="bank-name">Tribhuvan University Teaching Hospital</h3>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Maharajgunj, Kathmandu</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available 24/7</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Premier teaching hospital with a comprehensive blood bank facility. Serves as a major referral center and maintains blood supplies for complex surgeries.</p>
                  <div class="bank-stats">
                    <div class="stat-item">
                      <span class="stat-number">5,000+</span>
                      <span class="stat-label">Units Stored</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">100+</span>
                      <span class="stat-label">Daily Patients</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">24/7</span>
                      <span class="stat-label">Emergency Service</span>
                    </div>
                  </div>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-1-4412403</span>
                    </div>
                    <div class="contact-item">
                      <i class="fas fa-envelope"></i>
                      <span>bloodbank@tuth.edu.np</span>
                    </div>
                  </div>
                  <a href="tel:+97714412403" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-phone"></i> Call Now
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- All Blood Banks -->
      <section class="all-banks">
        <div class="container">
          <h2 class="section-title text-center">All Partner Blood Banks</h2>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">B.P. Koirala Institute</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Dharan, Sunsari</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Regional blood bank serving eastern Nepal with comprehensive blood services and emergency support.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-25-520555</span>
                    </div>
                  </div>
                  <a href="tel:+97725520555" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">Pokhara Regional Blood Bank</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Pokhara, Kaski</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Western Nepal's primary blood bank serving hospitals in Pokhara and surrounding districts.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-61-430000</span>
                    </div>
                  </div>
                  <a href="tel:+97761430000" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">Biratnagar Medical College</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Biratnagar, Morang</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Eastern Nepal's medical college blood bank providing blood services to local hospitals.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-21-470000</span>
                    </div>
                  </div>
                  <a href="tel:+97721470000" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">Nepalgunj Medical College</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Nepalgunj, Banke</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Mid-western Nepal's blood bank serving hospitals in Nepalgunj and surrounding areas.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-81-520000</span>
                    </div>
                  </div>
                  <a href="tel:+97781520000" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">Butwal Medical College</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Butwal, Rupandehi</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Lumbini Province's blood bank providing services to hospitals in Butwal and nearby districts.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-71-540000</span>
                    </div>
                  </div>
                  <a href="tel:+97771540000" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="bank-card">
                <div class="bank-header">
                  <div class="bank-logo">
                    <i class="fas fa-hospital"></i>
                  </div>
                  <div class="bank-info">
                    <h4 class="bank-name">Kathmandu Medical College</h4>
                    <div class="bank-meta">
                      <span class="bank-location"><i class="fas fa-map-marker-alt"></i> Sinamangal, Kathmandu</span>
                      <span class="bank-status available"><i class="fas fa-circle"></i> Available</span>
                    </div>
                  </div>
                </div>
                <div class="bank-content">
                  <p>Private medical college blood bank serving Kathmandu Valley with modern blood banking facilities.</p>
                </div>
                <div class="bank-footer">
                  <div class="contact-info">
                    <div class="contact-item">
                      <i class="fas fa-phone"></i>
                      <span>+977-1-4460000</span>
                    </div>
                  </div>
                  <a href="tel:+97714460000" class="btn btn-outline-danger btn-sm">Call</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Blood Bank Services -->
      <section class="services-section">
        <div class="container">
          <h2 class="section-title text-center">Blood Bank Services</h2>
          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-tint"></i>
                </div>
                <h4 class="service-title">Blood Collection</h4>
                <p class="service-description">Professional blood collection from voluntary donors with proper screening and testing.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-microscope"></i>
                </div>
                <h4 class="service-title">Blood Testing</h4>
                <p class="service-description">Comprehensive testing for blood type, infections, and compatibility screening.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-snowflake"></i>
                </div>
                <h4 class="service-title">Blood Storage</h4>
                <p class="service-description">Proper storage and preservation of blood units under controlled conditions.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-ambulance"></i>
                </div>
                <h4 class="service-title">Emergency Supply</h4>
                <p class="service-description">24/7 emergency blood supply to hospitals and medical facilities.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Call to Action -->
      <section class="cta-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="cta-title">Partner With Us</h2>
              <p class="cta-description">
                Are you a hospital or blood bank interested in partnering with bloodX? Join our network to help save more lives.
              </p>
              <div class="cta-buttons">
                <a href="contact_us.php" class="btn btn-danger btn-lg">
                  <i class="fas fa-handshake"></i> Become a Partner
                </a>
                <a href="register_donor.php" class="btn btn-outline-danger btn-lg">
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
.banks-hero {
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

/* Search Section */
.search-section {
  background: #f8f9fa;
  padding: 60px 0;
}

.search-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.search-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

.search-form-row {
  display: flex;
  gap: 15px;
  align-items: center;
}

.search-form-row .form-group {
  margin-bottom: 0;
  overflow: visible;
  position: relative;
}

.search-form-row .form-group select {
  width: 100%;
  max-width: none;
}

.search-form-row .form-control {
  border: 2px solid #dc3545;
  border-radius: 8px;
  padding: 12px 15px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
  background: #fff;
  color: #333;
  height: auto;
  min-height: 48px;
  line-height: 1.5;
  overflow: visible;
  text-overflow: unset;
  white-space: normal;
}

.search-form-row .form-control:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
  outline: none;
}

.search-form-row .form-control option {
  background: #fff;
  color: #333;
  padding: 8px;
  height: auto;
  line-height: 1.5;
  white-space: normal;
  overflow: visible;
}

.search-btn {
  padding: 12px 25px;
  font-weight: 600;
  border-radius: 8px;
  white-space: nowrap;
  background: #dc3545;
  border: 2px solid #dc3545;
  color: #fff;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background: #c82333;
  border-color: #c82333;
  transform: translateY(-1px);
}

/* Featured Banks */
.featured-banks {
  background: #fff;
  padding: 80px 0;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 50px;
}

.bank-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  height: 100%;
  transition: transform 0.3s ease;
}

.bank-card:hover {
  transform: translateY(-5px);
}

.bank-card.featured {
  border: 2px solid #dc3545;
  background: linear-gradient(135deg, #fff 0%, #fff8f8 100%);
}

.bank-header {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
}

.bank-logo {
  font-size: 2.5rem;
  color: #dc3545;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff5f5;
  border-radius: 12px;
}

.bank-info {
  flex: 1;
}

.bank-name {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 8px;
}

.bank-meta {
  display: flex;
  gap: 15px;
  color: #666;
  font-size: 0.9rem;
}

.bank-location {
  display: flex;
  align-items: center;
  gap: 5px;
}

.bank-status {
  display: flex;
  align-items: center;
  gap: 5px;
  font-weight: 600;
}

.bank-status.available {
  color: #28a745;
}

.bank-status.available i {
  font-size: 0.7rem;
}

.bank-content {
  margin-bottom: 20px;
}

.bank-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 15px;
}

.bank-stats {
  display: flex;
  gap: 20px;
  margin-top: 15px;
}

.stat-item {
  text-align: center;
  flex: 1;
}

.stat-number {
  display: block;
  font-size: 1.2rem;
  font-weight: 900;
  color: #dc3545;
}

.stat-label {
  font-size: 0.8rem;
  color: #666;
  font-weight: 600;
}

.bank-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 20px;
  border-top: 1px solid #f0f0f0;
}

.contact-info {
  flex: 1;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #666;
  font-size: 0.9rem;
  margin-bottom: 5px;
}

.contact-item i {
  color: #dc3545;
  width: 16px;
}

/* All Banks */
.all-banks {
  background: #f8f9fa;
  padding: 80px 0;
}

.all-banks .bank-card {
  background: #fff;
}

.all-banks .bank-name {
  font-size: 1.1rem;
}

/* Services Section */
.services-section {
  background: #fff;
  padding: 80px 0;
}

.service-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
  height: 100%;
  transition: transform 0.3s ease;
}

.service-card:hover {
  transform: translateY(-5px);
}

.service-icon {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.service-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.service-description {
  color: #666;
  line-height: 1.6;
  margin: 0;
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
  margin-bottom: 40px;
  opacity: 0.9;
}

.cta-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.cta-buttons .btn {
  padding: 15px 30px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.cta-buttons .btn-danger {
  background: #fff;
  color: #dc3545;
  border: 2px solid #fff;
}

.cta-buttons .btn-danger:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
}

.cta-buttons .btn-outline-danger {
  color: #fff;
  border: 2px solid #fff;
  background: transparent;
}

.cta-buttons .btn-outline-danger:hover {
  background: #fff;
  color: #dc3545;
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
  
  .cta-title {
    font-size: 2rem;
  }
  
  .search-form-row {
    flex-direction: column;
  }
  
  .search-btn {
    width: 100%;
  }
  
    .search-form-row .form-control {
    font-size: 16px;
    padding: 15px;
    min-height: 52px;
  }
  
  .bank-meta {
    flex-direction: column;
    gap: 5px;
  }
  
  .bank-stats {
    flex-direction: column;
    gap: 10px;
  }
  
  .bank-footer {
    flex-direction: column;
    gap: 15px;
    align-items: flex-start;
  }
  
  .cta-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .cta-buttons .btn {
    width: 100%;
    max-width: 300px;
  }
}

/* Search Results Styling */
.search-results {
  background: #f8f9fa;
  padding: 60px 0;
}

.results-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.results-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #333;
  margin: 0;
}

.results-title span {
  color: #dc3545;
}

.results-content {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.no-results {
  text-align: center;
  padding: 40px 20px;
  color: #666;
}

.no-results i {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 20px;
}

.no-results h4 {
  color: #333;
  margin-bottom: 10px;
}

.no-results p {
  color: #666;
  margin: 0;
}
</style>

<script>
// Blood bank data
const bloodBanksData = {
  kathmandu: [
    {
      name: "Nepal Red Cross Society Blood Bank",
      location: "Kathmandu, Nepal",
      description: "The largest blood bank in Nepal, operated by Nepal Red Cross Society. Provides blood to hospitals across the country and maintains emergency blood supplies.",
      phone: "+977-1-4270650",
      email: "bloodbank@nrcs.org.np",
      stats: { units: "10,000+", hospitals: "50+", service: "24/7" }
    },
    {
      name: "Tribhuvan University Teaching Hospital",
      location: "Maharajgunj, Kathmandu",
      description: "Premier teaching hospital with a comprehensive blood bank facility. Serves as a major referral center and maintains blood supplies for complex surgeries.",
      phone: "+977-1-4412403",
      email: "bloodbank@tuth.edu.np",
      stats: { units: "5,000+", hospitals: "100+", service: "24/7" }
    },
    {
      name: "Kathmandu Medical College",
      location: "Sinamangal, Kathmandu",
      description: "Private medical college blood bank serving Kathmandu Valley with modern blood banking facilities.",
      phone: "+977-1-4460000",
      email: "bloodbank@kmc.edu.np",
      stats: { units: "3,000+", hospitals: "25+", service: "24/7" }
    }
  ],
  lalitpur: [
    {
      name: "Patan Hospital Blood Bank",
      location: "Lalitpur, Nepal",
      description: "Regional blood bank serving Lalitpur and surrounding areas with comprehensive blood services.",
      phone: "+977-1-5522296",
      email: "bloodbank@patanhospital.gov.np",
      stats: { units: "2,500+", hospitals: "15+", service: "24/7" }
    }
  ],
  bhaktapur: [
    {
      name: "Bhaktapur Hospital Blood Bank",
      location: "Bhaktapur, Nepal",
      description: "Local blood bank serving Bhaktapur district with emergency blood supply services.",
      phone: "+977-1-6610000",
      email: "bloodbank@bhaktapurhospital.gov.np",
      stats: { units: "1,500+", hospitals: "10+", service: "24/7" }
    }
  ],
  pokhara: [
    {
      name: "Pokhara Regional Blood Bank",
      location: "Pokhara, Kaski",
      description: "Western Nepal's primary blood bank serving hospitals in Pokhara and surrounding districts.",
      phone: "+977-61-430000",
      email: "bloodbank@pokhararegional.gov.np",
      stats: { units: "4,000+", hospitals: "30+", service: "24/7" }
    }
  ],
  biratnagar: [
    {
      name: "Biratnagar Medical College",
      location: "Biratnagar, Morang",
      description: "Eastern Nepal's medical college blood bank providing blood services to local hospitals.",
      phone: "+977-21-470000",
      email: "bloodbank@bmc.edu.np",
      stats: { units: "2,000+", hospitals: "20+", service: "24/7" }
    }
  ],
  dharan: [
    {
      name: "B.P. Koirala Institute",
      location: "Dharan, Sunsari",
      description: "Regional blood bank serving eastern Nepal with comprehensive blood services and emergency support.",
      phone: "+977-25-520555",
      email: "bloodbank@bpki.edu.np",
      stats: { units: "3,500+", hospitals: "25+", service: "24/7" }
    }
  ],
  butwal: [
    {
      name: "Butwal Medical College",
      location: "Butwal, Rupandehi",
      description: "Lumbini Province's blood bank providing services to hospitals in Butwal and nearby districts.",
      phone: "+977-71-540000",
      email: "bloodbank@bmcbutwal.edu.np",
      stats: { units: "2,000+", hospitals: "15+", service: "24/7" }
    }
  ],
  nepalgunj: [
    {
      name: "Nepalgunj Medical College",
      location: "Nepalgunj, Banke",
      description: "Mid-western Nepal's blood bank serving hospitals in Nepalgunj and surrounding areas.",
      phone: "+977-81-520000",
      email: "bloodbank@nmc.edu.np",
      stats: { units: "2,500+", hospitals: "20+", service: "24/7" }
    }
  ]
};

// Search functionality
document.getElementById('searchForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const selectedLocation = document.getElementById('location').value;
  
  if (!selectedLocation) {
            Swal.fire({
          title: 'Location Required',
          text: 'Please select a location to search for blood banks.',
          icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'OK'
        });
    return;
  }
  
  searchBloodBanks(selectedLocation);
});

function searchBloodBanks(location) {
  const resultsSection = document.getElementById('searchResults');
  const resultsContent = document.getElementById('resultsContent');
  const selectedLocationSpan = document.getElementById('selectedLocation');
  
  // Update location display
  const locationNames = {
    kathmandu: 'Kathmandu',
    lalitpur: 'Lalitpur',
    bhaktapur: 'Bhaktapur',
    pokhara: 'Pokhara',
    biratnagar: 'Biratnagar',
    dharan: 'Dharan',
    butwal: 'Butwal',
    nepalgunj: 'Nepalgunj'
  };
  
  selectedLocationSpan.textContent = locationNames[location];
  
  // Get blood banks for selected location
  const bloodBanks = bloodBanksData[location] || [];
  
  if (bloodBanks.length === 0) {
    resultsContent.innerHTML = `
      <div class="no-results">
        <i class="fas fa-search"></i>
        <h4>No Blood Banks Found</h4>
        <p>Sorry, no blood banks are currently available in ${locationNames[location]}. Please try another location or contact us for assistance.</p>
      </div>
    `;
  } else {
    let resultsHTML = '<div class="row">';
    
    bloodBanks.forEach(bank => {
      resultsHTML += `
        <div class="col-lg-6 mb-4">
          <div class="bank-card">
            <div class="bank-header">
              <div class="bank-logo">
                <i class="fas fa-hospital"></i>
              </div>
              <div class="bank-info">
                <h4 class="bank-name">${bank.name}</h4>
                <div class="bank-meta">
                  <span class="bank-location"><i class="fas fa-map-marker-alt"></i> ${bank.location}</span>
                  <span class="bank-status available"><i class="fas fa-circle"></i> Available 24/7</span>
                </div>
              </div>
            </div>
            <div class="bank-content">
              <p>${bank.description}</p>
              <div class="bank-stats">
                <div class="stat-item">
                  <span class="stat-number">${bank.stats.units}</span>
                  <span class="stat-label">Units Stored</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number">${bank.stats.hospitals}</span>
                  <span class="stat-label">Hospitals Served</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number">${bank.stats.service}</span>
                  <span class="stat-label">Emergency Service</span>
                </div>
              </div>
            </div>
            <div class="bank-footer">
              <div class="contact-info">
                <div class="contact-item">
                  <i class="fas fa-phone"></i>
                  <span>${bank.phone}</span>
                </div>
                <div class="contact-item">
                  <i class="fas fa-envelope"></i>
                  <span>${bank.email}</span>
                </div>
              </div>
              <a href="tel:${bank.phone.replace(/\s/g, '')}" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-phone"></i> Call Now
              </a>
            </div>
          </div>
        </div>
      `;
    });
    
    resultsHTML += '</div>';
    resultsContent.innerHTML = resultsHTML;
  }
  
  // Show results section and scroll to it
  resultsSection.style.display = 'block';
  resultsSection.scrollIntoView({ behavior: 'smooth' });
  
  // Hide featured and all banks sections
  document.querySelector('.featured-banks').style.display = 'none';
  document.querySelector('.all-banks').style.display = 'none';
}

function showAllBanks() {
  // Hide results section
  document.getElementById('searchResults').style.display = 'none';
  
  // Show featured and all banks sections
  document.querySelector('.featured-banks').style.display = 'block';
  document.querySelector('.all-banks').style.display = 'block';
  
  // Reset form
  document.getElementById('location').value = '';
  
  // Scroll to top
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

</body>
</html> 