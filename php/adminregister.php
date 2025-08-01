<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);
    $type = trim($_POST['type']);
    $NIC = trim($_POST['NIC']);
    $address = trim($_POST['address']);

    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password) || empty($type) || empty($NIC) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => "Passwords don't match"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    if (!in_array($type, ['admin', 'contestant'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid user type']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT id FROM register WHERE username = ? OR email = ?";
    $check_stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($check_stmt, "ss", $username, $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
        exit;
    }
    mysqli_stmt_close($check_stmt);

    $register_query = "INSERT INTO register (username, email, phone, password, type, NIC, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $register_stmt = mysqli_prepare($con, $register_query);
    mysqli_stmt_bind_param($register_stmt, "sssssss", $username, $email, $phone, $hashed_password, $type, $NIC, $address);

    if (mysqli_stmt_execute($register_stmt)) {
        $register_id = mysqli_insert_id($con);
        $_SESSION['user_id'] = $register_id;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $type;
        echo json_encode(['success' => true, 'message' => 'User registered successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error registering user: ' . mysqli_error($con)]);
    }

    mysqli_stmt_close($register_stmt);
}

mysqli_close($con);
?>