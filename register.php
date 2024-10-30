<?php
include('./includes/config.php');
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $_POST['role'];
    
    // Basic validation
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    
    // Check if username already exists
    $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'");
    if (mysqli_num_rows($check_username) > 0) {
        $errors[] = "Username already exists.";
    }

    // Check if email already exists
    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'");
    if (mysqli_num_rows($check_email) > 0) {
        $errors[] = "Email already exists.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = $password;
        $sql = "INSERT INTO users (username, email, password, role) 
                VALUES ('" . mysqli_real_escape_string($conn, $username) . "', 
                        '" . mysqli_real_escape_string($conn, $email) . "', 
                        '" . mysqli_real_escape_string($conn, $hashed_password) . "', 
                        '" . mysqli_real_escape_string($conn, $role) . "')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['user'] = [
                'id' => mysqli_insert_id($conn),
                'username' => $username,
                'role' => $role
            ];
            
            header('Location: user/login.php');
            exit();
        } else {
            $errors[] = "Error during registration. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="tenant">Tenant</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3">Already have an account? <a href="./user/login.php">Login here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, only needed if you want to use Bootstrap's JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
