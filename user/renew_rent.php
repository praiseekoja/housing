<?php
include('../includes/config.php');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}


$tenant_id = mysqli_real_escape_string($conn, $_SESSION['user']['id']);

// Process payment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rent_id = mysqli_real_escape_string($conn, $_POST['rent_id']);
    $amount_paid = mysqli_real_escape_string($conn, $_POST['amount_paid']);
    
    // Check if rent exists and belongs to tenant
    $check_sql = "SELECT rent_amount FROM rents WHERE id='$rent_id' AND tenant_id='$tenant_id'";
    $check_result = mysqli_query($conn, $check_sql);
    $rent_data = mysqli_fetch_assoc($check_result);
    
    if ($rent_data && $rent_data['rent_amount'] == $amount_paid) {
        // Insert payment
        $payment_sql = "INSERT INTO payments (rent_id, amount_paid) VALUES ('$rent_id', '$amount_paid')";
        $update_sql = "UPDATE rents SET paid_status='paid' WHERE id='$rent_id'";
        
        if (mysqli_query($conn, $payment_sql) && mysqli_query($conn, $update_sql)) {
            $_SESSION['success'] = "Payment processed successfully!";
        } else {
            $_SESSION['error'] = "Payment failed. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Invalid payment amount!";
    }
    
    header("Location: pay_rent.php");
    exit();
}

// Get unpaid rents
$sql = "SELECT rents.*, properties.property_name 
        FROM rents
        JOIN properties ON rents.property_id = properties.id
        WHERE rents.tenant_id='$tenant_id' AND rents.paid_status='unpaid'";
$result = mysqli_query($conn, $sql);

include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
?>

<div class="container mt-5">
    <?php 
    // Display messages
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
        unset($_SESSION['success']);
    }
    ?>

    <h1 class="mb-4">Pay Rent</h1>
    
    <h2 class="mb-3">Unpaid Rents</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <form method="POST">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Rent Amount</th>
                        <th>Due Date</th>
                        <th>Pay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['rent_amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                            <td>
                                <div class="input-group">
                                    <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <input type="number" name="amount_paid" class="form-control" 
                                           value="<?php echo htmlspecialchars($row['rent_amount']); ?>" 
                                           readonly required>
                                    <button type="submit" class="btn btn-primary">Pay Now</button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <p class="alert alert-info">No unpaid rents found.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>
