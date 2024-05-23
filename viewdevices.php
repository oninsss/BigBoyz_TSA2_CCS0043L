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
    echo "<h2>Available Devices</h2>";
    echo "<ul>";
    foreach ($devices as $device) {
        echo "<li>{$device['name']} (Quantity: {$device['quantity']})";
        echo "<a href='buy_device.php?id={$device['id']}'>Buy</a> | ";
        echo "<a href='view_single_device.php?id={$device['id']}'>View Details</a> | ";
        echo "<a href='edit_device.php?id={$device['id']}'>Edit</a> | ";
        echo "<a href='delete_device.php?id={$device['id']}'>Delete</a></li>";
    }
    echo "</ul>";
}

// View Devices Page
echo "<h1>View Devices</h1>";
displayDevices($devices);

// Buy Devices Page
echo "<h1>Buy Devices</h1>";
echo "<a href='index.php'>Back to Home</a>";

// View Single Device Page
echo "<h1>View Single Device</h1>";
echo "<a href='index.php'>Back to Home</a>";

// Edit Device Page
echo "<h1>Edit Device</h1>";
echo "<a href='index.php'>Back to Home</a>";

// Delete Device Page
echo "<h1>Delete Device</h1>";
echo "<a href='index.php'>Back to Home</a>";

// Clear All Devices Page
echo "<h1>Clear All Devices</h1>";
echo "<a href='index.php'>Back to Home</a>";

// Clear All Purchases Page
echo "<h1>Clear All Purchases</h1>";
echo "<a href='index.php'>Back to Home</a>";
?>
