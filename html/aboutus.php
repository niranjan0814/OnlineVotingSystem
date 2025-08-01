<?php
session_start(); // Start session to check login status
require '../php/config.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Vote Scope</title>
    <link rel="stylesheet" href="../css/aboutus_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <main>
        <section class="about-section">
            <div class="container">
                <h1>About Us</h1>
                <p>
                    Welcome to our online voting system! We aim to simplify the award nomination process with a secure,
                    user-friendly platform.
                    Our system ensures a fair and transparent voting experience, supporting various award categories.
                    Join us to celebrate excellence
                    through our modern online voting solution.
                </p>
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <ul>
                        <li>
                            <span class="icon"><i class="fa fa-map-marker"></i></span>
                            <p>Address: Ballotbox2023, Colombo 07, Sri Lanka</p>
                        </li>
                        <li>
                            <span class="icon"><i class="fa fa-phone"></i></span>
                            <p>Phone: +91 2*9 6**7</p>
                        </li>
                        <li>
                            <span class="icon"><i class="fa fa-envelope"></i></span>
                            <p>Email: ballotbox2023@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <div class="social-media">
                    <h3>Our Social Media</h3>
                    <ul>
                        <li><span class="icon"><i class="fa fa-facebook"></i></span>
                            <p>Facebook</p>
                        </li>
                        <li><span class="icon"><i class="fa fa-twitter"></i></span>
                            <p>Twitter</p>
                        </li>
                        <li><span class="icon"><i class="fa fa-youtube"></i></span>
                            <p>YouTube</p>
                        </li>
                        <li><span class="icon"><i class="fa fa-instagram"></i></span>
                            <p>Instagram</p>
                        </li>
                    </ul>
                </div>
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