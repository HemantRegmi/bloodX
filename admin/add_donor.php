<?php include 'session.php'; ?>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../home.css">
  <link rel="stylesheet" href="../css/add_donor.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body style="color:black">
  <?php
  include 'conn.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    ?>
<div id="header">
<?php $active="add"; include 'header.php';
?>
</div>
<div id="sidebar">
<?php $active="add"; include 'sidebar.php'; ?>
</div>
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <div class="add-donor-main-card">
            <h1 class="section-title mb-4">Add Donor</h1>
            <hr>
            <form name="donor" action="save_donor_data.php" method="post" class="add-donor-form">
              <div class="row">
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Full Name<span style="color:red">*</span></label>
                  <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Mobile Number<span style="color:red">*</span></label>
                  <input type="text" name="mobileno" class="form-control" required>
                </div>
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Email Id</label>
                  <input type="email" name="emailid" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Age<span style="color:red">*</span></label>
                  <input type="text" name="age" class="form-control" required>
                </div>
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Gender<span style="color:red">*</span></label>
                  <select name="gender" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Blood Group<span style="color:red">*</span></label>
                  <select name="blood" class="form-control" required>
                    <option value="" selected disabled>Select</option>
                    <?php
                      include 'conn.php';
                      $sql= "select * from blood";
                      $result=mysqli_query($conn,$sql) or die("query unsuccessful.");
                      while($row=mysqli_fetch_assoc($result)){
                    ?>
                      <option value="<?php echo $row['blood_group']; ?>"><?php echo $row['blood_group']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 mb-4">
                  <label class="font-italic">Address<span style="color:red">*</span></label>
                  <textarea class="form-control" name="address" required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 mb-4">
                  <button type="submit" name="submit" class="btn btn-submit">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    } else {
        echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
        ?>
        <form method="post" name="" action="../login.php" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4" style="float:left">

              <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
            </div>
          </div>
        </form>
    <?php }
     ?>
     <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Donor added',
      showConfirmButton: false,
      timer: 1800
    });
  });
</script>
<?php endif; ?>

</body>
</html>
