<?php

session_start();
include 'conn.php';

$error = "";
if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        // Save user data in session
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_loggedin'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        // You can save more user info in session if needed

        header("Location: home.php"); // Redirect to homepage after login
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for home icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            padding: 32px 28px;
        }
        .login-box h2 {
            margin-bottom: 24px;
            color: #2d3a4b;
            text-align: center;
        }
        .error-msg {
            color: #e74c3c;
            margin-bottom: 18px;
            text-align: center;
        }
        .home-top-left {
            position: absolute;
            top: 20px;
            left: 30px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <!-- Home button top left -->
    <a href="home.php" class="btn btn-success home-top-left">
        <i class="fa fa-home"></i> Home
    </a>
    <div class="login-box">
        <h2>User Login</h2>
        <?php if($error) echo '<div class="error-msg">'.$error.'</div>'; ?>
        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="off">
            </div>
            <div class="text-center">
                <button type="submit" name="login" class="btn" style="background:#1abc9c;color:#fff;">Login</button>
            </div>
        </form>
    </div>
</body>
</html>