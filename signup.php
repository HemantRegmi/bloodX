<?php
require_once 'conn.php';
$message = '';
$showSuccess = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm = $_POST['confirm'] ?? '';
  if (!$name || !$email || !$phone || !$password || !$confirm) {
    $message = '<div class="alert alert-danger">All fields are required.</div>';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = '<div class="alert alert-danger">Invalid email address.</div>';
  } elseif ($password !== $confirm) {
    $message = '<div class="alert alert-danger">Passwords do not match.</div>';
  } else {
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if ($check === false) {
      $message = '<div class="alert alert-danger">Error: Database query failed. ' . mysqli_error($conn) . '</div>';
    } elseif (mysqli_num_rows($check) > 0) {
      $message = '<div class="alert alert-warning">Email already registered.</div>';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      if ($hash === false) {
        $message = '<div class="alert alert-danger">Error: Could not hash password.</div>';
      } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
          $message = '<div class="alert alert-danger">Error: Could not prepare statement. ' . mysqli_error($conn) . '</div>';
        } else {
          $stmt->bind_param("ssss", $name, $email, $phone, $hash);
          if ($stmt->execute()) {
            $showSuccess = true;
            $message = '<div class="alert alert-success">Signup successful! Redirecting to login...</div>';
          } else {
            $message = '<div class="alert alert-danger">Error: Could not register user. ' . $stmt->error . '</div>';
          }
          $stmt->close();
        }
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
  <title>Create an Account - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    body {
      background: #f8f9fa !important;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif !important;
      margin: 0 !important;
      padding: 0 !important;
      min-height: 100vh !important;
    }

    .back-link {
      position: absolute;
      top: 20px;
      left: 30px;
      color: #dc3545 !important;
      text-decoration: none !important;
      font-weight: 500 !important;
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
      z-index: 1000 !important;
    }

    .back-link:hover {
      color: #c82333 !important;
      text-decoration: none !important;
    }

    .signup-container {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      min-height: 100vh !important;
      padding: 20px !important;
    }

    .signup-card {
      background: #fff !important;
      border-radius: 12px !important;
      box-shadow: 0 8px 32px rgba(0,0,0,0.1) !important;
      padding: 30px !important;
      width: 100% !important;
      max-width: 420px !important;
      border: 1px solid #f0f0f0 !important;
    }

    .logo-container {
      text-align: center !important;
      margin-bottom: 25px !important;
    }

    .logo {
      width: 50px !important;
      height: 50px !important;
      background: #dc3545 !important;
      border-radius: 50% !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #fff !important;
      font-weight: 900 !important;
      font-size: 1.3rem !important;
      margin-bottom: 15px !important;
    }

    .signup-title {
      font-size: 1.8rem !important;
      font-weight: 700 !important;
      color: #dc3545 !important;
      margin-bottom: 6px !important;
      text-align: center !important;
    }

    .signup-subtitle {
      color: #666 !important;
      text-align: center !important;
      margin-bottom: 25px !important;
      font-size: 0.95rem !important;
    }

    .form-group {
      margin-bottom: 18px !important;
    }

    .form-label {
      display: block !important;
      margin-bottom: 6px !important;
      font-weight: 600 !important;
      color: #333 !important;
      font-size: 0.95rem !important;
    }

    .form-control {
      width: 100% !important;
      padding: 10px 12px !important;
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      font-size: 0.95rem !important;
      transition: border-color 0.3s ease !important;
      background: #fff !important;
    }

    .form-control:focus {
      outline: none !important;
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }

    .name-row {
      display: flex !important;
      gap: 15px !important;
    }

    .name-row .form-group {
      flex: 1 !important;
    }

    .password-container {
      position: relative !important;
    }

    .password-toggle {
      position: absolute !important;
      right: 15px !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      background: none !important;
      border: none !important;
      color: #666 !important;
      cursor: pointer !important;
      font-size: 1.1rem !important;
    }

    .password-requirements {
      margin-top: 15px !important;
      padding: 15px !important;
      background: #f8f9fa !important;
      border-radius: 8px !important;
      border: 1px solid #e9ecef !important;
    }

    .requirement {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      margin-bottom: 8px !important;
      font-size: 0.9rem !important;
      color: #666 !important;
    }

    .requirement:last-child {
      margin-bottom: 0 !important;
    }

    .requirement-icon {
      width: 16px !important;
      height: 16px !important;
      border-radius: 50% !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 0.7rem !important;
      font-weight: bold !important;
    }

    .requirement-icon.valid {
      background: #28a745 !important;
      color: #fff !important;
    }

    .requirement-icon.invalid {
      background: #dc3545 !important;
      color: #fff !important;
    }

    .terms-checkbox {
      display: flex !important;
      align-items: flex-start !important;
      gap: 10px !important;
      margin-bottom: 25px !important;
    }

    .terms-checkbox input[type="checkbox"] {
      width: 18px !important;
      height: 18px !important;
      accent-color: #dc3545 !important;
      margin-top: 2px !important;
    }

    .terms-checkbox label {
      color: #333 !important;
      font-size: 0.95rem !important;
      margin: 0 !important;
      line-height: 1.4 !important;
    }

    .terms-checkbox a {
      color: #dc3545 !important;
      text-decoration: none !important;
      font-weight: 600 !important;
    }

    .terms-checkbox a:hover {
      text-decoration: underline !important;
    }

    .create-account-btn {
      width: 100% !important;
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      border-radius: 8px !important;
      padding: 14px !important;
      font-size: 1.1rem !important;
      font-weight: 600 !important;
      cursor: pointer !important;
      transition: background-color 0.3s ease !important;
    }

    .create-account-btn:hover {
      background: #c82333 !important;
    }

    .create-account-btn:disabled {
      background: #6c757d !important;
      cursor: not-allowed !important;
    }

    .login-link {
      text-align: center !important;
      color: #666 !important;
      font-size: 0.95rem !important;
      margin-top: 20px !important;
    }

    .login-link a {
      color: #dc3545 !important;
      text-decoration: none !important;
      font-weight: 600 !important;
    }

    .login-link a:hover {
      text-decoration: underline !important;
    }

    .alert {
      border-radius: 8px !important;
      margin-bottom: 20px !important;
      padding: 12px 15px !important;
    }

    @media (max-width: 576px) {
      .signup-card {
        padding: 30px 20px !important;
      }
      
      .name-row {
        flex-direction: column !important;
        gap: 0 !important;
      }
    }
  </style>
</head>
<body>
  <!-- Back to Home Link -->
  <a href="home.php" class="back-link">
    <i class="fas fa-arrow-left"></i>
    Back to Home
  </a>

  <div class="signup-container">
    <div class="signup-card">
      <!-- Logo -->
      <div class="logo-container">
        <div class="logo">bX</div>
        <h1 class="signup-title">Create an Account</h1>
        <p class="signup-subtitle">Join BloodX and help save lives through blood donation</p>
      </div>

      <!-- Error Message -->
      <?php echo $message; ?>

      <!-- Signup Form -->
      <form method="post" autocomplete="off" id="signupForm">
        <div class="name-row">
          <div class="form-group">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" >
          </div>
          <div class="form-group">
            <label class="form-label" for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" >
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
          <label class="form-label" for="phone">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone">
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
            <button type="button" class="password-toggle" onclick="togglePassword()">
              <i class="fas fa-eye" id="password-icon"></i>
            </button>
          </div>
          
          <!-- Password Requirements -->
          <div class="password-requirements">
            <div class="requirement">
              <div class="requirement-icon invalid" id="req-length">×</div>
              <span>At least 8 characters</span>
            </div>
            <div class="requirement">
              <div class="requirement-icon invalid" id="req-letters">×</div>
              <span>Contains letters</span>
            </div>
            <div class="requirement">
              <div class="requirement-icon invalid" id="req-numbers">×</div>
              <span>Contains at least one number</span>
            </div>
            <div class="requirement">
              <div class="requirement-icon invalid" id="req-special">×</div>
              <span>Contains special character</span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="confirm_password">Confirm Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
            <button type="button" class="password-toggle" onclick="toggleConfirmPassword()">
              <i class="fas fa-eye" id="confirm-password-icon"></i>
            </button>
          </div>
        </div>

        <div class="terms-checkbox">
          <input type="checkbox" id="terms" name="terms" required>
          <label for="terms">
            I agree to the <a href="terms_of_service.php">Terms of Service</a> and <a href="privacy_policy.php">Privacy Policy</a>
          </label>
        </div>

        <button type="submit" class="create-account-btn" id="submitBtn" disabled>
          Create Account
        </button>
      </form>

      <!-- Login Link -->
      <div class="login-link">
        Already have an account? <a href="login.php">Sign in</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.getElementById('password-icon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
      } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
      }
    }

    function toggleConfirmPassword() {
      const passwordInput = document.getElementById('confirm_password');
      const passwordIcon = document.getElementById('confirm-password-icon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
      } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
      }
    }

    // Password validation
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      const requirements = {
        length: password.length >= 8,
        letters: /[a-zA-Z]/.test(password),
        numbers: /\d/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
      };

      // Update requirement icons
      document.getElementById('req-length').className = `requirement-icon ${requirements.length ? 'valid' : 'invalid'}`;
      document.getElementById('req-length').textContent = requirements.length ? '✓' : '×';
      
      document.getElementById('req-letters').className = `requirement-icon ${requirements.letters ? 'valid' : 'invalid'}`;
      document.getElementById('req-letters').textContent = requirements.letters ? '✓' : '×';
      
      document.getElementById('req-numbers').className = `requirement-icon ${requirements.numbers ? 'valid' : 'invalid'}`;
      document.getElementById('req-numbers').textContent = requirements.numbers ? '✓' : '×';
      
      document.getElementById('req-special').className = `requirement-icon ${requirements.special ? 'valid' : 'invalid'}`;
      document.getElementById('req-special').textContent = requirements.special ? '✓' : '×';

      // Check if all requirements are met
      const allValid = Object.values(requirements).every(req => req);
      const confirmPassword = document.getElementById('confirm_password').value;
      const passwordsMatch = password === confirmPassword && password.length > 0;
      const termsAccepted = document.getElementById('terms').checked;
      
      document.getElementById('submitBtn').disabled = !(allValid && passwordsMatch && termsAccepted);
    });

    document.getElementById('confirm_password').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      const passwordsMatch = password === confirmPassword && password.length > 0;
      
      // Check all requirements
      const passwordInput = document.getElementById('password');
      const requirements = {
        length: passwordInput.value.length >= 8,
        letters: /[a-zA-Z]/.test(passwordInput.value),
        numbers: /\d/.test(passwordInput.value),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(passwordInput.value)
      };
      const allValid = Object.values(requirements).every(req => req);
      const termsAccepted = document.getElementById('terms').checked;
      
      document.getElementById('submitBtn').disabled = !(allValid && passwordsMatch && termsAccepted);
    });

    document.getElementById('terms').addEventListener('change', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const passwordsMatch = password === confirmPassword && password.length > 0;
      
      // Check all requirements
      const requirements = {
        length: password.length >= 8,
        letters: /[a-zA-Z]/.test(password),
        numbers: /\d/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
      };
      const allValid = Object.values(requirements).every(req => req);
      const termsAccepted = this.checked;
      
      document.getElementById('submitBtn').disabled = !(allValid && passwordsMatch && termsAccepted);
    });

    // Form submission
    document.getElementById('signupForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const firstName = document.getElementById('first_name').value;
      const lastName = document.getElementById('last_name').value;
      const email = document.getElementById('email').value;
      const phone = document.getElementById('phone').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      
      // Combine first and last name
      const name = firstName + ' ' + lastName;
      
      // Create form data
      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('phone', phone);
      formData.append('password', password);
      formData.append('confirm', confirmPassword);
      
      // Submit form
      fetch('signup.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(html => {
        // Check if success message is in the response
        if (html.includes('Signup successful') || html.includes('alert-success')) {
          Swal.fire({
            icon: 'success',
            title: 'Account Created Successfully!',
            text: 'You can now sign in to your account.',
            confirmButtonText: 'Sign In',
            confirmButtonColor: '#dc3545'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'login.php';
            }
          });
        } else {
          // Reload page to show error message
          window.location.reload();
        }
      })
      .catch(error => {
        console.error('Error:', error);
        window.location.reload();
      });
    });

    <?php if ($showSuccess): ?>
    Swal.fire({
      icon: 'success',
      title: 'Account Created Successfully!',
      text: 'You can now sign in to your account.',
      confirmButtonText: 'Sign In',
      confirmButtonColor: '#dc3545'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'login.php';
      }
    });
    <?php endif; ?>
  </script>
</body>
</html> 