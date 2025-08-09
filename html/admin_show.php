<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Show Management - Vote Scope</title>
    <link rel="stylesheet" href="../css/admin_register.css">
</head>

<body>
    <?php
    session_start();
    include 'admin_header.php';
    require '../php/config.php';

    $success_message = '';
    $error_message = '';
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM shows WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Show deleted successfully!";
        } else {
            $error_message = "Error deleting show: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
    ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>Show Management Dashboard</h1>
                <p>Manage and add shows for the voting system</p>

                <!-- Temporary Success/Error Message with Close Button -->
                <div id="statusMessage" class="status-message" style="display: none;">
                    <span id="statusText"></span>
                    <button class="close-btn">&times;</button>
                </div>

                <button id="toggleShowForm" class="btn btn-primary">
                    ➕ Add New Show
                </button>

                <div id="showForm" class="registration-form" style="display: none;">
                    <h2>✏️ Add Show Form</h2>
                    <p>Fill in the details below to add a new show</p>

                    <form action="../php/admin_showcontroller.php" method="POST" id="showFormAction"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">📜 Name:</label>
                            <input type="text" id="name" name="name" required placeholder="Enter show name">
                        </div>
                        <div class="form-group">
                            <label for="image_url">🌐 Image URL:</label>
                            <input type="text" id="image_url" name="image_url" placeholder="Enter image URL">
                        </div>
                        <div class="form-group">
                            <label for="description">📝 Description:</label>
                            <textarea id="description" name="description" placeholder="Enter show description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start_date">📅 Start Date:</label>
                            <input type="date" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">📅 End Date:</label>
                            <input type="date" id="end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="venue">📍 Venue:</label>
                            <input type="text" id="venue" name="venue" required placeholder="Enter venue">
                        </div>
                        <div class="form-group">
                            <label for="status">🏷️ Status:</label>
                            <select id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn btn-success">
                                💾 Add Show
                            </button>
                            <button type="reset" class="btn btn-warning">
                                ↺ Reset Form
                            </button>
                        </div>
                    </form>
                </div>

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                    <div class="user-table-container">
                        <table class="user-table" id="showTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image URL</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Venue</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT id, name, image_url, description, start_date, end_date, venue, status FROM shows";
                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $shows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                if (!empty($shows)) {
                                    foreach ($shows as $show) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($show['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($show['image_url'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($show['description'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($show['start_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($show['end_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($show['venue']) . "</td>";
                                        echo "<td><span class='badge'>" . htmlspecialchars($show['status']) . "</span></td>";
                                        echo "<td class='actions'>";
                                        echo "<button class='btn btn-primary edit-btn' data-id='" . $show['id'] . "'>✏️ Edit</button>";
                                        echo "<button class='btn btn-danger delete-btn' data-id='" . $show['id'] . "'>🗑️ Delete</button>";
                                        echo "<a href='add_contestant.php?show_id=" . $show['id'] . "&show_name=" . urlencode($show['name']) . "' class='btn btn-info'>➕ Add Contestants</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8' style='text-align: center;'>No shows registered yet.</td></tr>";
                                }
                                mysqli_stmt_close($stmt);
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="status-message status-warning">
                        ⚠️ Access denied. Only admins can view shows.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Edit Show Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit Show</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="editShowForm">
                <input type="hidden" id="editShowId" name="id">
                <div class="form-group">
                    <label for="editName">📜 Name:</label>
                    <input type="text" id="editName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editImageUrl">🌐 Image URL:</label>
                    <input type="text" id="editImageUrl" name="image_url">
                </div>
                <div class="form-group">
                    <label for="editDescription">📝 Description:</label>
                    <textarea id="editDescription" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="editStartDate">📅 Start Date:</label>
                    <input type="date" id="editStartDate" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="editEndDate">📅 End Date:</label>
                    <input type="date" id="editEndDate" name="end_date" required>
                </div>
                <div class="form-group">
                    <label for="editVenue">📍 Venue:</label>
                    <input type="text" id="editVenue" name="venue" required>
                </div>
                <div class="form-group">
                    <label for="editStatus">🏷️ Status:</label>
                    <select id="editStatus" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="completed">Completed</option>
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
            <p>Are you sure you want to delete this show? This action cannot be undone.</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning close-modal">Cancel</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Delete Show</a>
            </div>
        </div>
    </div>

    <script src="../js/admin_show.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>
</body>

</html>