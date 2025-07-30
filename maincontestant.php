<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contestant.css">
    <script src="contestant.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="headcontainer1">

            <div id="logo_container">
                <img src="syslogo.png" alt="logo" id="logo_imgage">
            </div>

            <div id="sysname_container">
                <p>BIGG BOSS</p>
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
        
    </header>
    <div class="topnavi">
    <a class="fa fa-home" href="index.php" data-scroll-nav="0">Home</a> 
                <a class="fa fa-music" href="TVshow.php" data-scroll-nav="1">Shows</a>
                <a class="fa fa-vote" href="managevote.php" data-scroll-nav="3">Manage vote</a> 
                <a class="fa fa-vote" href="vote1.php" data-scroll-nav="3">voteing</a> 
                <a class="fa fa-star" href="sponsor.php" data-scroll-nav="4">Sponsor</a> 
                <a class="fa fa-users" href="aboutus.php" data-scroll-nav="5">About us</a> 

 </div>
    <div class="container">
        <h2>Contestants</h2>
        <div class="header">
            <button class="btn" onclick="toggleForm()">Add Contestant details </button>
            
        </div>
        
        <div id="contestantForm" style="display: none;">
            <form method="POST" action="contestant.php" enctype="multipart/form-data"  >
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="cName">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email"  name="email">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="cpassword">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" accept="image/*" name="cimage">
            </div>
            <button class="btn" onclick="addContestant()" name="addbtn">Add Contestant</button>
            <button class="btn" onclick="hideForm()">Cancel</button>
            </form>
        </div>
   <?php require 'contestant.php'?> 
        
    </div>
    <div class="contestant-list">
        <h1>Contestant-list</h1>
        <div id="contestants"></div>
    </div>

    <div id="popupForm" class="popup-form">
        <form id="editForm">
            <input type="hidden" id="editIndex" value="">
            <label for="editName">Name:</label><br>
            <input type="text" id="editName" name="editName"><br>
            <label for="editEmail">Email:</label><br>
            <input type="email" id="editEmail" name="editEmail"><br>
            <label for="editPhone">Phone:</label><br>
            <input type="tel" id="editPhone" name="editPhone"><br>
            <label for="editPassword">Password:</label><br>
            <input type="password" id="editPassword" name="editPassword"><br>
            <label for="editDob">Date of Birth:</label><br>
            <input type="date" id="editDob" name="editDob"><br>
            <label for="editGender">Gender:</label><br>
            <select id="editGender" name="editGender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
            <button type="button" onclick="saveEditedContestant()">Save</button>
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
