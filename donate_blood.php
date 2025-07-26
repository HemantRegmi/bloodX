<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include 'conn.php';
    $donor_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $donor_number = mysqli_real_escape_string($conn, $_POST['mobileno']);
    $donor_mail = mysqli_real_escape_string($conn, $_POST['emailid']);
    $donor_age = mysqli_real_escape_string($conn, $_POST['age']);
    $donor_gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $donor_blood_id = mysqli_real_escape_string($conn, $_POST['blood']);
    $donor_address = mysqli_real_escape_string($conn, $_POST['address']);

    // Get blood group name from blood table
    $bg_query = mysqli_query($conn, "SELECT blood_group FROM blood WHERE blood_id = '{$donor_blood_id}' LIMIT 1");
    $donor_blood = '';
    if ($bg_row = mysqli_fetch_assoc($bg_query)) {
        $donor_blood = $bg_row['blood_group'];
    }

    $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
            VALUES ('$donor_name', '$donor_number', '$donor_mail', '$donor_age', '$donor_gender', '$donor_blood', '$donor_address')";
    if (mysqli_query($conn, $sql)) {
        header("Location: donate_blood.php?success=1");
        exit;
    } else {
        echo '<div class="alert alert-danger text-center" style="margin-top:20px;">Error submitting form. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Donate Blood - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background: #f8f9fa !important;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif !important;
      margin: 0 !important;
      padding: 0 !important;
      min-height: 100vh !important;
    }

    #page-container {
      margin-top: 0 !important;
      position: relative !important;
      min-height: 100vh !important;
      background: #f8f9fa !important;
    }

    #content-wrap {
      padding: 60px 0 !important;
      background: #f8f9fa !important;
    }

    .donate-container {
      max-width: 800px !important;
      margin: 0 auto !important;
      padding: 0 20px !important;
    }

    .donate-card {
      background: #fff !important;
      border-radius: 12px !important;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
      padding: 40px !important;
      border: 1px solid #f0f0f0 !important;
    }

    .donate-title {
      font-size: 2.5rem !important;
      font-weight: 800 !important;
      color: #333 !important;
      text-align: center !important;
      margin-bottom: 40px !important;
      margin-top: 4rem !important;
    }

    .form-group {
      margin-bottom: 25px !important;
    }

    .form-label {
      display: block !important;
      margin-bottom: 8px !important;
      font-weight: 600 !important;
      color: #333 !important;
      font-size: 1rem !important;
    }

    .required {
      color: #dc3545 !important;
    }

    .form-control {
      width: 100% !important;
      padding: 12px 15px !important;
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      font-size: 1rem !important;
      transition: border-color 0.3s ease !important;
      background: #fff !important;
    }

    select.form-control {
      appearance: none !important;
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
      background-position: right 12px center !important;
      background-repeat: no-repeat !important;
      background-size: 16px 12px !important;
      padding-right: 40px !important;
      cursor: pointer !important;
      position: relative !important;
      z-index: 1 !important;
    }

    .form-control:focus {
      outline: none !important;
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }

    .form-control::placeholder {
      color: #adb5bd !important;
    }

    select.form-control option {
      color: #333 !important;
      background: #fff !important;
      padding: 8px !important;
      font-size: 1rem !important;
      border: none !important;
    }

    select.form-control option:first-child {
      color: #adb5bd !important;
    }

    /* Ensure dropdown options are visible */
    select.form-control:focus option {
      display: block !important;
    }

    /* Fix for dropdown overflow */
    .form-group {
      margin-bottom: 25px !important;
      position: relative !important;
      overflow: visible !important;
    }

    .donate-card {
      background: #fff !important;
      border-radius: 12px !important;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
      padding: 40px !important;
      border: 1px solid #f0f0f0 !important;
      overflow: visible !important;
    }

    textarea.form-control {
      resize: vertical !important;
      min-height: 100px !important;
    }

    .submit-btn {
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      border-radius: 8px !important;
      padding: 14px 40px !important;
      font-size: 1.1rem !important;
      font-weight: 600 !important;
      cursor: pointer !important;
      transition: all 0.3s ease !important;
      display: inline-block !important;
      text-decoration: none !important;
    }

    .submit-btn:hover {
      background: #c82333 !important;
      transform: translateY(-2px) !important;
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
      color: #fff !important;
      text-decoration: none !important;
    }

    .alert {
      border-radius: 8px !important;
      margin-bottom: 20px !important;
      padding: 12px 15px !important;
    }

    @media (max-width: 768px) {
      .donate-card {
        padding: 30px 20px !important;
      }
      
      .donate-title {
        font-size: 2rem !important;
        margin-bottom: 30px !important;
      }
    }

    /* Additional dropdown fixes */
    select.form-control {
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      appearance: none !important;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
      background-position: right 12px center !important;
      background-repeat: no-repeat !important;
      background-size: 16px 12px !important;
      padding: 12px 15px !important;
      padding-right: 40px !important;
      cursor: pointer !important;
      position: relative !important;
      z-index: 1 !important;
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      font-size: 1rem !important;
      line-height: 1.5 !important;
      height: 48px !important;
      transition: border-color 0.3s ease !important;
      background-color: #fff !important;
    }

    /* Ensure dropdown options are fully visible */
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

    /* Remove blue highlight and fix placeholder styling */
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

    /* Remove any browser default highlighting */
    select.form-control option:focus {
      background: #f8f9fa !important;
      color: #333 !important;
    }

    /* Remove default browser selection highlighting */
    select.form-control option:-moz-focusring {
      color: transparent !important;
      text-shadow: 0 0 0 #333 !important;
    }

    /* Ensure no blue highlighting on any option */
    select.form-control option:active,
    select.form-control option:focus,
    select.form-control option:target {
      background: #f8f9fa !important;
      color: #333 !important;
    }

    /* Remove any default browser styling */
    select.form-control {
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      appearance: none !important;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
      background-position: right 12px center !important;
      background-repeat: no-repeat !important;
      background-size: 16px 12px !important;
      padding: 12px 15px !important;
      padding-right: 40px !important;
      cursor: pointer !important;
      position: relative !important;
      z-index: 1 !important;
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      font-size: 1rem !important;
      line-height: 1.5 !important;
      height: 48px !important;
      transition: border-color 0.3s ease !important;
      background-color: #fff !important;
      box-sizing: border-box !important;
    }

    /* Remove focus outline that might cause blue highlighting */
    select.form-control:focus {
      outline: none !important;
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }

    /* Additional fix for browser-specific highlighting */
    select.form-control option::-ms-expand {
      display: none !important;
    }

    select.form-control option::-webkit-select-placeholder {
      color: #adb5bd !important;
    }

    /* Fix for container overflow */
    .donate-container {
      max-width: 800px !important;
      margin: 0 auto !important;
      padding: 0 20px !important;
      overflow: visible !important;
    }

    #content-wrap {
      padding: 60px 0 !important;
      background: #f8f9fa !important;
      overflow: visible !important;
    }
  </style>
