<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Avianna's Inland Resort</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --tropical-green: #1a4731;
            --accent-gold: #ffc107;
            --deep-palm: #0e2a1d;
            --soft-cream: #000000;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #7bc58b;
            color: #444;
        }

        h1, h2, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            background-color: var(--tropical-green) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* About Header */
        .page-header {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=1600&q=80') center/center;
            background-size: cover;
            color: white;
            padding: 120px 0;
            text-align: center;
        }

        /* Feature Cards */
        .card-feature {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #000000;
        }

        .card-feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(26, 71, 49, 0.1);
            border-color: var(--accent-gold);
        }

        .icon-bounce {
            font-size: 3rem;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Maps & Content */
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        iframe {
            width: 100%;
            filter: grayscale(20%);
        }

        .text-teal {
            color: var(--tropical-green);
        }

        footer {
            background-color: var(--deep-palm) !important;
        }

        a {
            color: var(--teal);
            text-decoration: none;
        }
        
        a:hover {
            color: var(--accent-gold);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Avianna's Inland Resort</a>
        <div class="ms-auto">
            <a href="index.php" class="btn btn-sm btn-outline-light rounded-pill px-3 me-2">Home</a>
            <a href="aboutus.php" class="btn btn-sm btn-light rounded-pill px-3 me-2 text-dark">About</a>
            <a href="gallery.php" class="btn btn-sm btn-outline-light rounded-pill px-3 me-2">Gallery</a>
            <a href="reviews.php" class="btn btn-sm btn-outline-light rounded-pill px-3 me-2">Reviews</a>
            <a href="book.php" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold">Book Now</a>
        </div>
    </div>
</nav>

<header class="hero text-center text-white">
    <div class="container py-5">
        <h1 class="display-1 fw-bold animate__animated animate__zoomIn">Our Story</h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Discover the heart and soul of Avianna's Inland Resort.</p>
        
    </div>
</header>

<div class="container py-5">
    <div class="row g-4 text-center">
        <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card-feature"><div class="icon-bounce">🌿</div><h5 class="fw-bold">Nature Friendly</h5></div>
        </div>
        <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card-feature"><div class="icon-bounce">🏊</div><h5 class="fw-bold">Clean Pools</h5></div>
        </div>
        <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card-feature"><div class="icon-bounce">🏨</div><h5 class="fw-bold">Luxury Rooms</h5></div>
        </div>
        <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="card-feature"><div class="icon-bounce">🍽</div><h5 class="fw-bold">Local Food</h5></div>
        </div>
    </div>

    <div class="row mt-5 pt-4">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h2 class="fw-bold mb-4 text-teal">Our Commitment</h2>
            <p class="lead">At Avianna's Inland Resort, we are dedicated to providing an unforgettable experience in a serene natural setting. Our commitment to sustainability and guest satisfaction drives everything we do.</p>
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
            <h2 class="fw-bold mb-4 text-teal">Our Vision</h2>
            <p class="lead">We envision a place where guests can escape the hustle and bustle of everyday life and reconnect with nature. Our goal is to be the premier destination for peaceful retreats.</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="fw-bold mb-5 text-center">Meet the Team</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="card-feature"><div class="icon-bounce">👩‍💼</div><h5 class="mt-2">Jane Doe</h5><p class="small text-muted">Manager</p></div>
                </div>
                <div class="col-md-3">
                    <div class="card-feature"><div class="icon-bounce">👨‍🍳</div><h5 class="mt-2">John Smith</h5><p class="small text-muted">Chef</p></div>
                </div>
                <div class="col-md-3">
                    <div class="card-feature"><div class="icon-bounce">👩‍🔧</div><h5 class="mt-2">Emily Davis</h5><p class="small text-muted">Maintenance</p></div>
                </div>
                <div class="col-md-3">
                    <div class="card-feature"><div class="icon-bounce">👨‍💼</div><h5 class="mt-2">Michael Brown</h5><p class="small text-muted">Concierge</p></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="fw-bold mb-4 text-center">Our Location</h2>
            <p class="lead text-center mx-auto mb-4" style="max-width: 800px;">Nestled in the heart of the countryside, Avianna's Inland Resort offers breathtaking views and a tranquil atmosphere perfect for your next escape.</p>
            
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.123!2d122.5!3d10.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ4JzAwLjAiTiAxMjLCsDMwJzAwLjAiRQ!5e0!3m2!1sen!2sph!4v1650000000000!5m2!1sen!2sph" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="text-center mt-4">
                <p class="mb-1 fw-bold">Zone 6 Cabugao Sur Sta. Barbara, Iloilo City, Philippines</p>
                <p class="mb-1">Email: <a href="mailto:info@aviannasresort.com">info@aviannasresort.com</a> | Phone: <a href="tel:+1234567890">+1 234 567 890</a></p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0">© 2026 Avianna's Inland Resort. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
