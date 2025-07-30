<?php
$con = mysqli_connect("localhost", "root", "", "VoteScopeNU");

if (!$con) {
    die("Connection error: " . mysqli_connect_error());
} else {
    echo "Connection successful!";
}
?>