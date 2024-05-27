<?php
session_start();

// Sample devices data (can be fetched from the database)
$devices = $_SESSION['devices'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' exists in the POST data
    if (isset($_POST['edit']) && isset($_POST['id'])) {
        $deviceToEdit = $_POST['id'];
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
    <title>View Devices</title>
    <link rel="stylesheet" href="./Assets/Styles/style.css">
    <style>
        .container.card{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="navBx">
        <div class="logo">
            <h1 onclick="home()">HJT</h1>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>
    </div>
    <div class="container" >
        <?php
            foreach ($devices as $device) {
                if ($device['id'] == $deviceToEdit) {
                    // Display the device information in a form for editing
                    echo "<div class='card' style='display: flex; flex-direction: row; justify-content: space-between; gap: 50px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 50px; border-radius: 5px;'> ";
                    
                    echo "<div class='cardOne' style='padding-50px;'>";
                    echo "<h1>Device Details</h1>";
                    echo "<p>ID: {$device['id']}</p>";
                    echo "<p>Name: {$device['name']}</p>";
                    echo "<p>Quantity: {$device['quantity']}</p>";
                    echo "<p>Price: \${$device['price']}</p>";
                    echo "<p>Image: <img src='{$device['image']}' alt='{$device['name']}'></p>";
                    echo "</div>";

                    echo "<div class='cardTwo'>";
                    echo "<h1>Edit Device</h1>";
                    echo "<form action='edit_device_action.php' method='POST' style='display: flex; flex-direction: column; '>";
                    echo "<input type='hidden' name='id' value='{$device['id']}'>";
                    echo "Name: <input type='text' name='name' style='border: 1px solid #000; border-radius: 4px; height:30px;' ><br>";
                    echo "Quantity: <input type='number' name='quantity' style='border: 1px solid #000; border-radius: 4px; height:30px;' ><br>";
                    echo "Price: <input type='number' name='price' style='border: 1px solid #000; border-radius: 4px; height:30px;'><br>";
                    echo "<input type='submit' name='update' value='Update' style='border: none; border-radius: 4px; height:30px; background-color: green; color: white;'>"; // Changed button text to "Update"
                    echo "</form>";
                    echo "</div>";
                    
                    echo "</div>"; // Close the .card div
                    break;
                }
            }
        ?>
    <!-- <button onclick="location.href='viewDevices.php'">Back to Devices</button> -->
    </div>


</body>
</html>
