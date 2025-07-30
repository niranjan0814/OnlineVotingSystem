<?php
require 'config.php';

include('session.php');
include('addadminform.php')
?>

<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
	<title>Vote scope</title>
	<link rel="stylesheet" href="css/index_style.css">
	<link rel="stylesheet" href="css/Adminform_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .data-container {
      display: flex;
      flex-wrap: wrap;
      margin: 10px;
    }

    .data-box {
      border: 2px solid #ddd;
      padding: 15px;
      margin: 5px;
      width: calc(22% - 10px); /* Adjust width for 3 columns */
      text-align: center;
    }
  </style>
</head>

<body>
<!-- Navbar -->
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
                <a class="fa fa-user" href= data-scroll-nav="2">Contestant</a> 
                <a class="fa fa-vote" href="managevote.php" data-scroll-nav="3">Manage vote</a> 
                <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voting</a> 
                <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
                <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 
 </div>

 <img src="image/syslogo.png" style="width:90px;height:90px;background:none;" alt="logo" class="logo-1"> 
 
 
 <div >
	<button class="add-button" onclick="addForm()">ADD +</button>
</div>
	<div class="form-popup" id="myForm">
	  <form action="addadminform.php" method="post" class="form-container" id="form-container" >
		<h1>Admin</h1>
		
		<label for="AID">Admin ID:</label>
		<input type="text"  id="AID" name="AID"><br>

		<label for="F_name">First Name:</label>
		<input type="text" placeholder="Enter Name" id="name" name="name"><br>
		
		<label for="email">Email</label><br>
		<input type="text" placeholder="Enter Email" id="email" name="email" required><br>

		<label for="phone">Phone Number:</label> <br>
	    <input type="tel" placeholder="077-XXXXXXX" id="phone" name="phone" required> <br><br>
		
		<label for="psw">Password</label>
		<input type="password" placeholder="Enter Password" name="psw" required><br>

		<input type="submit" value="Submit" name="submit" onclick="closeForm()" >
		<button type="button" class="btn" onclick="closeForm()">Cancel</button>
	  </form>
	</div>


   <script>
		function addForm() {
			document.getElementById("myForm").style.display = "block";
		}
			

		function closeForm() {
		  document.getElementById("myForm").style.display = "none";
		}
		
		function resetForm() {
		  document.getElementById('name').value = "";
          document.getElementById('email').value = "";
		 
		}
	</script>

  <div class="data-container" id="dataContainer"></div>

  <script>
    const form = document.getElementById('myForm');
    const dataContainer = document.getElementById('dataContainer');

    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission

      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;

      // Create a new data box element
      const dataBox = document.createElement('div');
      dataBox.classList.add('data-box');

      // Add heading and content to the data box
      const heading = document.createElement('h2');
      heading.textContent = "Submitted Information";
      dataBox.appendChild(heading);

      const nameData = document.createElement('p');
      nameData.textContent = "Name: " + name;
      dataBox.appendChild(nameData);

      const emailData = document.createElement('p');
      emailData.textContent = "Email: " + email;
      dataBox.appendChild(emailData);

      // Add edit and delete buttons
      const buttonContainer = document.createElement('div');
      buttonContainer.style.display = 'flex';
      buttonContainer.style.justifyContent = 'space-between';

      const editButton = document.createElement('button');
      editButton.textContent = "Edit";
      // Add functionality for edit button (implementation depends on your specific needs)

	  editButton.addEventListener('click', function() {
	  // Get the data box element for this button
	  const dataBox = this.parentElement.parentElement;

	  // Get current name and email values from the data box
	  const nameData = dataBox.querySelector('p:nth-child(2)'); // Selects second paragraph (name)
	  const emailData = dataBox.querySelector('p:nth-child(3)'); // Selects third paragraph (email)
	  const currentName = nameData.textContent.split(':')[1].trim(); // Extract name value
	  const currentEmail = emailData.textContent.split(':')[1].trim(); // Extract email value

	  // Create an edit form element
	  const editForm = document.createElement('form');

	  // Add name and email input fields with pre-filled values
	  const editName = document.createElement('input');
	  editName.type = 'text';
	  editName.value = currentName;
	  editForm.appendChild(editName);

	  const editEmail = document.createElement('input');
	  editEmail.type = 'email';
	  editEmail.value = currentEmail;
	  editForm.appendChild(editEmail);

	  // Add a submit button for editing
	  const editSubmit = document.createElement('button');
	  editSubmit.type = 'submit';
	  editSubmit.textContent = 'Save';
	  editForm.appendChild(editSubmit);

	  // Replace data box content with the edit form (temporary)
	  dataBox.innerHTML = ''; // Clear existing content
	  dataBox.appendChild(editForm);

	  // Implement form submission logic to update data and replace the form with updated data box content
	  editForm.addEventListener('submit', function(event) {
		event.preventDefault(); // Prevent default form submission

		// Get updated name and email from the edit form
		const updatedName = editName.value;
		const updatedEmail = editEmail.value;

		// Update data box content with new values (implementation depends on your data storage)
		nameData.textContent = `Name: ${updatedName}`;
		emailData.textContent = `Email: ${updatedEmail}`;

		// Replace edit form with the updated data box (optional)
		dataBox.removeChild(editForm);
		dataBox.appendChild(nameData);
		dataBox.appendChild(emailData);
		dataBox.appendChild(buttonContainer); // Re-append button container
	  });
	});

      buttonContainer.appendChild(editButton);

      const deleteButton = document.createElement('button');
      deleteButton.textContent = "Delete";
 
      deleteButton.addEventListener('click', function() {
        // Code to handle delete functionality 
		 dataContainer.removeChild(dataBox);
      });
      buttonContainer.appendChild(deleteButton);

      dataBox.appendChild(buttonContainer);

      // Append the data box to the container
      dataContainer.appendChild(dataBox);

      // Clear the form fields
      document.getElementById('name').value = "";
      document.getElementById('email').value = "";
    });
	




  </script>
</div>
<div class="footer">
    <p> <b>copyright 2024 &copy; &nbsp; All Rights Reserved. &nbsp; Northern Uni Vote scope.</b>  
      <a class="fa fa-envelope" href="" >northernunivote@gmail.com </a>  
      <a class="fa fa-phone" href="" >0761111222</a>
	</p>
</div>

<a class="fa fa-phone-square" href="contactus.php" data-scroll-nav="4">
    <button class="support">Contact us</button>
</a>
</body>
</html>
