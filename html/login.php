<?php
session_start(); // Start session
require '../php/config.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Header Placeholder -->
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Login</h1>
        <form action="../php/login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="../html/register.php">Register here</a>.</p>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer"></div>

    <script src="../js/script.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>
</body>

</html>