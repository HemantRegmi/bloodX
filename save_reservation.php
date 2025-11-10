<?php
require_once 'conn.php';
header('Content-Type: application/json');

$hospital_id = $_POST['hospital_id'] ?? '';
$name = $_POST['name'] ?? '';
$contact = $_POST['contact'] ?? '';
$date = $_POST['date'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';
$user_id = $_POST['user_id'] ?? null;
$with_suggestions = isset($_POST['with_suggestions']) ? (int)$_POST['with_suggestions'] : 0;

if (!$hospital_id || !$name || !$contact || !$date || !$blood_group) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_id, user_name, user_phone, reservation_date, blood_group, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iissss", $hospital_id, $user_id, $name, $contact, $date, $blood_group);
} else {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_name, user_phone, reservation_date, blood_group, status) VALUES (?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("issss", $hospital_id, $name, $contact, $date, $blood_group);
}

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$response = ['success' => false];
if ($stmt->execute()) {
    $response['success'] = true;
    // Optionally add donor suggestions using the same compatibility logic endpoint
    if ($with_suggestions) {
        // Default to 8 suggestions
        $limit = 8;
        // Reuse compatibility by querying best_donors.php internally
        // Fallback to direct query if allow_url_fopen is disabled
        $donors = [];

        // Direct query using compatibility
        $compatibility = [
            'O-'  => ['O-'],
            'O+'  => ['O+', 'O-'],
            'A-'  => ['A-', 'O-'],
            'A+'  => ['A+', 'A-', 'O+', 'O-'],
            'B-'  => ['B-', 'O-'],
            'B+'  => ['B+', 'B-', 'O+', 'O-'],
            'AB-' => ['AB-', 'A-', 'B-', 'O-'],
            'AB+' => ['AB+', 'AB-', 'A+', 'A-', 'B+', 'B-', 'O+', 'O-'],
        ];
        $compatibleGroups = isset($compatibility[$blood_group]) ? $compatibility[$blood_group] : [$blood_group];
        $placeholders = implode(',', array_fill(0, count($compatibleGroups), '?'));
        $sql = "SELECT donor_id, donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address
                FROM donor_details
                WHERE donor_blood IN ($placeholders)
                ORDER BY (donor_blood = ?) DESC, RAND()
                LIMIT ?";
        $stmt2 = $conn->prepare($sql);
        if ($stmt2) {
            $types = str_repeat('s', count($compatibleGroups)) . 'si';
            $params = $compatibleGroups;
            $params[] = $blood_group;
            $params[] = $limit;
            $bind = [];
            $bind[] = $types;
            for ($i = 0; $i < count($params); $i++) {
                $bindVar = 'p' . $i;
                $$bindVar = $params[$i];
                $bind[] = &$$bindVar;
            }
            call_user_func_array([$stmt2, 'bind_param'], $bind);
            if ($stmt2->execute()) {
                $res2 = $stmt2->get_result();
                while ($row = $res2->fetch_assoc()) {
                    $donors[] = $row;
                }
            }
            $stmt2->close();
        }
        $response['suggestions'] = [
            'count' => count($donors),
            'donors' => $donors
        ];
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Execute failed: ' . $stmt->error;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?> 