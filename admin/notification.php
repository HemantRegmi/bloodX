<?php
include 'conn.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Send Notifications - bloodX Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Modern Notification Styling */
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
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .notification-card {
      background: #fff;
      border-radius: 12px;
      padding: 2.5rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      border: 1px solid rgba(0,0,0,0.05);
      max-width: 600px;
      width: 100%;
    }

    .notification-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .notification-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      color: #fff;
      font-size: 2rem;
    }

    .notification-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .notification-subtitle {
      color: #666;
      font-size: 1.1rem;
      line-height: 1.5;
    }

    .form-section {
      margin-bottom: 1.5rem;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
      display: block;
    }

    .form-control, .custom-select {
      border: 1px solid #e9ecef;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus, .custom-select:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .btn.btn-send {
      background: #dc3545 !important;
      color: #fff !important;
      border: none !important;
      padding: 0.75rem 2rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      width: 100%;
      box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
    }

    .btn.btn-send:hover {
      background: #c82333 !important;
      color: #fff !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .recipient-info {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 1rem;
      margin-top: 0.5rem;
      border-left: 3px solid #dc3545;
    }

    .recipient-info p {
      margin: 0;
      color: #666;
      font-size: 0.9rem;
    }

    .broadcast-option {
      background: #fff3cd;
      border: 1px solid #ffeaa7;
      border-radius: 8px;
      padding: 1rem;
      margin-top: 0.5rem;
    }

    .broadcast-option p {
      margin: 0;
      color: #856404;
      font-size: 0.9rem;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
      
      .notification-card {
        padding: 1.5rem;
      }
      
      .notification-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>
<?php 
$active = "";
include 'sidebar.php'; 
?>

<div class="content-wrapper">
  <div class="notification-card">
    <div class="notification-header">
      <div class="notification-icon">
        <i class="fas fa-bell"></i>
      </div>
      <h1 class="notification-title">Send Notification</h1>
      <p class="notification-subtitle">Send notifications to specific users or broadcast to all users</p>
    </div>

    <form method="post" action="send_notification.php" autocomplete="off">
      <div class="form-section">
        <label class="form-label" for="user_id">
          <i class="fas fa-user text-danger"></i> Recipient
        </label>
        <select name="user_id" id="user_id" class="custom-select">
          <option value="">
            <i class="fas fa-users"></i> Broadcast to All Users
          </option>
          <?php
          $users = mysqli_query($conn, "SELECT id, name, email FROM users ORDER BY name ASC");
          while ($u = mysqli_fetch_assoc($users)) {
            echo '<option value="' . $u['id'] . '">' . htmlspecialchars($u['name']) . ' (' . htmlspecialchars($u['email']) . ')</option>';
          }
          ?>
        </select>
        
        <div id="recipient-info" class="recipient-info" style="display: none;">
          <p><strong>Selected User:</strong> <span id="selected-user"></span></p>
        </div>
        
        <div id="broadcast-info" class="broadcast-option">
          <p><i class="fas fa-info-circle"></i> This notification will be sent to all registered users.</p>
        </div>
      </div>

      <div class="form-section">
        <label class="form-label" for="subject">
          <i class="fas fa-tag text-danger"></i> Subject
        </label>
        <input type="text" name="title" id="subject" class="form-control" placeholder="Enter notification subject" required>
      </div>

      <div class="form-section">
        <label class="form-label" for="message">
          <i class="fas fa-comment text-danger"></i> Message
        </label>
        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Enter your notification message" required></textarea>
      </div>

      <div class="form-section">
        <button type="submit" class="btn btn-send">
          <i class="fas fa-paper-plane"></i> Send Notification
        </button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#user_id').change(function() {
    var selectedOption = $(this).find('option:selected');
    var selectedText = selectedOption.text();
    var selectedValue = $(this).val();
    
    if (selectedValue) {
      // Specific user selected
      $('#recipient-info').show();
      $('#broadcast-info').hide();
      $('#selected-user').text(selectedText);
    } else {
      // Broadcast selected
      $('#recipient-info').hide();
      $('#broadcast-info').show();
    }
  });
  
  // Trigger change event on page load
  $('#user_id').trigger('change');
});

// Show success popup if notification was sent
<?php if (isset($_GET['notif_sent']) && $_GET['notif_sent'] == '1'): ?>
Swal.fire({
  icon: 'success',
  title: 'Notification Sent Successfully!',
  text: 'Your notification has been delivered to the selected recipient(s).',
  showConfirmButton: true,
  confirmButtonColor: '#dc3545',
  confirmButtonText: 'OK'
});
<?php endif; ?>

// Show error popup if there was an error
<?php if (isset($_GET['notif_error']) && $_GET['notif_error'] == '1'): ?>
Swal.fire({
  icon: 'error',
  title: 'Error Sending Notification',
  text: 'Please fill in all required fields and try again.',
  showConfirmButton: true,
  confirmButtonColor: '#dc3545',
  confirmButtonText: 'OK'
});
<?php endif; ?>
</script>

</body>
</html> 