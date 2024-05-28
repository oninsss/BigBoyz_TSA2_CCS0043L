<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Details</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/deviceDetails.css">
</head>
<body>
<div class="navBx">
    <nav>
        <div class="logo">
            <h1 onclick="home()">HJT</h1>
        </div>
        <div class="menu">
            <button onclick="openPurchHistory()">Purchase History</button>
        </div>
    </nav>  
</div>
<div class="container">
    <?php
    session_start();

    if(isset($_GET['id'])) {
        $deviceId = $_GET['id'];
        $deviceDetails = getDeviceDetails($deviceId, $_SESSION['devices']);
        if($deviceDetails) {
            echo "<h1>{$deviceDetails['name']}</h1>";
            echo "<div class='imgBx'>";   
                echo "<img src='{$deviceDetails['image']}' alt='{$deviceDetails['name']}'>";
            echo "</div>";
            echo "<p>Quantity: {$deviceDetails['quantity']}</p>";
            echo "<p>Price: \${$deviceDetails['price']}</p>";
            echo "<button onclick='openViewDevice()'>Back to Devices</button>";
        } else {
            echo "<p>Device details not found for ID: {$deviceId}</p>";
            echo "<pre>";
            print_r($_SESSION['devices']); 
            echo "</pre>";
        }
    } else {
        echo "<p>No device ID provided.</p>";
    }

    function getDeviceDetails($deviceId, $devices) {
        foreach($devices as $device) {
            if($device['id'] == $deviceId) {
                return $device;
            }
        }
        return null;
    }
    ?>
</div>
<script src="Assets/Script/script.js"></script>
</body>
</html>
