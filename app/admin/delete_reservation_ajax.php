<?php
include 'conn.php';
include 'session.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

if (isset($_POST['reservation_id']) && is_numeric($_POST['reservation_id'])) {
    $id = intval($_POST['reservation_id']);
    
    $delete_reservation = mysqli_query($conn, "DELETE FROM reservation WHERE id=$id");
    
    if ($delete_reservation) {
        echo json_encode(['success' => true, 'message' => 'Reservation deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting reservation']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid reservation ID']);
}

mysqli_close($conn);
?> 