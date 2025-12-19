<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BloodX - Your Online Blood Donation Destination</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Flatpickr (popup datepicker) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
      /* Dark red theme to match BloodX */
      .flatpickr-calendar {
        border-radius: 16px !important;
        box-shadow: 0 14px 34px rgba(0,0,0,0.18) !important;
        border: 1px solid rgba(0,0,0,0.06) !important;
        overflow: hidden !important;
      }
      .flatpickr-months,
      .flatpickr-months .flatpickr-month {
        background: #b21f2d !important; /* dark red */
        color: #fff !important;
        padding: 0 12px !important;
        height: 48px !important;
        min-height: 48px !important;
        border-bottom: 1px solid rgba(255,255,255,.12) !important;
      }
      .flatpickr-current-month {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 12px !important;
        width: 100% !important;
        height: 48px !important;
      }
      .flatpickr-current-month .flatpickr-monthDropdown-months,
      .flatpickr-current-month .numInputWrapper input.cur-year {
        background: transparent !important;
        color: #fff !important;
        border: 0 !important;
        border-radius: 0 !important;
        padding: 0 !important;
        font-weight: 700 !important;
        font-size: 18px !important;
        line-height: 1 !important;
      }
      /* Ensure full 4-digit year is visible */
      .flatpickr-current-month .numInputWrapper { min-width: 64px !important; }
      .flatpickr-current-month .numInputWrapper input.cur-year { width: 64px !important; text-align: center !important; }
      .flatpickr-months .flatpickr-prev-month,
      .flatpickr-months .flatpickr-next-month {
        top: 50% !important;
        transform: translateY(-50%) !important;
      }
      .flatpickr-current-month .flatpickr-monthDropdown-months:focus,
      .flatpickr-current-month .numInputWrapper input.cur-year:focus { outline: none !important; box-shadow: 0 0 0 2px rgba(255,255,255,.25) inset !important; }
      .flatpickr-months .flatpickr-prev-month svg,
      .flatpickr-months .flatpickr-next-month svg { fill: #fff !important; }
      .flatpickr-day.selected,
      .flatpickr-day.selected:hover,
      .flatpickr-day.startRange,
      .flatpickr-day.endRange { background: #b21f2d !important; border-color: #b21f2d !important; color: #fff !important; }
      .flatpickr-day.today:not(.selected) { border-color: rgba(178,31,45,.35) !important; color: #b21f2d !important; }

      /* Softer, rounded day cells */
      .flatpickr-day { border-radius: 12px !important; font-weight: 600 !important; }
      .flatpickr-day:hover { background: rgba(178,31,45,.08) !important; }

      /* Rounder controls for month/year selectors */
      .flatpickr-current-month .flatpickr-monthDropdown-months,
      .flatpickr-current-month .numInputWrapper input {
        background: #ffffff !important;
        border: 0 !important;
        border-radius: 8px !important;
        color: #b21f2d !important;
        font-weight: 600 !important;
        padding: 2px 8px !important;
      }
      .flatpickr-current-month .numInputWrapper span.arrowUp::after,
      .flatpickr-current-month .numInputWrapper span.arrowDown::after { border-bottom-color: #fff !important; }
      .flatpickr-current-month .numInputWrapper:hover { background: rgba(255,255,255,.15) !important; }

      /* Prev/Next buttons as rounded icons */
      .flatpickr-months .flatpickr-prev-month,
      .flatpickr-months .flatpickr-next-month {
        border-radius: 50% !important;
        width: 28px !important; height: 28px !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
      }
      .flatpickr-months .flatpickr-prev-month:hover,
      .flatpickr-months .flatpickr-next-month:hover { background: rgba(255,255,255,.15) !important; }
    </style>
</head>

<body>
<div class="header">
<?php
$active="home";
include('head.php'); ?>
</div>

<div id="page-container">
    <div class="container">
        <div id="content-wrap">
            
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content text-center">
                    <h1 class="hero-title">
                        <span class="text-danger">Every Drop,</span><br>
                        <span class="text-dark">Saves Lives</span>
                    </h1>
                    <p class="hero-description">
                        Join our community of life-savers. Every donation can save up to three lives. 
                        Find donors, donation centers, or register to donate today.
                    </p>
                    <div class="hero-buttons">
                        <a href="register_donor.php" class="btn btn-danger btn-lg hero-btn">Become a Donor</a>
                        <a href="need_blood.php" class="btn btn-outline-danger btn-lg hero-btn">Find Blood</a>
                    </div>
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

            <!-- How It Works Section -->
            <section class="how-it-works-section">
                <h2 class="section-title text-center">How It Works</h2>
                <p class="section-description text-center">
                    Donating blood is a simple process that takes less than an hour of your time 
                    but can save multiple lives.
                </p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-search text-danger"></i>
                            </div>
                            <h3 class="step-title">Find a Location</h3>
                            <p class="step-description">
                                Search for nearby donation centers or blood drives based on your location.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-calendar-alt text-danger"></i>
                            </div>
                            <h3 class="step-title">Schedule a Donation</h3>
                            <p class="step-description">
                                Pick a convenient date and time that works best for your schedule.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-clipboard-check text-danger"></i>
                            </div>
                            <h3 class="step-title">Complete Screening</h3>
                            <p class="step-description">
                                Answer a few health questions to ensure your eligibility to donate.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                            </div>
                            <h3 class="step-title">Donate & Save Lives</h3>
                            <p class="step-description">
                                The donation process only takes about 10-15 minutes and can save multiple lives.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" id="scheduleDonationBtn" class="btn btn-danger btn-lg">Schedule Your Donation</a>
                </div>
            </section>

            

            <!-- Testimonials Section -->
            <section class="testimonials-section">
                <h2 class="section-title text-center">What People Say</h2>
                <p class="section-description text-center">
                    Read how bloodX has made a difference in the lives of donors, recipients, and healthcare providers.
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left text-danger"></i>
                            </div>
                            <p class="testimonial-text">
                                I needed a rare blood type for my emergency surgery. bloodX connected me with a donor within hours, saving my life.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <i class="fas fa-user-circle text-danger"></i>
                                </div>
                                <div class="author-info">
                                    <div class="author-name">Sarah Johnson</div>
                                    <div class="author-role">Blood Recipient</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left text-danger"></i>
                            </div>
                            <p class="testimonial-text">
                                As a regular donor, bloodX has made it so easy to schedule donations and track my impact. I've never felt more motivated to donate.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <i class="fas fa-user-circle text-danger"></i>
                                </div>
                                <div class="author-info">
                                    <div class="author-name">Michael Chen</div>
                                    <div class="author-role">Blood Donor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <div class="quote-icon">
                                <i class="fas fa-quote-left text-danger"></i>
                            </div>
                            <p class="testimonial-text">
                                Our hospital has partnered with bloodX for a year now, and we've seen a 40% increase in timely blood supply for critical procedures.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <i class="fas fa-user-circle text-danger"></i>
                                </div>
                                <div class="author-info">
                                    <div class="author-name">Dr. Amelia Patel</div>
                                    <div class="author-role">Hospital Director</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Hospital Partners Section (Preserved from original) -->
            <section class="hospitals-section">
                <h2 class="section-title text-center">Our Partner Hospitals</h2>
                <div class="row">
                    <?php
                    include 'conn.php';
                    $sql = "SELECT * FROM hospitals ORDER BY name ASC";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="hospital-card">
                                <div class="hospital-content">
                                    <div class="hospital-icon">
                                        <i class="fas fa-hospital text-danger"></i>
                                    </div>
                                    <h5 class="hospital-name">
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </h5>
                                </div>
                                <button class="btn btn-outline-danger btn-block reserve-btn" 
                                        data-hospital-id="<?php echo $row['id']; ?>" 
                                        data-hospital-name="<?php echo htmlspecialchars($row['name']); ?>">
                                    Reserve Now
                                </button>
                            </div>
                        </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12"><div class="alert alert-info">No hospitals found.</div></div>';
                    }
                    ?>
                </div>
            </section>

        </div>
    </div>
</div>

<?php include('footer.php');?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function searchDonors() {
    const bloodType = document.getElementById('bloodTypeSelect').value;
    if (!bloodType) {
        Swal.fire({
          title: 'Blood Type Required',
          text: 'Please select a blood type to search for donors.',
          icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'OK'
        });
        return;
    }
    window.location.href = `need_blood.php?blood_type=${bloodType}`;
}

document.querySelectorAll('.reserve-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        <?php if (!isset($_SESSION['user_id'])): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Login Required',
                text: 'Please log in to reserve blood.',
                confirmButtonText: 'OK'
            });
            return;
        <?php endif; ?>
        
        const hospitalId = this.getAttribute('data-hospital-id');
        const hospitalName = this.getAttribute('data-hospital-name');
        
        Swal.fire({
            title: 'Reserve Blood at ' + hospitalName,
            html:
                `<div class="reservation-form">
                    <div class="form-group">
                        <input id="swal-input1" class="swal2-input" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input id="swal-input2" class="swal2-input" placeholder="Contact Number">
                    </div>
                    <div class="form-group">
                        <select id="swal-input4" class="swal2-input">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="swal-input3" class="swal2-input" type="text" placeholder="Reservation Date">
                    </div>
                </div>`,
            showCancelButton: true,
            confirmButtonText: 'Reserve Blood',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            customClass: {
                popup: 'reservation-popup',
                confirmButton: 'reservation-confirm-btn',
                cancelButton: 'reservation-cancel-btn'
            },
            didOpen: () => {
                flatpickr('#swal-input3', {
                    dateFormat: 'Y-m-d',
                    minDate: 'today',
                    disableMobile: true
                });
            },
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value,
                    document.getElementById('swal-input3').value,
                    document.getElementById('swal-input4').value
                ]
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const [name, contact, date, blood_group] = result.value;
                if (!name || !contact || !date || !blood_group) {
                    Swal.fire({
          title: 'Required Fields Missing',
          text: 'Please fill in all required fields before submitting.',
          icon: 'error',
          showConfirmButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'OK'
        });
                    return;
                }
                <?php $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>
                fetch('save_reservation.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `hospital_id=${encodeURIComponent(hospitalId)}&name=${encodeURIComponent(name)}&contact=${encodeURIComponent(contact)}&date=${encodeURIComponent(date)}&blood_group=${encodeURIComponent(blood_group)}<?php if ($user_id) { echo '&user_id=' . $user_id; } ?>`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                                            Swal.fire({
                      title: 'Reservation Saved Successfully!',
                      text: 'Your blood reservation has been saved.',
                      icon: 'success',
                      showConfirmButton: true,
                      confirmButtonColor: '#dc3545',
                      confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                      title: 'Error Saving Reservation',
                      text: data.message || 'Failed to save reservation. Please try again.',
                      icon: 'error',
                      showConfirmButton: true,
                      confirmButtonColor: '#dc3545',
                      confirmButtonText: 'OK'
                    });
                }
            })
            .catch(() => Swal.fire({
              title: 'Error',
              text: 'Failed to save reservation. Please try again.',
              icon: 'error',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            }));
            }
        });
    });
});

