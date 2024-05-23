<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Devices</title>
</head>
<body>
    <h1>Purchase Devices</h1>
    
    <?php
    // Dummy data for demonstration purposes
    $devices = [
        ['id' => 1, 'device_name' => 'Phone', 'price' => 500, 'quantity' => 10],
        ['id' => 2, 'device_name' => 'Laptop', 'price' => 1000, 'quantity' => 5],
        ['id' => 3, 'device_name' => 'Tablet', 'price' => 300, 'quantity' => 8]
    ];

    if (!empty($devices)) {
        echo "<form action='process_purchase.php' method='POST'>";
        echo "<table>";
        echo "<tr><th>Device Name</th><th>Price</th><th>Available Quantity</th><th>Quantity to Buy</th></tr>";
        foreach ($devices as $device) {
            echo "<tr>";
            echo "<td>{$device['device_name']}</td>";
            echo "<td>{$device['price']}</td>";
            echo "<td>{$device['quantity']}</td>";
            echo "<td><input type='number' name='quantity[{$device['id']}]' min='1' max='{$device['quantity']}' required></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button type='submit'>Confirm Purchase</button>";
        echo "</form>";
    } else {
        echo "<p>No devices available for purchase.</p>";
    }
    ?>
</body>
</html>
