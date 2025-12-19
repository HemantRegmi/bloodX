<?php
include 'conn.php';
include 'session.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

if (isset($_POST['donor_id']) && is_numeric($_POST['donor_id'])) {
    $id = intval($_POST['donor_id']);
    
    $delete_donor = mysqli_query($conn, "DELETE FROM donor_details WHERE donor_id=$id");
    
    if ($delete_donor) {
        echo json_encode(['success' => true, 'message' => 'Donor deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting donor']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid donor ID']);
}

mysqli_close($conn);
?> 