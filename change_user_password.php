<?php
session_start();
require_once 'conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
$message = '';
$showSuccess = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $old = $_POST['old_password'] ?? '';
  $new = $_POST['new_password'] ?? '';
  $confirm = $_POST['confirm_password'] ?? '';
  $user_id = $_SESSION['user_id'];
  if (!$old || !$new || !$confirm) {
    $message = 'All fields are required.';
  } elseif ($new !== $confirm) {
    $message = 'New passwords do not match.';
  } else {
    $res = mysqli_query($conn, "SELECT password FROM users WHERE id=$user_id");
    $row = mysqli_fetch_assoc($res);
    if (!$row || !password_verify($old, $row['password'])) {
      $message = 'Old password is incorrect.';
    } else {
      $hash = password_hash($new, PASSWORD_DEFAULT);
      if (mysqli_query($conn, "UPDATE users SET password='$hash' WHERE id=$user_id")) {
        $showSuccess = true;
      } else {
        $message = 'Error updating password.';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
      min-height: 100vh;
    }

    .content-wrapper {
      padding: 2rem;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .home-btn {
      position: absolute;
      top: 20px;
      left: 30px;
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: #fff;
      text-decoration: none;
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
      z-index: 1000;
    }

    .home-btn:hover {
      background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
      color: #fff;
      text-decoration: none;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
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
  <div class="content-wrapper">
    <a href="home.php" class="home-btn">
      <i class="fas fa-home"></i> Home
    </a>
    
    <div class="password-card">
      <div class="password-header">
        <div class="password-icon">
          <i class="fas fa-key"></i>
        </div>
        <h1 class="password-title">Change Password</h1>
        <p class="password-subtitle">Update your account password to keep it secure</p>
      </div>
      
      <form method="post" autocomplete="off">
        <div class="form-section">
          <label for="old_password" class="form-label">Current Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="old_password" name="old_password" required>
            <button type="button" class="password-toggle" onclick="togglePassword('old_password')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>
        
        <div class="form-section">
          <label for="new_password" class="form-label">New Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="new_password" name="new_password" required>
            <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="password-strength" id="password-strength"></div>
        </div>
        
        <div class="form-section">
          <label for="confirm_password" class="form-label">Confirm New Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="password-match" id="password-match"></div>
        </div>
        
        <button type="submit" class="btn-save">
          <i class="fas fa-save"></i> Update Password
        </button>
      </form>
    </div>
  </div>

  <script>
    // Password toggle functionality
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const toggle = input.nextElementSibling;
      const icon = toggle.querySelector('i');
      
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    // Password strength checker
    function checkPasswordStrength(password) {
      let strength = 0;
      let feedback = '';
      
      if (password.length >= 8) strength++;
      if (/[a-z]/.test(password)) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;
      
      if (strength < 3) {
        feedback = '<span class="strength-weak">Weak password</span>';
      } else if (strength < 5) {
        feedback = '<span class="strength-medium">Medium strength password</span>';
      } else {
        feedback = '<span class="strength-strong">Strong password</span>';
      }
      
      return feedback;
    }

    // Password match checker
    function checkPasswordMatch() {
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const matchDiv = document.getElementById('password-match');
      
      if (confirmPassword === '') {
        matchDiv.innerHTML = '';
        return;
      }
      
      if (newPassword === confirmPassword) {
        matchDiv.innerHTML = '<span class="match-success">Passwords match</span>';
      } else {
        matchDiv.innerHTML = '<span class="match-error">Passwords do not match</span>';
      }
    }

    // Event listeners
    document.getElementById('new_password').addEventListener('input', function() {
      const strengthDiv = document.getElementById('password-strength');
      strengthDiv.innerHTML = checkPasswordStrength(this.value);
      checkPasswordMatch();
    });

    document.getElementById('confirm_password').addEventListener('input', checkPasswordMatch);
  </script>

  <?php if ($showSuccess): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Password Updated!',
      text: 'Your password has been successfully changed.',
      confirmButtonText: 'OK',
      customClass: { popup: 'themed-popup' }
    }).then(() => { 
      window.location = 'home.php'; 
    });
  </script>
  <?php elseif ($message): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: <?php echo json_encode($message); ?>,
      confirmButtonText: 'OK',
      customClass: { popup: 'themed-popup' }
    });
  </script>
  <?php endif; ?>
</body>
</html> 