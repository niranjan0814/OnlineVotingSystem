<?php 
require 'config.php';
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit'])){
$username=$_POST["name"];
$email=$_POST["email"];

$sql="INSERT INTO sponsor ('name','email') VALUES ('$username','$email')";
if($con->query($sql)){
    echo "<script>alert('Detail Entered Successfully')";
    }
else{
    echo "error".$con->connect_error;
}
$con->close();
?>
