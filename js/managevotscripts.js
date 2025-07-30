document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch contestants from the database and populate the select element
    function fetchContestants() {
        // You can make an AJAX request to fetch contestants from the database
        // For simplicity, let's assume contestants are fetched from a static array
        const contestants = ["Contestant 1", "Contestant 2", "Contestant 3"];

        const selectElement = document.getElementById("contestants");
        contestants.forEach(contestant => {
            const option = document.createElement("option");
            option.text = contestant;
            option.value = contestant;
            selectElement.appendChild(option);
        });
    }

    // Populate contestants select element on page load
    fetchContestants();

    // Function to handle form submission
    document.getElementById("addForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        
        // You can make an AJAX request to send form data to the server for insertion into the database
        // For simplicity, let's assume the data is sent to a PHP script using fetch API
        fetch("addmanagevote.php", {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            // Handle the response from the server
            console.log(result);
            
            location.reload();
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });

    // Function to fetch and display existing voting scopes
    function fetchVotingScopes() {
        // You can make an AJAX request to fetch existing voting scopes from the database
        // For simplicity, let's assume voting scopes are fetched from a static array
        const votingScopes = [
            { votingId: "V001", showName: "Show 1", startDate: "2024-05-10", endDate: "2024-05-20" },
            { votingId: "V002", showName: "Show 2", startDate: "2024-06-01", endDate: "2024-06-10" }
        ];

        const tableBody = document.querySelector("#votingScopes tbody");
        votingScopes.forEach(scope => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${scope.votingId}</td>
                <td>${scope.showName}</td>
                <td>${scope.startDate}</td>
                <td>${scope.endDate}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    
    fetchVotingScopes();
});
