<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signIn'])) {
    // Check if username is in email format
    $email = $_POST['email'];
    $password=$_POST['password1'];


   /* if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If username is not in email format, display an error message
        echo "<script>alert('Please enter a valid email address as username.');</script>";
    } else {
        // Proceed with the sign-in process
        // Add your sign-in logic here
    }
}*/
$sql="SELECT * from users WHERE email='$email' and password='$password'";
$result = $con->query($sql);
if($result->num_rows > 0){
    echo "<script>alert('you are logged in')</script>";
    session_start(); 
    $_SESSION['user_id'] = $email; // Store user ID in session (optional)
    header("Location: index.php"); // Redirect to homepage
    exit;
}
else {
    echo "<script>alert('Invalid username or password'); window.location='new.html';</script>";
}
}
$con->close();
?>