// Schedule Donation button -> popup for donation scheduling
document.getElementById('scheduleDonationBtn').addEventListener('click', function(e) {
    e.preventDefault();
    <?php if (!isset($_SESSION['user_id'])): ?>
        Swal.fire({ icon: 'warning', title: 'Login Required', text: 'Please log in to schedule a donation.', confirmButtonText: 'OK' });
        return;
    <?php endif; ?>

    Swal.fire({
        title: 'Schedule a Blood Donation',
        html: `
          <div class="reservation-form" style="text-align: left; max-height: 70vh; overflow-y: auto;">
            <h5 style="color: #dc3545; margin-bottom: 15px; font-weight: 600;">Personal Information</h5>
            <div class="form-group">
              <input id="sched-name" class="swal2-input" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input id="sched-contact" class="swal2-input" placeholder="Contact Number">
            </div>
            <div class="form-group">
              <select id="sched-blood" class="swal2-input">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>
            <div class="form-group">
              <select id="sched-hospital" class="swal2-input">
                <option value="">Select Hospital</option>
                <?php
                  include 'conn.php';
                  $hres = mysqli_query($conn, "SELECT id, name FROM hospitals ORDER BY name ASC");
                  while ($hrow = mysqli_fetch_assoc($hres)) {
                    echo '<option value="'. $hrow['id'] .'">'. htmlspecialchars($hrow['name']) .'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <input id="sched-date" class="swal2-input" type="text" placeholder="Preferred Donation Date">
            </div>
            
            <hr style="margin: 20px 0; border-color: #e9ecef;">
            
            <h5 style="color: #dc3545; margin-bottom: 15px; font-weight: 600;">Health Screening Questions</h5>
            <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;">Please answer the following questions to ensure your eligibility to donate:</p>
            
            <div class="form-group" style="margin-bottom: 20px;">
              <p style="font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.95rem;">1. Are you feeling healthy and well today?</p>
              <div style="display: flex; gap: 20px; margin-left: 10px;">
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q1" value="yes" id="q1-yes" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>Yes</span>
                </label>
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q1" value="no" id="q1-no" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>No</span>
                </label>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 20px;">
              <p style="font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.95rem;">2. Have you donated blood in the last 56 days (8 weeks)?</p>
              <div style="display: flex; gap: 20px; margin-left: 10px;">
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q2" value="yes" id="q2-yes" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>Yes</span>
                </label>
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q2" value="no" id="q2-no" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>No</span>
                </label>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 20px;">
              <p style="font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.95rem;">3. Do you have any cold, flu, or fever symptoms today?</p>
              <div style="display: flex; gap: 20px; margin-left: 10px;">
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q3" value="yes" id="q3-yes" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>Yes</span>
                </label>
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q3" value="no" id="q3-no" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>No</span>
                </label>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 20px;">
              <p style="font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.95rem;">4. Have you had any major surgery in the last 6 months?</p>
              <div style="display: flex; gap: 20px; margin-left: 10px;">
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q4" value="yes" id="q4-yes" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>Yes</span>
                </label>
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q4" value="no" id="q4-no" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>No</span>
                </label>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 20px;">
              <p style="font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.95rem;">5. Are you currently taking any medications?</p>
              <div style="display: flex; gap: 20px; margin-left: 10px;">
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q5" value="yes" id="q5-yes" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>Yes</span>
                </label>
                <label style="display: flex; align-items: center; font-size: 0.95rem; color: #333; cursor: pointer;">
                  <input type="radio" name="health_q5" value="no" id="q5-no" style="margin-right: 8px; accent-color: #dc3545;">
                  <span>No</span>
                </label>
              </div>
            </div>
          </div>
        `,
        width: '600px',
        showCancelButton: true,
        confirmButtonText: 'Schedule Donation',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        didOpen: () => {
          flatpickr('#sched-date', { dateFormat: 'Y-m-d', minDate: 'today', disableMobile: true });
        },
        preConfirm: () => {
          const name = document.getElementById('sched-name').value;
          const contact = document.getElementById('sched-contact').value;
          const date = document.getElementById('sched-date').value;
          const blood = document.getElementById('sched-blood').value;
          const hospitalId = document.getElementById('sched-hospital').value;
          
          // Get health question answers
          const q1 = document.querySelector('input[name="health_q1"]:checked')?.value || '';
          const q2 = document.querySelector('input[name="health_q2"]:checked')?.value || '';
          const q3 = document.querySelector('input[name="health_q3"]:checked')?.value || '';
          const q4 = document.querySelector('input[name="health_q4"]:checked')?.value || '';
          const q5 = document.querySelector('input[name="health_q5"]:checked')?.value || '';
          
          if (!name || !contact || !date || !blood || !hospitalId) {
            Swal.showValidationMessage('Please fill in all personal information fields');
            return false;
          }
          
          if (!q1 || !q2 || !q3 || !q4 || !q5) {
            Swal.showValidationMessage('Please answer all health screening questions');
            return false;
          }
          
          // Check eligibility - if any disqualifying answers
          if (q1 === 'no' || q2 === 'yes' || q3 === 'yes') {
            Swal.showValidationMessage('Based on your answers, you may not be eligible to donate at this time. Please consult with a healthcare provider.');
            return false;
          }
          
          const healthQuestions = {
            q1: q1,
            q2: q2,
            q3: q3,
            q4: q4,
            q5: q5
          };
          
          return { name, contact, date, blood, hospitalId, healthQuestions };
        }
    }).then(res => {
        if (res.isConfirmed) {
            const { name, contact, date, blood, hospitalId, healthQuestions } = res.value;
            <?php $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>
            const healthQuestionsJson = JSON.stringify(healthQuestions);
            fetch('admin/save_donation_schedule.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `hospital_id=${encodeURIComponent(hospitalId)}&name=${encodeURIComponent(name)}&contact=${encodeURIComponent(contact)}&date=${encodeURIComponent(date)}&blood_group=${encodeURIComponent(blood)}&health_questions=${encodeURIComponent(healthQuestionsJson)}<?php if ($user_id) { echo '&user_id=' . $user_id; } ?>`
            }).then(r => r.json()).then(data => {
                if (data.success) {
                    Swal.fire({ title: 'Donation Scheduled', icon: 'success', confirmButtonColor: '#dc3545' });
                } else {
                    Swal.fire({ title: 'Error', text: data.message || 'Failed to save.', icon: 'error', confirmButtonColor: '#dc3545' });
                }
            }).catch(() => Swal.fire({ title: 'Error', text: 'Failed to save donation.', icon: 'error', confirmButtonColor: '#dc3545' }));
        }
    });
});
// Show logout popup if redirected from logout
if (window.location.search.includes('logged_out=1')) {
    Swal.fire({
        title: 'Logged out',
        text: 'You have been successfully logged out.',
        icon: 'info',
        confirmButtonText: 'Log in',
        confirmButtonColor: '#dc3545',
        showCancelButton: true,
        cancelButtonText: 'Stay logged out'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'login.php';
        }
    });
}
</script>

</body>
</html>
