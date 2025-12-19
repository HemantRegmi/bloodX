<?php
include 'conn.php';
include 'session.php';

header('Content-Type: application/json');

// Accept schedule from homepage (user side too), no admin requirement
$hospital_id = $_POST['hospital_id'] ?? '';
$name = $_POST['name'] ?? '';
$contact = $_POST['contact'] ?? '';
$date = $_POST['date'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';
$user_id = $_POST['user_id'] ?? null;
$health_questions = $_POST['health_questions'] ?? '';

if (!$hospital_id || !$name || !$contact || !$date || !$blood_group) {
  echo json_encode(['success' => false, 'message' => 'All fields are required.']);
  exit;
}

// Insert into reservation table. Prefer using type='donation' if the column exists; otherwise, use status='donation' fallback.
$datetime = $date . ' 00:00:00';

// Check if health_questions column exists
$hasHealthQuestionsCol = false;
$healthColRes = mysqli_query($conn, "SHOW COLUMNS FROM reservation LIKE 'health_questions'");
if ($healthColRes && mysqli_num_rows($healthColRes) > 0) { 
  $hasHealthQuestionsCol = true; 
}

$hasTypeCol = false;
$colRes = mysqli_query($conn, "SHOW COLUMNS FROM reservation LIKE 'type'");
if ($colRes && mysqli_num_rows($colRes) > 0) { $hasTypeCol = true; }

// Prepare health questions JSON
$healthQuestionsJson = !empty($health_questions) ? $health_questions : null;

if ($hasTypeCol && $hasHealthQuestionsCol) {
  if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_id, user_name, user_phone, reservation_date, blood_group, status, type, health_questions) VALUES (?, ?, ?, ?, ?, ?, 'pending', 'donation', ?)");
    $stmt->bind_param("iisssss", $hospital_id, $user_id, $name, $contact, $datetime, $blood_group, $healthQuestionsJson);
  } else {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_name, user_phone, reservation_date, blood_group, status, type, health_questions) VALUES (?, ?, ?, ?, ?, 'pending', 'donation', ?)");
    $stmt->bind_param("isssss", $hospital_id, $name, $contact, $datetime, $blood_group, $healthQuestionsJson);
  }
} elseif ($hasTypeCol) {
  if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_id, user_name, user_phone, reservation_date, blood_group, status, type) VALUES (?, ?, ?, ?, ?, ?, 'pending', 'donation')");
    $stmt->bind_param("iissss", $hospital_id, $user_id, $name, $contact, $datetime, $blood_group);
  } else {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_name, user_phone, reservation_date, blood_group, status, type) VALUES (?, ?, ?, ?, ?, 'pending', 'donation')");
    $stmt->bind_param("issss", $hospital_id, $name, $contact, $datetime, $blood_group);
  }
} elseif ($hasHealthQuestionsCol) {
  if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_id, user_name, user_phone, reservation_date, blood_group, status, health_questions) VALUES (?, ?, ?, ?, ?, ?, 'donation', ?)");
    $stmt->bind_param("iisssss", $hospital_id, $user_id, $name, $contact, $datetime, $blood_group, $healthQuestionsJson);
  } else {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_name, user_phone, reservation_date, blood_group, status, health_questions) VALUES (?, ?, ?, ?, ?, 'donation', ?)");
    $stmt->bind_param("isssss", $hospital_id, $name, $contact, $datetime, $blood_group, $healthQuestionsJson);
  }
} else {
  if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_id, user_name, user_phone, reservation_date, blood_group, status) VALUES (?, ?, ?, ?, ?, ?, 'donation')");
    $stmt->bind_param("iissss", $hospital_id, $user_id, $name, $contact, $datetime, $blood_group);
  } else {
    $stmt = $conn->prepare("INSERT INTO reservation (hospital_id, user_name, user_phone, reservation_date, blood_group, status) VALUES (?, ?, ?, ?, ?, 'donation')");
    $stmt->bind_param("issss", $hospital_id, $name, $contact, $datetime, $blood_group);
  }
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


