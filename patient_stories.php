<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Patient Stories - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .patient-hero-section, .patient-header, .section-title {
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
      <section class="stories-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Patient</span> <span class="text-dark">Stories</span></h1>
              <p class="hero-description">
                Real stories from people whose lives were saved by blood donors. Every donation makes a difference.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Featured Story -->
      <section class="featured-story">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="featured-card">
                <div class="story-header">
                  <div class="story-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="story-info">
                    <h3 class="story-title">Sara's Miracle Recovery</h3>
                    <div class="story-meta">
                      <span class="story-age">28 years old</span>
                      <span class="story-location">Lalitpur, Nepal</span>
                    </div>
                  </div>
                </div>
                <div class="story-content">
                  <p>"I was in a serious car accident and lost a lot of blood. The doctors said I needed an immediate transfusion. Thanks to bloodX, they found compatible donors within hours. I'm alive today because of the generosity of strangers who donated blood."</p>
                  <p>"The blood I received was from multiple donors - people I'll never meet but who saved my life. Now I'm fully recovered and planning to become a blood donor myself to help others in need."</p>
                </div>
                <div class="story-footer">
                  <div class="blood-info">
                    <i class="fas fa-tint text-danger"></i>
                    <span>Received: 4 units of O+ blood</span>
                  </div>
                  <div class="recovery-status">
                    <i class="fas fa-heart text-success"></i>
                    <span>Fully recovered</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- More Stories -->
      <section class="more-stories">
        <div class="container">
          <h2 class="section-title text-center">More Stories of Hope</h2>
          <div class="row">
            <div class="col-lg-6 mb-4">
              <div class="story-card">
                <div class="story-header">
                  <div class="story-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="story-info">
                    <h4 class="story-title">Rahul's Battle with Cancer</h4>
                    <div class="story-meta">
                      <span class="story-age">45 years old</span>
                      <span class="story-location">Kathmandu, Nepal</span>
                    </div>
                  </div>
                </div>
                <div class="story-content">
                  <p>"During my chemotherapy treatment, I needed regular blood transfusions. bloodX connected me with donors who provided the blood I needed to continue my treatment. Today, I'm cancer-free and grateful for every donor who helped me through this journey."</p>
                </div>
                <div class="story-footer">
                  <div class="blood-info">
                    <i class="fas fa-tint text-danger"></i>
                    <span>Received: 8 units of A+ blood</span>
                  </div>
                  <div class="recovery-status">
                    <i class="fas fa-heart text-success"></i>
                    <span>Cancer-free</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="story-card">
                <div class="story-header">
                  <div class="story-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="story-info">
                    <h4 class="story-title">Priya's Emergency Surgery</h4>
                    <div class="story-meta">
                      <span class="story-age">32 years old</span>
                      <span class="story-location">Pokhara, Nepal</span>
                    </div>
                  </div>
                </div>
                <div class="story-content">
                  <p>"I had complications during childbirth and needed an emergency C-section. I lost a lot of blood and needed an immediate transfusion. bloodX helped the hospital find donors quickly. My baby and I are both healthy today thanks to blood donors."</p>
                </div>
                <div class="story-footer">
                  <div class="blood-info">
                    <i class="fas fa-tint text-danger"></i>
                    <span>Received: 3 units of B+ blood</span>
                  </div>
                  <div class="recovery-status">
                    <i class="fas fa-heart text-success"></i>
                    <span>Mother and baby healthy</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="story-card">
                <div class="story-header">
                  <div class="story-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="story-info">
                    <h4 class="story-title">Amit's Road to Recovery</h4>
                    <div class="story-meta">
                      <span class="story-age">19 years old</span>
                      <span class="story-location">Biratnagar, Nepal</span>
                    </div>
                  </div>
                </div>
                <div class="story-content">
                  <p>"I was diagnosed with thalassemia and needed regular blood transfusions. bloodX made it easy for my family to find donors. The donors became like family to us. I'm now studying medicine and want to help others like me."</p>
                </div>
                <div class="story-footer">
                  <div class="blood-info">
                    <i class="fas fa-tint text-danger"></i>
                    <span>Received: 15+ units of O- blood</span>
                  </div>
                  <div class="recovery-status">
                    <i class="fas fa-heart text-success"></i>
                    <span>Managing condition well</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="story-card">
                <div class="story-header">
                  <div class="story-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="story-info">
                    <h4 class="story-title">Meena's Heart Surgery</h4>
                    <div class="story-meta">
                      <span class="story-age">56 years old</span>
                      <span class="story-location">Dharan, Nepal</span>
                    </div>
                  </div>
                </div>
                <div class="story-content">
                  <p>"I needed open-heart surgery and the doctors required blood to be available. bloodX helped coordinate with multiple donors to ensure I had the blood I needed. The surgery was successful and I'm back to my normal life."</p>
                </div>
                <div class="story-footer">
                  <div class="blood-info">
                    <i class="fas fa-tint text-danger"></i>
                    <span>Received: 6 units of AB+ blood</span>
                  </div>
                  <div class="recovery-status">
                    <i class="fas fa-heart text-success"></i>
                    <span>Fully recovered</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Impact Statistics -->
      <section class="impact-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="impact-card">
                <div class="impact-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="impact-number">500+</div>
                <div class="impact-label">Lives Saved</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="impact-card">
                <div class="impact-icon">
                  <i class="fas fa-tint"></i>
                </div>
                <div class="impact-number">2,000+</div>
                <div class="impact-label">Units Donated</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="impact-card">
                <div class="impact-icon">
                  <i class="fas fa-heart"></i>
                </div>
                <div class="impact-number">1,500+</div>
                <div class="impact-label">Donors Registered</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="impact-card">
                <div class="impact-icon">
                  <i class="fas fa-hospital"></i>
                </div>
                <div class="impact-number">25+</div>
                <div class="impact-label">Partner Hospitals</div>
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
              <h2 class="cta-title">Be Part of Someone's Story</h2>
              <p class="cta-description">
                Your blood donation could be the difference between life and death for someone in need. Join our community of lifesavers today.
              </p>
              <div class="cta-buttons">
                <a href="register_donor.php" class="btn btn-danger btn-lg">
                  <i class="fas fa-heart"></i> Become a Donor
                </a>
                <a href="need_blood.php" class="btn btn-outline-danger btn-lg">
                  <i class="fas fa-search"></i> Find Blood
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
.stories-hero {
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

/* Featured Story */
.featured-story {
  background: #f8f9fa;
  padding: 80px 0;
}

.featured-card {
  background: #fff;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.story-header {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 25px;
}

.story-avatar {
  font-size: 4rem;
  color: #dc3545;
}

.story-info {
  flex: 1;
}

.story-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 8px;
}

.story-meta {
  display: flex;
  gap: 20px;
  color: #666;
  font-size: 0.95rem;
}

.story-content {
  margin-bottom: 25px;
}

.story-content p {
  color: #666;
  line-height: 1.7;
  margin-bottom: 15px;
  font-size: 1.1rem;
}

.story-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 20px;
  border-top: 1px solid #f0f0f0;
}

