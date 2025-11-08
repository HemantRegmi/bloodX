<?php
require_once 'conn.php';
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = trim($_POST['user_or_email'] ?? '');
  $password = $_POST['password'] ?? '';
  if (!$input || !$password) {
    $message = '<div class="alert alert-danger">All fields are required.</div>';
  } else {
    // 1. Try admin login (username, plain password)
    $admin_input = mysqli_real_escape_string($conn, $input);
    $admin_pass = mysqli_real_escape_string($conn, $password);
    $admin_sql = "SELECT * FROM admin_info WHERE admin_username='$admin_input' AND admin_password='$admin_pass'";
    $admin_res = mysqli_query($conn, $admin_sql);
    if ($admin_res && mysqli_num_rows($admin_res) === 1) {
      $admin_row = mysqli_fetch_assoc($admin_res);
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $admin_row['admin_username'];
      usleep(500000);
      header('Location: admin/dashboard.php');
      exit;
    }
    // 2. Try user login (email, hashed password)
    $user_input = mysqli_real_escape_string($conn, $input);
    $user_sql = "SELECT id, name, password FROM users WHERE email='$user_input'";
    $user_res = mysqli_query($conn, $user_sql);
    if ($user_res === false) {
      $message = '<div class="alert alert-danger">Database error. Please try again later.</div>';
    } elseif (mysqli_num_rows($user_res) === 1) {
      $user_row = mysqli_fetch_assoc($user_res);
      if (password_verify($password, $user_row['password'])) {
        $_SESSION['user_id'] = $user_row['id'];
        $_SESSION['user_name'] = $user_row['name'];
        usleep(500000);
        header('Location: home.php');
        exit;
      } else {
        $message = '<div class="alert alert-danger">Invalid credentials.</div>';
      }
    } else {
      $message = '<div class="alert alert-danger">Invalid credentials.</div>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in to bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #fff !important;
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
      font-size: 0.95rem !important;
    }

    .back-link:hover {
      color: #c82333 !important;
      text-decoration: none !important;
    }

    .login-container {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      min-height: 100vh !important;
      padding: 20px !important;
    }

    .login-card {
      background: #fff !important;
      border-radius: 8px !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
      padding: 40px !important;
      width: 100% !important;
      max-width: 400px !important;
      border: 1px solid #e9ecef !important;
    }

    .logo-container {
      text-align: center !important;
      margin-bottom: 30px !important;
    }

    .logo {
      width: 60px !important;
      height: 60px !important;
      background: #dc3545 !important;
      border-radius: 50% !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #fff !important;
      font-weight: 900 !important;
      font-size: 1.5rem !important;
      margin-bottom: 20px !important;
    }

    .login-title {
      font-size: 2rem !important;
      font-weight: 700 !important;
      color: #dc3545 !important;
      margin-bottom: 8px !important;
      text-align: center !important;
    }

    .login-subtitle {
      color: #666 !important;
      text-align: center !important;
      margin-bottom: 30px !important;
      font-size: 1rem !important;
    }

    .form-group {
      margin-bottom: 20px !important;
    }

    .form-label {
      display: block !important;
      margin-bottom: 8px !important;
      font-weight: 600 !important;
      color: #333 !important;
      font-size: 1rem !important;
    }

    .form-control {
      width: 100% !important;
      padding: 12px 15px !important;
      border: 1px solid #e9ecef !important;
      border-radius: 6px !important;
      font-size: 1rem !important;
      transition: border-color 0.3s ease !important;
      background: #fff !important;
    }

    .form-control:focus {
      outline: none !important;
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.1) !important;
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

    .forgot-password {
      text-align: right !important;
      margin-bottom: 15px !important;
    }

    .forgot-password a {
      color: #dc3545 !important;
      text-decoration: none !important;
      font-size: 0.9rem !important;
    }

    .forgot-password a:hover {
      text-decoration: underline !important;
    }

    .remember-me {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      margin-bottom: 25px !important;
    }

    .remember-me input[type="checkbox"] {
      width: 18px !important;
      height: 18px !important;
      accent-color: #dc3545 !important;
      border: 1px solid #e9ecef !important;
    }

    .remember-me label {
      color: #333 !important;
      font-size: 0.95rem !important;
      margin: 0 !important;
    }

    .signin-btn {
      width: 100% !important;
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      border-radius: 6px !important;
      padding: 14px !important;
      font-size: 1.1rem !important;
      font-weight: 600 !important;
      cursor: pointer !important;
      transition: background-color 0.3s ease !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 10px !important;
    }

    .signin-btn:hover {
      background: #c82333 !important;
    }

    .arrow-circle {
      width: 20px !important;
      height: 20px !important;
      background: rgba(255,255,255,0.2) !important;
      border-radius: 50% !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 0.8rem !important;
    }

    .separator {
      text-align: center !important;
      margin: 30px 0 !important;
      position: relative !important;
    }

    .separator::before {
      content: '' !important;
      position: absolute !important;
      top: 50% !important;
      left: 0 !important;
      right: 0 !important;
      height: 1px !important;
      background: #e9ecef !important;
    }

    .separator span {
      background: #fff !important;
      padding: 0 15px !important;
      color: #666 !important;
      font-size: 0.9rem !important;
    }

    .social-buttons {
      display: flex !important;
      gap: 15px !important;
      margin-bottom: 30px !important;
    }

    .social-btn {
      flex: 1 !important;
      background: #fff !important;
      border: 1px solid #e9ecef !important;
      border-radius: 6px !important;
      padding: 12px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 10px !important;
      text-decoration: none !important;
      color: #333 !important;
      font-weight: 500 !important;
      transition: border-color 0.3s ease !important;
    }

    .social-btn:hover {
      border-color: #dc3545 !important;
      text-decoration: none !important;
      color: #333 !important;
    }

    .google-icon {
      width: 20px !important;
      height: 20px !important;
    }

    .facebook-icon {
      width: 20px !important;
      height: 20px !important;
      background: #1877f2 !important;
      border-radius: 50% !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #fff !important;
      font-weight: bold !important;
      font-size: 0.9rem !important;
    }

    .signup-link {
      text-align: center !important;
      color: #666 !important;
      font-size: 0.95rem !important;
    }

    .signup-link a {
      color: #dc3545 !important;
      text-decoration: none !important;
      font-weight: 600 !important;
    }

    .signup-link a:hover {
      text-decoration: underline !important;
    }

    .alert {
      border-radius: 6px !important;
      margin-bottom: 20px !important;
      padding: 12px 15px !important;
    }

    @media (max-width: 576px) {
      .login-card {
        padding: 30px 20px !important;
      }
      
      .social-buttons {
        flex-direction: column !important;
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

  <div class="login-container">
    <div class="login-card">
      <!-- Logo -->
      <div class="logo-container">
        <div class="logo">bX</div>
        <h1 class="login-title">Sign in to BloodX</h1>
        <p class="login-subtitle">Enter your credentials to access your account</p>
      </div>

      <!-- Error Message -->
      <?php echo $message; ?>

      <!-- Login Form -->
      <form method="post" autocomplete="off">
        <div class="form-group">
          <label class="form-label" for="user_or_email">Email</label>
          <input type="text" class="form-control" id="user_or_email" name="user_or_email" >
        </div>

        <div class="form-group">
          
          <label class="form-label" for="password">Password</label>
          <div class="password-container">
            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••">
            <button type="button" class="password-toggle" onclick="togglePassword()">
              <i class="fas fa-eye" id="password-icon"></i>
            </button>
          </div>
        </div>

        

        <button type="submit" class="signin-btn">
          <div class="arrow-circle">
            <i class="fas fa-arrow-right"></i>
          </div>
          Sign in
        </button>
      </form>

      
      

      <!-- Sign Up Link -->
      <div class="signup-link" style="margin-top: 24px;">
  Don't have an account? <a href="signup.php">Sign up</a>
</div>
  </div>

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
  </script>
</body>
</html> 