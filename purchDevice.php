<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Device</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/purchDevice.css">
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
