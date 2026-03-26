<?php
session_start();
// Include DB connection from the parent directory
include "../conn.php";

// Security Check: Only admins allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if an ID was provided via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepare the delete statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redirect back to dashboard with a success message
        header("Location: admin.php?delete=success");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
} else {
    // If no ID is provided, just go back to the dashboard
    header("Location: admin.php");
    exit();
}
?>