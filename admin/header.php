<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin_header.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse admin-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand font-weight-bold" id="qq" href="dashboard.php" style="padding-right: 0; margin-right: 0;">BloodX</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" id="qw" data-toggle="dropdown" href="#" style="font-weight:bold;color:white">
          <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
          <?php
          include 'conn.php';
          $username=$_SESSION['username'];
          $sql="select * from admin_info where admin_username='$username'";
          $result=mysqli_query($conn,$sql) or die("query failed.");
          $row=mysqli_fetch_assoc($result);
          echo "Hello ".$row['admin_name'];
         ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu admin-dropdown-menu">
          <li><a href="change_password.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</body></html>
