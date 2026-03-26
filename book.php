<?php
include "conn.php"; 

$booking_success = false;
$booking_error = "";
$confirmed_details = []; // Store details for confirmation display

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    $checkin = $_POST['checkin']; 
    $checkout = $_POST['checkout']; 
    $guests = filter_input(INPUT_POST, 'guests', FILTER_SANITIZE_NUMBER_INT);
    $room_type_price = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_NUMBER_INT);
    $requests = filter_input(INPUT_POST, 'requests', FILTER_SANITIZE_SPECIAL_CHARS);

    $room_type_name = "";
    switch ($room_type_price) {
        case 1000: $room_type_name = "Standard"; break;
        case 2000: $room_type_name = "Deluxe"; break;
        case 3000: $room_type_name = "Suite"; break;
        default: $booking_error = "Invalid room type selected.";
    }

    if ($checkin && $checkout && strtotime($checkout) <= strtotime($checkin)) {
        $booking_error = "Check-out date must be after the check-in date.";
    }

    if (empty($booking_error) && isset($conn)) {
        $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, checkin_date, checkout_date, num_guests, room_type, price_per_night, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssisis", $name, $email, $phone, $checkin, $checkout, $guests, $room_type_name, $room_type_price, $requests);

        if ($stmt->execute()) {
            $booking_success = true;
            // Store details to show the person what they just booked
            $confirmed_details = [
                'name' => $name,
                'email' => $email,
                'room' => $room_type_name,
                'checkin' => $checkin,
                'checkout' => $checkout
            ];
        } else {
            $booking_error = "Oops! Something went wrong. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Avianna's Inland Resort</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="nav-bar">
    <a href="index.php"><button type="button">Home</button></a>
    <a href="aboutus.php"><button type="button">About Us</button></a>
    <a href="reviews.php"><button type="button">Reviews</button></a>
</div>

<div class="booking-container">
    <h1>Reserve Your Sanctuary</h1>

    <?php if ($booking_error): ?>
        <div class="alert error"><?php echo htmlspecialchars($booking_error); ?></div>
    <?php endif; ?>

    <?php if ($booking_success): ?>
        <div class="alert success" style="text-align: center; border: 2px solid var(--primary); padding: 20px; border-radius: 10px;">
            <span class="success-icon" style="font-size: 3rem;">🎉</span>
            <h2>Booking Confirmed!</h2>
            <p>Thank you, <strong><?php echo htmlspecialchars($confirmed_details['name']); ?></strong>!</p>
            
            <div style="background: #f9f9f9; padding: 15px; margin: 20px 0; border-radius: 8px; text-align: left;">
                <p><strong>Room:</strong> <?php echo htmlspecialchars($confirmed_details['room']); ?></p>
                <p><strong>Check-in:</strong> <?php echo htmlspecialchars($confirmed_details['checkin']); ?></p>
                <p><strong>Check-out:</strong> <?php echo htmlspecialchars($confirmed_details['checkout']); ?></p>
            </div>

            <div style="display: flex; gap: 10px; justify-content: center;">
                <a href="index.php" style="padding: 10px 20px; background: var(--primary); color: white; text-decoration: none; border-radius: 5px;">Return to Home</a>
                
                <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($confirmed_details['email']); ?>">
                    <button type="submit" style="background: #e74c3c; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Cancel Booking</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <form class="booking-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group full-width">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Juan Dela Cruz" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="juan@example.com" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="0912 345 6789" required>
            </div>
            <div class="form-group">
                <label for="checkin">Check-in Date</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>
            <div class="form-group">
                <label for="checkout">Check-out Date</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>
            <div class="form-group">
                <label for="guests">Guests</label>
                <input type="number" id="guests" name="guests" min="1" max="10" value="1">
            </div>
            <div class="form-group">
                <label for="room">Room Type</label>
                <select id="room" name="room">
                    <option value="1000">Standard - ₱1,000</option>
                    <option value="2000">Deluxe - ₱2,000</option>
                    <option value="3000">Suite - ₱3,000</option>
                </select>
            </div>
            <div class="form-group full-width">
                <label for="requests">Special Requests</label>
                <textarea id="requests" name="requests" placeholder="Any preferences?"></textarea>
            </div>
            <button type="submit">Confirm My Reservation</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>