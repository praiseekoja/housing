<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];

if ($user['role'] == 'owner') {
    // Fetch properties owned by the owner
    $properties = $conn->query("SELECT * FROM properties WHERE owner_id = " . $user['id']);
} else if ($user['role'] == 'tenant') {
    // Fetch properties assigned to the tenant
    $properties = $conn->query("SELECT properties.* FROM properties
        JOIN rents ON properties.id = rents.property_id
        WHERE rents.tenant_id = " . $user['id']);
}
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
?>


<body>
    <div class="container mt-5">
        <h1 class="mb-4"><?php echo $user['role'] == 'owner' ? 'Owned Properties' : 'Your Properties'; ?></h1>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Property Name</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($property = $properties->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $property['property_name']; ?></td>
                    <td><?php echo $property['address']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <a href="index.php" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>

  <!-- include('../includes/footer.php'); -->