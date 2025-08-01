<?php
session_start();
require '../php/config.php';
require '../php/votecontroller.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$votes = getUserVotes($con, $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Votes - Vote Scope</title>
    <link rel="stylesheet" href="../css/vote.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <section class="vote-section">
            <div class="container">
                <h1>My Voting History</h1>
                <p>View all the votes you have cast for your favorite contestants.</p>
                <?php if (!empty($votes)): ?>
                    <div class="vote-list">
                        <?php foreach ($votes as $vote): ?>
                            <div class="vote-item">
                                <h3><?php echo htmlspecialchars($vote['contestant_name']); ?></h3>
                                <p>Show: <?php echo htmlspecialchars($vote['show_name']); ?></p>
                                <p>Voted on: <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($vote['created_at']))); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>You haven't cast any votes yet.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div class="marquee">
        <marquee>
            <img src="../images/add1.png" alt="Advertisement">
            <img src="../images/add2.jpeg" alt="Advertisement">
            <img src="../images/add1.jpeg" alt="Advertisement">
            <img src="../images/add5.jpeg" alt="Advertisement">
        </marquee>
    </div>

    <div id="footer"></div>
    <script src="../js/script.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>

    <a href="contactus.php" class="support">
        <i class="fa fa-phone"></i> Contact Us
    </a>
</body>
</html>