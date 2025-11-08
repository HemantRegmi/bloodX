<?php
include 'conn.php';
include 'session.php';

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Access denied. Please login first.";
    exit;
}

echo "<h2>Database Migration: Adding created_at column to reservation table</h2>";

try {
    // Check if created_at column already exists
    $checkColumn = "SHOW COLUMNS FROM reservation LIKE 'created_at'";
    $result = mysqli_query($conn, $checkColumn);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: green;'>✓ created_at column already exists in reservation table.</p>";
    } else {
        // Add created_at column
        $addColumn = "ALTER TABLE reservation ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        
        if (mysqli_query($conn, $addColumn)) {
            echo "<p style='color: green;'>✓ Successfully added created_at column to reservation table.</p>";
            
            // Update existing records with current timestamp
            $updateExisting = "UPDATE reservation SET created_at = NOW() WHERE created_at IS NULL";
            if (mysqli_query($conn, $updateExisting)) {
                echo "<p style='color: green;'>✓ Updated existing reservation records with current timestamp.</p>";
            } else {
                echo "<p style='color: orange;'>⚠ Warning: Could not update existing records: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>✗ Error adding created_at column: " . mysqli_error($conn) . "</p>";
        }
    }
    
    // Show current table structure
    echo "<h3>Current reservation table structure:</h3>";
    $showTable = "DESCRIBE reservation";
    $tableResult = mysqli_query($conn, $showTable);
    
    if ($tableResult) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = mysqli_fetch_assoc($tableResult)) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    // Show sample data
    echo "<h3>Sample reservation data:</h3>";
    $sampleData = "SELECT * FROM reservation ORDER BY id DESC LIMIT 5";
    $sampleResult = mysqli_query($conn, $sampleData);
    
    if ($sampleResult && mysqli_num_rows($sampleResult) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>User Name</th><th>Blood Group</th><th>Status</th><th>Created At</th></tr>";
        
        while ($row = mysqli_fetch_assoc($sampleResult)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['blood_group']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . ($row['created_at'] ?? 'N/A') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: blue;'>No reservation data found.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

echo "<br><a href='dashboard.php' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Dashboard</a>";
?>
