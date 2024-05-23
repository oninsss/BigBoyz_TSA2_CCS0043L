<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_device"])) {
    // Validate and sanitize input
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';

    // Check if all required fields are filled
    if (empty($name) || empty($price)) {
        $_SESSION['message'] = "Name and price are required fields.";
        header("Location: addDevice.php"); // Corrected the filename here
        exit();
    }

    // Additional validation if needed (e.g., price should be a positive number)

    // Assuming devices are stored in an array in session
    if (!isset($_SESSION['devices'])) {
        $_SESSION['devices'] = array();
    }

    // Add device to the session array using the quantity provided
    $_SESSION['devices'][] = array('name' => $name, 'quantity' => $quantity, 'price' => $price);

    $_SESSION['message'] = "Device added successfully";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Device</title>
</head>
<body>
    <h1>Add New Device</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <form action="addDevice.php" method="post">
        Name: <input type="text" name="name"><br>
        Quantity: <input type="number" name="quantity"><br>
        Price: <input type="number" name="price"><br>
        <input type="submit" name="add_device" value="Add Device">
    </form>
</body>
</html>
