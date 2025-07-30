<?php
session_start();
    // connection change it 
    $con = new mysqli('localhost:8111','root','','test');

    // Assuming form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation and sanitization

    // Retrieve input data
    $userid = $_POST['email'];
    $password = $_POST['passpassword1'];

    $query = "SELECT * FROM users WHERE email = '$userid' AND Password = '$password'";
    $result = mysqli_query($con, $query);
   
    $num = mysqli_num_rows($result);

    if($num == 1){
        $_SESSION['email'] = $userid;
        header('location:index.php');
        exit();
    }else{
        $error = "Invalid username or password";
       
    }

}

       
?>