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
      header('Location: admin/dashboard.php');
      exit;
    }
    // 2. Try user login (email, hashed password)
    $user_input = mysqli_real_escape_string($conn, $input);
    $user_sql = "SELECT id, name, password FROM users WHERE email='$user_input'";
    $user_res = mysqli_query($conn, $user_sql);
    if ($user_res && mysqli_num_rows($user_res) === 1) {
      $user_row = mysqli_fetch_assoc($user_res);
      if (password_verify($password, $user_row['password'])) {
        $_SESSION['user_id'] = $user_row['id'];
        $_SESSION['user_name'] = $user_row['name'];
        header('Location: home.php');
        exit;
      }
    }
    $message = '<div class="alert alert-danger">Invalid credentials.</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body { background: #fff3f3; }
    .login-card { max-width: 400px; margin: 60px auto; border-radius: 18px; box-shadow: 0 4px 32px rgba(220,53,69,0.10); border: 1px solid #f8d7da; }
    .login-card .card-header { background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%); color: #fff; border-radius: 18px 18px 0 0; text-align: center; font-size: 1.5em; }
    .btn-danger { background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%); border: none; }
    .btn-danger:hover { background: #b71c1c; }
    .home-top-left {
      position: absolute;
      top: 20px;
      left: 30px;
      z-index: 1000;
      background: linear-gradient(90deg, #b1001a 0%, #ff1744 100%);
      color: #fff !important;
      font-weight: 700;
      border: none;
      border-radius: 50px;
      padding: 0.5rem 1.5rem;
      box-shadow: 0 2px 8px rgba(200,0,0,0.13);
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
      text-decoration: none;
    }
    .home-top-left:hover {
      background: linear-gradient(90deg, #ff1744 0%, #b1001a 100%);
      color: #fff !important;
      box-shadow: 0 6px 18px rgba(200,0,0,0.22);
      text-decoration: none;
    }
    .themed-link-btn {
      display: block;
      width: 100%;
      margin: 18px 0 0 0;
      background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%);
      color: #fff !important;
      border-radius: 8px;
      padding: 0.7em 0;
      font-weight: 600;
      text-align: center;
      text-decoration: none !important;
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px rgba(220,53,69,0.10);
    }
    .themed-link-btn:hover {
      background: linear-gradient(90deg, #b71c1c 0%, #dc3545 100%);
      color: #fff !important;
      text-decoration: none;
      box-shadow: 0 6px 18px rgba(220,53,69,0.18);
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: url('image/bloodX_2.jpg') no-repeat center center fixed; background-size: cover; min-height: 100vh; position: relative;">
  <div style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(255,255,255,0.4); z-index: 0;"></div>
  <!-- Home button top left -->
  <a href="home.php" class="home-top-left">
    <i class="fa fa-home"></i> Home
  </a>
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position: relative; z-index: 1;">
    <div class="col-md-6 col-lg-5 mx-auto">
      <div class="card login-card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <?php echo $message; ?>
          <form method="post" autocomplete="off">
            <div class="form-group">
              <label for="user_or_email">Username or Email</label>
              <input type="text" class="form-control" id="user_or_email" name="user_or_email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block">Login</button>
            <div class="text-center mt-2">
              <a href="signup.php" class="themed-link-btn">Don't have an account? Sign Up</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html> 