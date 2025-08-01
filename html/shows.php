<?php
session_start();
require '../php/config.php';
require '../php/showcontroller.php';

$shows = getShows($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Shows - Vote Scope</title>
    <link rel="stylesheet" href="../css/aboutus_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <section class="show-section">
            <div class="container">
                <h1>Our Shows</h1>
                <p>Explore our exciting shows and vote for your favorite contestants!</p>
                <?php if (!empty($shows)): ?>
                    <div class="show-list">
                        <?php foreach ($shows as $show): ?>
                            <div class="show-item">
                                <a href="contestant.php?show_id=<?php echo htmlspecialchars($show['id']); ?>">
                                    <img src="<?php echo htmlspecialchars($show['image_url']); ?>" alt="<?php echo htmlspecialchars($show['name']); ?> Image" class="show-image">
                                </a>
                                <h3><?php echo htmlspecialchars($show['name']); ?></h3>
                                <p><?php echo htmlspecialchars($show['description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No shows available at this time.</p>
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