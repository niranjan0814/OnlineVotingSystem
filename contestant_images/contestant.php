<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['addbtn'])){
    // Sanitize inputs
    $cname = mysqli_real_escape_string($con, $_POST['cName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $cimage = $_FILES['cimage']['name'];
    $cimage_tmp_image = $_FILES['cimage']['tmp_name'];
    $cimage_folder = 'contestant_images/'.basename($cimage);

    // Create directory if it doesn't exist
    if (!is_dir('contestant_images')) {
        mkdir('contestant_images', 0777, true); // Create directory recursively with permissions 0777
        chmod('contestant_images', 0777); // Set directory permissions
    }

    // Insert into database
    $insert = "INSERT INTO contestant (CName, Email, Phone, Gender, CPassword, cimage) 
               VALUES ('$cname', '$email', $phone, '$gender', '$cpassword', '$cimage')";
    $upload = mysqli_query($con, $insert); 
    if($upload){
        // Move uploaded file to the specified directory
        move_uploaded_file($cimage_tmp_image, $cimage_folder);
        // Set permissions for the directory and its contents
        header("location:maincontestant.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Query contestants AFTER inserting new contestant
$select = mysqli_query($con, "SELECT * FROM contestant");
if(isset($_GET['delete'])){
    $id = mysqli_real_escape_string($con, $_GET['delete']); // Sanitize input
    mysqli_query($con, "DELETE FROM contestant WHERE ID=$id"); // Corrected the DELETE query
    header('location:maincontestant.php');
    exit(); // Stop script execution after redirection
}
/////////////////////////////checked////////////////////////////////////////////

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="contestant.css">
</head>
<body>

<div class="contestant-display">
   <table class="contestant-display-table">
      <thead>
      <tr>
         <th>Contestant image</th>
         <th>Contentant name</th>
         <th>Action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="contestant_images/<?php echo $row['cimage']; ?>" height="150" width="150" alt=""></td>
         <td><?php echo $row['CName']; ?></td>
         <td>
         <a href="contestant_update.php?edit=<?php echo $row['ID']; ?>" class="editebtn"> <button class="editebtn">Edit</button>  </a>
         <a href="maincontestant.php?delete=<?php echo $row['ID']; ?>" class="deletebtn"><button class="deletebtn">Delete</button>  </a>
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
<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['update_details'])){
    // Check if 'edit' is set in $_GET before using it
    if(isset($_GET['edit'])) {
        $id = mysqli_real_escape_string($con, $_GET['edit']); // Sanitize input
    } else {
        // Redirect or handle the case where 'edit' is not set
        echo "Edit ID is not set.";
        exit(); // Stop script execution if edit ID is not set
    }

    $cname = mysqli_real_escape_string($con, $_POST['cName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $update = "UPDATE contestant SET CName='$cname', Email='$email', Phone=$phone WHERE ID=$id";
    $upload = mysqli_query($con, $update); 
    if(!$upload){
        echo "Error updating contestant details: " . mysqli_error($con);
    } else {
        header("location: maincontestant.php");
        exit(); // Stop script execution after redirection
    }
}

// Fetch data for editing
// Check if 'edit' is set in $_GET before using it

?>



<?php
mysqli_close($con); // Close the connection after all database operations
?>
