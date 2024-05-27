<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update']) && isset($_POST['id'])) {

        // Sample devices data (can be fetched from the database)
        $devices = $_SESSION['devices'];
    
        $deviceId = ($_POST['id']);
        $updatedName = $_POST['name'];
        $updatedQuantity = intval($_POST['quantity']);
        $updatedPrice = floatval($_POST['price']);  // Use floatval for prices

        echo "The device ID is: " . htmlspecialchars($deviceId);
        echo "The device name is: " . htmlspecialchars($updatedName);
        echo "The device quantity is: " . htmlspecialchars($updatedQuantity);
        echo "The device price is: " . htmlspecialchars($updatedPrice);

        // Search for the device in the devices array and update its details
        foreach ($devices as &$device) {  // Use reference to modify the original array
            if ($device['id'] == $deviceId) {
                echo $device['id'];
                $device['name'] = $updatedName;
                $device['quantity'] = $updatedQuantity;
                $device['price'] = $updatedPrice;
                unset($device); // Unset the reference to avoid unintended side effects
                break; // Exit the loop once the device is updated
            }
        }

        // Update the session variable with the modified devices array
        $_SESSION['devices'] = $devices;

        // Display the updated device information
        foreach ($devices as $device) {
            if ($device['id'] == $deviceId) {
                // Display the device information in a form for editing
                echo "<h2>Device Details</h2>";
                echo "<p>ID: {$device['id']}</p>";
                echo "<p>Name: {$device['name']}</p>";
                echo "<p>Quantity: {$device['quantity']}</p>";
                echo "<p>Price: \${$device['price']}</p>";
                echo "<p>Image: <img src='{$device['image']}' alt='{$device['name']}'></p>";
    
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
        
        // Redirect back to viewDevices.php or any other appropriate page after updating
        header("Location: viewDevice.php");
        exit();
    }
    else {
        echo "No ID was provided!";
    }
} else {
    echo "Invalid request method.";
}

// Check if form is submitted and update button is clicked

?>
