<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = [
    ['id' => 1, 'name' => 'Laptop', 'quantity' => 10, 'price' => 1000],
    ['id' => 2, 'name' => 'Smartphone', 'quantity' => 20, 'price' => 800],
    ['id' => 3, 'name' => 'Tablet', 'quantity' => 15, 'price' => 500]
];

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
            echo "<a href='purchase_devices.php?id={$device['id']}'>Buy</a> | ";
            echo "<a href='deviceDetails.php?id={$device['id']}'>View Details</a> | ";
            echo "<a href='editDevice.php?id={$device['id']}'>Edit</a> | ";
            echo "<a href='delete_device.php?id={$device['id']}'>Delete</a>";
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
        displayDevices($devices); 
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
