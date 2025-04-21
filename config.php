<?php
$host = "127.0.0.1";    // Database host (e.g., 127.0.0.1 or your server IP)
$user = "root";         // Database username
$pass = "";             // Database password
$dbname = "roast-ms"; // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for better security & compatibility
$conn->set_charset("utf8mb4");
?>
