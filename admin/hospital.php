<?php
include 'conn.php';
include 'session.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Hospitals - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern Hospital Management Styling */
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .content-wrapper {
      margin-left: 250px;
      padding: 2rem;
      min-height: calc(100vh - 80px);
    }

    .page-header {
      margin-bottom: 2rem;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      color: #666;
      font-size: 1.1rem;
    }

    .form-card {
      background: #fff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    .form-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .add-form {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 1rem;
    }

    .add-form .form-group {
      max-width: 400px;
    }

    .form-control {
      border: 1px solid #e9ecef;
      border-radius: 8px 0 0 8px;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      transition: all 0.3s ease;
      height: 48px;
      /* Ensure same height as button */
    }

    .form-control:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .btn-add {
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      padding: 0.75rem 1.5rem !important;
      border-radius: 8px !important;
      font-weight: 700 !important;
      font-size: 1rem !important;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: none;
      margin-top: 0;
      margin-left: 0;
      margin-right: 0;
      height: 48px;
      /* Match input height */
    }

    .btn-add:hover {
      background: #c82333;
      transform: translateY(-1px);
    }

    .table-card {
      background: #fff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid #f0f0f0;
    }

    .table-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #333;
      margin: 0;
    }

    .table {
      margin-bottom: 0;
    }

    .table thead th {
      background: #f8f9fa;
      border: none;
      color: #333;
      font-weight: 600;
      padding: 1rem;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table tbody td {
      border: none;
      padding: 1rem;
      vertical-align: middle;
      color: #666;
      border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
      background: #f8f9fa;
    }

    .btn-delete {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-delete:hover {
      background: #c82333;
      transform: translateY(-1px);
    }

    .hospital-name {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .reservation-count {
      color: #666;
      font-size: 0.9rem;
    }

    .reservation-item {
      background: #f8f9fa;
      border-radius: 6px;
      padding: 0.75rem;
      margin-bottom: 0.5rem;
      border-left: 3px solid #dc3545;
    }

    .reservation-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.5rem;
    }

    .reservation-name {
      font-weight: 600;
      color: #333;
    }

    .reservation-status {
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .status-pending {
      background: #ffc107;
      color: #212529;
    }

    .status-completed {
      background: #28a745;
      color: #fff;
    }

    .reservation-details {
      color: #666;
      font-size: 0.9rem;
    }

    .blood-group-badge {
      background: #dc3545;
      color: #fff;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .reservation-actions {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .reservation-actions .btn {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .reservation-actions .btn:hover {
      transform: translateY(-1px);
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .form-card, .table-card {
        padding: 1.5rem;
      }
      
      .page-title {
        font-size: 1.5rem;
      }
      
      .add-form {
        flex-direction: column;
        align-items: stretch;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "hospital";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="page-header">
    <h1 class="page-title">Manage Hospitals</h1>
    <p class="page-subtitle">Add and manage partner hospitals</p>
  </div>

  <div class="form-card">
    <h3 class="form-title">
      <i class="fas fa-hospital text-danger"></i> Add New Hospital
    </h3>
    <form method="post" action="" class="add-form">
      <div class="form-group" style="margin-bottom: 0; max-width: 400px; width: 100%;">
        <input type="text" name="hospital_name" class="form-control" placeholder="Enter hospital name" required>
      </div>
      <button type="submit" name="add_hospital" class="btn-add">
        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Add Hospital
      </button>
    </form>
  </div>

  <?php
  // Insert hospital
  if (isset($_POST['add_hospital'])) {
    $name = trim(mysqli_real_escape_string($conn, $_POST['hospital_name']));
    if ($name != "") {
      $check = mysqli_query($conn, "SELECT * FROM hospitals WHERE name='$name'");
      if (mysqli_num_rows($check) == 0) {
        $insert = mysqli_query($conn, "INSERT INTO hospitals (name) VALUES ('$name')");
                          if ($insert) {
                    echo "<script>Swal.fire({icon: 'success', title: 'Hospital Added Successfully!', text: 'The hospital has been added to the system.', showConfirmButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'OK'});</script>";
                  } else {
                    echo "<script>Swal.fire({icon: 'error', title: 'Error Adding Hospital', text: 'An error occurred while adding the hospital. Please try again.', showConfirmButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'OK'});</script>";
                  }
                } else {
                  echo "<script>Swal.fire({icon: 'warning', title: 'Hospital Already Exists', text: 'A hospital with this name already exists in the system.', showConfirmButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'OK'});</script>";
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
                echo "<script>Swal.fire({icon: 'success', title: 'Hospital Deleted Successfully!', text: 'The hospital and all associated reservations have been removed.', showConfirmButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'OK'});</script>";
              } else {
                echo "<script>Swal.fire({icon: 'error', title: 'Error Deleting Hospital', text: 'An error occurred while deleting the hospital. Please try again.', showConfirmButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'OK'});</script>";
              }
  }

  // Handle status update
  if (isset($_POST['update_status']) && isset($_POST['reservation_id']) && isset($_POST['new_status'])) {
    $reservation_id = intval($_POST['reservation_id']);
    $target_status = $_POST['new_status'] === 'completed' ? 'completed' : 'pending';
    // If this row is a donation schedule, use donation-specific statuses
    $cur = mysqli_query($conn, "SELECT status FROM reservation WHERE id=$reservation_id");
    $curStatus = $cur ? mysqli_fetch_assoc($cur)['status'] : '';
    if ($curStatus === 'donation' && $target_status === 'completed') {
      $target_status = 'donation_completed';
    }
    mysqli_query($conn, "UPDATE reservation SET status='$target_status' WHERE id=$reservation_id");

    if ($new_status === 'completed') {
      // Fetch user details to notify
      $info = mysqli_query($conn, "SELECT user_id, user_name, blood_group FROM reservation WHERE id=$reservation_id");
      if ($info && $rowInfo = mysqli_fetch_assoc($info)) {
        $notifyUserId = intval($rowInfo['user_id'] ?? 0);
        if ($notifyUserId > 0) {
          $title = 'Donation Schedule Confirmed';
          $msg = 'Hi ' . $rowInfo['user_name'] . ', your blood donation schedule has been confirmed.';
          $stmt = $conn->prepare("INSERT INTO admin_notifications (user_id, title, message) VALUES (?, ?, ?)");
          $stmt->bind_param('iss', $notifyUserId, $title, $msg);
          $stmt->execute();
          $stmt->close();
        }
      }
    }

    echo "<script>location.href=location.href;</script>";
  }

  // List hospitals
  $result = mysqli_query($conn, "SELECT * FROM hospitals ORDER BY id DESC");
  if ($result && mysqli_num_rows($result) > 0) {
  ?>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">
        <i class="fas fa-list text-danger"></i> Partner Hospitals
      </h3>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Hospital Name & Reservations</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; while($row = mysqli_fetch_assoc($result)) { 
            // Fetch reservations and donation schedules for this hospital
            $reservations = [];
            $schedules = [];
            $res_q = mysqli_query($conn, "SELECT id, user_name, user_phone, blood_group, status FROM reservation WHERE hospital_id=" . intval($row['id']) . " ORDER BY id DESC");
            if ($res_q && mysqli_num_rows($res_q) > 0) {
              while ($res_row = mysqli_fetch_assoc($res_q)) {
                if ($res_row['status'] === 'donation' || $res_row['status'] === 'donation_completed') {
                  $schedules[] = $res_row;
                } else {
                  $reservations[] = $res_row;
                }
              }
            }
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td>
              <div class="hospital-name"><?php echo htmlspecialchars($row['name']); ?></div>
              <div class="reservation-count">
                <?php echo count($reservations); ?> reservation(s) · <?php echo count($schedules); ?> schedule(s)
              </div>
              <?php if (!empty($reservations)) { ?>
                <div class="mt-3">
                  <div class="text-muted mb-2" style="font-weight:600;">Reservations</div>
                  <?php foreach($reservations as $res) { ?>
                    <div class="reservation-item">
                      <div class="reservation-header">
                        <span class="reservation-name"><?php echo htmlspecialchars($res['user_name']); ?></span>
                        <span class="reservation-status status-<?php echo $res['status']; ?>">
                          <?php echo ucfirst($res['status']); ?>
                        </span>
                      </div>
                                             <div class="reservation-details">
                         <span class="blood-group-badge"><?php echo $res['blood_group']; ?></span>
                         <span class="ml-2"><?php echo htmlspecialchars($res['user_phone']); ?></span>
                         <div class="reservation-actions mt-2">
                           <?php if ($res['status'] == 'pending') { ?>
                             <form method="post" style="display: inline;" class="mr-2">
                               <input type="hidden" name="reservation_id" value="<?php echo $res['id']; ?>">
                               <input type="hidden" name="new_status" value="completed">
                               <button type="submit" name="update_status" class="btn btn-sm btn-success">
                                 <i class="fas fa-check"></i> Complete
                               </button>
                             </form>
                           <?php } ?>
                           <a href="#" 
                              class="btn btn-sm btn-danger"
                              onclick="confirmDeleteReservation(<?php echo $res['id']; ?>)">
                             <i class="fas fa-trash"></i> Delete
                           </a>
                         </div>
                       </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
              <?php if (!empty($schedules)) { ?>
                <div class="mt-4">
                  <div class="text-muted mb-2" style="font-weight:600;">Donation Schedules</div>
                  <?php foreach($schedules as $res) { ?>
                    <div class="reservation-item">
                      <div class="reservation-header">
                        <span class="reservation-name"><?php echo htmlspecialchars($res['user_name']); ?></span>
                        <span class="reservation-status status-<?php echo ($res['status']==='donation_completed'?'completed':'pending'); ?>">Donation</span>
                      </div>
                      <div class="reservation-details">
                        <span class="blood-group-badge"><?php echo $res['blood_group']; ?></span>
                        <span class="ml-2"><?php echo htmlspecialchars($res['user_phone']); ?></span>
                        <div class="reservation-actions mt-2">
                          <form method="post" style="display: inline;" class="mr-2">
                            <input type="hidden" name="reservation_id" value="<?php echo $res['id']; ?>">
                            <input type="hidden" name="new_status" value="completed">
                            <button type="submit" name="update_status" class="btn btn-sm btn-success">
                              <i class="fas fa-check"></i> Mark Completed
                            </button>
                          </form>
                          <a href="#" 
                             class="btn btn-sm btn-danger"
                             onclick="confirmDeleteReservation(<?php echo $res['id']; ?>)">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                        </div>
                      </div>
                   </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </td>
            <td>
              <a class="btn btn-delete" href="#" 
                 onclick="confirmDeleteHospital(<?php echo $row['id']; ?>)">
                <i class="fas fa-trash"></i> Delete
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php } else { ?>
  <div class="table-card">
    <div class="text-center py-5">
      <i class="fas fa-hospital" style="font-size: 4rem; color: #ccc; margin-bottom: 1rem;"></i>
      <h4 style="color: #666;">No Hospitals Found</h4>
      <p style="color: #999;">No hospitals have been added yet.</p>
    </div>
  </div>
  <?php } ?>
</div>

<script>
function confirmDeleteHospital(hospitalId) {
  Swal.fire({
    title: 'Delete Hospital?',
    text: 'Are you sure you want to delete this hospital? This will also delete all associated reservations.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      // Show loading state
      Swal.fire({
        title: 'Deleting...',
        text: 'Please wait while we delete the hospital.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      
      // Send AJAX request
      $.ajax({
        url: 'delete_hospital_ajax.php',
        type: 'POST',
        data: {hospital_id: hospitalId},
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Hospital Deleted Successfully!',
              text: 'The hospital and all associated reservations have been removed.',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            }).then(() => {
              // Reload the page to refresh the table
              window.location.reload();
            }).catch(() => {
              // Fallback if the promise doesn't resolve
              window.location.reload();
            });
            
            // Additional fallback with timeout
            setTimeout(function() {
              if (document.visibilityState !== 'hidden') {
                window.location.reload();
              }
            }, 2000);
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error Deleting Hospital',
              text: response.message || 'An error occurred while deleting the hospital.',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the hospital. Please try again.',
            showConfirmButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'OK'
          });
        }
      });
    }
  });
}

function confirmDeleteReservation(reservationId) {
  Swal.fire({
    title: 'Delete Reservation?',
    text: 'Are you sure you want to delete this reservation?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      // Show loading state
      Swal.fire({
        title: 'Deleting...',
        text: 'Please wait while we delete the reservation.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      
      // Send AJAX request
      $.ajax({
        url: 'delete_reservation_ajax.php',
        type: 'POST',
        data: {reservation_id: reservationId},
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Reservation Deleted Successfully!',
              text: 'The reservation has been removed.',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            }).then(() => {
              // Reload the page to refresh the table
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error Deleting Reservation',
              text: response.message || 'An error occurred while deleting the reservation.',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the reservation. Please try again.',
            showConfirmButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'OK'
          });
        }
      });
    }
  });
}
</script>

</body>
</html>

<?php
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Access Denied - bloodX</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #fafafa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .access-denied {
      background: #fff;
      border-radius: 12px;
      padding: 3rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
    }
    
    .access-denied i {
      font-size: 4rem;
      color: #dc3545;
      margin-bottom: 1rem;
    }
    
    .access-denied h2 {
      color: #333;
      margin-bottom: 1rem;
    }
    
    .access-denied p {
      color: #666;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <div class="access-denied">
    <i class="fas fa-lock"></i>
    <h2>Access Denied</h2>
    <p>Please login first to access the admin portal.</p>
    <a href="../login.php" class="btn btn-danger">
      <i class="fas fa-sign-in-alt"></i> Go to Login
    </a>
  </div>
</body>
</html>
<?php
}
?> 