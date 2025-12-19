<?php
include 'conn.php';
include 'session.php';

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

try {
    // Get recent reservations with hospital names
    $reservationQuery = "SELECT 
        r.id,
        r.user_name,
        r.blood_group,
        r.reservation_date,
        r.status,
        r.created_at,
        h.name as hospital_name
        FROM reservation r
        LEFT JOIN hospitals h ON r.hospital_id = h.id
        ORDER BY r.created_at DESC
        LIMIT 20";
    
    $reservationResult = mysqli_query($conn, $reservationQuery);
    $reservations = [];
    
    while ($row = mysqli_fetch_assoc($reservationResult)) {
        $reservations[] = [
            'id' => (int)$row['id'],
            'user_name' => htmlspecialchars($row['user_name']),
            'blood_group' => htmlspecialchars($row['blood_group']),
            'hospital_name' => htmlspecialchars($row['hospital_name'] ?: 'Unknown Hospital'),
            'reservation_date' => date('M j, Y', strtotime($row['reservation_date'])),
            'status' => htmlspecialchars($row['status'] ?: 'pending'),
            'created_at' => date('M j, Y g:i A', strtotime($row['created_at']))
        ];
    }
    
    echo json_encode($reservations);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
