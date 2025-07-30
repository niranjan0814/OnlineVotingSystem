<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="show.css">
    <script src="js/show.js"></script>
    <title>Show</title>
</head>
<body>
<header>
        <div class="headcontainer1">

            <div id="logo_container">
                <img src="syslogo.png" alt="logo" id="logo_imgage">
            </div>

            <div id="sysname_container">
                <p>VOTE SCOPE</p>
            </div>

            <div id="circle">
                <div class="profile_container">
                    <img src="profilelogo.png"  alt="profile" id="profileimg">
                </div>
                <div id="button_container">
                    <a href="Logout.php"><button id="btn"> Logout</button></a>
                </div>
            </div>
            
        </div>
        <hr id="horizontal">
        <div class="topnavi">
                <a class="fa fa-home" href="index.php" data-scroll-nav="0">Home</a> 
                <a class="fa fa-music" href="TVshow.php" data-scroll-nav="1">Shows</a>
                <a class="fa fa-vote" href="managevote.php" data-scroll-nav="3">Manage vote</a> 
                <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voting</a> 
                <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
                <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 
 </div>
   
    
    <div class="container">
        <h2>shows</h2>
        <div class="header">
            <button class="btn" onclick="toggleForm()">Add Details </button>
            <br><br><br>
            
        </div>
        
        <div id="showForm" style="display: none;">
            <form method="POST" action="show.php" enctype="multipart/form-data"  >
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="sname">
            </div>
            <div class="form-group">
                <label for="name">television:</label>
                <input type="text" id="name" name="television">
            </div>
            <div class="form-group">
    <label for="season">Season:</label>
    <input type="text" id="season" name="season" pattern="[0-9]*" title="Please enter a valid number for the season" required>
</div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" accept="image/*" name="simage">
            </div>
            <button class="btn" onclick="addshow()" name="addbtn">Add show</button>
            <button class="btn" onclick="hideForm()">Cancel</button>
            </form>
        </div>
   <?php require 'show.php'?> 
        
    </div>
    <div class="show-list">
        <h1>show-list</h1>
        <div id="shows"></div>
    </div>

    <div id="popupForm" class="popup-form">
        <form id="editForm">
            <input type="hidden" id="editIndex" value="">
            <label for="Name">Name:</label><br>
            <label for="name">television:</label>
            <input type="text" id="editIndex" name="tvname">
            <label for="seasion">seasion:</label><br>
            <input type="tel" id="seasion" name="seasion"><br>
            <label for="image">Image:</label>
            <input type="file" id="image" accept="image/*" name="simage">
            <button type="button" onclick="saveEditedshow()">Save</button>
        </form>
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
