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
  <title>Change Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    body { background: url('image/bloodX_2.jpg') no-repeat center center fixed; background-size: cover; min-height: 100vh; position: relative; }
    .change-pass-card { max-width: 400px; margin: 60px auto; border-radius: 18px; box-shadow: 0 4px 32px rgba(220,53,69,0.10); border: 1px solid #f8d7da; }
    .change-pass-card .card-header { background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%); color: #fff; border-radius: 18px 18px 0 0; text-align: center; font-size: 1.5em; }
    .btn-danger { background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%); border: none; }
    .btn-danger:hover { background: #b71c1c; }
    .home-top-left {
      position: absolute; top: 20px; left: 30px; z-index: 1000;
      background: linear-gradient(90deg, #b1001a 0%, #ff1744 100%);
      color: #fff !important; font-weight: 700; border: none; border-radius: 50px;
      padding: 0.5rem 1.5rem; box-shadow: 0 2px 8px rgba(200,0,0,0.13);
      transition: background 0.2s, color 0.2s, box-shadow 0.2s; text-decoration: none;
    }
    .home-top-left:hover {
      background: linear-gradient(90deg, #ff1744 0%, #b1001a 100%);
      color: #fff !important; box-shadow: 0 6px 18px rgba(200,0,0,0.22); text-decoration: none;
    }
  </style>
</head>
<body>
  <a href="home.php" class="home-top-left"><i class="fa fa-home"></i> Home</a>
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position: relative; z-index: 1;">
    <div class="col-md-6 col-lg-5 mx-auto">
      <div class="card change-pass-card">
        <div class="card-header">Change Password</div>
        <div class="card-body">
          <form method="post" autocomplete="off">
            <div class="form-group">
              <label for="old_password">Old Password</label>
              <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm New Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block">Change Password</button>
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
      title: 'Password changed!',
      text: 'Your password has been updated.',
      confirmButtonText: 'OK',
      customClass: { popup: 'themed-popup' }
    }).then(() => { window.location = 'home.php'; });
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