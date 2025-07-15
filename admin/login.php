<html>

<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
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
            background: linear-gradient(90deg, #b1001a 0%, #ff1744 100%);
            color: #fff !important;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            box-shadow: 0 2px 8px rgba(200,0,0,0.13);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .home-top-left:hover {
            background: linear-gradient(90deg, #ff1744 0%, #b1001a 100%);
            color: #fff !important;
            box-shadow: 0 6px 18px rgba(200,0,0,0.22);
            text-decoration: none;
        }
    </style>
</head>
<body style="background: url('../image/bloodX_2.jpg') no-repeat center center fixed; background-size: cover; min-height: 100vh; position: relative;">
  <div style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(255,255,255,0.4); z-index: 0;"></div>

  <!-- Home button top left -->
  <a href="../home.php" class="home-top-left">
    <i class="fa fa-home"></i> Home
  </a>

  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position: relative; z-index: 1;">
    <div class="col-md-6 col-lg-5 mx-auto">
      <div class="card p-4 shadow-lg login-box">
        <h2 class="section-title mb-4 text-center">Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <?php
            include 'conn.php';
            if(isset($_POST["login"])){
              $username=mysqli_real_escape_string($conn,$_POST["username"]);
              $password=mysqli_real_escape_string($conn,$_POST["password"]);
              $sql="SELECT * from admin_info where admin_username='$username' and admin_password='$password'";
              $result=mysqli_query($conn,$sql) or die("query failed.");
              if(mysqli_num_rows($result)>0)
              {
                while($row=mysqli_fetch_assoc($result)){
                  session_start();
                  $_SESSION['loggedin'] = true;
                  $_SESSION["username"]=$username;
                  header("Location: dashboard.php");
                }
              }
              else {
                echo '<div class="alert alert-danger text-center font-weight-bold">Username and Password are not matched!</div>';
              }
            }
          ?>
          <div class="form-group mb-3">
            <label class="font-italic font-weight-bold">Username<span style="color:red">*</span></label>
            <input type="text" name="username" placeholder="Enter your username" class="form-control" required>
          </div>
          <div class="form-group mb-4">
            <label class="font-italic font-weight-bold">Password<span style="color:red">*</span></label>
            <input type="password" name="password" placeholder="Enter your Password" class="form-control" required>
          </div>
          <div class="text-center">
            <input type="submit" name="login" class="btn become-donor-btn w-100" value="LOGIN">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
