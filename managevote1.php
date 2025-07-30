<?php
require 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vote scope</title>
    <link rel="stylesheet" href="css/index_style.css">
    <link rel="stylesheet" href="css/managevotestyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="header">

  <h1>Vote scope</h1>
 
  <img class="img-avatar" src="image/img_avatar.jpg" alt="Avatar">

  <div id="button_container">
      <a href="Logout.php"><button id="btn"> Logout</button></a>
  </div>
</div>
<div class="topnavi">
                <a class="fa fa-home" href="index.php" data-scroll-nav="0">Home</a> 
                <a class="fa fa-music" href="TVshow.php" data-scroll-nav="1">Shows</a>
                <a class="fa fa-vote" href="managevote.php" data-scroll-nav="3">Manage vote</a> 
                <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voteing</a> 
                <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
                <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 
 </div>

 <img src="image/syslogo.png" style="width:90px;height:90px;background:none;" alt="logo" class="logo-1"> 
 

<h1>Voting Management</h1>
        
<!-- Add Form -->
<h2>Add New Voting</h2>
<form id="addForm" action="" method="post">
    <label for="show">Select Show:</label>
    <select id="show" name="show">
    <?php
            
            $servername = "localhost:8111";
            $username = "username";
            $password = "";
            $dbname = "test";

            $con = new mysqli($servername, $username, $password, $dbname);

           
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
           
          
            $sql =$mysqli->query("SELECT ShID, Show_Name FROM tshow"); 
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["ShID"] . "'>" . $row["Show_Name"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            $con->close();
            ?>
        </select>
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required><br>
    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required><br>
    <label for="contestants">Select Contestants:</label><br>
    <div id="contestantsCheckbox">
    <?php
        $con = new mysqli($servername, $username, $password, $dbname);

       
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selected_show_id = $_POST["ShID"];
            $sql = $mysqli->query("SELECT CID, CName FROM contestant WHERE ShID = '$selected_show_id'");
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "<input type='checkbox' name='contestant_ids[]' value='" . $row["CID"] . "'>" . $row["CName"] . "<br>";
                }
            } else {
                echo "No contestants found for the selected show.";
            }
        }
        ?>
        <br>
    </div>
    <button type="submit">Add Voting Scope</button>
</form>


<h2>Manage Voting Scopes</h2>
<table id="votingScopes">
    <thead>
        <tr>
            <th>Voting ID</th>
            <th>Show Name</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>


</body>
</html>
