<?php
require_once "../../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO feedback (rating, name, email, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $rating, $name, $email, $comment);
    
    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
        header("Location: success.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
