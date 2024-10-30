<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}
$sql = "SELECT payments.amount_paid, payments.payment_date, users.username, properties.property_name
    FROM payments 
    JOIN rentals ON payments.rent_id = rentals.id
    JOIN users ON rentals.user_id = users.id 
    JOIN properties ON rentals.property_id = properties.id
    ORDER BY payments.payment_date DESC";
$payments = $conn->query($sql);



// $payments = $conn->query("SELECT payments.amount_paid, payments.payment_date, users.username, properties.property_name
//     FROM payments 
//     JOIN rentals ON payments.rent_id = rentals.id
//     JOIN users ON rentals.user_id = users.id 
//     JOIN properties ON rentals.property_id = properties.id
//     ORDER BY payments.payment_date DESC");
    

include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rent Payments</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">View Rent Payments</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Tenant</th>
                    <th>Property</th>
                    <th>Amount Paid</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
              
                <?php var_dump($payments); while($row = $payments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['amount_paid']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
