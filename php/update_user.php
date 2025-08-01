<?php
session_start();
require '../php/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'] ?? 0;
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $NIC = $_POST['NIC'] ?? '';
    $address = $_POST['address'] ?? '';
    $type = $_POST['type'] ?? '';
    
    // Basic validation
    if (empty($username) || empty($email) || empty($phone) || empty($NIC) || empty($address) || empty($type)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }
    
    $query = "UPDATE register SET username = ?, email = ?, phone = ?, NIC = ?, address = ?, type = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($con)]);
        exit;
    }
    
    mysqli_stmt_bind_param($stmt, "ssssssi", $username, $email, $phone, $NIC, $address, $type, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating user: ' . mysqli_error($con)]);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>