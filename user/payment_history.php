<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}

$tenant_id = $_SESSION['user']['id'];
$user = $_SESSION['user'];
$payments = $conn->query("SELECT payments.*, properties.property_name FROM payments 
    JOIN rents ON payments.rent_id = rents.id
    JOIN properties ON rents.property_id = properties.id
    WHERE rents.tenant_id='$tenant_id'");
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
?> 


<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Rental Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Payment History</a>
                    </li>
                    <!-- Add more navigation items as needed -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title mb-4">Payment History</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="bi bi-house-door me-2"></i>Property</th>
                                <th><i class="bi bi-cash me-2"></i>Amount Paid</th>
                                <th><i class="bi bi-calendar-date me-2"></i>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $payments->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                                <td>$<?php echo number_format(htmlspecialchars($row['amount_paid']), 2); ?></td>
                                <td><?php echo date('F j, Y', strtotime(htmlspecialchars($row['payment_date']))); ?></td>
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