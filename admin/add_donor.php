<?php 
include 'session.php'; 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Donor - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern Add Donor Styling */
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .content-wrapper {
      margin-left: 250px;
      padding: 2rem;
      min-height: calc(100vh - 80px);
    }

    .page-header {
      margin-bottom: 2rem;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      color: #666;
      font-size: 1.1rem;
    }

    .form-card {
      background: #fff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
    }

    .form-section {
      margin-bottom: 2rem;
    }

    .form-section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid #f0f0f0;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
      display: block;
    }

    .required {
      color: #dc3545;
    }

    .form-control {
      border: 1px solid #e9ecef;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-control:invalid {
      border-color: #dc3545;
    }

    .btn.btn-submit {
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      padding: 0.75rem 2rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
    }

    .btn.btn-submit:hover {
      background: #c82333 !important;
      color: #fff !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .form-row {
      margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .form-card {
        padding: 1.5rem;
      }
      
      .page-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "add";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="page-header">
    <h1 class="page-title">Add New Donor</h1>
    <p class="page-subtitle">Register a new blood donor in the system</p>
  </div>

  <div class="form-card">
    <form name="donor" action="save_donor_data.php" method="post" class="add-donor-form">
      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-user text-danger"></i> Personal Information
        </h3>
        
        <div class="row form-row">
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Full Name <span class="required">*</span></label>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Mobile Number <span class="required">*</span></label>
            <input type="tel" name="mobileno" class="form-control" required>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="emailid" class="form-control">
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-heartbeat text-danger"></i> Medical Information
        </h3>
        
        <div class="row form-row">
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Age <span class="required">*</span></label>
            <input type="number" name="age" class="form-control" min="18" max="65" required>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Gender <span class="required">*</span></label>
            <select name="gender" class="form-control" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Blood Group <span class="required">*</span></label>
            <select name="blood" class="form-control" required>
              <option value="">Select Blood Group</option>
              <?php
                include 'conn.php';
                $sql = "SELECT * FROM blood";
                $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                while($row = mysqli_fetch_assoc($result)){
              ?>
                <option value="<?php echo $row['blood_group']; ?>"><?php echo $row['blood_group']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-map-marker-alt text-danger"></i> Address Information
        </h3>
        
        <div class="row form-row">
          <div class="col-12 mb-3">
            <label class="form-label">Full Address <span class="required">*</span></label>
            <textarea class="form-control" name="address" rows="3" required placeholder="Enter complete address"></textarea>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-globe text-danger"></i> Location & Donation History
        </h3>
        
        <div class="row form-row">
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Latitude</label>
            <input type="number" name="latitude" class="form-control" step="any" placeholder="e.g., 27.7172" id="latitudeInput">
            <small class="form-text text-muted">Geographic latitude coordinate</small>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Longitude</label>
            <input type="number" name="longitude" class="form-control" step="any" placeholder="e.g., 85.3240" id="longitudeInput">
            <small class="form-text text-muted">Geographic longitude coordinate</small>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Use My Location</label>
            <button type="button" class="btn btn-outline-secondary form-control" id="btnUseLocation" style="height: calc(1.5em + 1.5rem + 2px);">
              <i class="fas fa-location-arrow"></i> Get Location
            </button>
            <div id="geoStatus" style="margin-top: 5px; font-size: 0.85rem; color: #666; display: none;"></div>
          </div>
        </div>
        
        <div class="row form-row">
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Last Donation Date</label>
            <input type="date" name="last_donation_date" class="form-control" max="<?php echo date('Y-m-d'); ?>" id="lastDonationDate">
            <small class="form-text text-muted">Date of donor's last blood donation</small>
          </div>
          <div class="col-lg-4 col-md-6 mb-3">
            <label class="form-label">Availability Score</label>
            <input type="number" name="availability_score" class="form-control" min="1" max="10" placeholder="1-10">
            <small class="form-text text-muted">Donor availability rating (optional)</small>
          </div>
        </div>
      </div>

      <div class="form-section">
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-submit">
              <i class="fas fa-lock"></i> Save Donor Information
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
// Geolocation functionality
document.addEventListener('DOMContentLoaded', function() {
  const btnUseLoc = document.getElementById('btnUseLocation');
  const latInput = document.getElementById('latitudeInput');
  const lngInput = document.getElementById('longitudeInput');
  const geoStatus = document.getElementById('geoStatus');

  function setGeoStatus(text, isError = false) {
    if (!geoStatus) return;
    geoStatus.style.display = 'block';
    geoStatus.style.color = isError ? '#dc3545' : '#28a745';
    geoStatus.textContent = text;
  }

  btnUseLoc?.addEventListener('click', function() {
    if (!navigator.geolocation) {
      setGeoStatus('Geolocation is not supported by your browser.', true);
      return;
    }
    
    setGeoStatus('Detecting location...');
    btnUseLoc.disabled = true;
    
    navigator.geolocation.getCurrentPosition(
      function(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        
        if (latInput) latInput.value = lat.toFixed(7);
        if (lngInput) lngInput.value = lng.toFixed(7);
        
        setGeoStatus(`Location captured: ${lat.toFixed(5)}, ${lng.toFixed(5)}`);
        btnUseLoc.disabled = false;
      },
      function(err) {
        setGeoStatus('Could not get location. Please allow access and try again.', true);
        btnUseLoc.disabled = false;
      },
      { enableHighAccuracy: true, timeout: 8000, maximumAge: 0 }
    );
  });
});
</script>

<?php if(isset($_GET['success']) && $_GET['success'] == '1'): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  Swal.fire({
    icon: 'success',
    title: 'Donor Added Successfully!',
    text: 'The donor information has been saved to the database.',
    showConfirmButton: true,
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'OK'
  });
});
</script>
<?php endif; ?>

</body>
</html>

<?php
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Access Denied - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .access-denied {
      background: #fff;
      border-radius: 12px;
      padding: 3rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
    }
    
    .access-denied i {
      font-size: 4rem;
      color: #dc3545;
      margin-bottom: 1rem;
    }
    
    .access-denied h2 {
      color: #333;
      margin-bottom: 1rem;
    }
    
    .access-denied p {
      color: #666;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <div class="access-denied">
    <i class="fas fa-lock"></i>
    <h2>Access Denied</h2>
    <p>Please login first to access the admin portal.</p>
    <a href="../login.php" class="btn btn-danger">
      <i class="fas fa-sign-in-alt"></i> Go to Login
    </a>
  </div>
</body>
</html>
<?php
}
?>
