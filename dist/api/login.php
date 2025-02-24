<?php
session_start();
require_once "../../database/config.php"; // Secure database connection

// Redirect logged-in users to their respective dashboard
if (isset($_SESSION['username'])) {
    switch ($_SESSION['role']) {
        case 'Administrator':
            header("Location: /roast-ms/dist/pages/admin/dashboard.php");
            break;
        case 'Manager':
            header("Location: /roast-ms/dist/pages/manager/manager_dashboard.php");
            break;
        case 'Accountant':
            header("Location: /roast-ms/dist/pages/accountant/accountant_dashboard.php");
            break;
        case 'Staff':
            header("Location: /roast-ms/dist/pages/barista/barista_dashboard.php");
            break;
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name']; // Store full name
            $_SESSION['role'] = $user['role'];

            // Redirect users based on role
            switch ($user['role']) {
                case 'Administrator':
                    header("Location: /roast-ms/dist/pages/admin/dashboard.php");
                    break;
                case 'Manager':
                    header("Location: /roast-ms/dist/pages/manager/manager_dashboard.php");
                    break;
                case 'Accountant':
                    header("Location: /roast-ms/dist/pages/accountant/accountant_dashboard.php");
                    break;
                case 'Staff':
                    header("Location: /roast-ms/dist/pages/barista/barista_dashboard.php");
                    break;
            }
            exit;
        } else {
            $_SESSION['invalidpassword'] = "Invalid Password";
            header("Location: /roast-ms/dist/pages/login");
        }
    } else {
        $_SESSION['usernotfound'] = "User not Found";
        header("Location: /roast-ms/dist/pages/login");
    }

    $stmt->close();
    $conn->close();
}
?>