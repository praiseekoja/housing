<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

// Fetch users
$users = $conn->query("SELECT * FROM users");
?>
<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');
?>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Manage Users</h1>
        <a href="add_user.php" class="btn btn-primary mb-4">Add New User</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
