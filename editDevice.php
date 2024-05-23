<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = [
    ['id' => 1, 'name' => 'Laptop', 'quantity' => 10, 'price' => 1000],
    ['id' => 2, 'name' => 'Smartphone', 'quantity' => 20, 'price' => 800],
    ['id' => 3, 'name' => 'Tablet', 'quantity' => 15, 'price' => 500]
];

// Check if device ID is provided and it exists
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $deviceId = intval($_GET['id']);
    
    // Search for the device in the devices array
    foreach ($devices as $device) {
        if ($device['id'] == $deviceId) {
            // Display the device information in a form for editing
            echo "<h1>Edit Device</h1>";
            echo "<form action='edit_device_action.php' method='POST'>";
            echo "<input type='hidden' name='id' value='{$device['id']}'>";
            echo "Name: <input type='text' name='name' value='{$device['name']}'><br>";
            echo "Quantity: <input type='number' name='quantity' value='{$device['quantity']}'><br>";
            echo "Price: <input type='number' name='price' value='{$device['price']}'><br>";
            echo "<input type='submit' name='update' value='Update'>"; // Changed button text to "Update"
            echo "</form>";
            break;
        }
    }
}
?>
