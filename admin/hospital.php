<?php
include 'conn.php';
include 'session.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/hospital.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="color:black">
<div id="header">
<?php include 'header.php'; ?>
</div>
<div id="sidebar">
<?php $active="hospital"; include 'sidebar.php'; ?>
</div>
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="donor-list-main-card">
            <h1 class="section-title">Manage Hospitals</h1>
            <form method="post" action="" class="form-inline" style="margin-bottom: 20px;">
              <div class="form-group">
                <input type="text" name="hospital_name" class="form-control" placeholder="Enter hospital name" required>
              </div>
              <button type="submit" name="add_hospital" class="btn btn-danger">Add Hospital</button>
            </form>
            <?php
            // Insert hospital
            if (isset($_POST['add_hospital'])) {
              $name = trim(mysqli_real_escape_string($conn, $_POST['hospital_name']));
              if ($name != "") {
                $check = mysqli_query($conn, "SELECT * FROM hospitals WHERE name='$name'");
                if (mysqli_num_rows($check) == 0) {
                  $insert = mysqli_query($conn, "INSERT INTO hospitals (name) VALUES ('$name')");
                  if ($insert) {
                    echo "<script>Swal.fire({icon: 'success', title: 'Hospital added!', showConfirmButton: false, timer: 1500});</script>";
                  } else {
                    echo "<script>Swal.fire({icon: 'error', title: 'Error adding hospital', showConfirmButton: false, timer: 1500});</script>";
                  }
                } else {
                  echo "<script>Swal.fire({icon: 'warning', title: 'Hospital already exists', showConfirmButton: false, timer: 1500});</script>";
                }
              }
            }
            // Delete hospital
            if (isset($_GET['delete'])) {
              $id = intval($_GET['delete']);
              // First delete reservations for this hospital
              mysqli_query($conn, "DELETE FROM reservation WHERE hospital_id=$id");
              // Then delete the hospital
              $del = mysqli_query($conn, "DELETE FROM hospitals WHERE id=$id");
              if ($del) {
                echo "<script>Swal.fire({icon: 'success', title: 'Hospital deleted!', showConfirmButton: false, timer: 1500});</script>";
              } else {
                echo "<script>Swal.fire({icon: 'error', title: 'Error deleting hospital', showConfirmButton: false, timer: 1500});</script>";
              }
            }
            // Handle status update
            if (isset($_POST['update_status']) && isset($_POST['reservation_id']) && isset($_POST['new_status'])) {
              $reservation_id = intval($_POST['reservation_id']);
              $new_status = $_POST['new_status'] === 'completed' ? 'completed' : 'pending';
              mysqli_query($conn, "UPDATE reservation SET status='$new_status' WHERE id=$reservation_id");
              echo "<script>location.href=location.href;</script>";
            }
            // List hospitals
            $result = mysqli_query($conn, "SELECT * FROM hospitals ORDER BY id DESC");
            if ($result && mysqli_num_rows($result) > 0) {
            ?>
            <div class="table-responsive donor-list-table-wrapper">
              <table class="table donor-list-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Hospital Name & Reservations</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; while($row = mysqli_fetch_assoc($result)) { 
                    // Fetch reservations for this hospital
                    $reservations = [];
                    $res_q = mysqli_query($conn, "SELECT id, user_name, user_phone, blood_group, status FROM reservation WHERE hospital_id=" . intval($row['id']));
                    if ($res_q && mysqli_num_rows($res_q) > 0) {
                      while ($res_row = mysqli_fetch_assoc($res_q)) {
                        $reservations[] = $res_row;
                      }
                    }
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <div><strong><?php echo htmlspecialchars($row['name']); ?></strong></div>
                      <?php if (count($reservations) > 0) { ?>
                        <div class="reservation-list" style="margin-top:8px;">
                          <table class="table table-bordered table-sm" style="background:#fff; margin-bottom:0;">
                            <thead>
                              <tr style="background:#f8d7da; color:#b71c1c;">
                                <th style="font-size:0.95em;">Name</th>
                                <th style="font-size:0.95em;">Contact</th>
                                <th style="font-size:0.95em;">Blood Group</th>
                                <th style="font-size:0.95em;">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($reservations as $res) { ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($res['user_name']); ?></td>
                                  <td><?php echo htmlspecialchars($res['user_phone']); ?></td>
                                  <td><?php echo htmlspecialchars($res['blood_group']); ?></td>
                                  <td>
                                    <form method="post" style="display:inline;">
                                      <input type="hidden" name="reservation_id" value="<?php echo $res['id']; ?>">
                                      <input type="hidden" name="new_status" value="<?php echo ($res['status'] === 'pending') ? 'completed' : 'pending'; ?>">
                                      <button type="submit" name="update_status" class="btn btn-xs <?php echo ($res['status'] === 'pending') ? 'btn-danger' : 'btn-success'; ?>">
                                        <?php echo ucfirst($res['status']); ?>
                                      </button>
                                    </form>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      <?php } else { ?>
                        <div class="text-muted" style="font-size:0.95em;">No reservations</div>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="#" class="btn btn-danger delete-hospital-link" data-id="<?php echo $row['id']; ?>">Delete</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { echo '<div class="alert alert-info">No hospitals found.</div>'; } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
  $('.delete-hospital-link').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to delete this hospital?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'hospital.php?delete=' + id;
      }
    });
  });
});
</script>
</body>
</html>
<?php } else { echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>'; ?>
<form method="post" name="" action="login.php" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-8 col-sm-offset-4" style="float:left">
      <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
    </div>
  </div>
</form>
<?php } ?> 