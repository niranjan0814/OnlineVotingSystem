<?php
function getShows($conn) {
    $shows = [];
    $sql = "SELECT id, name, image_url, description FROM shows";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $shows[] = $row;
        }
    }
    return $shows;
}

function getShowById($conn, $show_id) {
    $sql = "SELECT name FROM shows WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $show_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc() ?? [];
}

function getContestantsByShow($conn, $show_id) {
    $contestants = [];
    $sql = "SELECT id, name, image_url, description FROM contestants WHERE show_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $show_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contestants[] = $row;
        }
    }
    return $contestants;
}

function addVote($conn, $contestant_id, $user_id) {
    $sql = "INSERT INTO votes (contestant_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $contestant_id, $user_id);
    $stmt->execute();
}
?>