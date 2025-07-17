<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: ../login.php');
  exit;
}

// Use isset() only, not intval(), to distinguish between '0', '', and null
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
$title = trim($_POST['title'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$title || !$message) {
  header('Location: notification.php?notif_error=1');
  exit;
}

if ($user_id !== null && $user_id !== '' && $user_id !== '0') {
  // Send to one user
  $uid = intval($user_id);
  $stmt = $conn->prepare("INSERT INTO admin_notifications (user_id, title, message) VALUES (?, ?, ?)");
  $stmt->bind_param('iss', $uid, $title, $message);
  $stmt->execute();
  $stmt->close();
  //file_put_contents('notif_debug.log', "Sent to user_id=$uid\n", FILE_APPEND);
} else {
  // Send to all users: insert one row per user
  $users = mysqli_query($conn, "SELECT id FROM users");
  while ($u = mysqli_fetch_assoc($users)) {
    $uid = $u['id'];
    $stmt = $conn->prepare("INSERT INTO admin_notifications (user_id, title, message) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $uid, $title, $message);
    $stmt->execute();
    $stmt->close();
  }
}

header('Location: notification.php?notif_sent=1');
exit; 