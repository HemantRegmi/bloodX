<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Reservation Form Styling */
        .reservation-popup {
            border-radius: 12px !important;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1) !important;
        }
        
        .reservation-form {
            text-align: left;
            margin: 1rem 0;
        }
        
        .reservation-form .form-group {
            margin-bottom: 1rem;
        }
        
        .reservation-form .swal2-input {
            width: 100% !important;
            border: 1px solid #e9ecef !important;
            border-radius: 8px !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            margin: 0 !important;
            box-sizing: border-box !important;
            height: auto !important;
            min-height: 48px !important;
            line-height: 1.5 !important;
        }
        
        .reservation-form .swal2-input:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            outline: none !important;
        }
        
        .reservation-form .swal2-input::placeholder {
            color: #6c757d !important;
            opacity: 1 !important;
        }
        
        /* Specific styling for select dropdown */
        .reservation-form select.swal2-input {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 1rem center !important;
            background-size: 1em !important;
            padding-right: 2.5rem !important;
            overflow: visible !important;
            text-overflow: unset !important;
            white-space: normal !important;
        }
        
        .reservation-form select.swal2-input option {
            padding: 0.5rem 1rem !important;
            font-size: 1rem !important;
            line-height: 1.5 !important;
            background: white !important;
            color: #333 !important;
        }
        
        .reservation-confirm-btn {
            background: #dc3545 !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
        }
        
        .reservation-confirm-btn:hover {
            background: #c82333 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
        }
        
        .reservation-cancel-btn {
            border-radius: 8px !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
        }
        
        .reservation-cancel-btn:hover {
            transform: translateY(-1px) !important;
        }
        
        /* SweetAlert2 Title Styling */
        .swal2-title {
            color: #333 !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
        }
        
        /* SweetAlert2 Content Styling */
        .swal2-html-container {
            margin: 1rem 0 !important;
        }

        /* Add space between navbar and hero content */
        .hero-section {
            margin-top: 8rem;
        }
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
                        <a href="donate_blood.php" class="btn btn-danger btn-lg hero-btn">Donate Blood</a>
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
                    <a href="donate_blood.php" class="btn btn-danger btn-lg">Schedule Your Donation</a>
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
                        <input id="swal-input3" class="swal2-input" type="date" placeholder="Reservation Date">
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
