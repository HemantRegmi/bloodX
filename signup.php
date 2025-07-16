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
    $email = mysqli_real_escape_string($conn, $email);
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
      $message = '<div class="alert alert-warning">Email already registered.</div>';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $email, $phone, $hash);
      if ($stmt->execute()) {
        $showSuccess = true;
      } else {
        $message = '<div class="alert alert-danger">Error: Could not register user.</div>';
      }
      $stmt->close();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Signup</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    body { background: #fff3f3; }
    .signup-card { max-width: 400px; margin: 0 auto; border-radius: 18px; box-shadow: 0 4px 32px rgba(220,53,69,0.10); border: 1px solid #f8d7da; }
    .signup-card .card-header { background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%); color: #fff; border-radius: 18px 18px 0 0; text-align: center; font-size: 1.5em; }
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
</head>
<body style="background: url('image/bloodX_2.jpg') no-repeat center center fixed; background-size: cover; min-height: 100vh; position: relative;">
  <div style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(255,255,255,0.4); z-index: 0;"></div>
  <!-- Home button top left -->
  <a href="home.php" class="home-top-left">
    <i class="fa fa-home"></i> Home
  </a>
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position: relative; z-index: 1;">
    <div class="col-md-6 col-lg-5 mx-auto">
      <div class="card signup-card">
        <div class="card-header">User Signup</div>
        <div class="card-body">
          <?php echo $message; ?>
          <form method="post" autocomplete="off">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
              <label for="confirm">Confirm Password</label>
              <input type="password" class="form-control" id="confirm" name="confirm" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block">Sign Up</button>
            <div class="text-center mt-2">
              <a href="user_login.php" class="themed-link-btn">Already have an account? Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if ($showSuccess): ?>
  <script>
  Swal.fire({
    icon: 'success',
    title: 'Signup successful!',
    html: 'You can now <a href="user_login.php" style="display:inline-block;margin-top:10px;padding:0.5em 1.5em;background:linear-gradient(90deg,#dc3545 0%,#b71c1c 100%);color:#fff!important;border-radius:8px;font-weight:600;text-decoration:none;transition:background 0.2s;">Login here</a>.',
    confirmButtonText: 'OK',
    customClass: { popup: 'themed-popup' }
  });
  </script>
  <?php endif; ?>
</body>
</html> 