<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Contestant Registration - Vote Scope</title>
    <link rel="stylesheet" href="../css/admin_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include 'header.php';
    require '../php/config.php';

    // Handle delete action
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

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $NIC = $_POST['NIC'];
        $address = $_POST['address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $type = $_POST['type'];

        $query = "INSERT INTO register (username, email, phone, NIC, address, password, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $username, $email, $phone, $NIC, $address, $password, $type);

        if (mysqli_stmt_execute($stmt)) {
            $success_message = "User registered successfully!";
        } else {
            $error_message = "Error registering user: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    }
    ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>User Management Dashboard</h1>
                <p>Manage admin and contestant accounts for the voting system</p>

                <button id="toggleRegister" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Register New User
                </button>

                <div id="registrationForm" class="registration-form">
                    <h2><i class="fas fa-user-edit"></i> User Registration Form</h2>
                    <p>Fill in the details below to register a new admin or contestant</p>

                    <?php if (isset($success_message)): ?>
                        <div class="status-message status-success">
                            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($error_message)): ?>
                        <div class="status-message status-error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form action="admin_register.php" method="POST" id="registrationFormAction">
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Username:</label>
                            <input type="text" id="username" name="username" required placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                            <input type="email" id="email" name="email" required placeholder="Enter email address">
                        </div>

                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Phone:</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Enter phone number">
                        </div>

                        <div class="form-group">
                            <label for="NIC"><i class="fas fa-id-card"></i> NIC:</label>
                            <input type="text" id="NIC" name="NIC" required placeholder="Enter national ID number">
                        </div>

                        <div class="form-group">
                            <label for="address"><i class="fas fa-map-marker-alt"></i> Address:</label>
                            <textarea id="address" name="address" required placeholder="Enter full address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock"></i> Password:</label>
                            <input type="password" id="password" name="password" required placeholder="Create password">
                            <div class="password-strength">
                                <div class="password-strength-bar" id="password-strength-bar"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password"><i class="fas fa-lock"></i> Confirm Password:</label>
                            <input type="password" id="confirm-password" name="confirm-password" required
                                placeholder="Confirm password">
                        </div>

                        <div class="form-group">
                            <label for="type"><i class="fas fa-user-tag"></i> User Type:</label>
                            <select id="type" name="type" required>
                                <option value="">Select user type</option>
                                <option value="admin">Admin</option>
                                <option value="contestant">Contestant</option>
                            </select>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Register User
                            </button>
                            <button type="reset" class="btn btn-warning">
                                <i class="fas fa-undo"></i> Reset Form
                            </button>
                        </div>
                    </form>

                    <?php if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin'): ?>
                        <div class="status-message status-warning">
                            <i class="fas fa-exclamation-triangle"></i> Only admins can register new users.
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                    <div class="search-filter">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
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
                                        echo "<button class='btn btn-primary edit-btn' data-id='" . $user['id'] . "'><i class='fas fa-edit'></i> Edit</button>";
                                        echo "<button class='btn btn-danger delete-btn' data-id='" . $user['id'] . "'><i class='fas fa-trash'></i> Delete</button>";
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
                        <i class="fas fa-exclamation-triangle"></i> Access denied. Only admins can view registered users.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Edit User Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-user-edit"></i> Edit User</h2>
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
                <h2><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h2>
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
    <div class="fab" id="fabButton" title="Quick Actions">
        <i class="fas fa-bolt"></i>
    </div>

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
    </script>
</body>

</html>