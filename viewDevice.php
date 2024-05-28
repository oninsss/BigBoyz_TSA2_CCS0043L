<?php
session_start();

function displayDevices() {
    $devices = $_SESSION['devices'] ?? [];

    if (isset($devices) && is_array($devices) && !empty($devices)) {
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
                echo "<button id='_purchase' type='submit'>Purchase</button>";
                echo "</form>";
                echo "<button id='_viewProd' onclick=\"location.href='deviceDetails.php?id={$device['id']}'\">View Product Details</button>";

                echo "<div class='editDel'>";
                    echo "<form id='_left' action='editDevice.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='{$device['id']}'>";
                        echo "<input id='_edit' type='submit' name='edit' value='Edit'>";
                    echo "</form>";
                    echo "<form id='_right' action='deleteDevice.php' method='POST' onsubmit='return confirmDelete();'>";
                        echo "<input type='hidden' name='id' value='{$device['id']}'>";
                        echo "<input id='_del' type='submit' name='delete' value='Delete'>";
                    echo "</form>";
                echo "</div>";

            echo "</div>";
            
        }

        echo "</div>";
        echo "<div class = 'btnBx'>";    
            echo "<div class = 'clearButtons'>";
                echo "<div class='clrAllDvcs'>";
                    echo "<form action='clearAllDevices.php' method='POST'>";
                        echo "<input type='submit' name='clrAD' value='Clear All Devices' onclick=\"return confirm('Are you sure you want to clear all devices?');\">";
                    echo "</form>";
                echo "</div>";
                echo "<div class='clrAllPurch'>";
                    echo "<form action='clearAllPurchases.php' method='POST'>";
                        echo "<input type='submit' name='clrAP' value='Clear All Purchases';\">";
                    echo "</form>";
                echo "</div>";
            echo "</div>";
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
    <title>Devices</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/viewDevice.css">
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

    <?php
        displayDevices();
    ?>
<script src="Assets/Script/script.js"></script>
</body>
</html>
