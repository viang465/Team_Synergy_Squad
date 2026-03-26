<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rating = (int)$_POST['rating'];
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);

    $sql = "INSERT INTO reviews (name, rating, review_text) VALUES ('$name', $rating, '$review_text')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to reviews page after success
        header("Location: reviews.php?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>