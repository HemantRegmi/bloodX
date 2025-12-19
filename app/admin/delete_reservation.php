<?php
include '../conn.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo 'fail: invalid id';
  exit;
}
$id = intval($_GET['id']);
$sql = "DELETE FROM reservation WHERE id = $id";
if (mysqli_query($conn, $sql)) {
  echo 'ok';
} else {
  echo 'fail: ' . mysqli_error($conn);
}
mysqli_close($conn); 