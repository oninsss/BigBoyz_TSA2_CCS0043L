<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = $_SESSION['devices'] ?? [];

// Check if form is submitted and update button is clicked
if (isset($_POST['update']) && isset($_POST['id'])) {
    $deviceId = intval($_POST['id']);
    $updatedName = $_POST['name'];
    $updatedQuantity = intval($_POST['quantity']);
    $updatedPrice = floatval($_POST['price']);  // Use floatval for prices

    // Search for the device in the devices array and update its details
    foreach ($devices as &$device) {  // Use reference to modify the original array
        if ($device['id'] == $deviceId) {
            $device['name'] = $updatedName;
            $device['quantity'] = $updatedQuantity;
            $device['price'] = $updatedPrice;
            break;
        }
    }

    // Update the session variable with the modified devices array
    $_SESSION['devices'] = $devices;

    // Redirect back to viewDevices.php or any other appropriate page after updating
    header("Location: viewDevice.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Assets/Styles/style.css">
</head>
<body>
    <div class="navBx">
        <div class="logo">
            <h1 onclick="home()">HJT</h1>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
