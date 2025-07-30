<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['update_details'])){
    $id = mysqli_real_escape_string($con, $_GET['edit']); // Sanitize input
    $sname = mysqli_real_escape_string($con, $_POST['sname']);
    $television = mysqli_real_escape_string($con, $_POST['television']);
    $seasion = mysqli_real_escape_string($con, $_POST['seasion']);

    $update = "UPDATE tshow SET Show_Name='$sname', television='$television', seasion=$seasion WHERE ShID=$id"; // Enclose 'show' in backticks
    $upload = mysqli_query($con, $update); 
    if(!$upload){
        echo "Error updating show details: " . mysqli_error($con);
    } else {
        header("location: TVshow.php");
        exit(); // Stop script execution after redirection
    }
}

// Fetch data for editing
$id = mysqli_real_escape_string($con, $_GET['edit']); // Sanitize input
$select = mysqli_query($con, "SELECT * FROM `tshow` WHERE ShID=$id"); // Enclose 'show' in backticks
if(!$select){
    echo "Error fetching show details: " . mysqli_error($con);
    exit(); // Stop script execution if there's an error
}
$row = mysqli_fetch_assoc($select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit show</title>
    <link rel="stylesheet" href="css/show.css">
    <link rel="stylesheet" href="css/index_style.css">

    <script src="js/show.js"></script>
</head>
<body>
<div class="header">

<h1>Vote scope</h1>

<img class="img-avatar" src="image/img_avatar.jpg" alt="Avatar">

<div id="button_container">
                  <a href="Logout.php"><button id="btn"> Logout </button></a>
</div>
</div>
<div class="topnavi">
              <a class="fa fa-home" href="index.php" data-scroll-nav="0">Home</a> 
              <a class="fa fa-music" href="TVshow.php" data-scroll-nav="1">Shows</a>
              <a class="fa fa-vote" href="managevote.php" data-scroll-nav="3">Manage vote</a> 
              <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voting</a> 
              <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
              <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 
</div>

<img src="image/syslogo.png" style="width:90px;height:90px;background:none;" alt="logo" class="logo-1"> 


    <h2>Edit show Details</h2>
    <form method="POST" action="showedite.php?edit=<?php echo $id; ?>" enctype="multipart/form-data"> <!-- Corrected the action URL -->
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="sname" value="<?php echo $row['Show_Name']; ?>">
        </div>
        <div>
            <label for="television">Television:</label> <!-- Corrected the input type -->
            <input type="text" id="television" name="television" value="<?php echo $row['television']; ?>">
        </div>
        <div class="form-group">
            <label for="seasion">Seasion:</label>
            <input type="number" id="seasion" name="seasion" min="1" max="12" step="1" value="<?php echo $row['seasion']; ?>">
        </div>
                
        <button type="submit" name="update_details">Update Details</button>
        <button type="button" onclick="location.href='TVshow.php'">Cancel</button>
    </form>
</body>
</html>

<?php
mysqli_close($con); // Close the connection after all database operations
?>
