<?php
session_start();
require_once 'conn.php';
if (!isset($_SESSION['user_id'])) { echo 'not_logged_in'; exit; }
$user_id = $_SESSION['user_id'];
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id > 0) {
  // Only delete if this notification belongs to this user
  $stmt = $conn->prepare("DELETE FROM admin_notifications WHERE id = ? AND user_id = ?");
  $stmt->bind_param('ii', $id, $user_id);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    echo 'ok';
  } else {
    echo 'fail';
  }
  $stmt->close();
} else {
  echo 'invalid';
}
$conn->close(); 