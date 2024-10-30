<?php
include './includes/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing Management System - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/random/1200x600/?modern-apartment');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-content {
            text-align: center;
            color: #fff;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
        .testimonial-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .navbar {
            background-color: transparent !important;
            transition: background-color 0.3s ease;
        }
        .navbar.scrolled {
            background-color: #fff !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .navbar.scrolled .navbar-brand, .navbar.scrolled .nav-link {
            color: #333 !important;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">HMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Simplify Your Property Management</h1>
                <a href="#features" class="btn btn-primary btn-lg">Explore Features</a>
            </div>
        </section>

        <div class="container my-5">
            <section id="features" class="row g-4 py-5">
                <h2 class="text-center mb-5">Our Features</h2>
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="bi bi-house-door feature-icon mb-3"></i>
                        <h3 class="h5">Property Listings</h3>
                        <p>Easily manage and showcase your properties with detailed listings.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="bi bi-people feature-icon mb-3"></i>
                        <h3 class="h5">Tenant Management</h3>
                        <p>Streamline tenant applications, screening, and communication.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <i class="bi bi-graph-up feature-icon mb-3"></i>
                        <h3 class="h5">Financial Reporting</h3>
                        <p>Generate comprehensive financial reports and track performance.</p>
                    </div>
                </div>
            </section>

            <section id="testimonials" class="py-5">
                <h2 class="text-center mb-5">What Our Clients Say</h2>
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <img src="https://source.unsplash.com/random/60x60/?portrait-1" alt="John Doe" class="testimonial-img mb-3">
                                    <p class="card-text">"This system has revolutionized the way we handle our properties. It's user-friendly and incredibly efficient!"</p>
                                    <footer class="blockquote-footer">John Doe, Property Manager</footer>
                                </div>
                            </div>
                        </div>
                        <!-- Add more carousel items here -->
                    </div>
                </div>
            </section>

            <section id="contact" class="py-5">
                <h2 class="text-center mb-5">Get in Touch</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php
                        if (isset($_GET['status'])) {
                            if ($_GET['status'] == 'success') {
                                echo '<div class="alert alert-success">Your message has been sent successfully!</div>';
                            } elseif ($_GET['status'] == 'error') {
                                echo '<div class="alert alert-danger">There was an error sending your message. Please try again.</div>';
                            }
                        }
                        ?>
                        <form action="send_email.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="message" rows="4" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            include './includes/config.php';
            ?>

            <section id="available-properties" class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5">Available Properties for Rent</h2>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        $sql = "SELECT * FROM properties WHERE available = 1 LIMIT 3";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($property = mysqli_fetch_assoc($result)) {
                                echo '<div class="col">
                                    <div class="card h-100 shadow-sm">
                                        <img src="' . htmlspecialchars($property['image_path']) . '" class="card-img-top" alt="' . htmlspecialchars($property['property_name']) . '">
                                        <div class="card-body">
                                            <h5 class="card-title">' . htmlspecialchars($property['property_name']) . '</h5>
                                            <p class="card-text">
                                                <i class="bi bi-geo-alt-fill"></i> ' . htmlspecialchars($property['address']) . '<br>
                                                <i class="bi bi-currency-dollar"></i> $' . number_format($property['price'], 2) . '/month<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<p class="text-center">No properties available at the moment.</p>';
                        }

                        mysqli_close($conn);
                        ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="user/login.php" class="btn btn-primary">See More Properties</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-light py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2023 Housing Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Navbar color change on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
