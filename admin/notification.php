<?php
include 'conn.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="../home.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .notif-card {
      background: #fffbe6;
      border: 1.5px solid #ffe082;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(220, 53, 69, 0.07);
      padding: 2.2rem 2rem 2rem 2rem;
      margin-bottom: 2rem;
      max-width: 540px;
    }
    .notif-card h3 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
      color: #b1001a;
    }
    .notif-card .notif-subtitle {
      color: #b1001a;
      font-size: 1rem;
      margin-bottom: 1.2rem;
      font-weight: 500;
    }
    .notif-card label {
      font-weight: 600;
      color: #b1001a;
    }
    .notif-card .form-control, .notif-card .custom-select {
      border-radius: 8px;
      border: 1.5px solid #ffe082;
      margin-bottom: 1rem;
      font-size: 1.08em;
      box-shadow: none;
    }
    .notif-card .form-control:focus, .notif-card .custom-select:focus {
      border-color: #ffecb3;
      box-shadow: 0 0 0 2px #ffe08233;
    }
    .notif-card .btn-theme {
      border-radius: 8px;
      font-weight: 700;
      font-size: 1.1em;
      padding: 0.6em 2.2em;
      background: linear-gradient(90deg, #b1001a 0%, #ff1744 100%);
      color: #fff;
      border: none;
      box-shadow: 0 2px 8px rgba(220,53,69,0.10);
      transition: background 0.2s, color 0.2s;
    }
    .notif-card .btn-theme:hover, .notif-card .btn-theme:focus {
      background: linear-gradient(90deg, #ff1744 0%, #b1001a 100%);
      color: #fff;
    }
    .notif-card .input-group-text {
      background: #ffe082;
      border: 1.5px solid #ffe082;
      color: #b1001a;
      font-weight: 700;
      border-radius: 8px 0 0 8px;
    }
  </style>
</head>
<body style="background: linear-gradient(135deg, #fff6f6 0%, #ffe6e6 100%); min-height: 100vh;">
<div id="header">
  <?php include 'header.php'; ?>
</div>
<div id="sidebar">
  <?php $active=""; include 'sidebar.php'; ?>
</div>
<div id="content" style="display: flex; justify-content: center; align-items: center; min-height: 90vh;">
  <div class="content-wrapper d-flex flex-column align-items-center" style="width:100%; display:flex; justify-content:center; align-items:center;">
    <div class="notif-card">
      <h3><span style="font-size:1.3em;">&#9993;</span> Send Notification</h3>
      <div class="notif-subtitle">Send notifications to specific users or broadcast to all users</div>
      <form method="post" action="send_notification.php" autocomplete="off">
        <div class="form-group">
          <label for="user_id">Recipient</label>
          <select name="user_id" id="user_id" class="custom-select">
            <option value="">&#128101; Broadcast to All Users</option>
            <?php
              $users = mysqli_query($conn, "SELECT id, name, email FROM users ORDER BY name ASC");
              while ($u = mysqli_fetch_assoc($users)) {
                echo '<option value="' . $u['id'] . '">' . htmlspecialchars($u['name']) . ' (' . htmlspecialchars($u['email']) . ')</option>';
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="notif_type">Type</label>
          <select id="notif_type" name="notif_type" class="custom-select">
            <option value="info" selected>&#8505; Info</option>
            <option value="success">&#9989; Success</option>
            <option value="warning">&#9888; Warning</option>
            <option value="error">&#10060; Error</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Enter notification title" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter notification message" required></textarea>
        </div>
        <button type="submit" class="btn btn-theme">Send</button>
      </form>
    </div>
  </div>
</div>
<?php if (isset($_GET['notif_sent']) && $_GET['notif_sent'] == '1'): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Notification sent',
      showConfirmButton: false,
      timer: 1800
    });
  });
</script>
<?php endif; ?>
</body>
</html> 