
// Function to toggle the visibility of the contestant form
function toggleForm() {
    var form = document.getElementById("contestantForm");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

/*// Function to add a contestant
function addContestant() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;
    var dob = document.getElementById("dob").value;
    var gender = document.getElementById("gender").value;
    var imageInput = document.getElementById("image");
    var image = imageInput.files[0];

    var reader = new FileReader();
    reader.onload = function(event) {
        var contestant = {
            name: name,
            email: email,
            phone: phone,
            password: password,
            dob: dob,
            gender: gender,
            image: event.target.result // Base64 data URI
        };

        var existingContestants = JSON.parse(localStorage.getItem("contestants")) || [];
        existingContestants.unshift(contestant); // Add the new contestant to the beginning of the array

        localStorage.setItem("contestants", JSON.stringify(existingContestants));

        displayContestants();
        toggleForm(); // Hide the form after adding contestant
    };
    reader.readAsDataURL(image);
}*/

/*// Function to display contestants
function displayContestants() {
    var contestantsDiv = document.getElementById("contestants");
    contestantsDiv.innerHTML = ""; // Clear previous content

    // Retrieve contestant data from URL query parameter
    var urlParams = new URLSearchParams(window.location.search);
    var contestantsJson = urlParams.get('contestants');

    // If contestant data exists, parse and display it
    if (contestantsJson) {
        var contestants = JSON.parse(decodeURIComponent(contestantsJson));
        contestants.forEach(function(contestant) {
            // Create HTML elements to display contestant details
            var contestantDiv = document.createElement("div");
            contestantDiv.classList.add("contestant");

            var image = document.createElement("img");
            image.src = contestant.image; // Assuming you have an 'image' property in your contestant object
            image.alt = "Contestant Image";

            var detailsDiv = document.createElement("div");
            detailsDiv.classList.add("contestant-details");

            var nameP = document.createElement("p");
            nameP.innerHTML = "<strong>Name:</strong> " + contestant.CName; // Assuming 'CName' is the property for name

            var emailP = document.createElement("p");
            emailP.innerHTML = "<strong>Email:</strong> " + contestant.Email; // Assuming 'Email' is the property for email

            var phoneP = document.createElement("p");
            phoneP.innerHTML = "<strong>Phone:</strong> " + contestant.Phone; // Assuming 'Phone' is the property for phone

            var dobP = document.createElement("p");
            dobP.innerHTML = "<strong>Date of Birth:</strong> " + contestant.DOB; // Assuming 'DOB' is the property for date of birth

            var genderP = document.createElement("p");
            genderP.innerHTML = "<strong>Gender:</strong> " + contestant.Gender; // Assuming 'Gender' is the property for gender

            detailsDiv.appendChild(nameP);
            detailsDiv.appendChild(emailP);
            detailsDiv.appendChild(phoneP);
            detailsDiv.appendChild(dobP);
            detailsDiv.appendChild(genderP);

            contestantDiv.appendChild(image);
            contestantDiv.appendChild(detailsDiv);

            contestantsDiv.appendChild(contestantDiv);
        });
    }
}

// Display existing contestants on page load
displayContestants();


// Function to show edit form
function showEditForm(index) {
    var contestants = JSON.parse(localStorage.getItem("contestants")) || [];
    var contestant = contestants[index];
    if (!contestant) return;

    document.getElementById("editIndex").value = index;
    document.getElementById("editName").value = contestant.name;
    document.getElementById("editEmail").value = contestant.email;
    document.getElementById("editPhone").value = contestant.phone;
    document.getElementById("editPassword").value = contestant.password;
    document.getElementById("editDob").value = contestant.dob;
    document.getElementById("editGender").value = contestant.gender;

    document.getElementById("popupForm").style.display = "block";
}
*
// Function to save edited contestant
function saveEditedContestant() {
    var index = parseInt(document.getElementById("editIndex").value);
    var contestants = JSON.parse(localStorage.getItem("contestants")) || [];
    var name = document.getElementById("editName").value;
    var email = document.getElementById("editEmail").value;
    var phone = document.getElementById("editPhone").value;
    var password = document.getElementById("editPassword").value;
    var dob = document.getElementById("editDob").value;
    var gender = document.getElementById("editGender").value;

    if (name !== null && email !== null && phone !== null && password !== null && dob !== null && gender !== null) {
        contestants[index] = {
            name: name,
            email: email,
            phone: phone,
            password: password,
            dob: dob,
            gender: gender,
            image: contestants[index].image // Retain the existing image
        };

        localStorage.setItem("contestants", JSON.stringify(contestants));
        displayContestants();
    }

    document.getElementById("popupForm").style.display = "none";
}

// Function to delete a contestant
function deleteContestant(index) {
    var contestants = JSON.parse(localStorage.getItem("contestants")) || [];
    contestants.splice(index, 1);
    localStorage.setItem("contestants", JSON.stringify(contestants));
    displayContestants();
}*/

// Display existing contestants on page load
//displayContestants();
// Function to toggle the visibility of the contestant form
function toggleForm() {
    var form = document.getElementById("contestantForm");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Function to hide the contestant form
function hideForm() {
    document.getElementById("contestantForm").style.display = "none";
    window.location.href = 'maincontestant.php';
    
}
