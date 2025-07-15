<!DOCTYPE html>
<html lang="en">

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
<div class="header">
<?php
$active="home";
include('head.php'); ?>

</div>


  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;   ">
    <div class="container">
    <div id="content-wrap"style="padding-bottom:75px;">
  <!-- Banner Image -->
  <div class="banner-img-wrapper mb-4">
    <img src="image/bloodX_1.jpg" alt="Donate Blood Save Life" class="img-fluid w-100 rounded banner-img">
  </div>
<br>
        <h1 class="main-title">Welcome to BloodX</h1>
<br>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">The need for blood</h4>
                    <p class="card-body card-section-text">
                      <?php
                        include 'conn.php';
                        $sql=$sql= "select * from pages where page_type='needforblood'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)   {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo $row['page_data'];
                            }
                          }

                       ?>
                     </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Blood Tips</h4>
                    <p class="card-body card-section-text">
                      <?php
                        include 'conn.php';
                        $sql=$sql= "select * from pages where page_type='bloodtips'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)   {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo $row['page_data'];
                            }
                          }

                       ?>
                     </p>

                        </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Who you could Help</h4>
                    <p class="card-body card-section-text">
                      <?php
                        include 'conn.php';
                        $sql=$sql= "select * from pages where page_type='whoyouhelp'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)   {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo $row['page_data'];
                            }
                          }

                       ?>
                     </p>


                        </div>
            </div>
</div>

        <h2>Blood Donor Names</h2>

        <div class="row">
          <?php
            include 'conn.php';
            $sql= "SELECT * FROM donor_details ORDER BY rand() LIMIT 6";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="col-lg-4 col-sm-6 portfolio-item" ><br>
            <div class="card donor-card">
                <img class="card-img-top donor-img" src="image/bloodX_4.png" alt="Card image">
                <div class="card-body">
                  <h3 class="card-title"><?php echo htmlspecialchars($row['donor_name']); ?></h3>
                  <p class="card-text">
                    <b>Blood Group : </b> <b><?php echo htmlspecialchars($row['donor_blood']); ?></b><br>
                    <b>Mobile No. : </b> <?php echo htmlspecialchars($row['donor_number']); ?><br>
                    <b>Gender : </b><?php echo htmlspecialchars($row['donor_gender']); ?><br>
                    <b>Age : </b> <?php echo htmlspecialchars($row['donor_age']); ?><br>
                    <b>Address : </b> <?php echo htmlspecialchars($row['donor_address']); ?><br>
                  </p>

                </div>
              </div>
        </div>
      <?php }} ?>
</div>
<br>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-title">BLOOD GROUPS</h2>
                <p>
                  <?php
                    include 'conn.php';
                    $sql=$sql= "select * from pages where page_type='bloodgroups'";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0)   {
                        while($row = mysqli_fetch_assoc($result)) {
                          echo $row['page_data'];
                        }
                      }

                   ?></p>

            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded blood-cover-img" src="image\blood_donationcover.jpeg" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
            <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
            <p>
              <?php
                include 'conn.php';
                $sql=$sql= "select * from pages where page_type='universal'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0)   {
                    while($row = mysqli_fetch_assoc($result)) {
                      echo $row['page_data'];
                    }
                  }

               ?></p>
              </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block become-donor-btn" href="donate_blood.php">Become a Donor </a>
            </div>
        </div>

    </div>
  </div>
  <?php include('footer.php');?>
</div>

</body>

</html>
