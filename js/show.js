
// Function to toggle the visibility of the show form
function toggleForm() {
    var form = document.getElementById("showForm");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

/*// Function to add a show
function addshow() {
    var name = document.getElementById("name").value;
    var television = document.getElementById("television").value;
    var seasion = document.getElementById("seasion").value;
    var password = document.getElementById("password").value;
    var dob = document.getElementById("dob").value;
    var gender = document.getElementById("gender").value;
    var imageInput = document.getElementById("image");
    var image = imageInput.files[0];

    var reader = new FileReader();
    reader.onload = function(event) {
        var show = {
            name: name,
            television: television,
            seasion: seasion,
            password: password,
            dob: dob,
            gender: gender,
            image: event.target.result // Base64 data URI
        };

        var existingshows = JSON.parse(localStorage.getItem("shows")) || [];
        existingshows.unshift(show); // Add the new show to the beginning of the array

        localStorage.setItem("shows", JSON.stringify(existingshows));

        displayshows();
        toggleForm(); // Hide the form after adding show
    };
    reader.readAsDataURL(image);
}*/

/*// Function to display shows
function displayshows() {
    var showsDiv = document.getElementById("shows");
    showsDiv.innerHTML = ""; // Clear previous content

    // Retrieve show data from URL query parameter
    var urlParams = new URLSearchParams(window.location.search);
    var showsJson = urlParams.get('shows');

    // If show data exists, parse and display it
    if (showsJson) {
        var shows = JSON.parse(decodeURIComponent(showsJson));
        shows.forEach(function(show) {
            // Create HTML elements to display show details
            var showDiv = document.createElement("div");
            showDiv.classList.add("show");

            var image = document.createElement("img");
            image.src = show.image; // Assuming you have an 'image' property in your show object
            image.alt = "show Image";

            var detailsDiv = document.createElement("div");
            detailsDiv.classList.add("show-details");

            var nameP = document.createElement("p");
            nameP.innerHTML = "<strong>Name:</strong> " + show.sname; // Assuming 'sname' is the property for name

            var televisionP = document.createElement("p");
            televisionP.innerHTML = "<strong>television:</strong> " + show.television; // Assuming 'television' is the property for television

            var seasionP = document.createElement("p");
            seasionP.innerHTML = "<strong>seasion:</strong> " + show.seasion; // Assuming 'seasion' is the property for seasion

            var dobP = document.createElement("p");
            dobP.innerHTML = "<strong>Date of Birth:</strong> " + show.DOB; // Assuming 'DOB' is the property for date of birth

            var genderP = document.createElement("p");
            genderP.innerHTML = "<strong>Gender:</strong> " + show.Gender; // Assuming 'Gender' is the property for gender

            detailsDiv.appendChild(nameP);
            detailsDiv.appendChild(televisionP);
            detailsDiv.appendChild(seasionP);
            detailsDiv.appendChild(dobP);
            detailsDiv.appendChild(genderP);

            showDiv.appendChild(image);
            showDiv.appendChild(detailsDiv);

            showsDiv.appendChild(showDiv);
        });
    }
}

// Display existing shows on page load
displayshows();


// Function to show edit form
function showEditForm(index) {
    var shows = JSON.parse(localStorage.getItem("shows")) || [];
    var show = shows[index];
    if (!show) return;

    document.getElementById("editIndex").value = index;
    document.getElementById("editName").value = show.name;
    document.getElementById("edittelevision").value = show.television;
    document.getElementById("editseasion").value = show.seasion;
    document.getElementById("editPassword").value = show.password;
    document.getElementById("editDob").value = show.dob;
    document.getElementById("editGender").value = show.gender;

    document.getElementById("popupForm").style.display = "block";
}
*
// Function to save edited show
function saveEditedshow() {
    var index = parseInt(document.getElementById("editIndex").value);
    var shows = JSON.parse(localStorage.getItem("shows")) || [];
    var name = document.getElementById("editName").value;
    var television = document.getElementById("edittelevision").value;
    var seasion = document.getElementById("editseasion").value;
    var password = document.getElementById("editPassword").value;
    var dob = document.getElementById("editDob").value;
    var gender = document.getElementById("editGender").value;

    if (name !== null && television !== null && seasion !== null && password !== null && dob !== null && gender !== null) {
        shows[index] = {
            name: name,
            television: television,
            seasion: seasion,
            password: password,
            dob: dob,
            gender: gender,
            image: shows[index].image // Retain the existing image
        };

        localStorage.setItem("shows", JSON.stringify(shows));
        displayshows();
    }

    document.getElementById("popupForm").style.display = "none";
}

// Function to delete a show
function deleteshow(index) {
    var shows = JSON.parse(localStorage.getItem("shows")) || [];
    shows.splice(index, 1);
    localStorage.setItem("shows", JSON.stringify(shows));
    displayshows();
}*/

// Display existing shows on page load
//displayshows();
// Function to toggle the visibility of the show form
function toggleForm() {
    var form = document.getElementById("showForm");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Function to hide the show form
function hideForm() {
    document.getElementById("showForm").style.display = "none";
    window.location.href = 'TVshow.php';
    
}
document.getElementById("seasion").addEventListener("input", function() {
    var input = this.value.trim();
    var errorMessage = "";

    if (isNaN(input) || input < 1 || input > 12) {
        errorMessage = "Please enter a number between 1 and 12.";
    }

    document.getElementById("seasion-error").textContent = errorMessage;
});