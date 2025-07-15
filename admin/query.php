<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../home.css">
  <link rel="stylesheet" href="../css/query.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
include 'conn.php';
include 'session.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<body style="color:black">
<div id="header">
<?php include 'header.php'; ?>
</div>
<div id="sidebar">
<?php $active="query"; include 'sidebar.php'; ?>
</div>
<div id="content" >
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <div class="donor-list-main-card">
            <h1 class="section-title">User Query</h1>
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
              <div class="table-responsive donor-list-table-wrapper">
                <table class="table donor-list-table">
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
                      <td><?php echo htmlspecialchars($row['query_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_mail']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_number']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_message']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_date']); ?></td>
                      <?php if($row['query_status']==1) { ?>
                        <td>Read<br></td>
                      <?php } else { ?>
                        <td>
                          <a href="#" class="mark-read-link" data-id="<?php echo $row['query_id']; ?>">
                            <b id="demo">Pending</b>
                          </a><br>
                        </td>
                      <?php } ?>
                      <td>
                        <a class="btn donor-action-btn delete-query-link" href="#" data-id="<?php echo $row['query_id']; ?>"> Delete </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <?php } else {
              echo '<div class="alert alert-info">No queries found.</div>';
            }
            ?>
          </div>
        </div>
      </div>
      <hr>
      <div class="table-responsive donor-list-pagination-wrapper" style="text-align:center;align:center">
        <?php
        // Pagination
        $sql1 = "SELECT COUNT(*) as total FROM contact_query";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $total_records = $row1['total'];
        $total_page = ceil($total_records / $limit);
        if($total_page > 1){
          echo '<ul class="pagination admin-pagination">';
          if($page > 1){
            echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
          }
          for($i = 1; $i <= $total_page; $i++){
            $active = ($i == $page) ? "active" : "";
            echo '<li class="' . $active . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
          }
          if($total_page > $page){
            echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
          }
          echo '</ul>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
} else {
    echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
?>
    <form method="post" name="" action="login.php" class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4" style="float:left">
          <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
        </div>
      </div>
    </form>
<?php }
?>
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Deleted successfully',
      showConfirmButton: false,
      timer: 1800
    });
  });
</script>
<?php endif; ?>
<script>
$(document).ready(function(){
  $('.mark-read-link').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to mark as Read?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, mark as read!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'mark_read.php?id=' + id;
      }
    });
  });

  // SweetAlert for delete
  $('.delete-query-link').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to delete this query?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'delete_query.php?id=' + id;
      }
    });
  });
});
</script>
</body>
</html>
