<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

// Fetch properties
$sql = "SELECT properties.*, users.username as owner_name 
        FROM properties 
        JOIN users ON properties.owner_id = users.id";
$properties = mysqli_query($conn, $sql);
?>

<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');
?>

<div class="container mt-4">
    <h1 class="mb-4">Manage Properties</h1>
    
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <a href="add_property.php" class="btn btn-primary">Add New Property</a>
            </div>
            
            <h2>All Properties</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Property Name</th>
                            <th>Address</th>
                            <th>Owner</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($properties)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['owner_name']); ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td>
                                <?php if(!empty($row['image_path'])): ?>
                                    <img src="../<?php echo htmlspecialchars($row['image_path']); ?>" alt="Property Image" style="max-width: 100px;">
                                <?php else: ?>
                                    No image
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('../includes/footer.php');
?>
</body>
</html>
