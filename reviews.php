<?php
include "conn.php"; 

$reviews = []; 
$reviews_error = "";

if (isset($conn) && $conn->connect_error === null) {
    // Note: Ensure your table name is 'reviews' and columns match these names
    $sql = "SELECT name, rating, review_text, submission_date FROM reviews ORDER BY submission_date DESC"; 
    $result = $conn->query($sql);

    if ($result) {
        while($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    } else {
        $reviews_error = "Unable to load reviews at this time.";
    }
} else {
    $reviews_error = "Database connection failed.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guest Reviews - Avianna's Inland Resort</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php"><button>Home</button></a>
    <a href="aboutus.php"><button>About Us</button></a>
    <a href="book.php"><button>Book Now</button></a>
</nav>

<div class="container">
    <h2>Guest Experiences</h2>

    <div class="form-box">
        <h3>Share Your Stay</h3>
        <form action="submit_review.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" required>
                    <option value="5">★★★★★ - Excellent</option>
                    <option value="4">★★★★☆ - Good</option>
                    <option value="3">★★★☆☆ - Average</option>
                    <option value="2">★★☆☆☆ - Poor</option>
                    <option value="1">★☆☆☆☆ - Bad</option>
                </select>
            </div>

            <div class="form-group">
                <label for="review_text">Your Experience</label>
                <textarea id="review_text" name="review_text" placeholder="Tell us about your visit..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">Post Review</button>
        </form>
    </div>

    <section class="reviews-list">
        <h3>What People Are Saying</h3>
        
        <?php if ($reviews_error): ?>
            <p style="color:red;"><?php echo $reviews_error; ?></p>
        <?php elseif (empty($reviews)): ?>
            <p>No reviews yet. Be the first to leave one!</p>
        <?php else: ?>
            <?php foreach ($reviews as $r): ?>
                <div class="review-card">
                    <div class="review-header">
                        <span class="reviewer-name"><?php echo htmlspecialchars($r['name']); ?></span>
                        <span class="stars">
                            <?php 
                                echo str_repeat('★', $r['rating']); 
                                echo str_repeat('☆', 5 - $r['rating']); 
                            ?>
                        </span>
                    </div>
                    <p class="review-text">"<?php echo nl2br(htmlspecialchars($r['review_text'])); ?>"</p>
                    <span class="date">Visited on <?php echo date('M d, Y', strtotime($r['submission_date'])); ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2026 Avianna's Inland Resort</p>
    </footer>
</div>

</body>
</html>