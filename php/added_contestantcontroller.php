<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle UPDATE request
    if (isset($_GET['id'])) {
        $id = trim($_GET['id']);

        // Fetch existing record
        $select_query = "SELECT name, image_url, description, status FROM contestants WHERE id = ?";
        $select_stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($select_stmt, "i", $id);
        mysqli_stmt_execute($select_stmt);
        $result = mysqli_stmt_get_result($select_stmt);
        $existing_contestant = mysqli_fetch_assoc($result);
        mysqli_stmt_close($select_stmt);

        if (!$existing_contestant) {
            echo json_encode(['success' => false, 'message' => 'Contestant not found']);
            exit;
        }

        $name = trim($_POST['name'] ?? $existing_contestant['name']);
        $image_url = trim($_POST['image_url'] ?? $existing_contestant['image_url']);
        $description = trim($_POST['description'] ?? $existing_contestant['description']);
        $status = trim($_POST['status'] ?? $existing_contestant['status']);

        $fields_changed = false;
        $update_fields = [];
        $types = '';
        $values = [];

        if (isset($_POST['name']) && $name !== $existing_contestant['name']) {
            $update_fields[] = "name = ?";
            $types .= 's';
            $values[] = $name;
            $fields_changed = true;
        }
        if (isset($_POST['image_url']) && $image_url !== $existing_contestant['image_url']) {
            $update_fields[] = "image_url = ?";
            $types .= 's';
            $values[] = $image_url;
            $fields_changed = true;
        }
        if (isset($_POST['description']) && $description !== $existing_contestant['description']) {
            $update_fields[] = "description = ?";
            $types .= 's';
            $values[] = $description;
            $fields_changed = true;
        }
        if (isset($_POST['status']) && $status !== $existing_contestant['status']) {
            $update_fields[] = "status = ?";
            $types .= 's';
            $values[] = $status;
            $fields_changed = true;
        }

        if (!$fields_changed) {
            echo json_encode(['success' => true, 'message' => 'No changes detected']);
            exit;
        }

        $update_query = "UPDATE contestants SET " . implode(', ', $update_fields) . " WHERE id = ?";
        $types .= 'i';
        $values[] = $id;
        $update_stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($update_stmt, $types, ...$values);

        if (mysqli_stmt_execute($update_stmt)) {
            echo json_encode(['success' => true, 'message' => 'Contestant updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating contestant: ' . mysqli_error($con)]);
        }
        mysqli_stmt_close($update_stmt);
        exit;
    }
}

mysqli_close($con);
?>