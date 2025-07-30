<?php
require 'config.php';


$show=$_POST('telivision');
$televition=$_POST('telivision');

$query = "INSERT INTO tvshow (ShID, name, season, AID)
VALUES ('Sh001', '$show', '$televition','123')";

$result=mysqli-qerry($query,$con);
if(result)
{
    echo"Data insert successfully";
}
else{
    echo "Error: " . $query . "<br>" . $con->error;
  }
  
  $con->close();
  ?>