<?php
session_start();
// Include DB connection
// Ensure the path to conn.php is correct relative to this file
include "../conn.php"; 

$error = ""; 

// Redirect if already logged in as admin
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: admin.php");
    exit();
}

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($conn) || $conn->connect_error) {
        $error = "System error: Database connection failed.";
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = "Please enter both username and password.";
        } else {
            // Prepared statement to find the admin user
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($user = $result->fetch_assoc()) {

                    // Verify the hashed password
                    if (password_verify($password, $user['password'])) {
                        // Regenerate session ID for security against session fixation
                        session_regenerate_id(true);
                        
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        
                        header("Location: admin.php");
                        exit();
                    } else {
                        $error = "Invalid username or password!";
                    }
                } else {
                    $error = "Invalid username or password!";
                }
                $stmt->close();
            } else {
                $error = "Internal server error. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - Avianna's Inland Resort</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-box">
    <h1>Admin Access</h1>
    <p class="subtitle">Secure portal for Avianna's Resort staff</p>

    <?php if(!empty($error)): ?>
        <div class="error-card">
            <span>⚠️</span> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="admin_user" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" required>
        </div>
        
        <label class="password-toggle">
            <input type="checkbox" id="showPasswordCheckbox" onclick="togglePassword()">
            Show Password
        </label>

        <button type="submit">Log Into Dashboard</button>
    </form>

    <a href="../index.php" class="back-link">← Return to Public Site</a>
</div>

<script>
function togglePassword(){
    const passInput = document.getElementById("password");
    const checkbox = document.getElementById("showPasswordCheckbox");
    passInput.type = checkbox.checked ? "text" : "password";
}
</script>

</body>
</html>