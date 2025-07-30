<?php

require 'config.php';



if (isset($_POST['submit'])) 
{
    $email = $_POST["email"];
    $newpassword = $_POST["newpassword"];
    $re_password = $_POST["re_password"];
 
    /* Check if new password matches confirm password
    if ($newpassword != $re_password) 
	{
        echo"Passwords do not match.";
    }
	else 
	{
        // Update password in the database
        $sql = "UPDATE userdetails set password='$newpassword' WHERE username='$username'";
        if ($con->query($sql) === TRUE) 
		{
            echo "Password updated successfully";
		    header('Location:loginpage.php');

			
        }
		else 
		{
            $errors[] = 'Error updating password: ' . $con->error;
        }
    }*/
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $sql1 = "UPDATE users SET password = '$newpassword' WHERE email='$email'";
        if ($con->query($sql1)) {
            echo "<script>alert('Password Updated Successfully'); window.location='';</script>";
        } else {
            echo "<script>alert('There Is No Account In Such username'); window.location='';</script>";
            echo "Error" . $con->connect_error;
        }
    } else {
        echo "no such account";
    }
}
$con->close();
?>

<!DOCTYPE html>
<html>
<head>

<title>Forget password</title>
 

<style>

body {
    display: flex;
	
    align-items: center;
    
   
   
    min-height: 100vh;
    background: white;
    flex-direction: column;
  
}

.log {
    background-color:lightyellow ;
    border-radius: 15px;
    padding: 10px 20px;
    width: 500px;
    text-align: center;
}
  #video-background {
  position: fixed;
  top: 0;
  left: 0;
  min-width: 100%;
  min-height: 100%;
  z-index: -1;
}


h1 {
    color: red;
}

label {
    display: block;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: left;
    color: blue;
    font-weight: bold;
}

input {
    display: block;
    width: 100%;
    
   
    box-sizing: border-box;
 
   
}

</style>



<!-- <script> 

function test() {
    var str1 = document.getElementById("newpassword").value;
    var str2 = document.getElementById("re_password").value;
	    const str1value = str1Input.value.trim(); // Trim whitespace from username input value
      const str2value = str2Input.value.trim();
    var abc = document.getElementById("error");

    if (str1value === str2value) 
	{

		 
		alert("Match password");


    }
	else if(!str1value || !str2value)
	{
		alert("Please enter the password");
	}
	else

		{
                        alert("Password not match");						

				       
    }
	
}


</script> -->
</head>
<body>

<video autoplay muted loop id="video-background">
  <source src="image/video.mp4" type="video/mp4">
</video>


<div class="log">
<h1> Votescope </h1>


<form action="forgotpassword.php" id="signIn" method="post" >
<fieldset>
<center>

<label for="email">Email</label><br>
<input type="email" id="username1" name="email" required><br>
<p id="username_error"></p>
<label for="newpassword">New password</label><br>
<input type="Password" id="newpassword" name="newpassword" required><br><br>
<p id="password_error"></p>
<label for="re_password">Re-enter the new password</label><br>
<input type="Password" id="re_password" name="re_password" required><br><br>
<p id="confirmpassword_error"></p>


<p id="error"></p>



<button type="submit" id="btn4" onclick="test()" name="submit">Change password</button>


</div>

</div>

</fieldset>

   
		

</center>
</form>
</div>
<script src="forgotpassword.js"></script>
</body>
</html>