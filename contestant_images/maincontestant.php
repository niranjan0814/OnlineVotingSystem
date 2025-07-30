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
                    <a href="#"><button id="btn"> Logout</button></a>
                </div>
            </div>
        </div>
        <hr id="horizontal">
    </header>
    
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
</body>
</html>
