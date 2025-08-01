<?php
function getUserVotes($con, $user_id) {
    $votes = [];
    $sql = "SELECT c.name AS contestant_name, s.name AS show_name, v.created_at 
            FROM votes v 
            JOIN contestants c ON v.contestant_id = c.id 
            JOIN shows s ON c.show_id = s.id 
            WHERE v.user_id = ? 
            ORDER BY v.created_at DESC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $votes[] = $row;
        }
    }
    return $votes;
}
?>