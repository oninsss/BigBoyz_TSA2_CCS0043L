<?php
session_start();

function displayDevices() {
    $devices = $_SESSION['devices'] ?? [];

    if (!empty($devices)) {
        echo "<div class='cardWrapper'>";

        foreach ($devices as $device) {
            echo "<div class='card'>";
                echo "<div class='imgBx'>";   
                    echo "<img src='{$device['image']}' alt='{$device['name']}'>";
                echo "</div>";
                echo "<h2>{$device['name']}</h2>";
                echo "<p>Quantity: {$device['quantity']}</p>";
                echo "<p>Price: \${$device['price']}</p>";
                echo "<form action='purchDevice.php' method='GET'>";
                echo "<input type='hidden' name='id' value='{$device['id']}'>";
                echo "<button class='purchaseButton' type='submit'>Purchase</button>";
                echo "</form>";
                echo "<button id='_viewProd' onclick=\"location.href='deviceDetails.php?id={$device['id']}'\">View Product Details</button>";

                echo "<div class='editDel'>";
                    echo "<form action='editDevice.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='{$device['id']}'>";
                        echo "<input id='_edit' type='submit' name='edit' value='Edit'>";
                    echo "</form>";
                    echo "<form action='deleteDevice.php' method='POST' onsubmit='return confirmDelete();'>";
                        echo "<input type='hidden' name='id' value='{$device['id']}'>";
                        echo "<input id='_del' type='submit' name='delete' value='Delete'>";
                    echo "</form>";
                echo "</div>";

            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "
        <div class='popup'>
            <p>No devices available</p>
            <button id='_home' onclick='home()'>Back to Home</button>
        </div>";
    }
}
?>


<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this device?');
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Device</title>
    <link rel="stylesheet" href="Assets/Styles/style.css">
    <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            margin-bottom: 5px;
        }

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1.2rem;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        #totalPrice {
            color: #38b000;
            font-size: 1.2rem;
            font-weight: 800;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
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
    if(isset($_GET['id'])) {
        $deviceId = $_GET['id'];
        $deviceDetails = getDeviceDetails($deviceId, $_SESSION['devices']);
        if($deviceDetails) {
            echo "<h1>{$deviceDetails['name']} - Purchase</h1>";
            echo "<form method='post' action='purchaseHandler.php'>";
            echo "<input type='hidden' name='deviceId' value='{$deviceId}'>";
            echo "<p>Quantity:</p>";
            echo "<input type='number' name='quantity' min='1' max='{$deviceDetails['quantity']}' value='1' required onchange='calculateTotal(this.value, {$deviceDetails['price']})'>";
            echo "<p>Total Price: $<span id='totalPrice'>{$deviceDetails['price']}</span></p>";
            echo "<input type='submit' value='Purchase'>";
            echo "</form>";

            // Display success message if purchase was successful
            if(isset($_SESSION['purchase_success'])) {
                echo "<div class='success-message'>{$_SESSION['purchase_success']}</div>";
                unset($_SESSION['purchase_success']); // Clear the session variable
            }
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
<script>
function calculateTotal(quantity, price) {
    const totalPriceElement = document.getElementById('totalPrice');
    const total = quantity * price;
    totalPriceElement.textContent = total.toFixed(2);
}
</script>
</body>
</html>
