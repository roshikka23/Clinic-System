<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'clinic');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    if ($conn->query("SELECT * FROM users WHERE email = '$email'")->num_rows == 0) {
        $sql = "INSERT INTO users (name, email, password, phone, address) VALUES ('$name', '$email', '$password', '$phone', '$address')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php?message=Registration successful! Please log in.");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Email already registered.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="logo.png" alt="Health Care">
                <h2>Health Care</h2>
            </div>
            <form id="registerForm" method="post" action="">
                <input type="text" id="name" name="name" placeholder="Name" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="text" id="phone" name="phone" placeholder="Phone" required>
                <textarea id="address" name="address" placeholder="Address" required></textarea>
                <input type="submit" value="Register">
            </form>
            <p><?php echo $message; ?></p>
            <a href="login.php">Already have an account? Login here</a>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;

            if (!name || !email || !password || !phone || !address) {
                alert('Please fill in all fields.');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
