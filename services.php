<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px; /* Add padding to the top of the body */
            overflow-x: hidden; /* Hide horizontal scroll */
            background-image: url('background.png'); /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            color: white; /* Change text color to white */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add text shadow for better readability */
        }
        .services-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .service-card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card {
            height: 100%;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Ensure card body stretches to fill height */
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            flex-grow: 1; /* Allow description text to grow within the card */
        }
        .btn-primary {
            align-self: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Our Services</h1>
        </div>
        <div class="services-container">
            <div class="row">
                <?php
                $conn = new mysqli('localhost', 'root', '', 'clinic');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT DISTINCT * FROM tbl_services");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Define the image path
                        $imagePath = 'images/' . htmlspecialchars($row['service_image']);
                        // Check if the image file exists
                        if (!file_exists($imagePath)) {
                            $imagePath = 'images/default.jpg'; // Provide a default image path
                        }
                        echo '
                        <div class="col-md-4 service-card">
                            <div class="card shadow-sm h-100">
                                <img src="' . $imagePath . '" class="card-img-top" alt="' . htmlspecialchars($row['service_name']) . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['service_name']) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($row['service_description']) . '</p>
                                    <p class="card-text"><strong>Price: </strong>' . htmlspecialchars($row['service_price']) . '</p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#serviceModal' . htmlspecialchars($row['service_id']) . '">View Details</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="serviceModal' . htmlspecialchars($row['service_id']) . '" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel' . htmlspecialchars($row['service_id']) . '" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="serviceModalLabel' . htmlspecialchars($row['service_id']) . '">' . htmlspecialchars($row['service_name']) . '</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="' . $imagePath . '" class="img-fluid" alt="' . htmlspecialchars($row['service_name']) . '">
                                        <p>' . htmlspecialchars($row['service_description']) . '</p>
                                        <p><strong>Price: </strong>' . htmlspecialchars($row['service_price']) . '</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<div class='col'>No services found.</div>";
                }

                $conn->close();
                ?>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="main.php" class="btn btn-primary">Back to Main Page</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
