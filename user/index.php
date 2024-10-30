<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];
//$user = $_SESSION['user_details'];
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
//include('../includes/footer.php');
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
     Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Property Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        
        <!-- <div class="row">
            <div class="col-md-6">
                <?php if ($user['role'] == 'owner'): ?>
                    <h2>Owner Actions</h2>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="view_properties.php" class="text-decoration-none">View Owned Properties</a>
                        </li>
                    </ul>
                <?php elseif ($user['role'] == 'tenant'): ?>
                    <h2>Tenant Actions</h2>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="view_properties.php" class="text-decoration-none">View Your Properties</a>
                        </li>
                        <li class="list-group-item">
                            <a href="pay_rent.php" class="text-decoration-none">Pay Rent</a>
                        </li>
                        <li class="list-group-item">
                            <a href="payment_history.php" class="text-decoration-none">View Payment History</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div> -->
    </div>

<?php
include('../includes/footer.php');
?>
