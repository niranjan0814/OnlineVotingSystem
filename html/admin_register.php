<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Contestant Registration - Vote Scope</title>
    <link rel="stylesheet" href="../css/admin_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Removed Font Awesome CDN -->
</head>

<body>
    <?php
    session_start();
    include 'header.php';
    require '../php/config.php';

    // Handle delete action
    $success_message = '';
    $error_message = '';
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM register WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "User deleted successfully!";
        } else {
            $error_message = "Error deleting user: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }

    // No form submission handling here; moved to adminregister.php for AJAX
    ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>User Management Dashboard</h1>
                <p>Manage admin and contestant accounts for the voting system</p>

                <!-- Temporary Success/Error Message with Close Button -->
                <div id="statusMessage" class="status-message" style="display: none;">
                    <span id="statusText"></span>
                    <button class="close-btn">&times;</button>
                </div>

                <button id="toggleRegister" class="btn btn-primary">
                    ➕ Register New User
                </button>

                <div id="registrationForm" class="registration-form">
                    <h2>✏️ User Registration Form</h2>
                    <p>Fill in the details below to register a new admin or contestant</p>

                    <form action="../php/adminregister.php" method="POST" id="registrationFormAction"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">👤 Username:</label>
                            <input type="text" id="username" name="username" required placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="email">✉️ Email:</label>
                            <input type="email" id="email" name="email" required placeholder="Enter email address">
                        </div>

                        <div class="form-group">
                            <label for="phone">📞 Phone:</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Enter phone number">
                        </div>

                        <div class="form-group">
                            <label for="NIC">🪪 NIC:</label>
                            <input type="text" id="NIC" name="NIC" required placeholder="Enter national ID number">
                        </div>

                        <div class="form-group">
                            <label for="address">📍 Address:</label>
                            <textarea id="address" name="address" required placeholder="Enter full address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="password">🔒 Password:</label>
                            <input type="password" id="password" name="password" required placeholder="Create password">
                            <div class="password-strength">
                                <div class="password-strength-bar" id="password-strength-bar"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">🔒 Confirm Password:</label>
                            <input type="password" id="confirm-password" name="confirm-password" required
                                placeholder="Confirm password">
                        </div>

                        <div class="form-group">
                            <label for="type">🏷️ User Type:</label>
                            <select id="type" name="type" required>
                                <option value="">Select user type</option>
                                <option value="admin">Admin</option>
                                <option value="contestant">Contestant</option>
                            </select>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn btn-success">
                                💾 Register User
                            </button>
                            <button type="reset" class="btn btn-warning">
                                ↺ Reset Form
                            </button>
                        </div>
                    </form>

                    <?php if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin'): ?>
                        <div class="status-message status-warning">
                            ⚠️ Only admins can register new users.
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                    <div class="search-filter">
                        <div class="search-box">

                            <input type="text" id="searchInput" placeholder="Search users...">
                        </div>
                        <div class="filter-group">
                            <label for="typeFilter">Filter by:</label>
                            <select id="typeFilter">
                                <option value="">All Users</option>
                                <option value="admin">Admins</option>
                                <option value="contestant">Contestants</option>
                                <option value="user">Regular Users</option>
                            </select>
                        </div>
                    </div>

                    <div class="user-table-container">
                        <table class="user-table" id="userTable">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>NIC</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT id, username, email, phone, NIC, address, type FROM register";
                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                if (!empty($users)) {
                                    foreach ($users as $user) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user['phone']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user['NIC']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user['address']) . "</td>";
                                        echo "<td><span class='badge'>" . htmlspecialchars($user['type']) . "</span></td>";
                                        echo "<td class='actions'>";
                                        echo "<button class='btn btn-primary edit-btn' data-id='" . $user['id'] . "'>✏️ Edit</button>";
                                        echo "<button class='btn btn-danger delete-btn' data-id='" . $user['id'] . "'>🗑️ Delete</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' style='text-align: center;'>No users registered yet.</td></tr>";
                                }
                                mysqli_stmt_close($stmt);
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="status-message status-warning">
                        ⚠️ Access denied. Only admins can view registered users.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Edit User Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit User</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="editUserForm">
                <input type="hidden" id="editUserId" name="id">
                <div class="form-group">
                    <label for="editUsername">Username:</label>
                    <input type="text" id="editUsername" name="username" required>
                </div>
                <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="editPhone">Phone:</label>
                    <input type="tel" id="editPhone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="editNIC">NIC:</label>
                    <input type="text" id="editNIC" name="NIC" required>
                </div>
                <div class="form-group">
                    <label for="editAddress">Address:</label>
                    <textarea id="editAddress" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editType">User Type:</label>
                    <select id="editType" name="type" required>
                        <option value="admin">Admin</option>
                        <option value="contestant">Contestant</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>⚠️ Confirm Deletion</h2>
                <button class="close-modal">&times;</button>
            </div>
            <p>Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning close-modal">Cancel</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Delete User</a>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->


    <!-- Footer -->
    <div id="footer"></div>

    <!-- JavaScript -->
    <script src="../js/admin_register.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>

    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function () {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength-bar');
            let strength = 0;

            if (password.length > 0) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBar.className = 'password-strength-bar';
            if (password.length === 0) {
                strengthBar.style.width = '0';
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength === 3) {
                strengthBar.classList.add('strength-medium');
            } else if (strength === 4) {
                strengthBar.classList.add('strength-good');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        // Handle success/error message display and close button
        document.addEventListener('DOMContentLoaded', function () {
            const statusMessage = document.getElementById('statusMessage');
            const statusText = document.getElementById('statusText');
            const closeBtn = document.querySelector('.close-btn');

            <?php if (!empty($success_message)): ?>
                statusMessage.classList.add('status-success');
                statusText.textContent = '<?php echo addslashes($success_message); ?>';
                statusMessage.style.display = 'block';
                <?php unset($success_message); // Clear after setting ?>
            <?php elseif (!empty($error_message)): ?>
                statusMessage.classList.add('status-error');
                statusText.textContent = '<?php echo addslashes($error_message); ?>';
                statusMessage.style.display = 'block';
                <?php unset($error_message); // Clear after setting ?>
            <?php endif; ?>

            closeBtn.addEventListener('click', function () {
                statusMessage.style.display = 'none';
            });

            // Auto-hide after 5 seconds if not closed manually
            setTimeout(() => {
                if (statusMessage.style.display === 'block') {
                    statusMessage.style.display = 'none';
                }
            }, 5000);
        });
    </script>
</body>

</html>