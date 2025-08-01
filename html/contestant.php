<?php
session_start();
require '../php/config.php';
require '../php/showcontroller.php';

$show_id = isset($_GET['show_id']) ? (int)$_GET['show_id'] : 0;
$contestants = getContestantsByShow($con, $show_id);
$show = getShowById($con, $show_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contestant_id'])) {
    $contestant_id = (int)$_POST['contestant_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Optional user tracking
    addVote($con, $contestant_id, $user_id);
    header("Location: contestant.php?show_id=$show_id&voted=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contestants - <?php echo htmlspecialchars($show['name'] ?? 'Vote Scope'); ?></title>
    <link rel="stylesheet" href="../css/aboutus_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>Contestants for <?php echo htmlspecialchars($show['name'] ?? 'Show'); ?></h1>
                <p>Vote for your favorite contestant in this show!</p>
                <?php if (isset($_GET['voted'])): ?>
                    <p class="success-message">Your vote has been recorded!</p>
                <?php endif; ?>
                <?php if (!empty($contestants)): ?>
                    <div class="contestant-list">
                        <?php foreach ($contestants as $contestant): ?>
                            <div class="contestant-item">
                                <?php if (!empty($contestant['image_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($contestant['image_url']); ?>" alt="<?php echo htmlspecialchars($contestant['name']); ?> Image" class="contestant-image">
                                <?php endif; ?>
                                <h3><?php echo htmlspecialchars($contestant['name']); ?></h3>
                                <p><?php echo htmlspecialchars($contestant['description']); ?></p>
                                <form method="POST">
                                    <input type="hidden" name="contestant_id" value="<?php echo htmlspecialchars($contestant['id']); ?>">
                                    <button type="submit" class="vote-button">Vote</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No contestants available for this show.</p>
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