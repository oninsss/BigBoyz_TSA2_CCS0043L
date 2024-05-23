<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HJT Electronic Devices Store - Home</title>
</head>
<body>
    <h1>Welcome to HJT Electronic Devices Store</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <a href="addDevice.php">Add Device</a><br>
    <a href="viewdevices.php">View Devices</a><br>
    <a href="purchase_devices.php">Purchase Devices</a><br>
    <a href="view_purchase_history.php">View Purchase History</a><br>
    <a href="view_device_details.php">View Device Details</a><br>
</body>
</html>
