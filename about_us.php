<?php session_start(); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>


<?php 
$active ='about';
include('head.php');

?>


<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4">
          <h1 class="section-title">About Us</h1>
          BloodX is dedicated to connecting blood donors with those in need, making the process of blood donation and transfusion easier, safer, and more efficient. Our mission is to save lives by ensuring a reliable and accessible blood supply for everyone. We work with partner hospitals, organize donation drives, and provide resources and support for both donors and recipients. Join us in making a difference—because every drop counts.
        </div>
        <div class="col-lg-6 mb-4">
          <img class="img-fluid rounded blood-cover-img" src="image/bloodX_3.jpg" alt="About BloodX">
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</div>
</body>

</html>
