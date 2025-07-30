<?php
require 'config.php';

// Check if it's a POST request
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit']))){
    // Retrieve form data
        $showid = $_POST['show'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
    

        // Prepare and execute the SQL statement to insert into mngvoting table
        $sql = "INSERT INTO mngvotes (`s_date`, e_date,`name`) VALUES ('$startDate',  '$endDate', '$showid')";
       /* $stmt = $con->prepare($sql);
        $stmt->bind_param( $startDate, $endDate, $showid);
        $stmt->execute();

    // Close the prepared statements
    $stmt->close();*/

    if($con->query($sql)){
    // Redirect back to the voting management page or any other desired page
    header("Location: managevote.php");
    exit();
        } }else {
            echo "error" . $con->error;
    // Redirect to the form page if accessed directly without form submission
    header("Location: index.php");
    exit();
}

$con->close();
?>
