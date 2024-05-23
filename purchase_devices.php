<?php
session_start();

// Retrieve devices from session or use an empty array if not set
$devices = isset($_SESSION['devices']) ? $_SESSION['devices'] : [];

if (!empty($devices)) {
    if (!isset($_POST['submit']) || empty($_POST['quantity'])) { // Display purchase form if form not submitted or quantity array is empty
        echo "<h2>Choose a Device to Buy</h2>";
        echo "<ul>";
        foreach ($devices as $device) {
            echo "<li>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='device_id' value='{$device['id']}'>";
            echo "<p>{$device['device_name']} - {$device['price']} USD (Quantity: {$device['quantity']})</p>";
            echo "<label for='quantity'>Quantity to Buy:</label>";
            echo "<input type='number' name='quantity' id='quantity' min='1' max='{$device['quantity']}' required>";
            echo "<button type='submit' name='submit'>Buy</button>";
            echo "</form>";
            echo "</li>";
        }
        echo "</ul>";
        echo "<button onclick='window.location.href=\"index.php\";'>Back to Main Menu</button>"; // Button to go back to the main menu
    } elseif (isset($_POST['submit'])) { // Display confirmation message after purchase
        $deviceId = $_POST['device_id'];
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
