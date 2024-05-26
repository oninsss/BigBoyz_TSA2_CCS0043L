<?php
session_start();

function displayDevices($devices)
{
    $devices = array(
        array(
            'id' => 1,
            'name' => 'iPhone 15 Pro Max',
            'quantity' => 10,
            'price' => 1599.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),
        array(
            'id' => 2,
            'name' => 'Samsung Galaxy S30',
            'quantity' => 8,
            'price' => 1499.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),
        array(
            'id' => 3,
            'name' => 'Google Pixel 7 Pro',
            'quantity' => 5,
            'price' => 1399.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),

        array(
            'id' => 4,
            'name' => 'Xiaomi Mi 12',
            'quantity' => 15,
            'price' => 1099.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),
        array(
            'id' => 5,
            'name' => 'OnePlus 10 Pro',
            'quantity' => 20,
            'price' => 1299.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),
        array(
            'id' => 6,
            'name' => 'Sony Xperia 2',
            'quantity' => 12,
            'price' => 1399.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        ),
        array(
            'id' => 7,
            'name' => 'Huawei P50 Pro',
            'quantity' => 10,
            'price' => 1499.99,
            'image' => 'https://powermaccenter.com/cdn/shop/files/iPhone_15_Pro_Max_Natural_Titanium_PDP_Image_Position-1__en-US_3295c924-7c21-417d-870c-32bee7f1e310.jpg?v=1695861436'
        )
    );
    
    // Check if $devices is set and not empty
    if (isset($devices) && is_array($devices) && !empty($devices)) {
        echo "<div class='sortBx'>";
            echo "<button id='_back' onclick='#'>Sort</button>";    
        echo "</div>";
        echo "<div class='cardWrapper'>";  

        foreach ($devices as $device) {
            echo "<div class='card'>";
                echo "<img src='{$device['image']}' alt='{$device['name']}'>";
                echo "<h2>{$device['name']}</h2>";
                echo "<p>Quantity: {$device['quantity']}</p>";
                echo "<p>Price: \${$device['price']}</p>";
                echo "<button id='_purchase' onclick='purchase({$device['id']})'>Purchase</button>";
                // Update the onclick attribute to navigate to deviceDetails.php with the device ID
                echo "<button id='_viewProd' onclick=\"location.href='deviceDetails.php?id={$device['id']}'\">View Product Details</button>";
                echo "<div class='editDel'>";
                    echo "<button id='_edit' onclick='edit({$device['id']})'>Edit</button>";
                    echo "<button id='_del' onclick='del({$device['id']})'>Delete</button>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices</title>
    <link rel="stylesheet" href="Assets/Styles/style.css">
    <style>
    body {
        justify-content: start;
    }
    .sortBx {
        position: fixed;
        top: 8%;
        z-index: 1;
        width: 100%;
        padding-bottom: 1rem;
        display: flex;
        justify-content: start;
        align-items: end;
        gap: 20px;
        backdrop-filter: blur(4px);

        button {
            margin: 0 16rem ;
            padding: 0.5rem 1.2rem;
            background-color: transparent;
            color: #333;
            border: 1px solid #333;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: 0.5s;
        }
    }

    .cardWrapper {
        height: auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        max-width: 80%;
        margin-top: 12%;
    }

    .card {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        text-align: center;
    }

    .card img {
        width: 100%;
        border-radius: 5px;
    }

    .card h2 {
        font-size: 1.5rem;
        margin: 10px 0;
    }

    .card p {
        font-size: 1.2rem;
        margin: 10px 0;
    }

    .card button {
        width: 100%;
        margin: 0.5rem 0;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2rem;
        transition: 0.5s;
    }

    .card button:hover {
        filter: brightness(1.2);
    }

    .card button#_purchase {
        background-color: #38b000;
    }

    .card button#_viewProd {
        background-color: #333;
    }

    .card .editDel {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .card #_edit {
        border: 2px solid #FB8500;
        background-color: transparent;
        color: #FB8500;

        &:hover {
            background-color: #FB8500;
            color: #fff;
        }
    }

    .card #_del {
        border: 2px solid #c1121f;
        background-color: transparent;
        color: #c1121f;

        &:hover {
            background-color: #c1121f;
            color: #fff;
        }
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -70%);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 300px;
        text-align: center;
        margin: 20px;

        p {
            font-size: 1.2rem;
            color: #333;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: 0.5s;
        }
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
    <?php
        displayDevices(isset($_SESSION['devices']) ? $_SESSION['devices'] : []);
    ?>
<script src="Assets/Script/script.js"></script>
</body>
</html>
