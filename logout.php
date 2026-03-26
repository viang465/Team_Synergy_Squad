<?php
// Start session
session_start();

// Destroy all session data to log out
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Avianna's Inland Resort - Admin Logout</title>

<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="logout-box">
    <div class="icon">✔</div>
    <h1>Logged Out</h1>
    <p>You have been successfully logged out of the admin panel.</p>

    <a href="login.php">
        <button>Return to Login</button>
    </a>

    <a href="index.php">
        <button>Go to Home</button>
    </a>
</div>

<script>
// Optional auto redirect after 5 seconds
setTimeout(() => {
    window.location.href = "login.php";
}, 5000);
</script>

</body>
</html>