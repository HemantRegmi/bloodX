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
    // Get status distribution data
    $statusData = [];
    
    // Count by status
    $statusQuery = "SELECT 
        status,
        COUNT(*) as count
        FROM reservation 
        GROUP BY status";
    
    $statusResult = mysqli_query($conn, $statusQuery);
    $labels = [];
    $values = [];
    
    while ($row = mysqli_fetch_assoc($statusResult)) {
        $status = $row['status'] ?: 'pending';
        $labels[] = ucfirst($status);
        $values[] = (int)$row['count'];
    }
    
    // If no data, provide default values
    if (empty($labels)) {
        $labels = ['Pending', 'Completed'];
        $values = [0, 0];
    }
    
    $statusData = [
        'labels' => $labels,
        'values' => $values
    ];
    
        // Get trend data for last 30 days
    $trendData = [];
    $trendLabels = [];
    $trendValues = [];
    
    for ($i = 29; $i >= 0; $i--) {
      $date = date('Y-m-d', strtotime("-$i days"));
      $dayName = date('M j', strtotime($date));
      
      $trendQuery = "SELECT COUNT(*) as count 
                     FROM reservation 
                     WHERE DATE(created_at) = '$date'";
      
      $trendResult = mysqli_query($conn, $trendQuery);
      $trendRow = mysqli_fetch_assoc($trendResult);
      
      $trendLabels[] = $dayName;
      $trendValues[] = (int)$trendRow['count'];
    }
    
    $trendData = [
        'labels' => $trendLabels,
        'values' => $trendValues
    ];
    
    // Get additional statistics
    $stats = [];
    
    // Total reservations
    $totalQuery = "SELECT COUNT(*) as total FROM reservation";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $stats['total'] = (int)$totalRow['total'];
    
    // Completed reservations
    $completedQuery = "SELECT COUNT(*) as completed FROM reservation WHERE status = 'completed'";
    $completedResult = mysqli_query($conn, $completedQuery);
    $completedRow = mysqli_fetch_assoc($completedResult);
    $stats['completed'] = (int)$completedRow['completed'];
    
    // Pending reservations
    $pendingQuery = "SELECT COUNT(*) as pending FROM reservation WHERE status = 'pending'";
    $pendingResult = mysqli_query($conn, $pendingQuery);
    $pendingRow = mysqli_fetch_assoc($pendingResult);
    $stats['pending'] = (int)$pendingRow['pending'];
    
    // Today's reservations
    $todayQuery = "SELECT COUNT(*) as today FROM reservation WHERE DATE(created_at) = CURDATE()";
    $todayResult = mysqli_query($conn, $todayQuery);
    $todayRow = mysqli_fetch_assoc($todayResult);
    $stats['today'] = (int)$todayRow['today'];
    
    // This week's reservations
    $weekQuery = "SELECT COUNT(*) as week FROM reservation WHERE YEARWEEK(created_at) = YEARWEEK(NOW())";
    $weekResult = mysqli_query($conn, $weekQuery);
    $weekRow = mysqli_fetch_assoc($weekResult);
    $stats['week'] = (int)$weekRow['week'];
    
    // This month's reservations
    $monthQuery = "SELECT COUNT(*) as month FROM reservation WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())";
    $monthResult = mysqli_query($conn, $monthQuery);
    $monthRow = mysqli_fetch_assoc($monthResult);
    $stats['month'] = (int)$monthRow['month'];
    
    // Blood group distribution
    $bloodGroupQuery = "SELECT 
        blood_group,
        COUNT(*) as count
        FROM reservation 
        GROUP BY blood_group 
        ORDER BY count DESC";
    
    $bloodGroupResult = mysqli_query($conn, $bloodGroupQuery);
    $bloodGroupData = [];
    
    while ($row = mysqli_fetch_assoc($bloodGroupResult)) {
        $bloodGroupData[] = [
            'group' => $row['blood_group'],
            'count' => (int)$row['count']
        ];
    }
    
    $response = [
        'statusData' => $statusData,
        'trendData' => $trendData,
        'stats' => $stats,
        'bloodGroupData' => $bloodGroupData,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
