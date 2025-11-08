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
    // Get hourly distribution data for the last 7 days
    $hourlyQuery = "SELECT 
        HOUR(created_at) as hour,
        COUNT(*) as count
        FROM reservation 
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        GROUP BY HOUR(created_at)
        ORDER BY hour";
    
    $hourlyResult = mysqli_query($conn, $hourlyQuery);
    $hourlyData = array_fill(0, 24, 0); // Initialize all hours with 0
    
    while ($row = mysqli_fetch_assoc($hourlyResult)) {
        $hour = (int)$row['hour'];
        $hourlyData[$hour] = (int)$row['count'];
    }
    
    $labels = [];
    $values = [];
    
    for ($i = 0; $i < 24; $i++) {
        $labels[] = sprintf('%02d:00', $i);
        $values[] = $hourlyData[$i];
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
