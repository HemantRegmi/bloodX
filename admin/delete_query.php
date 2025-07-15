<?php
include 'conn.php';

  $que_id = $_GET['id'];
$sql= "DELETE FROM contact_query where query_id={$que_id}";
$result=mysqli_query($conn,$sql);
mysqli_close($conn);

 ?>
<?php
include 'conn.php';
$id = $_GET['id'];
$sql = "DELETE FROM contact_query WHERE query_id = {$id}";
if (mysqli_query($conn, $sql)) {
    header("Location: query.php?deleted=1");
    exit;
} else {
    header("Location: query.php?deleted=0");
    exit;
}
?>
