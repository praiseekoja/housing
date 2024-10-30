
<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$monthly_revenue = $conn->query("SELECT SUM(amount_paid) as total_revenue, MONTH(payment_date) as month 
    FROM payments
    GROUP BY month");

$outstanding_rents = $conn->query("SELECT SUM(rent_amount) as total_outstanding, property_name
    FROM rents
    JOIN properties ON rents.property_id = properties.id
    WHERE paid_status='unpaid'
    GROUP BY property_name");
    include('../includes/header.php');
    include('../includes/nav.php');
    include('../includes/sidebar.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
</head>
<body>
    <h1>Monthly Revenue</h1>
    <table>
        <tr>
            <th>Month</th>
            <th>Total Revenue</th>
        </tr>
        <?php while($row = $monthly_revenue->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['month']; ?></td>
            <td><?php echo $row['total_revenue']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    <h1>Outstanding Rents</h1>
    <table>
        <tr>
            <th>Property</th>
            <th>Total Outstanding Rent</th>
        </tr>
        <?php while($row = $outstanding_rents->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['property_name']; ?></td>
            <td><?php echo $row['total_outstanding']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
include('../includes/footer.php');
?>

