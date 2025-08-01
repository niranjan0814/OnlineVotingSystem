<?php
session_start();
require '../php/config.php';
require '../php/sponsorcontroller.php';

$sponsors = getSponsors($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Sponsors - Vote Scope</title>
    <link rel="stylesheet" href="../css/aboutus_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <main>
        <section class="sponsor-section">
            <div class="container">
                <h1>Our Sponsors</h1>
                <p>We are grateful for the support of our sponsors who make our platform possible. Their contributions
                    help us maintain a fair and transparent voting experience.</p>
                <?php if (!empty($sponsors)): ?>
                    <div class="sponsor-list">
                        <?php foreach ($sponsors as $sponsor): ?>
                            <div class="sponsor-item">
                                <?php if (!empty($sponsor['logo_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($sponsor['logo_url']); ?>"
                                        alt="<?php echo htmlspecialchars($sponsor['name']); ?> Logo" class="sponsor-logo">
                                <?php endif; ?>
                                <h3><?php echo htmlspecialchars($sponsor['name']); ?></h3>
                                <p><?php echo htmlspecialchars($sponsor['description']); ?></p>
                                <?php if (!empty($sponsor['website'])): ?>
                                    <a href="<?php echo htmlspecialchars($sponsor['website']); ?>" target="_blank"
                                        class="sponsor-link">Visit Website</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No sponsors available at this time.</p>
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