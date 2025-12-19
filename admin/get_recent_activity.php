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
    $activities = [];
    
    // Get recent reservations and donation schedules (last 10)
    $reservationQuery = "SELECT 
        r.id,
        r.user_name,
        r.blood_group,
        r.status,
        r.created_at,
        h.name as hospital_name
        FROM reservation r
        LEFT JOIN hospitals h ON r.hospital_id = h.id
        ORDER BY r.created_at DESC
        LIMIT 10";
    
    $reservationResult = mysqli_query($conn, $reservationQuery);
    
    if ($reservationResult) {
        while ($row = mysqli_fetch_assoc($reservationResult)) {
            $activity = [];
            
            $isDonation = (isset($row['status']) && ($row['status'] === 'donation' || $row['status'] === 'donation_completed'));
            if ($row['status'] == 'completed' || $row['status'] == 'donation_completed') {
                $activity['type'] = 'completed';
                $activity['icon'] = 'fa-check-circle';
                $activity['text'] = ($isDonation ? 'Donation' : 'Reservation') . " completed for {$row['user_name']} ({$row['blood_group']}) at {$row['hospital_name']}";
            } elseif ($row['status'] == 'pending') {
                $activity['type'] = 'pending';
                $activity['icon'] = 'fa-clock';
                $activity['text'] = "New " . ($isDonation ? 'donation schedule' : 'reservation') . " from {$row['user_name']} for {$row['blood_group']} at {$row['hospital_name']}";
            } else {
                $activity['type'] = 'new';
                $activity['icon'] = 'fa-plus-circle';
                $activity['text'] = "New " . ($isDonation ? 'donation schedule' : 'reservation') . " from {$row['user_name']} for {$row['blood_group']} at {$row['hospital_name']}";
            }
            
            $activity['time'] = date('M j, Y g:i A', strtotime($row['created_at']));
            $activities[] = $activity;
        }
    }
    
    // Get recent contact queries (last 5)
    $queryQuery = "SELECT 
        query_name,
        query_message,
        query_date
        FROM contact_query
        ORDER BY query_date DESC
        LIMIT 5";
    
    $queryResult = mysqli_query($conn, $queryQuery);
    
    if ($queryResult) {
        while ($row = mysqli_fetch_assoc($queryResult)) {
            $message = substr($row['query_message'], 0, 50);
            if (strlen($row['query_message']) > 50) {
                $message .= '...';
            }
            
            $activity = [
                'type' => 'pending',
                'icon' => 'fa-comment',
                'text' => "New query from {$row['query_name']}: {$message}",
                'time' => date('M j, Y g:i A', strtotime($row['query_date']))
            ];
            $activities[] = $activity;
        }
    }
    
    // Sort all activities by time (most recent first)
    usort($activities, function($a, $b) {
        return strtotime($b['time']) - strtotime($a['time']);
    });
    
    // Return only the 10 most recent activities
    $activities = array_slice($activities, 0, 10);
    
    echo json_encode($activities);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
