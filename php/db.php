<?php
// MySQL connection details
$database = "your_mysql_database";

// Create connection
$conn = new mysqli($database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to UTF-8 (optional)
$conn->set_charset("utf8mb4");
?>
