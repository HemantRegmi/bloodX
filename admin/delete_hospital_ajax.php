<?php
include 'conn.php';
include 'session.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

if (isset($_POST['hospital_id']) && is_numeric($_POST['hospital_id'])) {
    $id = intval($_POST['hospital_id']);
    
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        // First, check if hospital exists
        $check_hospital = mysqli_query($conn, "SELECT id FROM hospitals WHERE id = $id");
        if (mysqli_num_rows($check_hospital) == 0) {
            mysqli_rollback($conn);
            echo json_encode(['success' => false, 'message' => 'Hospital not found']);
            exit;
        }
        
        // Delete all reservations for this hospital (if any exist)
        $delete_reservations = mysqli_query($conn, "DELETE FROM reservation WHERE hospital_id = $id");
        if ($delete_reservations === false) {
            mysqli_rollback($conn);
            echo json_encode(['success' => false, 'message' => 'Error deleting reservations: ' . mysqli_error($conn)]);
            exit;
        }
        
        // Now delete the hospital
        $delete_hospital = mysqli_query($conn, "DELETE FROM hospitals WHERE id = $id");
        if ($delete_hospital === false) {
            mysqli_rollback($conn);
            echo json_encode(['success' => false, 'message' => 'Error deleting hospital: ' . mysqli_error($conn)]);
            exit;
        }
        
        // Check if hospital was actually deleted
        $check_deleted = mysqli_query($conn, "SELECT id FROM hospitals WHERE id = $id");
        if (mysqli_num_rows($check_deleted) > 0) {
            mysqli_rollback($conn);
            echo json_encode(['success' => false, 'message' => 'Hospital deletion failed - hospital still exists']);
            exit;
        }
        
        // Commit the transaction
        mysqli_commit($conn);
        echo json_encode(['success' => true, 'message' => 'Hospital and all associated reservations deleted successfully']);
        
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => 'Exception occurred: ' . $e->getMessage()]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid hospital ID']);
}

mysqli_close($conn);
?> 