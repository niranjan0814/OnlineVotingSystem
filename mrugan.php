<?php
require 'config.php';
echo"<script> console.log('Data insert successfully'); </script>";
$show=$_POST['show'];
$televition=$_POST['telivision'];
// $q2="select ShID from `tvshow1` ORDER BY ShID DESC LIMIT 1";
// $sh=mysqli_query($con,$q2);
// $shid=$sh+1;
$query =("INSERT INTO `tvshow1` (name, season, AID)
VALUES ('$show', '$televition','Ad005')");

$result=mysqli_query($con,$query);
if($result)
{
    echo"Data insert successfully";
}
else{
    echo "Error: " . $query . "<br>" . $con->error;
  }
  
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data when form is submitted

    // Validate inputs
    $show = htmlspecialchars($_POST["show"]);
    $television = htmlspecialchars($_POST['television']);
    $imageFile = $_FILES['filename'];
    echo"<script> console.log('Data insert successfully'); </script>";
    $query = "INSERT INTO tvshow (ShID, name, season, AID)
    VALUES ($show, 'Doe', 'test db','123')";
    if ($con->query($query) === TRUE) {
    // File upload handling
    $uploadDirectory = "uploads/C:\Users\HP\OneDrive - Sri Lanka Institute of Information Technology\Desktop\z"; // Directory where uploaded files will be saved
    $targetFile = $uploadDirectory . basename($imageFile['name']);
    echo "nnn";
    // Check if file is uploaded
    if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
        // File uploaded successfully
        // You can save other form data to a database or perform any other necessary operations here
        // For demonstration purpose, I'll just display the submitted data
        echo "<h2>Submitted Information</h2>";
        echo "<p>Show Name: " . $show . "</p>";
        echo "<p>Television Name: " . $television . "</p>";
        echo "<img src='" . $targetFile . "' alt='Uploaded Image' style='max-width: 100%;'>";
    } else {
        // Error uploading file
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
