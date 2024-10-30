<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

// Assign rent to tenant
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $tenant_id = $_POST['tenant_id'];
    $rent_amount = $_POST['rent_amount'];
    $due_date = $_POST['due_date'];
    
    $sql = "INSERT INTO rents (property_id, tenant_id, rent_amount, due_date, paid_status) VALUES ('$property_id', '$tenant_id', '$rent_amount', '$due_date', 'unpaid')";
    $conn->query($sql);
    header("Location: manage_rents.php");
}

// Fetch properties and tenants
$properties = $conn->query("SELECT * FROM properties");
$tenants = $conn->query("SELECT id, username FROM users WHERE role='tenant'");
$rents = $conn->query("SELECT * FROM rents");

include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Rents</title>
</head>
<body>
    <h1>Assign Rent</h1>
    <form method="POST">
        <label>Property</label>
        <select name="property_id">
            <?php while($property = $properties->fetch_assoc()): ?>
            <option value="<?php echo $property['id']; ?>"><?php echo $property['property_name']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label>Tenant</label>
        <select name="tenant_id">
            <?php while($tenant = $tenants->fetch_assoc()): ?>
            <option value="<?php echo $tenant['id']; ?>"><?php echo $tenant['username']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label>Rent Amount</label>
        <input type="number" name="rent_amount" required>
        
        <label>Due Date</label>
        <input type="date" name="due_date" required>
        
        <button type="submit">Assign Rent</button>
    </form>
    
    <h2>All Rents</h2>
    <table>
        <tr>
            <th>Property</th>
            <th>Tenant</th>
            <th>Rent Amount</th>
            <th>Due Date</th>
            <th>Paid Status</th>
        </tr>
        <?php while($rent = $rents->fetch_assoc()): ?>
        <tr>
            <td><?php echo $rent['property_id']; ?></td>
            <td><?php echo $rent['tenant_id']; ?></td>
            <td><?php echo $rent['rent_amount']; ?></td>
            <td><?php echo $rent['due_date']; ?></td>
            <td><?php echo $rent['paid_status']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php
include('../includes/footer.php');
?>
