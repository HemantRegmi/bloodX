<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Need Blood - bloodX</title>
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
  $active ='need';
  include('head.php') ?>

  <div id="page-container">
    <div id="content-wrap">
      
      <!-- Hero Section -->
      <section class="need-blood-hero">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="hero-title"><span class="text-danger">Need</span> <span class="text-dark">Blood</span></h1>
              <p class="hero-description">
                Find blood donors in your area quickly and easily. Our network connects you with available donors when you need them most.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Search Section -->
      <section class="search-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="search-card">
                <form name="needblood" action="" method="post">
                  <div class="search-form-row">
                    <div class="form-group">
                      <label class="form-label">Blood Group <span class="required">*</span></label>
                      <select name="blood" class="form-control" required>
                        <option value="" selected disabled>Select Blood Type</option>
                        <?php
                          include 'conn.php';
                          $sql= "select * from blood";
                          $result=mysqli_query($conn,$sql) or die("query unsuccessful.");
                          while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $row['blood_id'] ?>"><?php echo $row['blood_group'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <button type="submit" name="search" class="btn search-btn">
                      <i class="fas fa-search"></i> Search Donors
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Results Section -->
      <?php if(isset($_POST['search'])){ ?>
      <section class="results-section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="results-title">Available Donors</h2>
            </div>
          </div>
          <div class="row">
            <?php
              $bg = $_POST['blood'];
              $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");
              $blood_group_name = "";
              $bg_query = mysqli_query($conn, "SELECT blood_group FROM blood WHERE blood_id = '{$bg}' LIMIT 1");
              if ($bg_row = mysqli_fetch_assoc($bg_query)) {
                  $blood_group_name = $bg_row['blood_group'];
              }
              $sql = "SELECT * FROM donor_details WHERE donor_blood='{$blood_group_name}' ORDER BY rand() LIMIT 6";
              $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
              if(mysqli_num_rows($result)>0)   {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="donor-card">
                <div class="donor-header">
                  <div class="donor-avatar">
                    <i class="fas fa-user-circle"></i>
                  </div>
                  <div class="donor-info">
                    <h3 class="donor-name"><?php echo htmlspecialchars($row['donor_name']); ?></h3>
                    <div class="blood-badge"><?php echo htmlspecialchars($row['donor_blood']); ?></div>
                  </div>
                </div>
                <div class="donor-details">
                  <div class="detail-item">
                    <i class="fas fa-phone text-danger"></i>
                    <span><?php echo htmlspecialchars($row['donor_number']); ?></span>
                  </div>
                  <div class="detail-item">
                    <i class="fas fa-venus-mars text-danger"></i>
                    <span><?php echo htmlspecialchars($row['donor_gender']); ?></span>
                  </div>
                  <div class="detail-item">
                    <i class="fas fa-birthday-cake text-danger"></i>
                    <span><?php echo htmlspecialchars($row['donor_age']); ?> years old</span>
                  </div>
                  <div class="detail-item">
                    <i class="fas fa-map-marker-alt text-danger"></i>
                    <span><?php echo htmlspecialchars($row['donor_address']); ?></span>
                  </div>
                </div>
                <div class="donor-actions">
                  <button class="btn contact-btn" onclick="contactDonor('<?php echo htmlspecialchars($row['donor_number']); ?>')">
                    <i class="fas fa-phone"></i> Contact
                  </button>
                </div>
              </div>
            </div>
            <?php
                }
              } else {
            ?>
            <div class="col-12">
              <div class="no-results">
                <i class="fas fa-search text-muted"></i>
                <h3>No Donors Found</h3>
                <p>We couldn't find any donors for the selected blood group. Please try a different blood type or check back later.</p>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
      </section>
      <?php } ?>

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
.need-blood-hero {
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

/* Search Section */
.search-section {
  background: #fff;
  padding: 60px 0;
}

.search-card {
  background: #fff;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.search-form-row {
  display: flex;
  align-items: end;
  gap: 20px;
}

.search-form-row .form-group {
  flex: 1;
  margin-bottom: 0;
}

.search-form-row .search-btn {
  flex-shrink: 0;
  white-space: nowrap;
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
  line-height: 1.5;
  height: 48px;
}

/* Fix for dropdown in search form */
select.form-control {
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  appearance: none !important;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
  background-position: right 12px center !important;
  background-repeat: no-repeat !important;
  background-size: 16px 12px !important;
  padding-right: 40px !important;
  cursor: pointer !important;
  background-color: #fff !important;
}

select.form-control option {
  color: #333 !important;
  background: #fff !important;
  padding: 8px 12px !important;
  font-size: 1rem !important;
  line-height: 1.5 !important;
  border: none !important;
  display: block !important;
}

select.form-control option:hover {
  background: #f8f9fa !important;
  color: #333 !important;
}

select.form-control option:checked {
  background: #dc3545 !important;
  color: #fff !important;
}

/* Remove blue highlighting from placeholder */
select.form-control option[value=""] {
  background: #fff !important;
  color: #adb5bd !important;
}

select.form-control option[value=""]:hover {
  background: #f8f9fa !important;
  color: #adb5bd !important;
}

select.form-control option[value=""]:checked {
  background: #fff !important;
  color: #adb5bd !important;
}

/* Remove browser default highlighting */
select.form-control option:focus {
  background: #f8f9fa !important;
  color: #333 !important;
}

select.form-control option:-moz-focusring {
  color: transparent !important;
  text-shadow: 0 0 0 #333 !important;
}

select.form-control option:active,
select.form-control option:focus,
select.form-control option:target {
  background: #f8f9fa !important;
  color: #333 !important;
}

select.form-control option::-ms-expand {
  display: none !important;
}

select.form-control option::-webkit-select-placeholder {
  color: #adb5bd !important;
}

.form-control:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
  outline: none !important;
}

