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
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent-1: #4cc9f0;
            --accent-2: #f72585;
            --accent-3: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .hero {
            background-image: linear-gradient(rgba(67, 97, 238, 0.8), rgba(114, 9, 183, 0.8)), url('hero.jpg');
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
            color: var(--accent-2);
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
        .feature-card {
            padding: 2rem;
            border-radius: 10px;
            transition: transform 0.3s ease;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-top: 4px solid var(--accent-1);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            border-top-color: var(--accent-2);
        }
        .stats-section {
            background: linear-gradient(135deg, var(--accent-3), var(--primary));
            color: white;
            padding: 4rem 0;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .how-it-works-step {
            position: relative;
            padding: 2rem;
            border-left: 4px solid var(--accent-1);
            margin: 20px;
            transition: all 0.3s ease;
        }
        .how-it-works-step:hover {
            border-left-color: var(--accent-2);
            background: rgba(76, 201, 240, 0.1);
        }
        .step-number {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent-2);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-primary {
            background-color: var(--accent-2);
            border-color: var(--accent-2);
        }
        .btn-primary:hover {
            background-color: var(--accent-3);
            border-color: var(--accent-3);
        }
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        .testimonial-carousel .card {
            border-bottom: 4px solid var(--accent-1);
            transition: all 0.3s ease;
        }
        .testimonial-carousel .card:hover {
            border-bottom-color: var(--accent-2);
        }
        #contact {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.1), rgba(247, 37, 133, 0.1));
        }
        .form-control:focus {
            border-color: var(--accent-1);
            box-shadow: 0 0 0 0.25rem rgba(76, 201, 240, 0.25);
        }
        #available-properties .card {
            border-top: 4px solid var(--accent-1);
            transition: all 0.3s ease;
        }
        #available-properties .card:hover {
            border-top-color: var(--accent-2);
            transform: translateY(-5px);
        }
        .gradient-text {
            background: linear-gradient(45deg, var(--accent-2), var(--accent-1));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .stat-card {
            background: linear-gradient(45deg, var(--accent-3), var(--primary));
            border-radius: 10px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
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
                        <li class="nav-item"><a class="nav-link" href="./user/login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Simplify Your Property Management</h1>
                <p class="lead mb-4">Streamline your property management process with our comprehensive solution</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="#features" class="btn btn-primary btn-lg">Explore Features</a>
                    <a href="register.php" class="btn btn-outline-light btn-lg">Get Started</a>
                </div>
            </div>
        </section>

        <div class="container my-5">
            <section id="features" class="row g-4 py-5">
                <h2 class="text-center mb-5 gradient-text">Our Features</h2>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-house-door feature-icon mb-3"></i>
                        <h3 class="h5">Property Listings</h3>
                        <p>Easily manage and showcase your properties with detailed listings, virtual tours, and automated scheduling.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success"></i> Multiple property types</li>
                            <li><i class="bi bi-check-circle text-success"></i> Virtual tour integration</li>
                            <li><i class="bi bi-check-circle text-success"></i> Automated scheduling</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-people feature-icon mb-3"></i>
                        <h3 class="h5">Tenant Management</h3>
                        <p>Streamline tenant applications, screening, and communication.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success"></i> Automated tenant screening</li>
                            <li><i class="bi bi-check-circle text-success"></i> Secure online communications</li>
                            <li><i class="bi bi-check-circle text-success"></i> Efficient tenant management</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-graph-up feature-icon mb-3"></i>
                        <h3 class="h5">Financial Reporting</h3>
                        <p>Generate comprehensive financial reports and track performance.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success"></i> Automated financial reporting</li>
                            <li><i class="bi bi-check-circle text-success"></i> Customizable financial reports</li>
                            <li><i class="bi bi-check-circle text-success"></i> Real-time financial tracking</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="stats-section">
                <div class="container">
                    <div class="row text-center g-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">1000+</div>
                                <div>Properties Managed</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">500+</div>
                                <div>Happy Clients</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">98%</div>
                                <div>Satisfaction Rate</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">24/7</div>
                                <div>Support Available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="how-it-works py-5">
                <div class="container">
                    <h2 class="text-center mb-5">How It Works</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="how-it-works-step">
                                <div class="step-number">1</div>
                                <h3 class="h5">Register Account</h3>
                                <p>Create your account and set up your profile in minutes.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="how-it-works-step">
                                <div class="step-number">2</div>
                                <h3 class="h5">Select a House</h3>
                                <p>Browse available properties and choose your ideal home.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="how-it-works-step">
                                <div class="step-number">3</div>
                                <h3 class="h5">Make Payment</h3>
                                <p>Complete your secure payment and move into your new home.</p>
                            </div>
                        </div>
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
                                   
                                    <p class="card-text">"This system has revolutionized the way we handle our properties. It's user-friendly and incredibly efficient!"</p>
                                    <footer class="blockquote-footer">John Doe, Property Manager</footer>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                   
                                    <p class="card-text">"The financial reporting features have made tracking our property performance so much easier. Highly recommended!"</p>
                                    <footer class="blockquote-footer">Jane Smith, Real Estate Investor</footer>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    
                                    <p class="card-text">"The tenant management system is fantastic. It streamlines all our communications and paperwork perfectly."</p>
                                    <footer class="blockquote-footer">Mike Johnson, Landlord</footer>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    
                                    <p class="card-text">"As a property owner, this platform has saved me countless hours. The automation features are a game-changer!"</p>
                                    <footer class="blockquote-footer">Sarah Williams, Property Owner</footer>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    
                                    <p class="card-text">"The property listing features are excellent. We've seen a significant increase in tenant inquiries since using this system."</p>
                                    <footer class="blockquote-footer">David Chen, Real Estate Agent</footer>
                                </div>
                            </div>
                        </div>
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
