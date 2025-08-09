document.addEventListener('DOMContentLoaded', function() {
    // Handle success/error message display
    const statusMessage = document.getElementById('statusMessage');
    const statusText = document.getElementById('statusText');
    const closeBtn = document.querySelector('.close-btn');
    if (statusMessage && statusText && closeBtn) {
        closeBtn.addEventListener('click', function() {
            statusMessage.style.display = 'none';
        });

        setTimeout(() => {
            if (statusMessage.style.display === 'block') {
                statusMessage.style.display = 'none';
            }
        }, 5000);
    }

    // Modal functionality
    const modals = document.querySelectorAll('.modal');
    const editContestantButtons = document.querySelectorAll('.edit-contestant-btn');
    const deleteContestantButtons = document.querySelectorAll('.delete-contestant-btn');
    const closeButtons = document.querySelectorAll('.close-modal');
    const confirmDeleteContestant = document.getElementById('confirmDeleteContestant');

    // Open edit modal
    editContestantButtons.forEach(button => {
        button.addEventListener('click', function() {
            const contestantId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');

            document.getElementById('editContestantId').value = contestantId;
            document.getElementById('editContestantName').value = cells[1].textContent; // Contestant Name
            document.getElementById('editContestantImageUrl').value = cells[2].textContent; // Image URL
            document.getElementById('editContestantDescription').value = cells[3].textContent; // Description
            document.getElementById('editContestantStatus').value = cells[4].textContent.toLowerCase(); // Status

            document.getElementById('editContestantModal').style.display = 'flex';
        });
    });

    // Open delete confirmation modal
    deleteContestantButtons.forEach(button => {
        button.addEventListener('click', function() {
            const contestantId = this.getAttribute('data-id');
            confirmDeleteContestant.href = `added_contestant.php?delete_contestant=${contestantId}`;
            document.getElementById('deleteContestantModal').style.display = 'flex';
        });
    });

    // Close modals
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            modals.forEach(modal => modal.style.display = 'none');
        });
    });

    // Close modal when clicking outside
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });

    // Form submission for editing contestant
    const editContestantForm = document.getElementById('editContestantForm');
    if (editContestantForm) {
        editContestantForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const contestantId = formData.get('id');
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch(`../php/added_contestantcontroller.php?id=${contestantId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert('Contestant updated successfully!');
                    window.location.reload();
                } else {
                    alert('Error updating contestant: ' + data.message);
                }
            })
            .catch(error => {
                loading.remove();
                console.error('Error:', error);
                alert('An error occurred while updating the contestant.');
            });
        });
    }
});