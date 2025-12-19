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
    // Get hospital performance data
    $hospitalQuery = "SELECT 
        h.name as hospital_name,
        COUNT(r.id) as reservation_count,
        SUM(CASE WHEN r.status = 'completed' THEN 1 ELSE 0 END) as completed_count
        FROM hospitals h
        LEFT JOIN reservation r ON h.id = r.hospital_id
        GROUP BY h.id, h.name
        ORDER BY reservation_count DESC
        LIMIT 10";
    
    $hospitalResult = mysqli_query($conn, $hospitalQuery);
    $labels = [];
    $values = [];
    
    while ($row = mysqli_fetch_assoc($hospitalResult)) {
        $labels[] = $row['hospital_name'];
        $values[] = (int)$row['reservation_count'];
    }
    
    // If no data, provide default values
    if (empty($labels)) {
        $labels = ['No Hospitals'];
        $values = [0];
    }
    
    $response = [
        'labels' => $labels,
        'values' => $values
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
