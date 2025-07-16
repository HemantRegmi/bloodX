<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="sidebar" ><b>
  <a href="dashboard.php"   <?php if($active=='dashboard') echo "class='act'"; ?>><span class="glyphicon glyphicon-dashboard"></span>&nbsp&nbspDashboard</a>
  <a href="add_donor.php"   <?php if($active=='add') echo "class='act'"; ?>><span class="glyphicon glyphicon-pencil"></span>&nbsp&nbspAdd Donor</a>
  <a href="donor_list.php"   <?php if($active=='list') echo "class='act'"; ?>><span class="glyphicon glyphicon-list-alt"></span>&nbsp&nbsp Donor List</a>
  <a href="query.php"   <?php if($active=='query') echo "class='act'"; ?>><span class="glyphicon glyphicon-check"></span>&nbsp&nbspUser Query</a>
  <a href="hospital.php"   <?php if($active=='hospital') echo "class='act'"; ?>><span class="glyphicon glyphicon-plus-sign"></span>&nbsp&nbspManage Hospitals</a>
  <a href="notification.php" <?php if(basename($_SERVER['PHP_SELF'])=='notification.php') echo "class='act'"; ?>><span class="glyphicon glyphicon-bell"></span>&nbsp&nbspSend Notification</a>
</div>
