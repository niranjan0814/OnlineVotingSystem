<?php
session_start(); // Start session at the top
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    $login_query = "SELECT id, email, password, type FROM register WHERE email = ?";
    $login_stmt = mysqli_prepare($con, $login_query);
    mysqli_stmt_bind_param($login_stmt, "s", $email);
    mysqli_stmt_execute($login_stmt);
    $result = mysqli_stmt_get_result($login_stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true); // Regenerate session ID for security
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['type'] = $user['type'];
        echo "Debug: Session set - Type: " . $_SESSION['type'] . ", ID: " . session_id(); // Debug output

        switch ($user['type']) {
            case 'admin':
                header('Location: ../html/admin_index.php');
                break;
            case 'user':
                header('Location: ../html/index.php');
                break;
            case 'contestant':
                header('Location: ../html/contestant_dashboard.php');
                break;
            default:
                die("Invalid user type.");
        }
        exit;
    } else {
        die("Invalid email or password.");
    }

    mysqli_stmt_close($login_stmt);
}

mysqli_close($con);
?>