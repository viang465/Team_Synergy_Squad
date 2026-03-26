<?php
session_start();
// Use the correct relative path to your connection file
include "../conn.php"; 

// Check if user is logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// 1. Fetch Bookings (Ensure the variable is always defined)
$bookings_result = $conn->query("SELECT * FROM bookings ORDER BY checkin_date ASC");

// 2. Fetch Reviews for the stats or a separate table
$reviews_result = $conn->query("SELECT * FROM reviews ORDER BY id DESC LIMIT 5");

// Error handling: If query fails, show the error instead of crashing
if (!$bookings_result) {
    die("Database Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Avianna's Resort</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="sidebar">
        <h2>Avianna Admin</h2>
        <a href="admin.php">Dashboard</a>
        <a href="logout.php">Log Out</a>
    </div>

    <div class="main-content">
        <h1>Dashboard Overview</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Bookings</h3>
                <p><?php echo $bookings_result->num_rows; ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Reviews</h3>
                <p><?php echo $reviews_result->num_rows; ?></p>
            </div>
        </div>

        <h2>Current Bookings</h2>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Room Type</th>
                        <th>Check-in Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($bookings_result->num_rows > 0): ?>
                        <?php while($row = $bookings_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['checkin_date'])); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="edit_booking.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" 
                                           class="delete-btn" 
                                           onclick="return confirm('Are you sure you want to delete this booking?')">
                                           Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No bookings found in the database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>