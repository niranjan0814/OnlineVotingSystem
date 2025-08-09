<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// No POST handling needed for now, as this is a monitoring page
// Add functionality here if vote updates are required later

mysqli_close($con);
?>