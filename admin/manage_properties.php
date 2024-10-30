<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}


// Add property
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_name = $_POST['property_name'];
    $address = $_POST['address'];
    $owner_id = $_POST['owner_id'];
    $price = $_POST['price']; // Add this line
    
    // Handle image upload
    $target_dir = "../uploads/properties/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $image_path = "";
    if($_FILES["property_image"]["error"] == 0) {
        $file_extension = strtolower(pathinfo($_FILES["property_image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png");
        
        if(in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . "." . $file_extension;
            $target_file = $target_dir . $unique_filename;
            
            if(move_uploaded_file($_FILES["property_image"]["tmp_name"], $target_file)) {
                $image_path = "uploads/properties/" . $unique_filename;
            }
        }
    }
    
    $sql = "INSERT INTO properties (property_name, address, owner_id, image_path, price) 
            VALUES ('$property_name', '$address', '$owner_id', '$image_path', '$price')";
    mysqli_query($conn, $sql);
    header("Location: manage_properties.php");
    exit();
}

// Fetch properties
$sql = "SELECT properties.*, users.username as owner_name 
        FROM properties 
        JOIN users ON properties.owner_id = users.id";
$properties = mysqli_query($conn, $sql);

$sql = "SELECT id, username FROM users WHERE role='owner'";
$owners = mysqli_query($conn, $sql);
?>

<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar.php');
?>

<div class="container mt-4">
    <h1 class="mb-4">Manage Properties</h1>
    
    <div class="row">
        <div class="col-md-6">
            <h2>Add Property</h2>
            <form method="POST" class="mb-4" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="property_name" class="form-label">Property Name</label>
                    <input type="text" class="form-control" id="property_name" name="property_name" required>
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="owner_id" class="form-label">Owner</label>
                    <select class="form-select" id="owner_id" name="owner_id">
                        <?php while($owner = mysqli_fetch_assoc($owners)): ?>
                        <option value="<?php echo $owner['id']; ?>"><?php echo $owner['username']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="property_image" class="form-label">Property Image</label>
                    <input type="file" class="form-control" id="property_image" name="property_image" accept="image/*" required>
                    <small class="text-muted">Accepted formats: JPG, JPEG, PNG</small>
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Property</button>
            </form>
        </div>
        
        <div class="col-md-6">
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
