<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addDevice"])) {
    // Validate and sanitize input
    $name = isset($_POST["deviceName"]) ? htmlspecialchars($_POST["deviceName"]) : '';
    $quantity = isset($_POST["deviceStock"]) ? htmlspecialchars($_POST["deviceStock"]) : '';
    $price = isset($_POST["devicePrice"]) ? htmlspecialchars($_POST["devicePrice"]) : '';

    // Check if all required fields are filled
    if (empty($name) || empty($price)) {
        $_SESSION['message'] = "Name and price are required fields.";
        header("Location: addDevice.php");
        exit();
    }

    // Handle file upload
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
    } else {
        $deviceImage = '';
    }

    // Generate a unique identifier for the device
    $deviceId = uniqid();

    // Assuming devices are stored in an array in session
    if (!isset($_SESSION['devices'])) {
        $_SESSION['devices'] = array();
    }

    // Add device to the session array using the unique identifier
    $_SESSION['devices'][$deviceId] = array(
        'id' => $deviceId,
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price,
        'image' => $deviceImage
    );

    $_SESSION['message'] = "Device added successfully";
    header("Location: viewDevice.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Device</title>
    <link rel="stylesheet" href="Assets/Styles/style.css">
<style>
    .formBx {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .formBx h1 {
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .formBx input[type="text"], .formBx input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1.2rem;
    }

    .formBx input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1rem;
    }

    .formBx input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2rem;
    }

    .formBx input[type="submit"]:hover {
        filter: brightness(1.2);
    }

    .formBx button {
        width: 100%;
        padding: 10px;
        background-color: transparent;
        border: 2px solid #333;
        border-radius: 5px;
        cursor: pointer;
        color: #333;
        font-size: 1.2rem;
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
        <input type="file" name="deviceImage" placeholder="Image URL">

        <input type="submit" name="addDevice" value="Add Device">
        <button type="button" onclick="window.location.href='index.php'">Back to Home</button>
    </form>
</div>

<script src="Assets/Script/script.js"></script>
</body>
</html>
