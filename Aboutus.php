<?php
require 'config.php';

include 'session.php';
?>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
	<title>Vote scope</title>
	<link rel="stylesheet" href="css/index_style.css">
	<link rel="stylesheet" href="css/userIndex_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .call-to-action{
                color:white;

        }
        </style>
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
                <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voting</a> 
                <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
                <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 

 </div>

 <img src="image/syslogo.png" style="width:90px;height:90px;background:none;" alt="logo" class="logo-1"> 
 
 <main>

	<section class="call-to-action">
      <div class="container">
      <div class="about-right" align="center">
               <br><br>
               <h1>About Us</h1><br><br>
               <p>Greetings and welcome to our nomination online voting system! 
                Our goal is to completely transform the award-giving process by offering a cutting-edge, safe platform. 
                We guarantee an open, equitable, and effective award nomination voting procedure with our cutting edge.  
                It is easy for administrators and participants to participate in the nomination process because to our user-friendly interface.  
                Our platform supports many different award categories, ranging from top industry honours to acknowledgment from the community. 
                Our goal is to prioritise inclusion, accessibility, and accuracy in the award selection process by utilising the power of online voting.  
                Join us in embracing the future of award nominations through our state-of-the-art online voting system,
                as we celebrate excellence and empower individuals and organisations.
               
               </p>
               <div class="address" >
                   <ul>
                       <li>
                           <span class="address-logo">
                               <i class="fa fa-envelope"></i>
                           </span>
                           <p>Address: Ballotbox2023,Colombo 07,Sri Lanka</p>
                       </li>
                       <li>
                           <span class="address-logo">
                               <i class="fa fa-phone"></i>
                           </span>
                           <p>Phone No :+91 2*9 6**7</p>
                       </li>
                       <li>
                           <span class="address-logo">
                               <i class="fa fa-envelope"></i>
                           </span>
                           <p>Email ID :  ballotbox2023@gmail.com</p>
                       </li>
                   </ul>
               </div>
               <div class="expertise">
                   <h3>Our Pages</h3>
                   <ul>
                       <li>
                           <span class="expertise-logo">
                               <i class="fa fa-facebook"></i>
                           </span>
                           <p>Facebook</p>
                       </li>
                       <li>
                           <span class="expertise-logo">
                               <i class="fa fa-twitter"></i>
                           </span>
                           <p>Twitter</p>
                       </li>
                       <li>
                           <span class="expertise-logo">
                               <i class="fa youtube"></i>
                           </span>
                           <p>You Tube</p>
                       </li>
                       <li>
                           <span class="expertise-logo">
                               <i class="fa  fa-square-instagram"></i>
                           <p>Instagram</p>
                           </span>
                       </li>
                   </ul>
               </div>
           </div>
    </section>
  </main>



 <div class="marquee">
<marquee><img src="image/add1.png" width="500px" alt="Adverticement">
	<img src="image/add2.jpeg" width="300px" alt="Adverticement">
	<img src="image/add1.jpeg" width="170px" alt="Adverticement">
	<img src="image/add5.jpeg" width="250px" alt="Adverticement"></marquee>
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