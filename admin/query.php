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
  <title>User Queries - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern User Queries Styling */
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

    .status-badge {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .status-pending {
      background: #ffc107;
      color: #000;
    }

    .status-pending:hover {
      background: #e0a800;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }

    .status-read {
      background: #28a745;
      color: #fff;
    }

    .mark-read-link {
      text-decoration: none;
    }

    .mark-read-link:hover {
      text-decoration: none;
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

    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .status-read {
      background: #28a745;
      color: #fff;
    }

    .status-pending {
      background: #ffc107;
      color: #212529;
    }

    .mark-read-link {
      color: #ffc107;
      text-decoration: none;
      font-weight: 600;
    }

    .mark-read-link:hover {
      color: #e0a800;
      text-decoration: none;
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

    .message-preview {
      max-width: 200px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
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
$active = "query";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="page-header">
    <h1 class="page-title">User Queries</h1>
    <p class="page-subtitle">Manage and respond to user inquiries</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">
        <i class="fas fa-comments text-danger"></i> Contact Queries
      </h3>
    </div>

    <?php
    // Pagination logic
    $limit = 10;
    if(isset($_GET['page']) && is_numeric($_GET['page'])){
      $page = intval($_GET['page']);
    }else{
      $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $count = $offset + 1;
    
    // Fetch queries
    $sql = "SELECT * FROM contact_query ORDER BY query_id DESC LIMIT {$offset},{$limit}";
    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) > 0) {
    ?>
    
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Mobile Number</th>
            <th>Message</th>
            <th>Posting Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo htmlspecialchars($row['query_name']); ?></strong></td>
            <td><?php echo htmlspecialchars($row['query_mail']); ?></td>
            <td><?php echo htmlspecialchars($row['query_number']); ?></td>
            <td>
              <div class="message-preview" title="<?php echo htmlspecialchars($row['query_message']); ?>">
                <?php echo htmlspecialchars($row['query_message']); ?>
              </div>
            </td>
            <td><?php echo date('M d, Y H:i', strtotime($row['query_date'])); ?></td>
            <td>
              <?php if($row['query_status'] == 1) { ?>
                <span class="status-badge status-read">Read</span>
              <?php } else { ?>
                <a href="#" class="mark-read-link" data-id="<?php echo $row['query_id']; ?>">
                  <span class="status-badge status-pending">Pending</span>
                </a>
              <?php } ?>
            </td>
            <td>
              <a class="btn btn-delete delete-query-link" href="#" data-id="<?php echo $row['query_id']; ?>">
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
      // Pagination
      $sql1 = "SELECT COUNT(*) as total FROM contact_query";
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $total_records = $row1['total'];
      $total_page = ceil($total_records / $limit);
      
      if($total_page > 1) {
        echo '<ul class="pagination">';
        if($page > 1){
          echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
        }
        for($i = 1; $i <= $total_page; $i++){
          $active_class = ($page == $i) ? 'active' : '';
          echo '<li class="' . $active_class . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
        }
        if($page < $total_page){
          echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>

    <?php } else { ?>
    <div class="text-center py-5">
      <i class="fas fa-comments" style="font-size: 4rem; color: #ccc; margin-bottom: 1rem;"></i>
      <h4 style="color: #666;">No Queries Found</h4>
      <p style="color: #999;">No user queries have been submitted yet.</p>
    </div>
    <?php } ?>
  </div>
</div>

<script>
$(document).ready(function() {
  // Mark as read functionality
  $('.mark-read-link').click(function(e) {
    e.preventDefault();
    var queryId = $(this).data('id');
    var link = $(this);
    
    // Show loading state
    link.html('<span class="status-badge status-pending">Updating...</span>');
    
    $.ajax({
      url: 'mark_read.php',
      type: 'POST',
      data: {query_id: queryId},
      success: function(response) {
        if(response == 'success') {
          link.html('<span class="status-badge status-read">Read</span>');
          link.removeClass('mark-read-link');
          
          // Show success message
          Swal.fire({
            icon: 'success',
            title: 'Marked as Read!',
            text: 'The query has been marked as read.',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          // Revert to original state if failed
          link.html('<span class="status-badge status-pending">Pending</span>');
          
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to mark query as read. Please try again.',
            confirmButtonColor: '#dc3545'
          });
        }
      },
      error: function() {
        // Revert to original state if failed
        link.html('<span class="status-badge status-pending">Pending</span>');
        
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Failed to mark query as read. Please try again.',
          confirmButtonColor: '#dc3545'
        });
      }
    });
  });

  // Delete query functionality
  $('.delete-query-link').click(function(e) {
    e.preventDefault();
    var queryId = $(this).data('id');
    var row = $(this).closest('tr');
    
    Swal.fire({
      title: 'Delete Query?',
      text: 'Are you sure you want to delete this query? This action cannot be undone.',
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
          text: 'Please wait while we delete the query.',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        
        $.ajax({
          url: 'delete_query.php',
          type: 'POST',
          data: {query_id: queryId},
          success: function(response) {
            if(response == 'success') {
              row.fadeOut(400, function() {
                $(this).remove();
                Swal.fire({
                  icon: 'success',
                  title: 'Query Deleted Successfully!',
                  text: 'The query has been removed.',
                  showConfirmButton: true,
                  confirmButtonColor: '#dc3545',
                  confirmButtonText: 'OK'
                });
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error Deleting Query',
                text: 'An error occurred while deleting the query. Please try again.',
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
              text: 'An error occurred while deleting the query. Please try again.',
              showConfirmButton: true,
              confirmButtonColor: '#dc3545',
              confirmButtonText: 'OK'
            });
          }
        });
      }
    });
  });
});
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
