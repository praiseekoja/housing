<?php
include('../includes/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$monthly_revenue = $conn->query("SELECT SUM(amount_paid) as total_revenue, DATE_FORMAT(payment_date, '%M') as month 
    FROM payments
    GROUP BY month");

$outstanding_rents = $conn->query("SELECT SUM(rent_amount) as total_outstanding, property_name
    FROM rents
    JOIN properties ON rents.property_id = properties.id
    WHERE paid_status='unpaid'
    GROUP BY property_name");

$highest_rents = $conn->query("SELECT u.username, p.property_name, r.rent_amount 
    FROM rents r
    JOIN users u ON r.tenant_id = u.id
    JOIN properties p ON r.property_id = p.id
    WHERE r.paid_status = 'paid' AND u.role = 'tenant'
    ORDER BY r.rent_amount DESC
    LIMIT 5");

$owner_earnings = $conn->query("SELECT u.username as owner_name, SUM(py.amount_paid) as total_earnings
    FROM payments py
    JOIN properties p ON py.property_id = p.id
    JOIN users u ON p.owner_id = u.id
    WHERE u.role = 'owner'
    GROUP BY u.username
    ORDER BY total_earnings DESC");

    include('../includes/header.php');
    include('../includes/nav.php');
    include('../includes/sidebar.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Monthly Revenue Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Monthly Revenue</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Outstanding Rents Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Outstanding Rents by Property</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="outstandingChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Highest Rents Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Top 5 Highest Rents Paid</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="highestRentsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Owner Earnings Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Total Earnings by Owner</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="ownerEarningsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const revenueCtx = document.getElementById('revenueChart');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: [<?php 
                    $monthly_revenue->data_seek(0);
                    while($row = $monthly_revenue->fetch_assoc()) {
                        echo "'" . $row['month'] . "',";
                    }
                ?>],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [<?php 
                        $monthly_revenue->data_seek(0);
                        while($row = $monthly_revenue->fetch_assoc()) {
                            echo $row['total_revenue'] . ",";
                        }
                    ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const outstandingCtx = document.getElementById('outstandingChart');
        new Chart(outstandingCtx, {
            type: 'pie',
            data: {
                labels: [<?php 
                    $outstanding_rents->data_seek(0);
                    while($row = $outstanding_rents->fetch_assoc()) {
                        echo "'" . $row['property_name'] . "',";
                    }
                ?>],
                datasets: [{
                    data: [<?php 
                        $outstanding_rents->data_seek(0);
                        while($row = $outstanding_rents->fetch_assoc()) {
                            echo $row['total_outstanding'] . ",";
                        }
                    ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Outstanding Rents by Property'
                    }
                }
            }
        });

        // Highest Rents Chart
        const highestRentsCtx = document.getElementById('highestRentsChart');
        new Chart(highestRentsCtx, {
            type: 'bar',
            data: {
                labels: [<?php 
                    while($row = $highest_rents->fetch_assoc()) {
                        echo "'" . $row['tenant_name'] . " (" . $row['property_name'] . ")',";
                    }
                ?>],
                datasets: [{
                    label: 'Highest Rents Paid',
                    data: [<?php 
                        $highest_rents->data_seek(0);
                        while($row = $highest_rents->fetch_assoc()) {
                            echo $row['rent_amount'] . ",";
                        }
                    ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rent Amount'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 5 Highest Rents Paid'
                    }
                }
            }
        });

        // Owner Earnings Chart
        const ownerEarningsCtx = document.getElementById('ownerEarningsChart');
        new Chart(ownerEarningsCtx, {
            type: 'doughnut',
            data: {
                labels: [<?php 
                    while($row = $owner_earnings->fetch_assoc()) {
                        echo "'" . $row['owner_name'] . "',";
                    }
                ?>],
                datasets: [{
                    data: [<?php 
                        $owner_earnings->data_seek(0);
                        while($row = $owner_earnings->fetch_assoc()) {
                            echo $row['total_earnings'] . ",";
                        }
                    ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Total Earnings by Owner'
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php include('../includes/footer.php'); ?>

