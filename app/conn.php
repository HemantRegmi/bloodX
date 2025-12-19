<?php
// Use environment variables so the container can point at RDS instead of localhost
$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbName = getenv('DB_NAME') ?: 'blood_donation';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASSWORD') ?: '';
$dbPort = (int) (getenv('DB_PORT') ?: 3306);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
$conn->set_charset('utf8mb4');
?>
