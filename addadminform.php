<?php
require 'config.php';

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit'])))
{
    
        $Aid        =  $_POST['AID'];
        $name  =   $_POST['name'];
        $pNo        =   $_POST['phone'];
        $pw     =   $_POST['password'];
        $email      =   $_POST['email'];

$sql = "INSERT INTO admin(AID,name,phoneNo,pw, email) 
                    VALUES ('$Aid','$name', '$pNo','$pw','$email')";

if ($con->query($sql) === TRUE) 
{
    echo"Data insert successfully";
   
        header("location:adminform.php");

}
else{
    echo "Error: " . $sql . "<br>" . $con->error;
  }
  
  $con->close();
}
?>