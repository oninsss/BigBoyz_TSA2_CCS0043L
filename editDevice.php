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
    <link rel="stylesheet" href="./Assets/Styles/style.css">
    <style>

        .card {
            background-color: #fff;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 50px;
            border-radius: 10px;
        }
        .left, .right {
            display: flex;
            flex-direction: column;
            gap: 1rem;

            h1 {
                font-size: 1.6rem;
            }

            p {
                font-size: 1rem;
            }
        }
        .left {
            img {
                height: 100px;
                border-radius: 5px;
            }
            button {
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #333;
                color: #fff;
                cursor: pointer;
                transition: 0.5s;

                &:hover {
                    filter: brightness(1.5);
                }   
            }
        }
        .right {
            form {
                display: flex;
                flex-direction: column;

                input[type="text"], input[type="number"] {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                    font-size: 1.2rem;
                }

                input[type="submit"] {
                    background-color: #38B000;
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 1.2rem;
                    transition: 0.5s;
                }

                input[type="submit"]:hover {
                    filter: brightness(1.2);
                }
            }
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
