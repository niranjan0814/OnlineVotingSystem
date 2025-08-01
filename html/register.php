<?php
session_start(); // Start session
require '../php/config.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../css/register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- Header included via PHP -->
        <?php include 'header.php'; ?>

        <div class="container">
            <h1>Register</h1>
            <form action="../php/register.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="../html/login.php">Login here</a>.</p>
        </div>

        <!-- Footer Placeholder (still using JS for now) -->
        <div id="footer"></div>

        <script src="../js/script.js"></script>
        <script src="../js/loadHeaderFooter.js"></script>
    </body>
</html>