<?php
session_start();
// Adjusted path to connection file based on your previous structure
include "../conn.php";

// Redirect if not logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get the ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$id = intval($_GET['id']);
$message = "";

// Handle Approval Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // We update the status to 'Approved'
    $status = "Approved";

    $stmt = $conn->prepare("UPDATE bookings SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        // Redirect back to dashboard with a success message
        header("Location: admin.php?approve=success");
        exit();
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// Fetch current booking data to display to the admin
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Booking - Avianna's Resort</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="setup-card">
        <h2>Approve Reservation</h2>
        
        <?php if($message): ?> 
            <p class="alert error"><?php echo $message; ?></p> 
        <?php endif; ?>

        <div class="booking-details" style="text-align: left; margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <p><strong>Guest Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
            <p><strong>Room Type:</strong> <?php echo htmlspecialchars($booking['room_type']); ?></p>
            <p><strong>Check-in:</strong> <?php echo date('M d, Y', strtotime($booking['checkin_date'])); ?></p>
            <p><strong>Current Status:</strong> 
                <span class="status-badge" style="background: #d4a373; color: white; padding: 2px 8px; border-radius: 4px;">
                    <?php echo htmlspecialchars($booking['status'] ?? 'Pending'); ?>
                </span>
            </p>
        </div>

        <p style="margin-bottom: 20px;">Are you sure you want to approve this booking?</p>
        
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <button type="submit" class="submit-btn">Yes, Approve Booking</button>
            
            <div style="margin-top: 15px; text-align: center;">
                <a href="admin.php" style="color: var(--primary); text-decoration: none; font-weight: bold;">
                    Cancel and Go Back
                </a>
            </div>
        </form>
    </div>
</body>
</html>