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

        // Fetch existing record to preserve unchanged fields
        $select_query = "SELECT name, image_url, description, start_date, end_date, venue, status FROM shows WHERE id = ?";
        $select_stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($select_stmt, "i", $id);
        mysqli_stmt_execute($select_stmt);
        $result = mysqli_stmt_get_result($select_stmt);
        $existing_show = mysqli_fetch_assoc($result);
        mysqli_stmt_close($select_stmt);

        if (!$existing_show) {
            echo json_encode(['success' => false, 'message' => 'Show not found']);
            exit;
        }

        // Use existing values as defaults, override with new values if provided
        $name = trim($_POST['name'] ?? $existing_show['name']);
        $image_url = trim($_POST['image_url'] ?? $existing_show['image_url']);
        $description = trim($_POST['description'] ?? $existing_show['description']);
        $start_date = trim($_POST['start_date'] ?? $existing_show['start_date']);
        $end_date = trim($_POST['end_date'] ?? $existing_show['end_date']);
        $venue = trim($_POST['venue'] ?? $existing_show['venue']);
        $status = trim($_POST['status'] ?? $existing_show['status']);

        // Validate only if new values are provided
        $fields_changed = false;
        $update_fields = [];
        $params = [];
        $types = '';
        $values = [];

        if (isset($_POST['name']) && $name !== $existing_show['name']) {
            $update_fields[] = "name = ?";
            $types .= 's';
            $values[] = $name;
            $fields_changed = true;
        }
        if (isset($_POST['image_url']) && $image_url !== $existing_show['image_url']) {
            $update_fields[] = "image_url = ?";
            $types .= 's';
            $values[] = $image_url;
            $fields_changed = true;
        }
        if (isset($_POST['description']) && $description !== $existing_show['description']) {
            $update_fields[] = "description = ?";
            $types .= 's';
            $values[] = $description;
            $fields_changed = true;
        }
        if (isset($_POST['start_date']) && $start_date !== $existing_show['start_date']) {
            $update_fields[] = "start_date = ?";
            $types .= 's';
            $values[] = $start_date;
            $fields_changed = true;
        }
        if (isset($_POST['end_date']) && $end_date !== $existing_show['end_date']) {
            $update_fields[] = "end_date = ?";
            $types .= 's';
            $values[] = $end_date;
            $fields_changed = true;
        }
        if (isset($_POST['venue']) && $venue !== $existing_show['venue']) {
            $update_fields[] = "venue = ?";
            $types .= 's';
            $values[] = $venue;
            $fields_changed = true;
        }
        if (isset($_POST['status']) && $status !== $existing_show['status']) {
            $update_fields[] = "status = ?";
            $types .= 's';
            $values[] = $status;
            $fields_changed = true;
        }

        // If no fields changed, exit early
        if (!$fields_changed) {
            echo json_encode(['success' => true, 'message' => 'No changes detected']);
            exit;
        }

        // Validate dates only if changed
        if ((isset($_POST['start_date']) || isset($_POST['end_date'])) && ($start_date !== $existing_show['start_date'] || $end_date !== $existing_show['end_date'])) {
            $start_date_obj = DateTime::createFromFormat('Y-m-d', $start_date);
            $end_date_obj = DateTime::createFromFormat('Y-m-d', $end_date);
            if (!$start_date_obj || !$end_date_obj || $end_date_obj < $start_date_obj) {
                echo json_encode(['success' => false, 'message' => 'Invalid date range']);
                exit;
            }
        }

        // Construct and execute update query
        $update_query = "UPDATE shows SET " . implode(', ', $update_fields) . " WHERE id = ?";
        $types .= 'i';
        $values[] = $id;
        $update_stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($update_stmt, $types, ...$values);

        if (mysqli_stmt_execute($update_stmt)) {
            echo json_encode(['success' => true, 'message' => 'Show updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating show: ' . mysqli_error($con)]);
        }
        mysqli_stmt_close($update_stmt);
        exit;
    }

    // Handle INSERT request
    $name = trim($_POST['name']);
    $image_url = trim($_POST['image_url'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);
    $venue = trim($_POST['venue']);
    $status = trim($_POST['status']);

    if (empty($name) || empty($start_date) || empty($end_date) || empty($venue) || empty($status)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        exit;
    }

    // Validate dates for insert
    $start_date_obj = DateTime::createFromFormat('Y-m-d', $start_date);
    $end_date_obj = DateTime::createFromFormat('Y-m-d', $end_date);
    if (!$start_date_obj || !$end_date_obj || $end_date_obj < $start_date_obj) {
        echo json_encode(['success' => false, 'message' => 'Invalid date range']);
        exit;
    }

    // Check for duplicate name and date range only for new insertions
    $check_query = "SELECT id FROM shows WHERE name = ? AND start_date = ? AND end_date = ? AND id != ?";
    $check_stmt = mysqli_prepare($con, $check_query);
    // Use a dummy id (0) for INSERT since no id exists yet; this prevents self-match
    $dummy_id = 0;
    mysqli_stmt_bind_param($check_stmt, "sss", $name, $start_date, $end_date, $dummy_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo json_encode(['success' => false, 'message' => 'Show with this name and date range already exists']);
        exit;
    }
    mysqli_stmt_close($check_stmt);

    $insert_query = "INSERT INTO shows (name, image_url, description, start_date, end_date, venue, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "sssssss", $name, $image_url, $description, $start_date, $end_date, $venue, $status);

    if (mysqli_stmt_execute($insert_stmt)) {
        echo json_encode(['success' => true, 'message' => 'Show added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding show: ' . mysqli_error($con)]);
    }

    mysqli_stmt_close($insert_stmt);
}

mysqli_close($con);
?>