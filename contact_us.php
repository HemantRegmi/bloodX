<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

include 'conn.php';
if(isset($_POST["send"])){
  $name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $sql = "INSERT INTO contact_query (query_name, query_mail, query_number, query_message, query_status) VALUES ('$name', '$email', '$subject', '$message', 0)";
  $result=mysqli_query($conn,$sql) or die("query unsuccessful.");
  header("Location: contact_us.php?sent=1");
  exit;
}
?>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php $active ='contact';
include 'head.php'; ?>

<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      
      <!-- Contact Hero Section -->
      <section class="contact-hero-section">
        <div class="text-center">
          <h1 class="section-title">Contact Us</h1>
          <p class="contact-description">
            Have questions or need assistance? Reach out to our team and we'll be happy to help.
          </p>
        </div>
      </section>

      <!-- Contact Content Section -->
      <section class="contact-content-section">
        <div class="row">
          <!-- Contact Form -->
          <div class="col-lg-7 mb-4">
            <div class="contact-form-card">
              <h3 class="form-title">Send Us a Message</h3>
              <form name="sentMessage" method="post">
                <div class="form-group">
                  <label class="form-label">Your Name <span class="required">*</span></label>
                  <input type="text" class="form-control" id="name" name="fullname" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Email Address <span class="required">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="How can we help you?">
                </div>
                <div class="form-group">
                  <label class="form-label">Message <span class="required">*</span></label>
                  <textarea rows="6" class="form-control" id="message" name="message" placeholder="Your message here..." required maxlength="999" style="resize:none"></textarea>
                </div>
                <div class="form-group text-center">
                  <button type="submit" name="send" class="btn btn-danger btn-lg">Send Message</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="col-lg-5 mb-4">
            <div class="contact-info-section">
              <div class="contact-info-item">
                <div class="contact-info-content">
                  <div class="contact-icon">
                    <i class="fas fa-phone text-danger"></i>
                  </div>
                  <div class="contact-details">
                    <h5 class="contact-title">Phone</h5>
                    <p class="contact-text">+977 9866717332</p>
                  </div>
                </div>
              </div>

              <div class="contact-info-item">
                <div class="contact-info-content">
                  <div class="contact-icon">
                    <i class="fas fa-envelope text-danger"></i>
                  </div>
                  <div class="contact-details">
                    <h5 class="contact-title">Email</h5>
                    <p class="contact-text">legal@bloodx.org.np</p>
                  </div>
                </div>
              </div>

              <div class="contact-info-item">
                <div class="contact-info-content">
                  <div class="contact-icon">
                    <i class="fas fa-map-marker-alt text-danger"></i>
                  </div>
                  <div class="contact-details">
                    <h5 class="contact-title">Address</h5>
                    <p class="contact-text">Patandhoka, Lalitpur</p>
                  </div>
                </div>
              </div>

              <div class="contact-info-item">
                <div class="contact-info-content">
                  <div class="contact-icon">
                    <i class="fas fa-clock text-danger"></i>
                  </div>
                  <div class="contact-details">
                    <h5 class="contact-title">Hours</h5>
                    <p class="contact-text">Mon-Fri: 9AM-6PM, Sat: 10AM-4PM</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
  <?php include 'footer.php' ?>
</div>

<style>
.contact-hero-section {
  padding: 80px 0 60px 0;
  background: #fff;
  text-align: center;
}

.contact-description {
  font-size: 1.2rem;
  color: #666;
  max-width: 600px;
  margin: 0 auto 40px auto;
  line-height: 1.6;
}

.contact-content-section {
  padding: 60px 0;
  background: #f8f9fa;
}

.contact-form-card {
  background: #fff;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.form-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 30px;
}

.form-label {
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.required {
  color: #dc3545;
}

.form-control {
  border: 2px solid #e9ecef;
  border-radius: 8px;
  padding: 12px 15px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
}

.form-control:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.contact-info-section {
  height: 100%;
}

.contact-info-item {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  margin-bottom: 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  transition: transform 0.3s ease;
}

.contact-info-item:hover {
  transform: translateY(-3px);
}

.contact-info-content {
  display: flex;
  align-items: flex-start;
  gap: 15px;
}

.contact-icon {
  font-size: 1.5rem;
  margin-top: 5px;
}

.contact-details {
  flex: 1;
}

.contact-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 8px;
}

.contact-text {
  color: #666;
  margin: 0;
  line-height: 1.5;
}

.section-title {
  font-size: 2.5rem !important;
  font-weight: 800 !important;
  color: #333 !important;
  text-align: center !important;
  margin-bottom: 40px !important;
  margin-top: 4rem !important;
}

@media (max-width: 768px) {
  .contact-form-card {
    padding: 30px 20px;
  }
  
  .contact-info-item {
    padding: 20px;
  }
}
</style>

<script>
  <?php if (isset($_GET['sent']) && $_GET['sent'] == 1): ?>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Message Sent Successfully!',
      text: 'We will contact you shortly.',
      confirmButtonColor: '#dc3545'
    });
  });
  <?php endif; ?>
</script>

</body>
</html>
