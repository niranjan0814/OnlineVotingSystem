<?php
require 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["signup"])) {
        // Handle Sign Up form submission
        $username = $_POST["username2"];
        $password = $_POST["password2"];
        $confirmPassword = $_POST["cpassword"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phonenumber"];
        $DateOfbirth = $_POST["dob"];

        session_start(); 
            $_SESSION['user_id'] = $email; 

        // Perform necessary actions for Sign Up
      
        echo "Sign Up Form Submitted<br>";
        echo "Username: " . $_POST['username2'] . "<br>";
        echo "Password: " . $_POST['password2'] . "<br>";
        echo "Confirm Password:" . $_POST['cpassword'] . "<br>";
        echo "Email: " . $_POST['email'] . "<br>";
        echo "Phone Number: " . $_POST['phonenumber'] . "<br>";
        echo "Date Of Birth:" . $_POST['dob'] . "<br>";


        
        
        $sql = "INSERT INTO users (name, password, email, phonenumber, dob) 
                VALUES ('$username', '$password', '$email', '$phoneNumber', '$DateOfbirth')";
        
        // Execute the SQL query, 
        if (mysqli_query($con, $sql)) {
            echo "Your account created successfully";
            echo '<script>window.location.href = "index.php";</script>'; // Redirect to homepage
            exit; 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    }
}
?>
