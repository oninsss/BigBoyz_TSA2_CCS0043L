<?php
session_start();

// Function to display devices
function displayDevices($devices)
{
    // Check if $devices is set and not empty
    if (isset($devices) && is_array($devices) && !empty($devices)) {
        echo "<h2>Available Devices</h2>";
        echo "<ul class='devices'>";
        foreach ($devices as $device) {
            echo "<li>";
            echo "<div>{$device['name']} (Quantity: {$device['quantity']})</div>";
            echo "<div class='actions'>";
            echo "<a href='purchase_devices.php?id={$device['name']}'>Buy</a> | ";
            echo "<a href='view_single_device.php?id={$device['name']}'>View Details</a> | ";
            echo "<a href='edit_device.php?id={$device['name']}'>Edit</a> | ";
            echo "<a href='delete_device.php?id={$device['name']}'>Delete</a>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No devices available.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Devices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Devices</h1>
        <?php 
        // Pass $_SESSION['devices'] to the displayDevices() function
        displayDevices($_SESSION['devices'] ?? null); 
        ?>
        <ul class="sub-menu">
            <div class="selection"><a href="#">Buy Devices</a></div>
            <div class="selection"><a href="#">View Single Device</a></div>
            <div class="selection"><a href="#">Edit Device</a></div>
            <div class="selection"><a href="#">Delete Device</a></div>
            <div class="selection"><a href="#">Clear All Devices</a></div>
            <div class="selection"><a href="#">Clear All Purchases</a></div>
        </ul>
    </div>
</body>
</html>
