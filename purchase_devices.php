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
        echo "<table>";
        echo "<tr><th>Device Name</th><th>Price</th><th>Initial Quantity</th><th>Quantity to Buy</th></tr>";

        foreach ($devices as $device) {
            $initialQuantity = isset($_SESSION['quantity'][$device['id']]) ? $_SESSION['quantity'][$device['id']] : 1;
            echo "<tr>";
            echo "<td>{$device['device_name']}</td>";
            echo "<td>{$device['price']}</td>";
            echo "<td>{$device['quantity']}</td>";
            echo "<td><input type='number' name='quantity[{$device['id']}]' min='1' max='{$device['quantity']}' value='$initialQuantity' required></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<button type='submit' name='submit'>Submit</button>";
        echo "</form>";
        echo "<button onclick='window.location.href=\"index.php\";'>Back to Main Menu</button>"; // Button to go back to the main menu
    } elseif (isset($_POST['submit'])) { // Display confirmation message after purchase
        foreach ($_POST['quantity'] as $id => $quantity) {
            $_SESSION['quantity'][$id] = $quantity;
        }

        echo "<p>Thank you for your purchase!</p>";
        echo "<button onclick='window.location.href=\"index.php\";'>Back to Main Menu</button>"; // Button to go back to the main menu
        echo "<button onclick='window.location.href=\"purchase_devices.php\";'>Back to purchase devices</button>"; // Button to go back to the main menu
        session_unset(); // Clear session data after purchase confirmation
    }
} else {
    echo "<p>No devices available for purchase.</p>";
}
?>
