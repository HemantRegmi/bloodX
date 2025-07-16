<?php
session_start();
require_once 'conn.php';
if (!isset($_SESSION['user_id'])) { echo '<span class="text-muted">Not logged in.</span>'; exit; }
$user_id = $_SESSION['user_id'];
$sql = "SELECT r.*, h.name as hospital_name FROM reservation r JOIN hospitals h ON r.hospital_id = h.id WHERE r.user_id = $user_id ORDER BY r.reservation_date DESC, r.id DESC LIMIT 10";
$res = mysqli_query($conn, $sql);
if (!$res || mysqli_num_rows($res) == 0) {
  echo '<span class="text-muted">No Notifications found.</span>';
  exit;
}
// Mark as seen only user-specific notifications
if (isset($_GET['mark_seen']) && $_GET['mark_seen'] == '1') {
  $sql = "UPDATE reservation SET seen = 1 WHERE user_id = $user_id AND seen = 0";
  mysqli_query($conn, $sql);
  $sql = "UPDATE admin_notifications SET seen = 1 WHERE user_id = $user_id AND seen = 0";
  mysqli_query($conn, $sql);
  echo 'ok';
  exit;
}
if (isset($_GET['count']) && $_GET['count'] == '1') {
  $sql = "SELECT COUNT(*) as cnt FROM reservation WHERE user_id = $user_id AND seen = 0";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  $count = (int)$row['cnt'];
  $sql = "SELECT COUNT(*) as cnt FROM admin_notifications WHERE user_id = $user_id AND seen = 0";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  $count += (int)$row['cnt'];
  echo $count;
  exit;
}
// When fetching notifications, mark as seen only user-specific
$sql = "UPDATE reservation SET seen = 1 WHERE user_id = $user_id AND seen = 0";
mysqli_query($conn, $sql);
$sql = "UPDATE admin_notifications SET seen = 1 WHERE user_id = $user_id AND seen = 0";
mysqli_query($conn, $sql);
// Fetch both types of notifications
$res1 = mysqli_query($conn, "SELECT r.*, h.name as hospital_name, 'reservation' as type FROM reservation r JOIN hospitals h ON r.hospital_id = h.id WHERE r.user_id = $user_id ORDER BY r.reservation_date DESC, r.id DESC LIMIT 10");
$res2 = mysqli_query($conn, "SELECT id, title, message, created_at, 'admin' as type FROM admin_notifications WHERE user_id = $user_id OR user_id IS NULL ORDER BY created_at DESC, id DESC LIMIT 10");
$notifications = [];
while ($row = mysqli_fetch_assoc($res1)) {
  $notifications[] = [
    'type' => 'reservation',
    'id' => $row['id'],
    'hospital_name' => $row['hospital_name'],
    'reservation_date' => $row['reservation_date'],
    'status' => $row['status']
  ];
}
while ($row = mysqli_fetch_assoc($res2)) {
  $notifications[] = [
    'type' => 'admin',
    'id' => $row['id'],
    'title' => $row['title'],
    'message' => $row['message'],
    'created_at' => $row['created_at']
  ];
}
// Sort by date/time descending
usort($notifications, function($a, $b) {
  $dateA = $a['type'] === 'reservation' ? $a['reservation_date'] : $a['created_at'];
  $dateB = $b['type'] === 'reservation' ? $b['reservation_date'] : $b['created_at'];
  return strtotime($dateB) - strtotime($dateA);
});
echo '<ul class="list-unstyled mb-0">';
if (empty($notifications)) {
  echo '<span class="text-muted">No notifications found.</span>';
} else {
  foreach ($notifications as $n) {
    if ($n['type'] === 'reservation') {
      $badge = $n['status'] === 'pending' ? 'badge badge-warning' : 'badge badge-success';
      $status = ucfirst($n['status']);
      echo '<li class="mb-2 pb-2 border-bottom notification-item" id="reservation-notif-' . $n['id'] . '" data-type="reservation" data-id="' . $n['id'] . '">';
      echo '<div><b>' . htmlspecialchars($n['hospital_name']) . '</b></div>';
      echo '<div style="font-size:0.95em;">Date: ' . htmlspecialchars($n['reservation_date']) . '</div>';
      echo '<span class="' . $badge . '" style="font-size:0.9em;">' . $status . '</span>';
      echo '</li>';
    } else if ($n['type'] === 'admin') {
      echo '<li class="mb-2 pb-2 border-bottom notification-item" id="admin-notif-' . $n['id'] . '" data-type="admin" data-id="' . $n['id'] . '">';
      echo '<div><b>Admin Message: ' . htmlspecialchars($n['title']) . '</b></div>';
      echo '<div style="font-size:0.95em;">' . htmlspecialchars($n['message']) . '</div>';
      echo '<div class="text-muted" style="font-size:0.85em;">' . htmlspecialchars($n['created_at']) . '</div>';
      echo '<button class="btn btn-xs btn-danger delete-admin-notif-btn" data-id="' . $n['id'] . '" style="margin-top:4px;">Delete</button>';
      echo '</li>';
    }
  }
}
echo '</ul>';
?>
<script>
function showNotifDeletedPopup() {
  if (typeof Swal === 'undefined') {
    var script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    script.onload = function() {
      Swal.fire({
        icon: 'success',
        title: 'Notification deleted',
        showConfirmButton: false,
        timer: 1500
      });
    };
    document.head.appendChild(script);
  } else {
    Swal.fire({
      icon: 'success',
      title: 'Notification deleted',
      showConfirmButton: false,
      timer: 1500
    });
  }
}

$(document).on('click', '.delete-admin-notif-btn', function(e) {
  e.preventDefault();
  var notifId = $(this).data('id');
  var $li = $('#admin-notif-' + notifId);
  $.post('delete_notification.php', { id: notifId }, function(resp) {
    if (resp === 'ok') {
      $li.fadeOut(300, function() {
        $(this).remove();
        showNotifDeletedPopup();
      });
    }
  });
});
// Context menu for delete notification
$(document).on('contextmenu', '.notification-item', function(e) {
  e.preventDefault();
  var notifId = $(this).data('id');
  var notifType = $(this).data('type');
  var $li = $(this);
  // Remove any existing context menu
  $('.notif-context-menu').remove();
  // Create context menu
  var menu = $('<div class="notif-context-menu" style="position:absolute;z-index:9999;background:#fff;border:1px solid #dc3545;padding:6px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(220,53,69,0.13);color:#b1001a;font-weight:600;cursor:pointer;">Delete Notification</div>');
  $('body').append(menu);
  menu.css({ top: e.pageY + 'px', left: e.pageX + 'px' });
  menu.on('click', function() {
    var endpoint = notifType === 'admin' ? 'delete_notification.php' : 'delete_reservation_notification.php';
    $.post(endpoint, { id: notifId }, function(resp) {
      if (resp === 'ok') {
        $li.fadeOut(300, function() {
          $(this).remove();
          showNotifDeletedPopup();
        });
      }
    });
    menu.remove();
  });
  // Remove menu on click elsewhere
  $(document).on('click.notifctx', function() { menu.remove(); $(document).off('click.notifctx'); });
});
// Remove context menu on scroll or escape
$(window).on('scroll', function() { $('.notif-context-menu').remove(); });
$(document).on('keydown', function(e) { if (e.key === 'Escape') $('.notif-context-menu').remove(); });
</script> 