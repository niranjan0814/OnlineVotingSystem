<?php
session_start(); // Start session
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT id FROM register WHERE username = ? OR email = ?";
    $check_stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($check_stmt, "ss", $username, $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        die("Username or email already exists.");
    }
    mysqli_stmt_close($check_stmt);

    $register_query = "INSERT INTO register (username, email, phone, password) VALUES (?, ?, ?, ?)";
    $register_stmt = mysqli_prepare($con, $register_query);
    mysqli_stmt_bind_param($register_stmt, "ssss", $username, $email, $phone, $hashed_password);

    if (mysqli_stmt_execute($register_stmt)) {
        $register_id = mysqli_insert_id($con);
        $_SESSION['user_id'] = $register_id; // Set session after registration
        $_SESSION['email'] = $email; // Optional
        header('Location: ../html/index.php'); // Redirect to homepage
        exit;
    } else {
        echo "Error inserting into register: " . mysqli_error($con);
    }
    mysqli_stmt_close($register_stmt);
}

mysqli_close($con);
?>