<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}



include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');


?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_properties.php">Manage Properties</a></li>
        <li><a href="view_payments.php">View Rent Payments</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="logout.ph">Logout</a></li>
    </ul>p
</body>
</html> -->
<?php
include('../includes/footer.php');
?>