.search-btn {
  background: #dc3545;
  border: none;
  color: #fff;
  padding: 12px 25px;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background: #c82333;
  transform: translateY(-1px);
  color: #fff;
}

/* Results Section */
.results-section {
  background: linear-gradient(135deg, #e8eaed 0%, #ffffff 50%, #e8eaed 100%) !important;
  border-radius: 16px;
  padding: 40px 0;
  margin-top: 2rem;
}

.results-title {
  font-size: 2rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 40px;
  text-align: center;
  margin-top: 4rem !important;
}

.donor-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
  transition: transform 0.3s ease;
  height: 100%;
}

.donor-card:hover {
  transform: translateY(-5px);
}

.donor-header {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
}

.donor-avatar {
  font-size: 3rem;
  color: #dc3545;
}

.donor-info {
  flex: 1;
}

.donor-name {
  font-size: 1.3rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 8px;
}

.blood-badge {
  background: #dc3545;
  color: #fff;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-block;
}

.donor-details {
  margin-bottom: 20px;
}

.detail-item {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 12px;
  color: #666;
  font-size: 0.95rem;
}

.detail-item i {
  width: 16px;
  flex-shrink: 0;
}

.contact-btn {
  background: #dc3545;
  border: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 6px;
  font-weight: 600;
  transition: all 0.3s ease;
  width: 100%;
}

.contact-btn:hover {
  background: #c82333;
  color: #fff;
}

.no-results {
  text-align: center;
  padding: 60px 20px;
  color: #666;
}

.no-results i {
  font-size: 4rem;
  margin-bottom: 20px;
}

.no-results h3 {
  font-size: 1.5rem;
  margin-bottom: 15px;
  color: #333;
}

.find-title {
  font-size: 2.5rem !important;
  font-weight: 800 !important;
  color: #333 !important;
  text-align: center !important;
  margin-bottom: 40px !important;
  margin-top: 4rem !important;
}


/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .search-card {
    padding: 30px 20px;
  }
  
  .search-form-row {
    flex-direction: column;
    gap: 15px;
  }
  
  .search-form-row .search-btn {
    width: 100%;
  }
  
  .donor-card {
    padding: 20px;
  }
}
</style>

<script>
function contactDonor(phoneNumber) {
  // You can implement phone call functionality here
          Swal.fire({
          title: 'Contacting Donor',
          text: 'Contacting donor at: ' + phoneNumber,
          icon: 'info',
          showConfirmButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'OK'
        });
}

// Auto-scroll to results after search
document.addEventListener('DOMContentLoaded', function() {
  // Check if there are search results (results section exists)
  const resultsSection = document.querySelector('.results-section');
  if (resultsSection) {
    // Smooth scroll to results section
    resultsSection.scrollIntoView({ 
      behavior: 'smooth', 
      block: 'start' 
    });
  }
});

// Also handle form submission to ensure scroll happens
document.querySelector('form[name="needblood"]').addEventListener('submit', function() {
  // Small delay to ensure form processes first
  setTimeout(function() {
    const resultsSection = document.querySelector('.results-section');
    if (resultsSection) {
      resultsSection.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'start' 
      });
    }
  }, 100);
});
</script>

</body>
</html>
