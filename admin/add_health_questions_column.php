<?php
include 'conn.php';
include 'session.php';

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Access denied. Please login first.";
    exit;
}

echo "<h2>Database Migration: Adding health_questions column to reservation table</h2>";

try {
    // Check if health_questions column already exists
    $checkColumn = "SHOW COLUMNS FROM reservation LIKE 'health_questions'";
    $result = mysqli_query($conn, $checkColumn);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: green;'>✓ health_questions column already exists in reservation table.</p>";
    } else {
        // Add health_questions column as TEXT to store JSON data
        $addColumn = "ALTER TABLE reservation ADD COLUMN health_questions TEXT NULL AFTER status";
        
        if (mysqli_query($conn, $addColumn)) {
            echo "<p style='color: green;'>✓ Successfully added health_questions column to reservation table.</p>";
        } else {
            echo "<p style='color: red;'>✗ Error adding health_questions column: " . mysqli_error($conn) . "</p>";
        }
    }
    
    // Show current table structure
    echo "<h3>Current reservation table structure:</h3>";
    $showTable = "DESCRIBE reservation";
    $tableResult = mysqli_query($conn, $showTable);
    
    if ($tableResult) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f0f0f0;'><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        while ($row = mysqli_fetch_assoc($tableResult)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Field']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Null']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Key']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Default'] ?? 'NULL') . "</td>";
            echo "<td>" . htmlspecialchars($row['Extra']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>Error showing table structure: " . mysqli_error($conn) . "</p>";
    }
    
    echo "<br><a href='dashboard.php' style='padding: 10px 20px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px;'>Back to Dashboard</a>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>

