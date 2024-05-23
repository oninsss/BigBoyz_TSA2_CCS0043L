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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Devices</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        h2 {
            color: #555555;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .sub-menu {
            padding-left: 20px;
        }

        .sub-menu li {
            margin-bottom: 5px;
        }

        .sub-menu a {
            color: #555555;
        }

        .sub-menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Devices</h1>
        <?php displayDevices($devices); ?>
        <ul class="sub-menu">
            <li><a href="#">Buy Devices</a></li>
            <li><a href="#">View Single Device</a></li>
            <li><a href="#">Edit Device</a></li>
            <li><a href="#">Delete Device</a></li>
            <li><a href="#">Clear All Devices</a></li>
            <li><a href="#">Clear All Purchases</a></li>
        </ul>
    </div>
</body>
</html>
