<?php
// health.php
// Validates that the application AND database are ready.

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASSWORD') ?: '';
$db_name = getenv('DB_NAME') ?: 'bloodx';

// 1. Check if PHP is running
if (!function_exists('mysqli_connect')) {
    http_response_code(500);
    echo "PHP MySQL extension missing";
    exit;
}

// 2. Check Database Connection
$conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    http_response_code(500);
    echo "Database Connection Failed: " . mysqli_connect_error();
    exit;
}

// 3. Simple Query Check
if (!mysqli_query($conn, "SELECT 1")) {
    http_response_code(500);
    echo "Database Query Failed";
    mysqli_close($conn);
    exit;
}

mysqli_close($conn);

// All Good
http_response_code(200);
echo "Healthy";
?>