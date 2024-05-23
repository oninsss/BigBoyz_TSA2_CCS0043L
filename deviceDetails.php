<?php
session_start();

// Retrieve devices from session
$devices = isset($_SESSION['devices']) ? $_SESSION['devices'] : [];

// Function to retrieve device details by ID
function getDeviceById($devices, $id) {
    foreach ($devices as $device) {
        if ($device['id'] == $id) {
            return $device;
        }
    }
    return null; // Device not found
}

// Check if device ID is provided in the URL
if (isset($_GET['id'])) {
    $deviceId = $_GET['id'];
    $selectedDevice = getDeviceById($devices, $deviceId);

    if ($selectedDevice) {
        $name = $selectedDevice['name'];
        $quantity = $selectedDevice['quantity'];
        $price = $selectedDevice['price'];
    } else {
        // Device not found, handle the error
        echo "Device not found!";
        exit();
    }
} else {
    // Device ID not provided, handle the error
    echo "Device ID not provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Details</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Device Details</h1>
        <div class="device-details">
            <div class="detail-item">
                <span class="detail-label">Name:</span> <?php echo $name; ?>
            </div>
            <div class="detail-item">
                <span class="detail-label">Quantity:</span> <?php echo $quantity; ?>
            </div>
            <div class="detail-item">
                <span class="detail-label">Price:</span> <?php echo $price; ?>
            </div>
            <!-- Add more details here -->
        </div>
        <div class="back-btn">
            <a href="viewDevices.php">Back</a>
        </div>
    </div>
</body>
</html>
