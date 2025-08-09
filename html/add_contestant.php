<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contestants - Vote Scope</title>
    <link rel="stylesheet" href="../css/admin_register.css">
</head>

<body>
    <?php
    session_start();
    include 'admin_header.php';
    require '../php/config.php';

    $show_id = isset($_GET['show_id']) ? intval($_GET['show_id']) : 0;
    $show_name = isset($_GET['show_name']) ? urldecode($_GET['show_name']) : 'Unknown Show';

    $success_message = '';
    $error_message = '';
    if (isset($_GET['delete_contestant'])) {
        $contestant_id = $_GET['delete_contestant'];
        $query = "DELETE FROM contestants WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $contestant_id);
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Contestant deleted successfully!";
        } else {
            $error_message = "Error deleting contestant: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
    ?>

    <main>
        <section class="contestant-section">
            <div class="container">
                <h1>Contestant Management for <?php echo htmlspecialchars($show_name); ?></h1>
                <p>Manage contestants for the show: <?php echo htmlspecialchars($show_name); ?></p>

                <!-- Temporary Success/Error Message with Close Button -->
                <div id="statusMessage" class="status-message" style="display: none;">
                    <span id="statusText"></span>
                    <button class="close-btn">&times;</button>
                </div>

                <button id="toggleContestantForm" class="btn btn-primary">
                    ➕ Add New Contestant
                </button>

                <div id="contestantForm" class="registration-form" style="display: none;">
                    <h2>✏️ Add Contestant Form</h2>
                    <p>Fill in the details below to add a new contestant</p>

                    <form action="../php/add_contestantcontroller.php" method="POST" id="contestantFormAction"
                        enctype="multipart/form-data">
                        <input type="hidden" name="show_id" value="<?php echo $show_id; ?>">
                        <div class="form-group">
                            <label for="contestant_name">📜 Name:</label>
                            <input type="text" id="contestant_name" name="name" required placeholder="Enter contestant name">
                        </div>
                        <div class="form-group">
                            <label for="contestant_image_url">🌐 Image URL:</label>
                            <input type="text" id="contestant_image_url" name="image_url" placeholder="Enter image URL">
                        </div>
                        <div class="form-group">
                            <label for="contestant_description">📝 Description:</label>
                            <textarea id="contestant_description" name="description" placeholder="Enter contestant description"></textarea>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn btn-success">
                                💾 Add Contestant
                            </button>
                            <button type="reset" class="btn btn-warning">
                                ↺ Reset Form
                            </button>
                        </div>
                    </form>
                </div>

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                    <div class="user-table-container">
                        <table class="user-table" id="contestantTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image URL</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT id, name, image_url, description FROM contestants WHERE show_id = ?";
                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_bind_param($stmt, "i", $show_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $contestants = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                if (!empty($contestants)) {
                                    foreach ($contestants as $contestant) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($contestant['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($contestant['image_url'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($contestant['description'] ?? '') . "</td>";
                                        echo "<td class='actions'>";
                                        echo "<button class='btn btn-primary edit-contestant-btn' data-id='" . $contestant['id'] . "'>✏️ Edit</button>";
                                        echo "<button class='btn btn-danger delete-contestant-btn' data-id='" . $contestant['id'] . "'>🗑️ Delete</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' style='text-align: center;'>No contestants registered for this show yet.</td></tr>";
                                }
                                mysqli_stmt_close($stmt);
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="status-message status-warning">
                        ⚠️ Access denied. Only admins can view contestants.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Edit Contestant Modal -->
    <div class="modal" id="editContestantModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit Contestant</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="editContestantForm">
                <input type="hidden" id="editContestantId" name="id">
                <div class="form-group">
                    <label for="editContestantName">📜 Name:</label>
                    <input type="text" id="editContestantName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editContestantImageUrl">🌐 Image URL:</label>
                    <input type="text" id="editContestantImageUrl" name="image_url">
                </div>
                <div class="form-group">
                    <label for="editContestantDescription">📝 Description:</label>
                    <textarea id="editContestantDescription" name="description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteContestantModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>⚠️ Confirm Deletion</h2>
                <button class="close-modal">&times;</button>
            </div>
            <p>Are you sure you want to delete this contestant? This action cannot be undone.</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning close-modal">Cancel</button>
                <a href="#" id="confirmDeleteContestant" class="btn btn-danger">Delete Contestant</a>
            </div>
        </div>
    </div>

    <script src="../js/add_contestant.js"></script>
    <script src="../js/loadHeaderFooter.js"></script>
</body>

</html>