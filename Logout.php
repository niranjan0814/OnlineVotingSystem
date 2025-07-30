<?php
require 'config.php';
?>
<?php
include('session.php');
?>


<?php
// Assuming logout link/button
session_start(); // Start session
session_destroy(); // Destroy all session data
unset($_SESSION['username']);
// Redirect to the login page or any other page after logout
header("Location: index.php");
exit();
?>
