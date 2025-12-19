<?php
require_once 'conn.php';
header('Content-Type: application/json');

// Ensure new donor columns exist (latitude, longitude, last_donation_date, availability_score)
function ensureDonorColumns($conn) {
  // Check existing columns
  $columns = [];
  $res = $conn->query("SHOW COLUMNS FROM donor_details");
  if ($res) {
    while ($row = $res->fetch_assoc()) {
      $columns[strtolower($row['Field'])] = true;
    }
    $res->free();
  }

  $alterSqls = [];
  if (!isset($columns['latitude'])) {
    $alterSqls[] = "ADD COLUMN latitude DECIMAL(10,7) NULL";
  }
  if (!isset($columns['longitude'])) {
    $alterSqls[] = "ADD COLUMN longitude DECIMAL(10,7) NULL";
  }
  if (!isset($columns['last_donation_date'])) {
    $alterSqls[] = "ADD COLUMN last_donation_date DATE NULL";
  }
  if (!isset($columns['availability_score'])) {
    $alterSqls[] = "ADD COLUMN availability_score TINYINT NULL";
  }

  if (!empty($alterSqls)) {
    $sql = "ALTER TABLE donor_details " . implode(", ", $alterSqls);
    @$conn->query($sql); // suppress errors if permissions restricted
  }
}
ensureDonorColumns($conn);

// Accept both GET and POST
$getParam = function($key, $default = null) {
  if (isset($_POST[$key])) return $_POST[$key];
  if (isset($_GET[$key])) return $_GET[$key];
  return $default;
};

$blood_group = $getParam('blood_group', '');
$limit = (int)$getParam('limit', 12);
if ($limit <= 0 || $limit > 50) $limit = 12;

$age_min = $getParam('age_min', null);
$age_max = $getParam('age_max', null);
$gender = $getParam('gender', null); // 'Male' | 'Female' etc.
$address_like = $getParam('address_like', null); // substring match

// Optional recipient features for kNN ranking
$recipient_age = $getParam('recipient_age', null);
$recipient_lat = $getParam('recipient_lat', null);
$recipient_lng = $getParam('recipient_lng', null);
// Weights (defaults)
$w_age = (float)$getParam('weight_age', 0.3);
$w_distance = (float)$getParam('weight_distance', 0.5);
$w_recency = (float)$getParam('weight_recency', 0.2);
$k = (int)$getParam('k', $limit);
if ($k <= 0) $k = $limit;

if (!$blood_group) {
  echo json_encode(['success' => false, 'message' => 'blood_group is required']);
  exit;
}

// Compatibility map
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

// Build SQL with filters
$where = [];
$params = [];
$types = '';

// donor_blood IN (...)
$placeholders = implode(',', array_fill(0, count($compatibleGroups), '?'));
$where[] = "donor_blood IN ($placeholders)";
$types .= str_repeat('s', count($compatibleGroups));
$params = array_merge($params, $compatibleGroups);

if ($age_min !== null && $age_min !== '') {
  $where[] = "donor_age >= ?";
  $types .= 'i';
  $params[] = (int)$age_min;
}
if ($age_max !== null && $age_max !== '') {
  $where[] = "donor_age <= ?";
  $types .= 'i';
  $params[] = (int)$age_max;
}
if ($gender !== null && $gender !== '') {
  $where[] = "donor_gender = ?";
  $types .= 's';
  $params[] = $gender;
}
if ($address_like !== null && $address_like !== '') {
  $where[] = "donor_address LIKE ?";
  $types .= 's';
  $params[] = '%' . $address_like . '%';
}

$whereSql = count($where) ? ('WHERE ' . implode(' AND ', $where)) : '';

// Fetch a wider pool when we intend to kNN-rank client-side
$poolLimit = max($limit, 50);

$sql =
  "SELECT donor_id, donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address,
          latitude, longitude, last_donation_date
   FROM donor_details
   $whereSql
   ORDER BY (donor_blood = ?) DESC, RAND()
   LIMIT ?";

// Add ordering and limit parameters
$types .= 'si';
$params[] = $blood_group; // exact-match first
$params[] = $poolLimit;

$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
  exit;
}

$bind = [];
$bind[] = $types;
for ($i = 0; $i < count($params); $i++) {
  $bindVar = 'p' . $i;
  $$bindVar = $params[$i];
  $bind[] = &$$bindVar;
}
call_user_func_array([$stmt, 'bind_param'], $bind);

