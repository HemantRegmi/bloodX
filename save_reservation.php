<?php
require_once 'conn.php';
header('Content-Type: application/json');

$hospital_id = $_POST['hospital_id'] ?? '';
$name = $_POST['name'] ?? '';
$contact = $_POST['contact'] ?? '';
$date = $_POST['date'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';
$user_id = $_POST['user_id'] ?? null;

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

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?> 