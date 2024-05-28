<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Device</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            h1 {
                color: #333;
                margin-bottom: 15px;
            }

            p {
                color: #333;
                margin-bottom: 5px;
            }
        }

        input[type="number"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1.2rem;
        }

        input[type="button"] {
            border: none;   
            background-color: #38b000;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="button"]:hover {
            filter: brightness(1.1);
        }

        button {
            width: 100%;    
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
            transition: background-color 0.3s ease;

            &:hover {
                filter: brightness(1.1);
            }
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
        }

        .popup {
            width: 300px;
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); 
            z-index: 999; 
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            echo "<h1>{$deviceDetails['name']} - Purchase</h1>";
            echo "<form id='purchaseForm'>";
            echo "<input type='hidden' name='deviceId' value='{$deviceId}'>";
            echo "<p>Quantity:</p>";
            echo "<input type='number' name='quantity' min='1' max='{$deviceDetails['quantity']}' value='1' required onchange='calculateTotal(this.value, {$deviceDetails['price']})'>";
            echo "<p>Total Price: $<span id='totalPrice'>{$deviceDetails['price']}</span></p>";
            echo "<input type='button' value='Purchase' onclick='submitPurchase()'>";
            echo "</form>";
            echo "<button id='_cancel' onclick='openViewDevice()'>Cancel</button>";

            if(isset($_SESSION['purchase_success'])) {
                echo "<div class='success-message'>{$_SESSION['purchase_success']}</div>";
                unset($_SESSION['purchase_success']);
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
<div class="popup" id="popup">
    <p>Purchase successful!</p>
    <button onclick="closePopup()">Close</button>
</div>
<script src="Assets/Script/script.js"></script>
<script>
    function calculateTotal(quantity, price) {
        const totalPriceElement = document.getElementById('totalPrice');
        const total = quantity * price;
        totalPriceElement.textContent = total.toFixed(2);
    }

    function openViewDevice() {
        window.location.href = "viewDevice.php";
    }

    function submitPurchase() {
        const form = $('#purchaseForm');
        $.ajax({
            type: 'POST',
            url: 'purchHandler.php',
            data: form.serialize(),
            success: function(response) {
                if (response === 'success') {
                    showPopup();
                } else {
                    alert('Purchase failed: ' + response);
                }
            }
        });
    }

    function showPopup() {
        const overlay = document.createElement('div');
        overlay.classList.add('overlay');
        document.body.appendChild(overlay);

        $('#popup').fadeIn();
    }

    function closePopup() {
        $('#popup').fadeOut();

        const overlay = document.querySelector('.overlay');
        if (overlay) {
            overlay.remove();
        }
    }

</script>
</body>
</html>
