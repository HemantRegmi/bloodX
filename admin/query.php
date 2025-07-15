<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

#sidebar{position:relative;margin-top:-20px}
#content{position:relative;margin-left:210px}
@media screen and (max-width: 600px) {
  #content {
    position:relative;margin-left:auto;margin-right:auto;
  }
}
  #he{
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      align:center
  }
</style>
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
          <h1 class="page-title">User Query</h1>
        </div>
      </div>
      <hr>

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
        <table class="table table-bordered" style="text-align:center">
          <thead style="text-align:center">
            <tr>
              <th style="text-align:center">S.no</th>
              <th style="text-align:center">Name</th>
              <th style="text-align:center">Email Id</th>
              <th style="text-align:center">Mobile Number</th>
              <th style="text-align:center">Message</th>
              <th style="text-align:center">Posting Date</th>
              <th style="text-align:center">Status</th>
              <th style="text-align:center">Action</th>
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
              <td id="he" style="width:100px">
                <a style="background-color:aqua" href="#" class="delete-query-link" data-id="<?php echo $row['query_id']; ?>"> Delete </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php
        } else {
          echo '<div class="alert alert-info">No queries found.</div>';
        }
      ?>

      <div class="table-responsive" style="text-align:center;align:center">
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
            echo '<li><a href="query.php?page='.($page - 1).'">Prev</a></li>';
          }
          for($i = 1; $i <= $total_page; $i++){
            $active = ($i == $page) ? "active" : "";
            echo '<li class="'.$active.'"><a href="query.php?page='.$i.'">'.$i.'</a></li>';
          }
          if($total_page > $page){
            echo '<li><a href="query.php?page='.($page + 1).'">Next</a></li>';
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
