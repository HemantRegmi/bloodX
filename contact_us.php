<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

include 'conn.php';
if(isset($_POST["send"])){
  $name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = mysqli_real_escape_string($conn, $_POST['contactno']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $sql = "INSERT INTO contact_query (query_name, query_mail, query_number, query_message) VALUES ('$name', '$email', '$number', '$message')";
  $result=mysqli_query($conn,$sql) or die("query unsuccessful.");
  header("Location: contact_us.php?sent=1");
  exit;
}
?>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php $active ='contact';
include 'head.php'; ?>

<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      <h1 class="section-title mb-4">Contact</h1>
      <div class="row">
        <div class="col-lg-7 mb-4">
          <div class="card p-4 shadow-lg">
            <h3 class="mb-3 font-weight-bold">Send us a Message</h3>
            <form name="sentMessage" method="post">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="font-italic font-weight-bold">Full Name<span style="color:red">*</span></label>
                  <input type="text" class="form-control" id="name" name="fullname" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="font-italic font-weight-bold">Phone Number<span style="color:red">*</span></label>
                  <input type="tel" class="form-control" id="phone" name="contactno" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label class="font-italic font-weight-bold">Email Address<span style="color:red">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label class="font-italic font-weight-bold">Message<span style="color:red">*</span></label>
                  <textarea rows="6" class="form-control" id="message" name="message" required maxlength="999" style="resize:none"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12 text-center">
                  <button type="submit" name="send" class="btn become-donor-btn">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-5 mb-4">
          <div class="card p-4 shadow-sm h-100">
            <h3 class="mb-3 font-weight-bold">Contact Details</h3>
            <?php
              $sql= "select * from contact_info";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0)   {
                  while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="mb-3">
              <h5 class="mb-1 font-weight-bold">Address:</h5>
              <div><?php echo htmlspecialchars($row['contact_address']); ?></div>
            </div>
            <div class="mb-3">
              <h5 class="mb-1 font-weight-bold">Contact Number:</h5>
              <div class="text-danger font-weight-bold"><?php echo htmlspecialchars($row['contact_phone']); ?></div>
            </div>
            <div class="mb-3">
              <h5 class="mb-1 font-weight-bold">Email:</h5>
              <div><a href="mailto:<?php echo htmlspecialchars($row['contact_mail']); ?>" class="text-dark font-weight-bold"><?php echo htmlspecialchars($row['contact_mail']); ?></a></div>
            </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php' ?>
</div>
<script>
  <?php if (isset($_GET['sent']) && $_GET['sent'] == 1): ?>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Query Sent, We will contact you shortly.',
      showConfirmButton: false,
      timer: 2200
    });
  });
  <?php endif; ?>
</script>
</body>

</html>
