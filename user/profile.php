<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];

include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_id = $_SESSION['user']['id'];
    
    $errors = array();
    
    // Basic validation
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    
    // Password validation
    if (!empty($new_password)) {
        if ($new_password != $confirm_password) {
            $errors[] = "Passwords do not match";
        }
    }
    
    // If no errors, proceed with update
    if (empty($errors)) {
        if (!empty($new_password)) {
            // Update with new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET 
                     username = '$username', 
                     email = '$email', 
                     password = '$hashed_password' 
                     WHERE id = $user_id";
        } else {
            // Update without password
            $query = "UPDATE users SET 
                     username = '$username', 
                     email = '$email' 
                     WHERE id = $user_id";
        }
        
        if (mysqli_query($conn, $query)) {
            // Update session data
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            
            $success_message = "Profile updated successfully!";
            
            // Refresh user data
            $user = $_SESSION['user'];
        } else {
            $errors[] = "Error updating profile: " . mysqli_error($conn);
        }
    }
}

// Add this right after the <h1> tag to display messages
?>
<h1 class="mb-4">Profile</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php 
            foreach ($errors as $error) {
                echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success_message); ?>
    </div>
<?php endif; ?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Profile</h1>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="profile.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
        
        <a href="index.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include('../includes/footer.php');
?>