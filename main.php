<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <div class="main-box">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <div class="button-container">
                <button onclick="alert('Medical History')">Medical History</button>
                <button onclick="alert('My Account')">My Account</button>
                <button onclick="alert('Last Checkup')">Last Checkup</button>
                <!-- Add more buttons as needed -->
            </div>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
