<?php
session_start();
require_once '../../../config.php';

// ✅ Always set timezone
date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_in'])) {
    $user_id = $_SESSION['uid'];
    $name = $_SESSION['name'];

    if ($user_id) {
        $check_query = "SELECT id FROM dtr_logs WHERE user_id = ? AND date = CURDATE() AND time_in IS NOT NULL";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $_SESSION['timed_in'] = "You have already clocked in today.";
        } else {
            // ✅ Use PHP time (Asia/Manila), not MySQL NOW()
            $time_in = date('Y-m-d H:i:s');
            $today   = date('Y-m-d');

            $query = "INSERT INTO dtr_logs (user_id, name, time_in, date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $user_id, $name, $time_in, $today);
            $stmt->execute();
            $stmt->close();

            $_SESSION['timed_in'] = "Time in successfully.";
        }

        $check_stmt->close();
        header("Location: /roast-ms/pages/barista/dtr.php");
        exit;
    } else {
        echo "Please log in first.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_out'])) {
    $user_id = $_SESSION['uid'];

    if ($user_id) {
        $current_time = date('Y-m-d H:i:s'); // ✅ Manila time

        $query = "SELECT * FROM dtr_logs WHERE user_id = ? AND time_out IS NULL ORDER BY time_in DESC LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $clock_in = new DateTime($row['time_in']);
            $clock_out = new DateTime($current_time);
            $interval = $clock_in->diff($clock_out);
            $total_hours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);

            $update_query = "UPDATE dtr_logs SET time_out = ?, total_hours = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sds", $current_time, $total_hours, $row['id']);
            $update_stmt->execute();
            $update_stmt->close();

            $_SESSION['timed_out'] = "Time out successfully.";
        } else {
            $_SESSION['time_error'] = "No clock-in record found.";
        }

        $stmt->close();
        header("Location: /roast-ms/pages/barista/dtr.php");
        exit;
    } else {
        echo "Please log in first.";
    }
}
?>
=