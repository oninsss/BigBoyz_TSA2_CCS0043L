<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HJT Electronic Devices Store</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/landing.css">
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
<div class="header">
    <div class="textBx">
        <img src="https://www.nicepng.com/png/full/246-2469083_electronic-devices-png-live-webcasting-png.png">
        <h1>Welcome to HJT Electronic Devices Store</h1>
        <p>Here you can PURCHASE and even ADD your own device to the market!</p>
    </div>
    <div class="btnBx">   
        <button id="_viewDevice" onclick="openViewDevice()">View Devices</button>
        <button id="_addDevice" onclick="openAddDevice()">Add Device</button>
    </div>
</div>

<script src="Assets/Script/script.js"></script>
</body>
</html>