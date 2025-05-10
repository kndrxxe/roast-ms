<?php
session_start();
require_once '../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_in'])) {
    // Ensure the user is logged in
    $user_id = $_SESSION['uid'];
    
    if ($user_id) {
        // Insert clock-in time into the database
        $query = "INSERT INTO dtr_logs (user_id, time_in, date) VALUES (?, NOW(), CURDATE())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        // Respond with success
        echo "Time in successfully.";
    } else {
        echo "Please log in first.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_out'])) {
    $user_id = $_SESSION['uid'];

    if ($user_id) {
        // Get the current time
        $current_time = date('Y-m-d H:i:s');

        // Find the most recent clock-in record
        $query = "SELECT * FROM dtr_logs WHERE user_id = ? AND time_out IS NULL ORDER BY time_in DESC LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Calculate total hours worked
            $row = $result->fetch_assoc();
            $clock_in = new DateTime($row['time_in']);
            $clock_out = new DateTime($current_time);
            $interval = $clock_in->diff($clock_out);
            $total_hours = $interval->h + ($interval->i / 60);

            // Update the record with clock-out time and total hours worked
            $update_query = "UPDATE dtr_logs SET time_out = ?, total_hours = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sdi", $current_time, $total_hours, $row['id']);
            $update_stmt->execute();
            $update_stmt->close();

            echo "Time out successfully.";
        } else {
            echo "No time record found.";
        }
    } else {
        echo "Please log in first.";
    }
}

?>