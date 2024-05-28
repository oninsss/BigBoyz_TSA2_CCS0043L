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
    <style>
    body {
        justify-content: start;
    }

    .cardWrapper {
        height: auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
        max-width: 80%;
        margin-top: 200px;
    }

    .card {
        display: flex;
        flex-direction: column;
        height: fit-content;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        text-align: center;
    }

    .card .imgBx {
        height: 300px;
        width: 100%;
        overflow: hidden;
        border-bottom: 1px solid #ccc;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    .card h2 {
        font-size: 1.5rem;
        margin: 10px 0;
    }

    .card p {
        font-size: 1.1rem;
        margin: 8px 0;
    }

    .card button {
        width: 100%;
        margin: 0.4rem 0;
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
        margin: 0.2rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    form {
        width: 100%;
        display: flex;  
    }
    #_left {
        justify-content: start;
    }
    #_right {
        justify-content: end;
    }

    .card #_edit, 
    .card #_del {
        width: 95%;
        border: none;
        border-radius: 5px;
        padding: 10px;
        color: white;
        transition: 0.3s ease-in-out ;
        cursor: pointer;

        &:hover {
            filter: brightness(1.2);
        }
    }

    .card #_edit {
        background-color: #FB8500;
    }

    .card #_del {
        background-color: #c1121f;
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
