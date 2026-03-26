<?php
// Include DB connection first
include "conn.php";

// Optional: Check DB connection if $conn is defined in conn.php
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Avianna's Inland Resort</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <h1 class="reveal">Avianna's Inland Resort</h1>
    <nav>
        <a href="index.php"><button>Home</button></a>
        <a href="aboutus.php"><button>About Us</button></a>
        <a href="reviews.php"><button>Reviews</button></a>
    </nav>
</header>

<section class="reveal">
    <h2>Relax. Refresh. Reconnect.</h2>
    <p>Experience tranquility and luxury surrounded by nature. Your perfect getaway starts here.</p>
</section>

<section class="reveal">
    <h2>Our Amenities</h2>
    <p>Enjoy our swimming pool, spa, restaurant, and more. We have everything you need for a memorable stay.</p>
</section>

<section class="reveal">
    <h2>About Us</h2>
    <p>Avianna's Inland Resort offers a peaceful escape from city life, combining nature and comfort.</p>
</section>

<section class="reveal">
    <h2>What Our Guests Say</h2>
    <p>"A hidden gem! The staff was amazing and the surroundings were breathtaking." - Sarah K.</p>
</section>

<section class="cta reveal">
    <h2>Book Your Stay Today</h2>
    <a href="book.php">
        <button>Book Now</button>
    </a>
</section>

<footer>
    <p>&copy; 2026 Avianna's Inland Resort</p>
</footer>

<script>
/**
 * Intersection Observer for scroll animations
 */
const observerOptions = {
    threshold: 0.1 // Triggers when 10% of the element is visible
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting){
            entry.target.classList.add('active');
            observer.unobserve(entry.target); 
        }
    });
}, observerOptions);

// Select all elements with the 'reveal' class
document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
});
</script>

</body>
</html>