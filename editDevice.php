<?php
session_start();

$devices = $_SESSION['devices'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit']) && isset($_POST['id'])) {
        $deviceToEdit = $_POST['id'];
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
    <title>View Devices</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/editDevice.css">
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
    <div class="container" >
        <?php
            foreach ($devices as $device) {
                if ($device['id'] == $deviceToEdit) {
                    echo "<div class='card'>";
                    
                    echo "<div class='left'>";
                    echo "<h1>Device Details</h1>";
                    echo "<p>ID: {$device['id']}</p>";
                    echo "<p>Name: {$device['name']}</p>";
                    echo "<p>Quantity: {$device['quantity']}</p>";
                    echo "<p>Price: \${$device['price']}</p>";
                    echo "<p><img src='{$device['image']}' alt='{$device['name']}'></p>";
                    echo "<button onclick='openViewDevice()'>Back to Devices</button>";
                    echo "</div>";

                    echo "<div class='right'>";
                    echo "<h1>Edit Device</h1>";
                    echo "<form action='edit_device_action.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='{$device['id']}'>";
                    echo "Name: <input type='text' name='name'><br>";
                    echo "Quantity: <input type='number' name='quantity'><br>";
                    echo "Price: <input type='number' name='price'><br>";
                    echo "<input type='submit' name='update' value='Update'>";
                    echo "</form>";
                    echo "</div>";
                    
                    echo "</div>"; 
                    break;
                }
            }
        ?>
    
    </div>

    <script src="Assets/Script/script.js"></script>
</body>
</html>
