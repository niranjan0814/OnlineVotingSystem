<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Monitoring Dashboard - Vote Scope</title>
    <link rel="stylesheet" href="../css/admin_register.css">
    <style>
        .vote-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .vote-table th, .vote-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .vote-table th { background-color: #f2f2f2; }
        .vote-table tr:nth-child(even) { background-color: #f9f9f9; }
        .vote-table tr:hover { background-color: #f5f5f5; }
        .badge { padding: 4px 8px; border-radius: 12px; }
        .rank-1 { background-color: #ffd700; } /* Gold */
        .rank-2 { background-color: #c0c0c0; } /* Silver */
        .rank-3 { background-color: #cd7f32; } /* Bronze */
    </style>
</head>

<body>
    <?php
    session_start();
    include 'admin_header.php';
    require '../php/config.php';

    if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
        header('Location: login.php');
        exit;
    }

    // Fetch shows and contestants with vote counts
    $query = "SELECT s.name AS show_name, c.id AS contestant_id, c.name AS contestant_name, c.image_url, c.description, c.status, 
                     COALESCE(COUNT(v.id), 0) AS vote_count
              FROM shows s
              LEFT JOIN contestants c ON s.id = c.show_id
              LEFT JOIN votes v ON c.id = v.contestant_id
              GROUP BY s.name, c.id, c.name, c.image_url, c.description, c.status
              ORDER BY s.name, vote_count DESC";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>Vote Monitoring Dashboard</h1>
                <p>Track votes, rankings, and statuses for all shows and contestants</p>

                <!-- Temporary Success/Error Message with Close Button -->
                <div id="statusMessage" class="status-message" style="display: none;">
                    <span id="statusText"></span>
                    <button class="close-btn">&times;</button>
                </div>

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                    <div class="user-table-container">
                        <table class="vote-table">
                            <thead>
                                <tr>
                                    <th>Show Name</th>
                                    <th>Contestant Name</th>
                                    <th>Image URL</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $current_show = '';
                                $rank = 1;
                                $prev_votes = null;
                                $rank_tie = false;

                                foreach ($data as $index => $row) {
                                    if ($current_show !== $row['show_name']) {
                                        $current_show = $row['show_name'];
                                        $rank = 1;
                                        $prev_votes = null;
                                        $rank_tie = false;
                                    }

                                    $vote_count = $row['vote_count'];
                                    if ($prev_votes !== null && $vote_count < $prev_votes) {
                                        $rank_tie = false;
                                        $rank++;
                                    } elseif ($prev_votes !== null && $vote_count === $prev_votes) {
                                        $rank_tie = true;
                                    }
                                    $prev_votes = $vote_count;

                                    $rank_class = '';
                                    if (!$rank_tie) {
                                        if ($rank == 1) $rank_class = 'rank-1';
                                        elseif ($rank == 2) $rank_class = 'rank-2';
                                        elseif ($rank == 3) $rank_class = 'rank-3';
                                    }

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['show_name'] ?? 'Unknown Show') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['contestant_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['image_url'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['description'] ?? '') . "</td>";
                                    echo "<td><span class='badge'>" . htmlspecialchars($row['status']) . "</span></td>";
                                    echo "<td>" . htmlspecialchars($vote_count) . "</td>";
                                    echo "<td><span class='badge " . $rank_class . "'>" . ($rank_tie ? 'Tie' : ($rank <= 3 ? $rank . ($rank == 1 ? 'st' : ($rank == 2 ? 'nd' : 'rd')) : '')) . "</span></td>";
                                    echo "</tr>";
                                }
                                if (empty($data)) {
                                    echo "<tr><td colspan='7' style='text-align: center;'>No data available.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="status-message status-warning">
                        ⚠️ Access denied. Only admins can view vote monitoring.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="../js/admin_vote.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>
</body>

</html>