<?php
session_start(); // Start session to check login status
require '../php/config.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Scope</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Header Placeholder (will be loaded via PHP or JS) -->
    <?php include 'header.php'; ?> <!-- Use PHP include instead of JS for now -->

    <div>
        <marquee>
            <img src="../images/add1.png" width="500px" alt="Advertisement">
            <img src="../images/add2.jpeg" width="300px" alt="Advertisement">
            <img src="../images/add1.jpeg" width="170px" alt="Advertisement">
            <img src="../images/add5.jpeg" width="250px" alt="Advertisement">
        </marquee>
    </div>
    <div>
        <h1 id="heading">Welcome to VoteScopeNU</h1>
    </div>

    <div id="footer"></div> <!-- Keep footer reusable via JS for now -->

    <script src="../js/script.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>
    <script>
        // Load footer via JavaScript (if not converted to PHP)
        fetch('footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data)
            .catch(error => console.error('Error loading footer:', error));
    </script>
</body>
</html>