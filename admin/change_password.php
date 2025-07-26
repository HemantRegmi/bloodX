<?php 
include 'session.php'; 
include 'conn.php';

// Initialize popup variables
$popup_message = '';
$popup_type = '';

// Set active variable for sidebar (change password is not in main nav)
$active = '';

// Process password change
if(isset($_POST["submit"])){
  $username=$_SESSION['username'];
  $password=mysqli_real_escape_string($conn,$_POST["currpassword"]);
  $sql="select * from admin_info where admin_username='$username'";
  $result=mysqli_query($conn,$sql) or die("query failed.");
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_assoc($result)){
      if($password==$row['admin_password']){
        $newpassword=mysqli_real_escape_string($conn,$_POST["newpassword"]);
        $confpassword=mysqli_real_escape_string($conn,$_POST["confirmpassword"]);
        if($newpassword==$confpassword)
        {
          if($newpassword!=$password)
          {
            $update="update admin_info set admin_password='$newpassword' where admin_username='$username'";
            $update_result=mysqli_query($conn,$update);
            if($update_result){
              $popup_message = 'Password Updated Successfully! Your password has been changed successfully.';
              $popup_type = 'success';
            } else {
              $popup_message = 'Error Updating Password. An error occurred while updating your password. Please try again.';
              $popup_type = 'error';
            }
          } else {
            $popup_message = 'Password Change Required. New password should be different from current password.';
            $popup_type = 'warning';
          }
        } else {
          $popup_message = 'Password Mismatch. New password and confirm password do not match.';
          $popup_type = 'error';
        }
      } else {
        $popup_message = 'Incorrect Password. Current password is incorrect. Please try again.';
        $popup_type = 'error';
      }
    }
  }
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern Change Password Styling */
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
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .password-card {
      background: #fff;
      border-radius: 12px;
      padding: 2.5rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      border: 1px solid rgba(0,0,0,0.05);
      max-width: 500px;
      width: 100%;
    }

    .password-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .password-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      color: #fff;
      font-size: 2rem;
    }

    .password-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .password-subtitle {
      color: #666;
      font-size: 1.1rem;
      line-height: 1.5;
    }

    .form-section {
      margin-bottom: 1.5rem;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
      display: block;
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

    .password-container {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #666;
      cursor: pointer;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    .password-toggle:hover {
      color: #dc3545;
    }

    .btn-save {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-save:hover {
      background: #c82333;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .password-strength {
      margin-top: 0.5rem;
      font-size: 0.9rem;
    }

    .strength-weak {
      color: #dc3545;
    }

    .strength-medium {
      color: #ffc107;
    }

    .strength-strong {
      color: #28a745;
    }

    .password-match {
      margin-top: 0.5rem;
      font-size: 0.9rem;
    }

    .match-success {
      color: #28a745;
    }

    .match-error {
      color: #dc3545;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        padding: 1rem;
      }
      
      .password-card {
        padding: 2rem;
      }
      
      .password-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="password-card">
      <div class="password-header">
        <div class="password-icon">
          <i class="fas fa-key"></i>
        </div>
        <h1 class="password-title">Change Password</h1>
        <p class="password-subtitle">Update your admin account password to keep it secure</p>
      </div>
      
      <form method="post" autocomplete="off">
        <div class="form-section">
          <label for="currpassword" class="form-label">Current Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="currpassword" name="currpassword" required>
            <button type="button" class="password-toggle" onclick="togglePassword('currpassword')">
              <i class="fas fa-eye" id="currpassword-icon"></i>
            </button>
          </div>
        </div>
        
        <div class="form-section">
          <label for="newpassword" class="form-label">New Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="newpassword" name="newpassword" required>
            <button type="button" class="password-toggle" onclick="togglePassword('newpassword')">
              <i class="fas fa-eye" id="newpassword-icon"></i>
            </button>
          </div>
          <div class="password-strength" id="password-strength"></div>
        </div>
        
        <div class="form-section">
          <label for="confirmpassword" class="form-label">Confirm New Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
            <button type="button" class="password-toggle" onclick="togglePassword('confirmpassword')">
              <i class="fas fa-eye" id="confirmpassword-icon"></i>
            </button>
          </div>
          <div class="password-match" id="password-match"></div>
        </div>

        <div class="form-section">
          <button class="btn btn-save" name="submit" type="submit">
            <i class="fas fa-save"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php if($popup_message): ?>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: '<?php echo $popup_type; ?>',
      title: '<?php echo explode('.', $popup_message)[0]; ?>',
      text: '<?php echo $popup_message; ?>',
      showConfirmButton: true,
      confirmButtonColor: '#dc3545',
      confirmButtonText: 'OK'
    });
  });
  </script>
  <?php endif; ?>

  <script>
  function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
      field.type = 'text';
      icon.className = 'fas fa-eye-slash';
    } else {
      field.type = 'password';
      icon.className = 'fas fa-eye';
    }
  }

  // Password strength checker
  document.getElementById('newpassword').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('password-strength');
    
    let strength = 0;
    let message = '';
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    if (strength < 3) {
      message = '<span class="strength-weak">Weak password</span>';
    } else if (strength < 4) {
      message = '<span class="strength-medium">Medium strength password</span>';
    } else {
      message = '<span class="strength-strong">Strong password</span>';
    }
    
    strengthDiv.innerHTML = message;
  });

  // Password match checker
  document.getElementById('confirmpassword').addEventListener('input', function() {
    const newPassword = document.getElementById('newpassword').value;
    const confirmPassword = this.value;
    const matchDiv = document.getElementById('password-match');
    
    if (confirmPassword === '') {
      matchDiv.innerHTML = '';
    } else if (newPassword === confirmPassword) {
      matchDiv.innerHTML = '<span class="match-success"><i class="fas fa-check"></i> Passwords match</span>';
    } else {
      matchDiv.innerHTML = '<span class="match-error"><i class="fas fa-times"></i> Passwords do not match</span>';
    }
  });
  </script>

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
