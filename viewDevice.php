<?php
session_start();

function displayDevices() {
    $devices = $_SESSION['devices'] ?? [];

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
        height: fit-content;
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
        justify-content: start;
        gap: 10px;
    }

    .card #_edit {
        /* border: 2px solid #FB8500; */
        border: none;
        border-radius: 5px;
        padding: 10px;
        
        background-color: #FB8500;
        color: white;
        transition: 0.3s ease-in-out ;

        &:hover {
            background-color: transparent;
            transform: scale(1.1);
            cursor: pointer;
            color: #FB8500;
        }
    }

    .card #_del {
        /* border: 2px solid #c1121f; */
        border: none;
        border-radius: 5px;
        padding: 10px;
        background-color: transparent;
        background-color: #c1121f;
        color: white;
        transition: 0.3s ease-in-out;

        &:hover {
            background-color: transparent;
            transform: scale(1.1);
            cursor: pointer;
            color: #c1121f;
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
        displayDevices();
    ?>
<script src="Assets/Script/script.js"></script>
</body>
</html>
