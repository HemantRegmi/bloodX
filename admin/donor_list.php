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
  <title>Donor List - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern Donor List Styling */
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

    .table-actions {
      display: flex;
      gap: 1rem;
    }

    .btn-add {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-add:hover {
      background: #c82333;
      color: #fff;
      text-decoration: none;
      transform: translateY(-1px);
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

    .pagination-wrapper {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
    }

    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
      gap: 0.5rem;
    }

    .pagination li {
      margin: 0;
    }

    .pagination a {
      display: block;
      padding: 0.5rem 1rem;
      background: #fff;
      color: #333;
      text-decoration: none;
      border-radius: 6px;
      border: 1px solid #e9ecef;
      transition: all 0.3s ease;
    }

    .pagination a:hover {
      background: #dc3545;
      color: #fff;
      border-color: #dc3545;
    }

    .pagination .active a {
      background: #dc3545;
      color: #fff;
      border-color: #dc3545;
    }

    .blood-group-badge {
      background: #dc3545;
      color: #fff;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .gender-badge {
      background: #17a2b8;
      color: #fff;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .table-card {
        padding: 1rem;
      }
      
      .page-title {
        font-size: 1.5rem;
      }
      
      .table-responsive {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "list";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="page-header">
    <h1 class="page-title">Donor List</h1>
    <p class="page-subtitle">Manage and view all registered blood donors</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">
        <i class="fas fa-users text-danger"></i> Registered Donors
      </h3>
      <div class="table-actions">
        <a href="add_donor.php" class="btn-add">
          <i class="fas fa-plus"></i> Add New Donor
        </a>
      </div>
    </div>

    <?php
    $limit = 10;
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }else{
      $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $count = $offset + 1;
    $sql = "SELECT donor_id, donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date FROM donor_details LIMIT {$offset},{$limit}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
    ?>
    
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Address</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Last Donation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { 
            $latitude = isset($row['latitude']) && $row['latitude'] !== null && $row['latitude'] !== '' ? number_format((float)$row['latitude'], 7, '.', '') : '-';
            $longitude = isset($row['longitude']) && $row['longitude'] !== null && $row['longitude'] !== '' ? number_format((float)$row['longitude'], 7, '.', '') : '-';
            $last_donation = isset($row['last_donation_date']) && $row['last_donation_date'] !== null && $row['last_donation_date'] !== '' ? date('Y-m-d', strtotime($row['last_donation_date'])) : '-';
          ?>
          <tr>
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo $row['donor_name']; ?></strong></td>
            <td><?php echo $row['donor_number']; ?></td>
            <td><?php echo $row['donor_mail']; ?></td>
            <td><?php echo $row['donor_age']; ?></td>
            <td><span class="gender-badge"><?php echo $row['donor_gender']; ?></span></td>
            <td><span class="blood-group-badge"><?php echo $row['donor_blood']; ?></span></td>
            <td><?php echo $row['donor_address']; ?></td>
            <td><small style="color: #666; font-family: monospace;"><?php echo $latitude; ?></small></td>
            <td><small style="color: #666; font-family: monospace;"><?php echo $longitude; ?></small></td>
            <td><small style="color: #666;"><?php echo $last_donation; ?></small></td>
            <td>
              <a class="btn btn-delete" href="#" 
                 onclick="confirmDeleteDonor(<?php echo $row['donor_id']; ?>)">
                <i class="fas fa-trash"></i> Delete
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="pagination-wrapper">
      <?php
      $sql1 = "SELECT * FROM donor_details";
      $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
      if(mysqli_num_rows($result1) > 0){
        $total_records = mysqli_num_rows($result1);
        $total_page = ceil($total_records / $limit);
        echo '<ul class="pagination">';
        if($page > 1){
          echo '<li><a href="donor_list.php?page=' . ($page - 1) . '">Prev</a></li>';
        }
        for($i = 1; $i <= $total_page; $i++){
          $active_class = ($page == $i) ? 'active' : '';
          echo '<li class="' . $active_class . '"><a href="donor_list.php?page=' . $i . '">' . $i . '</a></li>';
        }
        if($page < $total_page){
          echo '<li><a href="donor_list.php?page=' . ($page + 1) . '">Next</a></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>

    <?php } else { ?>
    <div class="text-center py-5">
      <i class="fas fa-users" style="font-size: 4rem; color: #ccc; margin-bottom: 1rem;"></i>
      <h4 style="color: #666;">No Donors Found</h4>
      <p style="color: #999;">No donors have been registered yet.</p>
      <a href="add_donor.php" class="btn btn-add">
        <i class="fas fa-plus"></i> Add First Donor
      </a>
    </div>
    <?php } ?>
  </div>
</div>

<script>
function confirmDeleteDonor(donorId) {
  Swal.fire({
    title: 'Delete Donor?',
    text: 'Are you sure you want to delete this donor? This action cannot be undone.',
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
        text: 'Please wait while we delete the donor.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      
      // Send AJAX request
      $.ajax({
        url: 'delete_donor_ajax.php',
        type: 'POST',
        data: {donor_id: donorId},
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Donor Deleted Successfully!',
              text: 'The donor has been removed from the system.',
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
              title: 'Error Deleting Donor',
              text: response.message || 'An error occurred while deleting the donor.',
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
            text: 'An error occurred while deleting the donor. Please try again.',
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
