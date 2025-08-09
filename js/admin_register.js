document.addEventListener('DOMContentLoaded', function() {
    // Toggle registration form
    const toggleRegister = document.getElementById('toggleRegister');
    const registrationForm = document.getElementById('registrationForm');

    if (toggleRegister && registrationForm) {
        // Set initial state if not defined
        if (!registrationForm.style.display) {
            registrationForm.style.display = 'none';
        }
        toggleRegister.addEventListener('click', function() {
            registrationForm.style.display = registrationForm.style.display === 'none' ? 'block' : 'none';
            this.innerHTML = registrationForm.style.display === 'none' ?
                '<i class="fas fa-user-plus"></i> Register New User' :
                '<i class="fas fa-times"></i> Close Form';
            this.classList.toggle('btn-primary');
            this.classList.toggle('btn-warning');
        });
    }

    // Form submission for new user registration via AJAX
    const registrationFormAction = document.getElementById('registrationFormAction');
    if (registrationFormAction) {
        registrationFormAction.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch('../php/adminregister.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert(data.message);
                    registrationFormAction.reset();
                    registrationForm.style.display = 'none';
                    toggleRegister.innerHTML = '<i class="fas fa-user-plus"></i> Register New User';
                    toggleRegister.classList.remove('btn-warning');
                    toggleRegister.classList.add('btn-primary');
                    // Optionally update the user table dynamically instead of reload
                    location.reload(); // Reload to reflect new data
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                loading.remove();
                console.error('Error:', error);
                alert('An error occurred during registration.');
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
            const userId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');

            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsername').value = cells[0].textContent;
            document.getElementById('editEmail').value = cells[1].textContent;
            document.getElementById('editPhone').value = cells[2].textContent;
            document.getElementById('editNIC').value = cells[3].textContent;
            document.getElementById('editAddress').value = cells[4].textContent.trim();
            document.getElementById('editType').value = cells[5].textContent.trim().toLowerCase();

            document.getElementById('editModal').style.display = 'flex';
        });
    });

    // Open delete confirmation modal
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            confirmDelete.href = `admin_register.php?delete=${userId}`;
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

    // Form submission for editing user
    const editUserForm = document.getElementById('editUserForm');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const userId = formData.get('id');
            const loading = document.createElement('div');
            loading.id = 'loading';
            loading.style.cssText = 'text-align: center; padding: 10px;';
            loading.textContent = 'Processing...';
            this.appendChild(loading);

            fetch(`../php/update_user.php?id=${userId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.remove();
                if (data.success) {
                    alert('User updated successfully!');
                    window.location.reload();
                } else {
                    alert('Error updating user: ' + data.message);
                }
            })
            .catch(error => {
                loading.remove();
                console.error('Error:', error);
                alert('An error occurred while updating the user.');
            });
        });
    }

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    // Filter by type
    const typeFilter = document.getElementById('typeFilter');
    if (typeFilter) {
        typeFilter.addEventListener('change', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                if (filter === '') {
                    row.style.display = '';
                } else {
                    const type = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                    row.style.display = type === filter ? '' : 'none';
                }
            });
        });
    }

    // Floating action button
    const fabButton = document.getElementById('fabButton');
    if (fabButton) {
        fabButton.addEventListener('click', function() {
            if (registrationForm.style.display === 'block') {
                registrationForm.scrollIntoView({ behavior: 'smooth' });
            } else {
                toggleRegister.click();
                registrationForm.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // Password confirmation validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    if (password && confirmPassword) {
        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);
    }
});