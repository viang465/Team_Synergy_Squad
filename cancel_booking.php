<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Prepare deletion (we use email as the identifier for this simple example)
    $stmt = $conn->prepare("DELETE FROM bookings WHERE email = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successfully canceled.'); window.location.href='index.php';</script>";
    } else {
        echo "Error canceling booking: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>