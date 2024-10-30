<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <?php if ($user['role'] == 'owner'): ?>
                            <a class="nav-link" href="view_properties.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                View Owned Properties
                            </a>
                            <a class="nav-link" href="profile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profile
                            </a>
                            <?php elseif ($user['role'] == 'tenant'): ?>
                                <a class="nav-link" href="available_properties.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Available Properties
                            </a>
                            <a class="nav-link" href="rented_properties.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                rented  properties
                            </a>
                            
                            <a class="nav-link" href="payment_history.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                View Payments
                            </a>
                            <!-- <a class="nav-link" href="renew_rent.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Renew Rent
                            </a> -->
                            <a class="nav-link" href="profile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profile
                            </a>
                            <?php endif; ?>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Logout
                            </a>
                       </div>
                            
                              
                           
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">

                
       
