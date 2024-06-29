<?php
include('db.php'); // Include the database connection

if (isset($_GET['id'])) {
    $service_id = intval($_GET['id']);
    $query = "SELECT * FROM tbl_services WHERE service_id = $service_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $service = mysqli_fetch_assoc($result);
        echo json_encode($service);
    } else {
        echo json_encode(['error' => 'Service not found']);
    }
} else {
    echo json_encode(['error' => 'No service ID provided']);
}
?>
