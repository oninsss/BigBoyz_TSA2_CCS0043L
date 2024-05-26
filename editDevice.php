<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = $_SESSION['devices'] ?? [];

$deviceToEdit = $_SESSION['deviceToEdit'] ?? null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' exists in the POST data
    if (isset($_POST['id'])) {
        $deviceToEdit = $_POST['id'];
        // Now you can use $id as needed in this file
        echo "The device ID is: " . htmlspecialchars($deviceToEdit);
        
        // Proceed with your logic, for example, fetching device details from the database using $id
    } else {
        echo "No ID was provided!";
    }
} else {
    echo "Invalid request method.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <?php
            
                foreach ($devices as $device) {
                    if ($device['id'] == $deviceToEdit) {
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
            ?>
            <!-- <button onclick="location.href='viewDevices.php'">Back to Devices</button> -->
        </div>
    </div>
</body>
</html>
