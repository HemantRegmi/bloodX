<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php
$active ='donate';
include('head.php');

// Show success message as popup if redirected after submit
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'success',
          title: 'Submit successfully',
          showConfirmButton: false,
          timer: 1800
        });
      });
    </script>
    ";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include 'conn.php';
    $donor_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $donor_number = mysqli_real_escape_string($conn, $_POST['mobileno']);
    $donor_mail = mysqli_real_escape_string($conn, $_POST['emailid']);
    $donor_age = mysqli_real_escape_string($conn, $_POST['age']);
    $donor_gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $donor_blood_id = mysqli_real_escape_string($conn, $_POST['blood']);
    $donor_address = mysqli_real_escape_string($conn, $_POST['address']);

    // Get blood group name from blood table
    $bg_query = mysqli_query($conn, "SELECT blood_group FROM blood WHERE blood_id = '{$donor_blood_id}' LIMIT 1");
    $donor_blood = '';
    if ($bg_row = mysqli_fetch_assoc($bg_query)) {
        $donor_blood = $bg_row['blood_group'];
    }

    $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
            VALUES ('$donor_name', '$donor_number', '$donor_mail', '$donor_age', '$donor_gender', '$donor_blood', '$donor_address')";
    if (mysqli_query($conn, $sql)) {
        header("Location: donate_blood.php?success=1");
        exit;
    } else {
        echo '<div class="alert alert-danger text-center" style="margin-top:20px;">Error submitting form. Please try again.</div>';
    }
}
?>

<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="mt-4 mb-3">Donate Blood </h1>
        </div>
      </div>
      <form name="donor" action="donate_blood.php" method="post">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Full Name<span style="color:red">*</span></div>
            <div><input type="text" name="fullname" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
            <div><input type="text" name="mobileno" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Email Id</div>
            <div><input type="email" name="emailid" class="form-control"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Age<span style="color:red">*</span></div>
            <div><input type="text" name="age" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Gender<span style="color:red">*</span></div>
            <div>
              <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Blood Group<span style="color:red">*</span></div>
            <div>
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
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Address<span style="color:red">*</span></div>
            <div><textarea class="form-control" name="address" required></textarea></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include('footer.php') ?>
</div>
</body>
</html>
