<?php
session_start();

// Dummy data for demonstration purposes
$devices = [
    ['id' => 1, 'device_name' => 'Phone', 'price' => 500, 'quantity' => 10],
    ['id' => 2, 'device_name' => 'Laptop', 'price' => 1000, 'quantity' => 5],
    ['id' => 3, 'device_name' => 'Tablet', 'price' => 300, 'quantity' => 8]
];

if (!empty($devices)) {
    if (!isset($_POST['submit']) || empty($_POST['quantity'])) { // Display purchase form if form not submitted or quantity array is empty
        echo "<form action='' method='POST'>";
        echo "<label for='device'>Choose a device:</label>";
        echo "<select name='device' id='device'>";
        echo "<option value='' selected disabled>Select Device</option>";
        foreach ($devices as $device) {
            echo "<option value='{$device['id']}'>{$device['device_name']}</option>";
        }
        echo "</select>";
        echo "<label for='quantity'>Quantity to Buy:</label>";
        echo "<input type='number' name='quantity' id='quantity' min='1' required>";
        echo "<button type='submit' name='submit'>Submit</button>";
        echo "</form>";
        echo "<button onclick='window.location.href=\"index.php\";'>Back to Main Menu</button>"; // Button to go back to the main menu
    } elseif (isset($_POST['submit'])) { // Display confirmation message after purchase
        $deviceId = $_POST['device'];
        $quantity = $_POST['quantity'];
        
        // Find the selected device
        $selectedDevice = array_values(array_filter($devices, function ($device) use ($deviceId) {
            return $device['id'] == $deviceId;
        }))[0];

        // Check if quantity is valid
        if ($quantity > 0 && $quantity <= $selectedDevice['quantity']) {
            echo "<p>Thank you for your purchase of {$quantity} {$selectedDevice['device_name']}!</p>";
        } else {
            echo "<p>Invalid quantity selected.</p>";
        }

        echo "<button onclick='window.location.href=\"index.php\";'>Back to Main Menu</button>"; // Button to go back to the main menu
        session_unset(); // Clear session data after purchase confirmation
    }
} else {
    echo "<p>No devices available for purchase.</p>";
}
?>
