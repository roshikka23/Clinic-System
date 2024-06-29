<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$email = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Checkup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <h2>Last Checkup Details</h2>
        <p><strong>Date:</strong> March 15, 2024</p>
        <p><strong>Doctor:</strong> Dr. Smith</p>
        <p><strong>Summary:</strong> All vital signs are normal. Recommended to continue current medication.</p>
        <a href="main.php">Back to Main Page</a>
    </div>
</body>
</html>
