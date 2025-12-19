<?php
include 'conn.php';

// Handle both GET and POST requests
if(isset($_POST['query_id']) && is_numeric($_POST['query_id'])){
    $id = intval($_POST['query_id']);
    $sql = "UPDATE contact_query SET query_status=1 WHERE query_id=$id";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} elseif(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "UPDATE contact_query SET query_status=1 WHERE query_id=$id";
    mysqli_query($conn, $sql);
    header("Location: query.php");
    exit;
}
?>