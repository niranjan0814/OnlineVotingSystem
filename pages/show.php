<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['addbtn'])){
    global $con;

    // Sanitize inputs
    $sname = isset($_POST['sname']) ? mysqli_real_escape_string($con, $_POST['sname']) : '';
    $television = isset($_POST['television']) ? mysqli_real_escape_string($con, $_POST['television']) : '';
    $seasion = isset($_POST['seasion']) ? mysqli_real_escape_string($con, $_POST['seasion']) : '';
    $simage = isset($_FILES['simage']['name']) ? mysqli_real_escape_string($con, $_FILES['simage']['name']) : '';
    $simage_tmp_image = isset($_FILES['simage']['tmp_name']) ? $_FILES['simage']['tmp_name'] : '';
    $simage_folder = 'show_images/'.basename($simage);

    // Create directory if it doesn't exist
    if (!is_dir('show_images')) {
        mkdir('show_images', 0777, true); // Create directory recursively with permissions 0777
        chmod('show_images', 0777); // Set directory permissions
    }

    // Insert into database using prepared statement
    $stmt = $con->prepare("INSERT INTO `tshow` (Show_Name, television, seasion, simage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $sname, $television, $seasion, $simage);
    if($stmt->execute()){
        // Move uploaded file to the specified directory
        move_uploaded_file($simage_tmp_image, $simage_folder);
        // Set permissions for the directory and its contents
        header("location:TVshow.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Query shows AFTER inserting new show
$select = mysqli_query($con, "SELECT * FROM `tshow`"); // Escape 'show' with backticks
if(isset($_GET['delete'])){
    $id = mysqli_real_escape_string($con, $_GET['delete']); // Sanitize input
    mysqli_query($con, "DELETE FROM `tshow` WHERE ShID=$id"); // Corrected the DELETE query
    header('location:TVshow.php');
    exit(); // Stop script execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="show.css">
</head>
<body>

<div class="show-display">
   <table class="show-display-table">
      <thead>
      <tr>
         <th>show image</th>
         <th>Contentant name</th>
         <th>Action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="show_images/<?php echo $row['simage']; ?>" height="150" width="150" alt=""></td>
         <td><?php echo $row['Show_Name']; ?></td>
         <td>
         <a href="showedite.php?edit=<?php echo $row['ShID']; ?>" class="sbtn"><button class="editebtn">Edit</button>  </a>
         <a href="TVshow.php?delete=<?php echo $row['ShID']; ?>" class="sbtn" ><button class="deletebtn">Delete</button>  </a>
         <a href="maincontestant.php?select=<?php echo $row['ShID']; ?>"  class="sbtn"><button class="caddbtn">ADD contestant</button>  </a>

         </td>
      </tr>
   <?php } ?>
   </table>
</div>

</body>
</html>

<?php
mysqli_close($con); 
?>