if (!$stmt->execute()) {
  echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
  $stmt->close();
  $conn->close();
  exit;
}

$res = $stmt->get_result();
$donors = [];
while ($row = $res->fetch_assoc()) {
  $donors[] = $row;
}

// If recipient features provided, compute kNN-style ranking
if (($recipient_age !== null && $recipient_age !== '') ||
    ($recipient_lat !== null && $recipient_lng !== null && $recipient_lat !== '' && $recipient_lng !== '')) {

  $recipient_age = $recipient_age !== null && $recipient_age !== '' ? (int)$recipient_age : null;
  $recipient_lat = $recipient_lat !== null && $recipient_lat !== '' ? (float)$recipient_lat : null;
  $recipient_lng = $recipient_lng !== null && $recipient_lng !== '' ? (float)$recipient_lng : null;

  $ranked = [];
  foreach ($donors as $d) {
    // Age feature (normalized 0..1 roughly by 60-year range)
    $ageDist = 0.0;
    if ($recipient_age !== null && isset($d['donor_age']) && $d['donor_age'] !== null) {
      $ageDist = min(1.0, abs(((int)$d['donor_age']) - $recipient_age) / 60.0);
    }

    // Distance feature using haversine (km), normalized by 50km window
    $distNorm = 0.0;
    if ($recipient_lat !== null && $recipient_lng !== null &&
        isset($d['latitude']) && isset($d['longitude']) &&
        $d['latitude'] !== null && $d['longitude'] !== null &&
        $d['latitude'] !== '' && $d['longitude'] !== '') {
      $lat1 = deg2rad((float)$recipient_lat);
      $lon1 = deg2rad((float)$recipient_lng);
      $lat2 = deg2rad((float)$d['latitude']);
      $lon2 = deg2rad((float)$d['longitude']);
      $a = sin(($lat2 - $lat1)/2) ** 2 + cos($lat1) * cos($lat2) * sin(($lon2 - $lon1)/2) ** 2;
      $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
      $earthKm = 6371.0;
      $km = $earthKm * $c;
      // Normalize: 0 at 0km, approach 1 beyond 50km
      $distNorm = min(1.0, $km / 50.0);
    }

    // Recency: prefer donors eligible now. If date missing, neutral 0.5
    $recencyNorm = 0.5;
    if (!empty($d['last_donation_date'])) {
      $days = (new DateTime())->diff(new DateTime($d['last_donation_date']))->days;
      // 0 at 0 days, 1 at >= 180 days
      $recencyNorm = max(0.0, min(1.0, $days / 180.0));
    }

    // Weighted distance (lower is better)
    $score = ($w_age * $ageDist) + ($w_distance * $distNorm) + ($w_recency * (1.0 - $recencyNorm));

    $d['_score'] = $score;
    $d['_ageDist'] = $ageDist;
    $d['_distNorm'] = $distNorm;
    $d['_recencyNorm'] = $recencyNorm;
    $ranked[] = $d;
  }

  // Sort: exact blood match first, then by kNN score
  usort($ranked, function($a, $b) use ($blood_group) {
    $aExact = ($a['donor_blood'] === $blood_group) ? 1 : 0;
    $bExact = ($b['donor_blood'] === $blood_group) ? 1 : 0;
    
    // If one is exact match and other isn't, exact match wins
    if ($aExact != $bExact) {
      return $bExact - $aExact; // 1 (exact) comes before 0 (compatible)
    }
    
    // Both same type (both exact or both compatible), sort by score
    if ($a['_score'] == $b['_score']) return 0;
    return ($a['_score'] < $b['_score']) ? -1 : 1;
  });

  $ranked = array_slice($ranked, 0, $k);

  echo json_encode([
    'success' => true,
    'count' => count($ranked),
    'donors' => $ranked,
    'ranking' => [
      'weights' => ['age' => $w_age, 'distance' => $w_distance, 'recency' => $w_recency]
    ]
  ]);
} else {
  // Fallback to previous ranking
  $donors = array_slice($donors, 0, $limit);
  echo json_encode([
    'success' => true,
    'count' => count($donors),
    'donors' => $donors
  ]);
}

$stmt->close();
$conn->close();
?>