</head>

<body>
<?php
$active ='donate';
include('head.php');

// Show success message as popup if redirected after submit
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'success',
          title: 'Donation Submitted Successfully!',
          text: 'Thank you for your willingness to donate blood. We will contact you soon.',
          confirmButtonText: 'OK',
          confirmButtonColor: '#dc3545'
        });
      });
    </script>
    ";
}
?>

<div id="page-container">
  <div id="content-wrap">
    <div class="donate-container">
      <div class="donate-card">
        <h1 class="donate-title">Become a Donor</h1>
        
        <form name="donor" action="donate_blood.php" method="post">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">
                  Full Name<span class="required">*</span>
                </label>
                <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">
                  Mobile Number<span class="required">*</span>
                </label>
                <input type="tel" name="mobileno" class="form-control" placeholder="Enter mobile number" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">Email Id</label>
                <input type="email" name="emailid" class="form-control" placeholder="Enter email address">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">
                  Age<span class="required">*</span>
                </label>
                <input type="number" name="age" class="form-control" placeholder="Enter your age" min="18" max="65" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">
                  Gender<span class="required">*</span>
                </label>
                <select name="gender" class="form-control" required>
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">
                  Blood Group<span class="required">*</span>
                </label>
                <select name="blood" class="form-control" required>
                  <option value="">Select Blood Group</option>
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
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="form-label">
                  Address<span class="required">*</span>
                </label>
                <input type="text" class="form-control" name="address" placeholder="Enter your complete address" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" name="submit" class="submit-btn">
                <i class="fas fa-heart mr-2"></i>
                Submit Donation
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</div>
</body>
</html>
