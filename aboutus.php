<?php
include "conn.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Avianna's Inland Resort</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <div class="container">
        <h1>About Us</h1>
        <nav class="nav-buttons">
            <a href="index.php"><button>Home</button></a>
            <a href="reviews.php"><button>Reviews</button></a>
            <a href="book.php"><button>Book Now</button></a>
        </nav>
    </div>
</header>

<div class="container">
    <section class="reveal">
        <h2>Welcome to Avianna's</h2>
        <p>Where nature meets luxury. Escape the busy city and relax in a peaceful environment designed for comfort and tranquility. Our resort is built on the philosophy of harmony with the environment.</p>
    </section>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        <section class="reveal">
            <h2>Our Story</h2>
            <p>Founded with a vision to create a sanctuary, Avianna’s Inland Resort blends modern comfort with natural beauty, offering guests a refreshing and memorable experience.</p>
        </section>

        <section class="reveal">
            <h2>Our Mission</h2>
            <p>We aim to deliver exceptional hospitality, personalized service, and unforgettable stays for every guest who walks through our gates.</p>
        </section>
    </div>

    <section class="reveal">
        <h2>Why Choose Us</h2>
        <div class="cards">
            <div class="card">🌿 Nature-Friendly Environment</div>
            <div class="card">🏊 Clean Swimming Pools</div>
            <div class="card">🏨 Comfortable Rooms</div>
            <div class="card">🍽 Delicious Local Cuisine</div>
        </div>
    </section>

    <section class="reveal">
        <h2>Meet Our Team</h2>
        <div class="team">
            <div class="member">
                <h3>Resort Manager</h3>
                <p>Ensuring every guest feels at home with world-class service.</p>
            </div>
            <div class="member">
                <h3>Executive Chef</h3>
                <p>Crafting farm-to-table meals that delight the senses.</p>
            </div>
            <div class="member">
                <h3>Guest Relations</h3>
                <p>Our friendly staff is here to help you 24/7.</p>
            </div>
        </div>
    </section>

    <section class="reveal contact-info">
        <h2>Contact Us</h2>
        <p>📍 <strong>Location:</strong> Zone 6 Cabugao Sur Sta. Barbara , Iloilo City ,Philippines</p>
        <p>📞 <strong>Phone:</strong> 09205190851</p>
        <p>📧 <strong>Email:</strong> aviannaresort@gmail.com</p>
    </section>

    <footer>
        <p>&copy; 2026 Avianna's Inland Resort</p>
    </footer>
</div>

<script>
/**
 * Intersection Observer for scroll animations
 */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            observer.unobserve(entry.target); 
        }
    });
}, { threshold: 0.15 });

// Observe the sections for a cleaner "fade-in" effect
document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
});
</script>

</body>
</html>