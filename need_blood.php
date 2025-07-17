<?php session_start(); if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; } ?>

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
  $active ='need';
  include('head.php') ?>

  <div id="page-container">
    <div class="container">
      <div id="content-wrap">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="card p-4 shadow-lg mb-4">
              <h1 class="section-title mb-4">Need Blood</h1>
              <form name="needblood" action="" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="font-italic font-weight-bold">Blood Group<span style="color:red">*</span></label>
                    <select name="blood" class="form-control" required>
                      <option value="" selected disabled>Select</option>
                      <?php
                        include 'conn.php';
                        $sql= "select * from blood";
                        $result=mysqli_query($conn,$sql) or die("query unsuccessful.");
                        while($row=mysqli_fetch_assoc($result)){
                      ?>
                      <option value="<?php echo $row['blood_id'] ?>"><?php echo $row['blood_group'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6 d-flex align-items-end">
                    <input type="submit" name="search" class="btn become-donor-btn w-100" value="Search">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <?php if(isset($_POST['search'])){
            $bg = $_POST['blood'];
            $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");
            $blood_group_name = "";
            $bg_query = mysqli_query($conn, "SELECT blood_group FROM blood WHERE blood_id = '{$bg}' LIMIT 1");
            if ($bg_row = mysqli_fetch_assoc($bg_query)) {
                $blood_group_name = $bg_row['blood_group'];
            }
            $sql = "SELECT * FROM donor_details WHERE donor_blood='{$blood_group_name}' ORDER BY rand() LIMIT 5";
            $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
            if(mysqli_num_rows($result)>0)   {
              while($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
            <div class="card donor-card w-100">
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
          <?php
              }
            } else {
              echo '<div class="col-12"><div class="alert alert-danger text-center">No Donor Found For your search Blood group</div></div>';
            }
          } ?>
        </div>
      </div>
    </div>
    <?php include 'footer.php' ?>
  </div>
</body>

</html>
