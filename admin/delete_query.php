<?php
include 'conn.php';
include 'session.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo 'error';
    exit;
}

// Handle both POST and GET requests for compatibility
if (isset($_POST['query_id']) && is_numeric($_POST['query_id'])) {
    $id = intval($_POST['query_id']);
} elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo 'error';
    exit;
}

$sql = "DELETE FROM contact_query WHERE query_id = {$id}";
if (mysqli_query($conn, $sql)) {
    echo 'success';
} else {
    echo 'error';
}

mysqli_close($conn);
?>
