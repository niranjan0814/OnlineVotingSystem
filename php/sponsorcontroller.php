<?php
function getSponsors($conn) {
    $sponsors = [];
    $sql = "SELECT name, logo_url, website, description FROM sponsors";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sponsors[] = $row;
        }
    }
    return $sponsors;
}
?>