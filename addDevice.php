<?php
session_start();

$defaultImageURL = "https://i.ebayimg.com/images/g/ub0AAOSw1rdjSAhX/s-l1200.jpg";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addDevice"])) {
    $name = isset($_POST["deviceName"]) ? htmlspecialchars($_POST["deviceName"]) : '';
    $quantity = isset($_POST["deviceStock"]) ? htmlspecialchars($_POST["deviceStock"]) : '';
    $price = isset($_POST["devicePrice"]) ? htmlspecialchars($_POST["devicePrice"]) : '';

    if (empty($name) || empty($price)) {
        $_SESSION['message'] = "Name and price are required fields.";
        header("Location: addDevice.php");
        exit();
    }

    $deviceImage = $defaultImageURL;

    if (isset($_FILES['deviceImage']) && $_FILES['deviceImage']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["deviceImage"]["name"]);
        if (move_uploaded_file($_FILES["deviceImage"]["tmp_name"], $targetFile)) {
            $deviceImage = $targetFile;
        } else {
            $_SESSION['message'] = "Error uploading the image.";
            header("Location: addDevice.php");
            exit();
        }
    }

    $deviceId = uniqid();

    if (!isset($_SESSION['devices'])) {
        $_SESSION['devices'] = array();
    }

    $_SESSION['devices'][$deviceId] = array(
        'id' => $deviceId,
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price,
        'image' => $deviceImage
    );

    $_SESSION['message'] = "Device added successfully.";
    header("Location: addDevice.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Device</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/addDevice.css">
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

<div class="formBx">
    <h1>Add New Device</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="addDevice.php" enctype="multipart/form-data">
        <input type="text" name="deviceName" placeholder="Device Name" required>
        <input type="number" name="deviceStock" placeholder="Stock" required>
        <input type="number" name="devicePrice" placeholder="Price" required>
        <!-- <input type="file" name="deviceImage" placeholder="Image URL"> -->

        <input type="submit" name="addDevice" value="Add Device">
        <button type="button" onclick="window.location.href='index.php'">Back to Home</button>
    </form>
</div>

<script src="Assets/Script/script.js"></script>
</body>
</html>
