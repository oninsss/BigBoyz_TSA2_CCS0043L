<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HJT Electronic Devices Store</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
<style>
.header {
    max-width: 80%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .textBx {
        text-align: center;

        img {
            width: 40%;
            margin-bottom: -60px;
            filter: drop-shadow(0 0 4px rgba(0, 0, 0, 1));
        }
        h1 {
            font-size: 4rem;
            font-weight: 600;
            color: #333;

        }
        p {
            font-size: 1.5rem;
            font-weight: 400;
            color: #333;
        }
    }
    .btnBx {
        display: flex;
        justify-content: center;
        margin-top: 3rem;

        button {
            width: 14rem;
            border: none;
            padding: 1rem 1.5rem;
            margin: 0 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1.5rem;
            font-weight: 400;
            transition: 0.5s;   
        }
        #_viewDevice {
            background-color: #333;
            color: #EFEFEF;
        }

        #_addDevice {
            border: 2px solid #333;
            background-color: transparent;
            color: #333;
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