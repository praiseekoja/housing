<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}
include '../includes/config.php';
$user = $_SESSION['user'];

// Update the user session to include email
$user_id = $user['id'];
$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$_SESSION['user']['email'] = $user_data['email'];


include '../includes/header.php';
include '../includes/nav.php';
include '../includes/sidebar_user.php';  
include '../includes/footer.php';

?>
<?php
if (!isset($_GET['id'])) {
    header('Location: available_properties.php');
    exit();
}

// Get property details
$id = $_GET['id'];
$query = "SELECT * FROM properties WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$property = mysqli_fetch_assoc($result);
//var_dump($user_data);
?>


    

<body>
<!-- <style>
        .container { 
            width: 80%; 
            margin: 0 auto; 
            padding: 20px;
        }
        .property-info {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }
        .status {
            padding: 5px 10px;
            background: #green;
            color: white;
            display: inline-block;
        }
    </style> -->
    <div class="container mt-4">
        <h1 class="display-4 mb-4">Property Details</h1>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Property Name -->
                <h2 class="card-title mb-4"><?php echo $property['property_name']; ?></h2>

                <!-- Availability Status -->
                <div class="mb-4">
                    <?php 
                    if($property['available'] == 1) {
                        echo '<span class="badge bg-success">Available</span>';
                    } else {
                        echo '<span class="badge bg-danger">Not Available</span>';
                    }
                    ?>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <h5 class="text-muted">Address</h5>
                    <p class="lead">
                        <?php echo $property['address']; ?>
                    </p>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <h5 class="text-muted">Price</h5>
                    <p class="lead">
                        <?php 
                        if($property['price'] == 0) {
                            echo "Price on request";
                        } else {
                            echo "$" . number_format($property['price'], 2);
                        }
                        ?>
                    </p>
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <?php if(!empty($property['image_path'])): ?>
                        <img src="../<?php echo $property['image_path']; ?>" class="img-fluid rounded" alt="Property Image">
                    <?php else: ?>
                        <div class="alert alert-info">No image available</div>
                    <?php endif; ?>
                </div>

                <!-- Owner Info -->
                <div class="mb-4">
                    <h5 class="text-muted">Owner</h5>
                    <p class="lead"><?php echo $user_data['username']; ?></p>
                </div>

                <!-- Rent Button Form -->
                <?php if($property['available'] == 1): ?>
                    <div class="mb-4">
                        <button type="button" class="btn btn-success btn-lg" onClick="makePayment()">
                            <i class="bi bi-credit-card me-2"></i>Rent Now - ₦<?php echo number_format($property['price'], 2); ?>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Flutterwave Payment Script -->
                <script src="https://checkout.flutterwave.com/v3.js"></script>
                <script>
                    function makePayment() {
                        FlutterwaveCheckout({
                            public_key: "FLWPUBK_TEST-9b6ea1422c2caca239354117995a4046-X",
                            tx_ref: "PROP_" + Math.floor((Math.random() * 1000000000) + 1),
                            amount: <?php echo $property['price']; ?>,
                            currency: "NGN",
                            payment_options: "card,banktransfer,ussd",
                            redirect_url: window.location.origin + "/housing/user/process_payment.php?property_id=<?php echo $property['id']; ?>",
                            meta: {
                                property_id: <?php echo $property['id']; ?>
                            },
                            customer: {
                                email: "<?php echo $user_data['email']; ?>",
                                name: "<?php echo $user_data['username']; ?>",
                            },
                            customizations: {
                                title: "Property Rental Payment",
                                description: "Payment for <?php echo $property['property_name']; ?>",
                                logo: "https://yourwebsite.com/logo.png",
                            },
                            onclose: function(incomplete) {
                                if (incomplete) {
                                    // Handle if payment is incomplete
                                    window.location.href = 'property_details.php?id=<?php echo $property['id']; ?>';
                                }
                            },
                        });
                    }
                </script>
            </div>
        </div>

        <div class="mt-4">
            <a href="available_properties.php" class="btn btn-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Properties
            </a>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
