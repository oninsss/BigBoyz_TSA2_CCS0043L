<?php
session_start();

// Check if device ID is provided in the URL
if(isset($_GET['id'])) {
    $deviceId = $_GET['id'];
    // Fetch device details based on the device ID from your data source (e.g., database, session)
    // Replace this with your actual code to fetch device details
    $deviceDetails = getDeviceDetails($deviceId);
    // Display device details
    if($deviceDetails) {
        // Display device details (e.g., name, quantity, price)
        echo "<h1>{$deviceDetails['name']}</h1>";
        echo "<p>Quantity: {$deviceDetails['quantity']}</p>";
        echo "<p>Price: \${$deviceDetails['price']}</p>";
        // Add more details as needed
    } else {
        // Handle the case where device details are not found
        echo "<p>Device details not found for ID: {$deviceId}</p>";
        echo "<pre>";
        print_r($_SESSION['devices']); // Print session devices for debugging
        echo "</pre>";
    }
} else {
    // Handle the case where device ID is not provided in the URL
    echo "<p>No device ID provided.</p>";
}

// Function to fetch device details based on device ID (Replace this with your actual implementation)
function getDeviceDetails($deviceId) {
    // Fetch device details from your data source (e.g., database, session)
    // Return device details as an associative array
    // Example:
    $devices = [
        ['id' => 1, 'name' => 'Laptop', 'quantity' => 10, 'price' => 1000],
        ['id' => 2, 'name' => 'Smartphone', 'quantity' => 20, 'price' => 800],
        ['id' => 3, 'name' => 'Tablet', 'quantity' => 15, 'price' => 500]
    ];
    foreach($devices as $device) {
        if($device['id'] == $deviceId) {
            return $device;
        }
    }
    return null; // Device not found
}
?>
