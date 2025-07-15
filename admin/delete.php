<?php
include 'conn.php';
$id = $_GET['id'];
$sql = "DELETE FROM donor_details WHERE donor_id = {$id}";
if (mysqli_query($conn, $sql)) {
    header("Location: donor_list.php?deleted=1");
    exit;
} else {
    header("Location: donor_list.php?deleted=0");
    exit;
}

mysqli_close($conn);

 ?>
