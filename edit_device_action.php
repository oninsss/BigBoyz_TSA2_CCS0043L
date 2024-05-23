<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = $_SESSION['devices'] ?? [];

// Check if form is submitted and update button is clicked
if (isset($_POST['update']) && isset($_POST['id'])) {
    $deviceId = intval($_POST['id']);
    $updatedName = $_POST['name'];
    $updatedQuantity = intval($_POST['quantity']);
    $updatedPrice = intval($_POST['price']);

    // Search for the device in the devices array and update its details
    foreach ($devices as &$device) {
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
    header("Location: viewDevices.php");
    exit();
}
?>
