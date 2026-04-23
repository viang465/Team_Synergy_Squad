<?php 
include "conn.php"; 
$booking_success = false;
$booking_error = "";
$name = $email = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    if (strtotime($checkout) > strtotime($checkin)) {
        $stmt = $conn->prepare("INSERT INTO bookings (name, email, address, checkin_date, checkout_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $address, $checkin, $checkout);
        if ($stmt->execute()) {
            $booking_success = true;
        } else {
            $booking_error = "System error. Please try again later.";
        }
        $stmt->close();
    } else {
        $booking_error = "Check-out date must be after check-in date.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Avianna's Inland Resort</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root { 
            --teal: #2c7a7b; 
            --dark: #1e4d40; 
            --orange: #ed8936; 
            --glass: rgba(255, 255, 255, 0.95);
        }

        body { 
            background: linear-gradient(rgba(44, 122, 123, 0.1), rgba(44, 122, 123, 0.1)), 
                        url(img/avianna.png) center/cover no-repeat fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            padding: 40px 0;
        }

        .card-booking { 
            border: none; 
            border-radius: 30px; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.15); 
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
        }

        .form-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--teal);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 0.25 cereal rgba(44, 122, 123, 0.1);
        }

        .btn-confirm { 
            background: var(--orange); 
            color: white; 
            font-weight: 600; 
            border-radius: 50px;
            padding: 15px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-confirm:hover { 
            background: var(--dark); 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .success-icon {
            font-size: 6rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        a {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            color: var(--orange);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card card-booking p-4 p-md-5 animate__animated animate__fadeInUp">
                
                <?php if ($booking_success): ?>
                    <div class="text-center animate__animated animate__bounceIn">
                        <div class="success-icon">Check! ✅</div>
                        <h2 class="fw-bold mb-3">Reservation Confirmed!</h2>
                        <p class="mb-4 lead text-muted">We've saved a sanctuary for you, <strong><?php echo $name; ?></strong>. Check your email for the itinerary.</p>
                        <a href="index.php" class="btn btn-dark btn-lg rounded-pill px-5">Return Home</a>
                    </div>
                <?php else: ?>
                    
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Book Your Sanctuary</h2>
                        <p class="text-muted">Fill in your details to secure your tropical escape.</p>
                    </div>

                    <?php if($booking_error): ?>
                        <div class="alert alert-danger rounded-3 mb-4"><?php echo $booking_error; ?></div>
                    <?php endif; ?>

                    <form method="POST" class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Home Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="City, Province, Zip" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Room Type</label>
                            <select name="room_type" class="form-select" required>
                                <option value="Standard">Standard Room</option>
                                <option value="Deluxe">Deluxe Room</option>
                                <option value="Suite">Executive Suite</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="GCash">GCash</option>
                                <option value="Cash">Cash at Resort</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Check-in Date</label>
                            <input type="date" name="checkin" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Check-out Date</label>
                            <input type="date" name="checkout" class="form-control" required>
                        </div>
                        
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-confirm w-100 py-3 shadow">Confirm My Reservation</button>
                            
                            <div class="text-center mt-4 border-top pt-4">
                                <p class="small text-muted mb-1">Changed your mind? <a href="index.php">Return to Home</a></p>
                                <p class="small text-muted">Questions? Call us at <a href="tel:+1234567890">+1 234 567 890</a></p>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
