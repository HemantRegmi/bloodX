<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FAQs - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add space between navbar and content */
    .faq-hero-section, .faq-header, .section-title {
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
      <section class="faqs-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Frequently Asked</span> <span class="text-dark">Questions</span></h1>
              <p class="hero-description">
                Find answers to common questions about blood donation. Can't find what you're looking for? Contact us!
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- FAQs Section -->
      <section class="faqs-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="faq-accordion" id="faqAccordion">
                
                <!-- General Questions -->
                <div class="faq-category">
                  <h3 class="category-title">General Questions</h3>
                  
                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq1">
                      <h4>How often can I donate blood?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq1" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>You can donate whole blood every 56 days (8 weeks). This allows your body to replenish the red blood cells lost during donation. Platelet donors can donate more frequently, up to 24 times per year.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq2">
                      <h4>How long does the donation process take?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq2" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>The entire process takes about 1 hour, including registration, screening, donation, and recovery. The actual blood collection takes only 8-10 minutes.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq3">
                      <h4>How much blood is collected during donation?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq3" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>One unit of blood (approximately 450-500 ml) is collected during each donation. This represents about 10% of your total blood volume.</p>
                    </div>
                  </div>
                </div>

                <!-- Health & Safety -->
                <div class="faq-category">
                  <h3 class="category-title">Health & Safety</h3>
                  
                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq4">
                      <h4>Is blood donation safe?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq4" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>Yes, blood donation is very safe. We use sterile, single-use equipment for each donation. All staff are trained medical professionals, and we follow strict safety protocols.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq5">
                      <h4>Can I get an infection from donating blood?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq5" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>No, you cannot get an infection from donating blood. All equipment is sterile and used only once. The needle and collection bags are disposed of after each donation.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq6">
                      <h4>What should I do if I feel faint after donation?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq6" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>Stay seated and rest for a few minutes. Drink plenty of fluids and eat the snacks provided. If you continue to feel unwell, inform our staff immediately.</p>
                    </div>
                  </div>
                </div>

                <!-- Eligibility -->
                <div class="faq-category">
                  <h3 class="category-title">Eligibility</h3>
                  
                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq7">
                      <h4>Can I donate if I have a cold or flu?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq7" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>No, you should wait until you are completely recovered from any illness. This helps protect both you and the recipient of your blood.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq8">
                      <h4>Can I donate if I'm taking medication?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq8" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>It depends on the medication. Some medications require a waiting period, while others may permanently defer you. Our staff will review your medications during screening.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq9">
                      <h4>Can I donate if I have tattoos or piercings?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq9" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>Yes, but you must wait 3 months after getting a tattoo or piercing if it was done in a state-regulated facility. If done in an unregulated facility, the wait is 12 months.</p>
                    </div>
                  </div>
                </div>

                <!-- After Donation -->
                <div class="faq-category">
                  <h3 class="category-title">After Donation</h3>
                  
                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq10">
                      <h4>When can I resume normal activities?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq10" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>You can resume most activities immediately. Avoid heavy lifting or strenuous exercise for 5 hours. Drink extra fluids for 24 hours.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq11">
                      <h4>How long should I keep the bandage on?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq11" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>Keep the bandage on for 4-5 hours. After removing it, clean the area with soap and water. If you notice any bleeding, apply pressure and contact us.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <div class="faq-question" data-toggle="collapse" data-target="#faq12">
                      <h4>Will I be notified of my test results?</h4>
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="faq12" class="collapse faq-answer" data-parent="#faqAccordion">
                      <p>Yes, you will be notified of any significant findings from the tests performed on your donated blood. This includes infectious disease testing and blood type confirmation.</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="contact-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="contact-title">Still Have Questions?</h2>
              <p class="contact-description">
                Can't find the answer you're looking for? Our team is here to help!
              </p>
              <div class="contact-buttons">
                <a href="contact_us.php" class="btn btn-danger btn-lg">
                  <i class="fas fa-envelope"></i> Contact Us
                </a>
                <a href="eligibility.php" class="btn btn-outline-danger btn-lg">
                  <i class="fas fa-clipboard-check"></i> Check Eligibility
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
.faqs-hero {
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

/* FAQs Section */
.faqs-section {
  background: #f8f9fa;
  padding: 80px 0;
}

.faq-category {
  margin-bottom: 50px;
}

.category-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 25px;
  padding-bottom: 10px;
  border-bottom: 2px solid #dc3545;
}

.faq-item {
  background: #fff;
  border-radius: 8px;
  margin-bottom: 15px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  overflow: hidden;
}

.faq-question {
  padding: 20px 25px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: background-color 0.3s ease;
  border: none;
  background: #fff;
  width: 100%;
  text-align: left;
}

.faq-question:hover {
  background: #f8f9fa;
}

.faq-question h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #333;
  margin: 0;
  flex: 1;
}

.faq-question i {
  color: #dc3545;
  font-size: 1rem;
  transition: transform 0.3s ease;
  flex-shrink: 0;
  margin-left: 15px;
}

.faq-question[aria-expanded="true"] i {
  transform: rotate(180deg);
}

.faq-answer {
  padding: 0 25px 20px 25px;
  background: #fff;
}

.faq-answer p {
  color: #666;
  line-height: 1.6;
  margin: 0;
}

/* Contact Section */
.contact-section {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  color: #fff;
  padding: 80px 0;
  text-align: center;
}

.contact-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #fff;
}

.contact-description {
  font-size: 1.2rem;
  margin-bottom: 40px;
  opacity: 0.9;
}

.contact-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.contact-buttons .btn {
  padding: 15px 30px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.contact-buttons .btn-danger {
  background: #fff;
  color: #dc3545;
  border: 2px solid #fff;
}

.contact-buttons .btn-danger:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
}

.contact-buttons .btn-outline-danger {
  color: #fff;
  border: 2px solid #fff;
  background: transparent;
}

.contact-buttons .btn-outline-danger:hover {
  background: #fff;
  color: #dc3545;
  transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .contact-title {
    font-size: 2rem;
  }
  
  .contact-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .contact-buttons .btn {
    width: 100%;
    max-width: 300px;
  }
  
  .faq-question {
    padding: 15px 20px;
  }
  
  .faq-answer {
    padding: 0 20px 15px 20px;
  }
}
</style>

<script>
// Smooth accordion animation
$(document).ready(function() {
  $('.faq-question').on('click', function() {
    $(this).find('i').toggleClass('rotate');
  });
});
</script>

</body>
</html> 