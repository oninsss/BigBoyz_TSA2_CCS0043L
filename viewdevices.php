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
    echo "<ul class='devices'>";
    foreach ($devices as $device) {
        echo "<li>";
        echo "<div>{$device['name']} (Quantity: {$device['quantity']})</div>";
        echo "<div class='actions'>";
        echo "<a href='purchase_devices.php?id={$device['id']}'>Buy</a> | ";
        echo "<a href='view_single_device.php?id={$device['id']}'>View Details</a> | ";
        echo "<a href='edit_device.php?id={$device['id']}'>Edit</a> | ";
        echo "<a href='delete_device.php?id={$device['id']}'>Delete</a>";
        echo "</div>";
        echo "</li>";
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
            text-align: center;
        }

        h1 {
            color: #333333;
        }

        h2 {
            color: #555555;
        }

        ul.devices {
            list-style-type: none;
            padding: 0;
        }

        .sub-menu {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;

            .selection {
                border: 1px solid red;
                border-radius: 5px;

                &:hover {
                    background-color: red;
                }

                a {
                    text-decoration: none;
                    color: black;
                }
            }
        }

        ul.devices li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style-type: none;
        }

        ul.devices li .actions {
            display: flex;
        }

        ul.devices li .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }

        ul.devices li .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>View Devices</h1>
        <?php displayDevices($devices); ?>
        <ul class="sub-menu">
            <div class="selection"><a href="#">Buy Devices</a></div>
            <div class="selection"><a href="#">View Single Device</a></div>
            <div class="selection"><a href="#">Edit Device</a></div>
            <div class="selection"><a href="#">Delete Device</a></div>
            <div class="selection"><a href="#">Clear All Devices</a></div>
            <div class="selection"><a href="#">Clear All Purchases</a></div>
        </ul>
    </div>
</body>
</html>
