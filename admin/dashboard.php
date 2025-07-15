<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="../home.css">
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body style="background: linear-gradient(135deg, #fff6f6 0%, #ffe6e6 100%); min-height: 100vh;">

  <?php
  include 'conn.php';
    include 'session.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    ?>

<div id="header">
<?php include 'header.php';
?>
</div>
<div id="sidebar">
<?php
$active="dashboard";
include 'sidebar.php'; ?>

</div>
<div id="content">

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="dashboard-main-card">
            <h1 class="section-title mb-4">Dashboard</h1>
            <hr>
            <div class="row">
              <div class="col-md-3 mb-4">
                <div class="dashboard-stat-card">
                  <?php
                    $sql =" SELECT * from donor_details ";
                    $result=mysqli_query($conn,$sql) or die("query failed.");
                    $row=mysqli_num_rows($result);
                  ?>
                  <div class="dashboard-stat-number"><?php echo $row; ?></div>
                  <div class="dashboard-stat-title">Total Donors</div>
                  <a href="donor_list.php" class="btn become-donor-btn mt-3">Full Detail</a>
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <div class="dashboard-stat-card">
                  <?php
                    $sql ="SELECT * FROM contact_query";
                    $result=mysqli_query($conn,$sql) or die("query failed.");
                    $row=mysqli_num_rows($result);
                  ?>
                  <div class="dashboard-stat-number"><?php echo $row; ?></div>
                  <div class="dashboard-stat-title">All User Queries</div>
                  <a href="query.php" class="btn become-donor-btn mt-3">Full Detail</a>
                </div>
              </div>

              <!-- Removed Pending Queries panel -->



        </div>
      </div>
    </div>
  <?php
 } else {
     echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
     ?>
     <form method="post" name="" action="login.php" class="form-horizontal">
       <div class="form-group">
         <div class="col-sm-8 col-sm-offset-4" style="float:left">

           <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
         </div>
       </div>
     </form>
 <?php }
  ?>

</body>
</html>
