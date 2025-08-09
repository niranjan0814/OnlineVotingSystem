document.addEventListener('DOMContentLoaded', function() {
    // Toggle show form
    const toggleShowForm = document.getElementById('toggleShowForm');
    const showForm = document.getElementById('showForm');
    if (toggleShowForm && showForm) {
        toggleShowForm.addEventListener('click', function() {
            showForm.style.display = showForm.style.display === 'none' ? 'block' : 'none';
            this.textContent = showForm.style.display === 'none' ? '➕ Add New Show' : '❌ Close Form';
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

        // Auto-hide after 5 seconds if not closed manually
        setTimeout(() => {
            if (statusMessage.style.display === 'block') {
                statusMessage.style.display = 'none';
            }
        }, 5000);
    }

    // Form submission for adding a new show via AJAX
    const showFormAction = document.getElementById('showFormAction');
    if (showFormAction) {
        showFormAction.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch('../php/admin_showcontroller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert(data.message);
                    showFormAction.reset();
                    showForm.style.display = 'none';
                    toggleShowForm.textContent = '➕ Add New Show';
                    toggleShowForm.classList.remove('btn-warning');
                    toggleShowForm.classList.add('btn-primary');
                    location.reload(); // Reload to reflect new data
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
    const editButtons = document.querySelectorAll('.edit-btn');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const closeButtons = document.querySelectorAll('.close-modal');
    const confirmDelete = document.getElementById('confirmDelete');

    // Open edit modal
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const showId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');

            document.getElementById('editShowId').value = showId;
            document.getElementById('editName').value = cells[0].textContent;
            document.getElementById('editImageUrl').value = cells[1].textContent;
            document.getElementById('editDescription').value = cells[2].textContent;
            document.getElementById('editStartDate').value = cells[3].textContent;
            document.getElementById('editEndDate').value = cells[4].textContent;
            document.getElementById('editVenue').value = cells[5].textContent;
            document.getElementById('editStatus').value = cells[6].textContent.toLowerCase();

            document.getElementById('editModal').style.display = 'flex';
        });
    });

    // Open delete confirmation modal
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const showId = this.getAttribute('data-id');
            confirmDelete.href = `admin_show.php?delete=${showId}`;
            document.getElementById('deleteModal').style.display = 'flex';
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

    // Form submission for editing show
    const editShowForm = document.getElementById('editShowForm');
    if (editShowForm) {
        editShowForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const showId = formData.get('id');
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch(`../php/admin_showcontroller.php?id=${showId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert('Show updated successfully!');
                    window.location.reload();
                } else {
                    alert('Error updating show: ' + data.message);
                }
            })
            .catch(error => {
                loading.remove();
                console.error('Error:', error);
                alert('An error occurred while updating the show.');
            });
        });
    }
});