.blood-info, .recovery-status {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: 600;
}

.blood-info {
  color: #dc3545;
}

.recovery-status {
  color: #28a745;
}

/* More Stories */
.more-stories {
  background: #fff;
  padding: 80px 0;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 50px;
}

.story-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  height: 100%;
  transition: transform 0.3s ease;
}

.story-card:hover {
  transform: translateY(-5px);
}

.story-card .story-header {
  margin-bottom: 20px;
}

.story-card .story-avatar {
  font-size: 3rem;
}

.story-card .story-title {
  font-size: 1.3rem;
  margin-bottom: 5px;
}

.story-card .story-content p {
  font-size: 1rem;
  margin-bottom: 0;
}

.story-card .story-footer {
  padding-top: 15px;
  margin-top: 15px;
}

/* Impact Section */
.impact-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.impact-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  text-align: center;
  transition: transform 0.3s ease;
}

.impact-card:hover {
  transform: translateY(-5px);
}

.impact-icon {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 15px;
}

.impact-number {
  font-size: 2.5rem;
  font-weight: 900;
  color: #333;
  margin-bottom: 10px;
}

.impact-label {
  font-size: 1.1rem;
  color: #666;
  font-weight: 600;
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
  
  .cta-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .cta-buttons .btn {
    width: 100%;
    max-width: 300px;
  }
  
  .story-meta {
    flex-direction: column;
    gap: 5px;
  }
  
  .story-footer {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
  }
}
</style>

</body>
</html> 