<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}
$user = $_SESSION['user'];
include '../includes/config.php';
include '../includes/header.php';
include '../includes/nav.php';
include '../includes/sidebar_user.php';  
include '../includes/footer.php';

?>
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 text-primary">Available Properties</h1>
    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM properties WHERE available = 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($property = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow hover-shadow-lg transition-all">
                        <div class="position-relative">
                            <img src="../<?php echo htmlspecialchars($property['image_path']); ?>" 
                                 class="card-img-top object-fit-cover" 
                                 style="height: 250px;"
                                 alt="<?php echo htmlspecialchars($property['property_name']); ?>">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge bg-primary">For Rent</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary mb-3"><?php echo htmlspecialchars($property['property_name']); ?></h5>
                            <div class="card-text mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                                    <span><?php echo htmlspecialchars($property['address']); ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-currency-dollar text-success me-2"></i>
                                    <span class="fs-5 fw-bold text-success">
                                        $<?php echo number_format($property['price'], 2); ?>/month
                                    </span>
                                </div>
                            </div>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>" 
                               class="btn btn-primary mt-auto">
                                <i class="bi bi-info-circle me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    No properties available at the moment.
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
