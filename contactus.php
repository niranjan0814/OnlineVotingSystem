<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
	<title>Vote scope</title>
	<link rel="stylesheet" href="css/contactus.css">
    <link rel="stylesheet" href="css/index_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
 
	<h1>Contact Us</h1>
    <form action="contactus.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
		<label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required></br></br>
		<button type="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="submit">Submit</button>
    </form>

 
 
 <br><br><br><br><br><br><br><br><br>
<div class="footer">
    <p> <b>copyright 2024 &copy; &nbsp; All Rights Reserved. &nbsp; Northern Uni Vote scope.</b>  
      <a class="fa fa-envelope" href="mailto:someone@example.com" >northernunivote@gmail.com </a>  
      <a class="fa fa-phone" href="phoneto:0761111222" >0761111222</a>
	</p> 
</div>

<a class="fa fa-phone-square" href="contactus.php" data-scroll-nav="4">
    <button class="support">Contact us</button>
</a>
</body>
</html>