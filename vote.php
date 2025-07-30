<?php
require 'config.php';
$c1 = $_POST["c1"];
$c2 = $_POST["c2"];
$c3 = $_POST["c3"];
$c4 = $_POST["c4"];
$c5 = $_POST["c5"];

$sql = "INSERT INTO vote2 ('name', count) VALUES 
('ryan', '$c1'),
('drstr', '$c2'),
('dicap', '$c3'),
('toms', '$c4'),
('david', '$c5')";

if ($con->query($sql)) {
echo "Votes submitted successfully";
} 
else {
echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

?>