<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}

$tenant_id = $_SESSION['user']['id'];
$user = $_SESSION['user'];

// Get all unpaid rents
$rents = $conn->query("SELECT rents.*, properties.property_name FROM rents
    JOIN properties ON rents.property_id = properties.id
    WHERE rents.tenant_id='$tenant_id' AND rents.paid_status='unpaid'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rent_id = $_POST['rent_id'];
    $amount_paid = $_POST['amount_paid'];
    
    $sql = "INSERT INTO payments (rent_id, amount_paid) VALUES ('$rent_id', '$amount_paid')";
    $conn->query($sql);
    
    $update_rent = "UPDATE rents SET paid_status='paid' WHERE id='$rent_id'";
    $conn->query($update_rent);
    
    header("Location: pay_rent.php");
}
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
?>


<body>
    <div class="container mt-5">
        <h1 class="mb-4">Pay Rent</h1>
        
        <h2 class="mb-3">Unpaid Rents</h2>
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
                    <?php while($row = $rents->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['rent_amount']); ?></td>
                        <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                        <td>
                            <div class="input-group">
                                <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="number" name="amount_paid" class="form-control" required>
                                <button type="submit" class="btn btn-primary">Pay Now</button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS (optional, but needed for some Bootstrap features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <h1>Pay Rent</h1>
    
    <h2>Unpaid Rents</h2>
    <form method="POST">
        <table>
            <tr>
                <th>Property</th>
                <th>Rent Amount</th>
                <th>Due Date</th>
                <th>Pay</th>
            </tr>
            <?php while($row = $rents->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['property_name']; ?></td>
                <td><?php echo $row['rent_amount']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td>
                    <input type="hidden" name="rent_id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="amount_paid" required>
                    <button type="submit">Pay Now</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </form>
<?php
include('../includes/footer.php');
?>
</body>
</html>
