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
    <title>Medical History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <h2>Medical History of <?php echo htmlspecialchars($user['name']); ?></h2>
        <p><strong>Blood Type:</strong> A+</p>
        <p><strong>Allergies:</strong> Penicillin, Peanuts</p>
        <p><strong>Previous Surgeries:</strong> Appendectomy (2015)</p>
        <a href="main.php">Back to Main Page</a>
    </div>
</body>
</html>
