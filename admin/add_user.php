<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

// Add new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    $conn->query($sql);
    header("Location: manage_users.php");
}
?>
<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');
?>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Add New User</h1>
        <form method="POST" class="mb-5">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="owner">Owner</option>
                    <option value="tenant">Tenant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html> 