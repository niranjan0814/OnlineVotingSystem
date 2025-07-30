<?php
require 'config.php';

function populateDropdownAndCheckboxes() {
    global $con;

    // Fetch shows from tshow table
    $sqlShows = "SELECT ShID, Show_Name FROM tshow";
    $resultShows =$con->query($sqlshows); //$con->query($sqlShows);
    echo "Yes";

    if ($resultShows->num_rows > 0) {
        // Output data of each row
        echo "<select id='show' name='show'>";
        while($rowShows = $resultShows->fetch_assoc()) {
            echo "id: " . $rowShows["id"]. " - Name: " . $rowShows["Show_Name"]. "<br>";
            echo "<option value='" . $rowShows["ShID"] . "'>" . $rowShows["Show_Name"] . "</option>";
        }
        echo "</select><br>";
    } else {
        echo "No shows found";
    }

    // Fetch contestants from contestant table
    $sqlContestants = "SELECT CID, CName FROM contestant";
    $resultContestants = $con->query($sqlContestants);

    if ($resultContestants->num_rows > 0) {
        // Output data of each row
        while($rowContestants = $resultContestants->fetch_assoc()) {
            echo "<input type='checkbox' name='contestants[]' value='" . $rowContestants["CID"] . "'>";
            echo "<label>" . $rowContestants["CName"] . "</label><br>";
        }
    } else {
        echo "No contestants found";
    }
}
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
<!-- Navbar -->
<div class="header">

  <h1>Vote scope</h1>
 
  <img class="img-avatar" src="image/img_avatar.jpg" alt="Avatar">

  <div id="button_container">
                    <a href="new.html"><button id="btn"> Register </button></a>
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
<form id="addForm" action="addmanagevote.php" method="post">
    <label for="show">Select Show:</label>
    <select id="show" name="show">
    
            <option value="bigboss" name="Bigboss">Bigboss</option>
            <option value="song" name="Singing star">Singing star</option>
            <option value="talk" name="Common Talks">Common Talks</option>
    </select><br>
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required><br>
    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required><br>
    <label for="contestants">Select Contestants:</label><br>
    <div id="contestantsCheckbox">

            <input type="checkbox" name="John Doe" value="Contestant 1"> John Doe<br>
            <input type="checkbox" name="Arun" value="Contestant 2"> Arun<br>
            <input type="checkbox" name="Jay" value="Contestant 3"> Jay<br>
            <input type="checkbox" name="Ram" value="Contestant 4">Ram<br>
            <input type="checkbox" name="Vijay" value="Contestant 5"> Vijay<br>
            <input type="checkbox" name="Anitha" value="Contestant 6"> Anitha<br>
            <input type="checkbox" name="Kamal" value="Contestant 7"> Kamal<br>
            <input type="checkbox" name="Roy" value="Contestant 8"> Roy<br>
    </div><br><br>
    <button type="submit" name="submit">Add Voting Scope</button>
</form>

<!-- Manage Voting Scopes Table -->
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
        <!-- Table rows will be dynamically populated using JavaScript -->
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the select element for shows
    const showSelect = document.getElementById("show");

    // Populate checkboxes for the selected show's contestants
    showSelect.addEventListener("change", function() {
        const selectedShowId = this.value;
        const contestantsCheckbox = document.getElementById("contestantsCheckbox");
        contestantsCheckbox.innerHTML = ""; // Clear previous checkboxes

        // Find the selected show in the fetched data
        const selectedShow = <?php echo json_encode($shows); ?>.find(show => show.ShID === selectedShowId);

        // If the selected show is found, populate checkboxes for its contestants
        if (selectedShow) {
            selectedShow.contestants.forEach(contestant => {
                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "contestants[]";
                checkbox.value = contestant.CID;
                checkbox.id = "contestant_" + contestant.CID;

                const label = document.createElement("label");
                label.textContent = contestant.CName;
                label.setAttribute("for", "contestant_" + contestant.CID);

                contestantsCheckbox.appendChild(checkbox);
                contestantsCheckbox.appendChild(label);
                contestantsCheckbox.appendChild(document.createElement("br"));
            });
        }
    });
});
</script>
<div class="footer">
    <p> <b>copyright 2024 &copy; &nbsp; All Rights Reserved. &nbsp; Northern Uni Vote scope.</b>  
      <a class="fa fa-envelope" href="" >northernunivote@gmail.com </a>  
      <a class="fa fa-phone" href="" >0761111222</a>
	</p> 
</div>
<a class="fa fa-phone-square" href="contactus.php" data-scroll-nav="4">
    <button class="support">Contact us</button>
</a>

</a>
</body>
</html>
