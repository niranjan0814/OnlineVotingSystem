<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['update_details'])){
    $id = mysqli_real_escape_string($con, $_GET['edit']); // Sanitize input
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
$id = mysqli_real_escape_string($con, $_GET['edit']); // Sanitize input
$select = mysqli_query($con, "SELECT * FROM contestant WHERE CID=$id");
if(!$select){
    echo "Error fetching contestant details: " . mysqli_error($con);
    exit(); // Stop script execution if there's an error
}
$row = mysqli_fetch_assoc($select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contestant</title>
    <link rel="stylesheet" href="contestant.css">
    <script src="contestant.js"></script>
</head>
<body>
    <h2>Edit Contestant Details</h2>
    <form method="POST" action="contestant.php?edit=<?php echo $id; ?>" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="cName" value="<?php echo $row['CName']; ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>">
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $row['Phone']; ?>">
        </div>
                
        <button type="submit" name="update_details">Update Details</button>
        <button type="button" onclick="location.href='maincontestant.php'">Cancel</button>
    </form>
</body>
</html>

<?php
mysqli_close($con); // Close the connection after all database operations
?>
