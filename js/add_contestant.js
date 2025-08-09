document.addEventListener('DOMContentLoaded', function() {
    // Toggle contestant form
    const toggleContestantForm = document.getElementById('toggleContestantForm');
    const contestantForm = document.getElementById('contestantForm');
    if (toggleContestantForm && contestantForm) {
        toggleContestantForm.addEventListener('click', function() {
            contestantForm.style.display = contestantForm.style.display === 'none' ? 'block' : 'none';
            this.textContent = contestantForm.style.display === 'none' ? '➕ Add New Contestant' : '❌ Close Form';
            this.classList.toggle('btn-primary');
            this.classList.toggle('btn-warning');
        });
    }

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

    // Form submission for adding a new contestant via AJAX
    const contestantFormAction = document.getElementById('contestantFormAction');
    if (contestantFormAction) {
        contestantFormAction.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch('../php/add_contestantcontroller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert(data.message);
                    contestantFormAction.reset();
                    contestantForm.style.display = 'none';
                    toggleContestantForm.textContent = '➕ Add New Contestant';
                    toggleContestantForm.classList.remove('btn-warning');
                    toggleContestantForm.classList.add('btn-primary');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                loading.remove();
                console.error('Error:', error);
                alert('An error occurred during submission.');
            });
        });
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
            document.getElementById('editContestantName').value = cells[0].textContent;
            document.getElementById('editContestantImageUrl').value = cells[1].textContent;
            document.getElementById('editContestantDescription').value = cells[2].textContent;

            document.getElementById('editContestantModal').style.display = 'flex';
        });
    });

    // Open delete confirmation modal
    deleteContestantButtons.forEach(button => {
        button.addEventListener('click', function() {
            const contestantId = this.getAttribute('data-id');
            confirmDeleteContestant.href = `add_contestant.php?delete_contestant=${contestantId}&show_id=<?php echo $show_id; ?>`;
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

            fetch(`../php/add_contestantcontroller.php?id=${contestantId}`, {
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