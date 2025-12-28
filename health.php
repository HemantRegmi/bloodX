<?php
$conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
if (!$conn) {
    http_response_code(500);
    die("Database Connection Failed");
}
http_response_code(200);
echo "Healthy";
?>
