<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>


<?php 
$active ='why';
include('head.php');
?>

<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4">
          <h1 class="section-title">Why Should I Donate Blood?</h1>
          <p>
            <?php
              include 'conn.php';
              $sql=$sql= "select * from pages where page_type='donor'";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0)   {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }
            ?>
          </p>
        </div>
        <div class="col-lg-6 mb-4">
          <img class="img-fluid rounded blood-cover-img" src="image/08f2fccc45d2564f74ead4a6d5086871.png" alt="Why Donate Blood">
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</div>
</body>

</html>
