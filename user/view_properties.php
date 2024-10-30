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
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($property = $properties->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo '../' . htmlspecialchars($property['image_path']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo $property['property_name']; ?>"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $property['property_name']; ?></h5>
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php echo $property['address']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <a href="index.php" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>

  <!-- include('../includes/footer.php'); -->