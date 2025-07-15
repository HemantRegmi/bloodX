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
<body background="admin_image\blood-cells.jpg">

  <!-- Home button top left -->
  <a href="../home.php" class="btn btn-success home-top-left">
    <i class="fa fa-home"></i> Home
  </a>

  <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

    <div class="container" style="margin-top:200px;">
      <div class="row justify-content-center">
          <div class="col-lg-6">
              <h1 class="mt-4 mb-3" style="color:#fff; text-shadow:2px 2px 8px #000;">
                  BloodX
                  <br>Login Portal
                </h1>

            </div>
      </div>
      <div class="card" style="height:250px; background-image:url('admin_image/glossy1.jpg');">
          <div class="card-body">

      <div class="row justify-content-lg-center justify-content-mb-center" >
      <div class="col-lg-6 mb-6 ">
      <div class="font-italic" style="font-weight:bold">Username<span style="color:red">*</span></div>
      <div><input type="text" name="username" placeholder="Enter your username" class="form-control" value="" required></div>
    </div>
    </div>
    <div class="row justify-content-lg-center justify-content-mb-center">
    <div class="col-lg-6 mb-6 "><br>
    <div class="font-italic"style="font-weight:bold">Password<span style="color:red">*</span></div>
    <div><input type="password" name="password" placeholder="Enter your Password" class="form-control" value="" required></div>
    </div>
  </div>
  <div class="row justify-content-lg-center justify-content-mb-center">
    <div class="col-lg-4 mb-4 " style="text-align:center"><br>
      <div>
        <input type="submit" name="login" class="btn btn-primary" value="LOGIN" style="cursor:pointer">
      </div>
    </div>
  </div>
    </div>
  </div></div>
<br>
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
      echo '<div class="alert alert-danger" style="font-weight:bold"> Username and Password are not matched!</div>';
    }

  }
   ?>
 </form>
</body>
</html>
