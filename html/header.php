<?php
session_start(); // Start session to check login status
?>
<link rel="stylesheet" href="../css/header.css">
<div class="header">
    <img src="../images/syslogo.png" style="width:90px;height:90px;background:none;" alt="logo" class="logo-1"> 
    <h1 id="VOTE SCOPE">Vote Scope</h1>
    <img class="img-avatar" src="../images/img_avatar.jpg" alt="Avatar">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="../html/register.php"><button onclick="document.getElementById('id01').style.display='block'">Register</button></a>
    <?php else: ?>
        <div class="topnavi">
            <a class="fa fa-home" href="../html/index.php" data-scroll-nav="0">Home</a> 
            <a class="fa fa-music" href="../html/shows.php" data-scroll-nav="2">Shows</a> 
            <a class="fa fa-music" href="../html/vote.php" data-scroll-nav="3">Vote</a> 
            <a class="fa fa-star" href="../html/sponsor.php" data-scroll-nav="4">Sponsor</a> 
            <a class="fa fa-users" href="../html/aboutus.php" data-scroll-nav="5">About us</a> 
        </div>
        <a href="?logout=true"><button>Logout</button></a>
    <?php endif; ?>

    <?php
    // Handle logout
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: ../html/index.php"); // Redirect to home page after logout
        exit();
    }
    ?>
</div>