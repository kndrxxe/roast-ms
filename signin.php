<?php
// =========================
// 🔐 Session Security Settings
// =========================
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
session_start();

require_once "config.php"; // Secure database connection

// Redirect logged-in users to their respective dashboard
if (isset($_SESSION['username'])) {
    switch ($_SESSION['role']) {
        case 'Administrator':
            header("Location: /roast-ms/pages/admin/dashboard.php");
            exit;
        case 'Manager':
            header("Location: /roast-ms/pages/manager/dashboard.php");
            exit;
        case 'Barista':
            header("Location: /roast-ms/pages/barista/dashboard.php");
            exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $_SESSION['entered_username'] = $username; // Store the entered username
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Login success
            unset($_SESSION['entered_username']);
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['uid'] = $user['user_id'];

            // Set session timeout variables
            $_SESSION['LAST_ACTIVITY'] = time();
            $_SESSION['CREATED'] = time();

            // Redirect users based on role
            switch ($user['role']) {
                case 'Administrator':
                    header("Location: /roast-ms/pages/admin/dashboard.php");
                    exit;
                case 'Manager':
                    header("Location: /roast-ms/pages/manager/dashboard.php");
                    exit;
                case 'Barista':
                    header("Location: /roast-ms/pages/barista/dashboard.php");
                    exit;
            }
        } else {
            $_SESSION['invalidpassword'] = "The password you entered is incorrect. Please try again.";
            header("Location: /roast-ms/login.php");
            exit;
        }
    } else {
        $_SESSION['usernotfound'] = "User not Found";
        header("Location: /roast-ms/login.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
