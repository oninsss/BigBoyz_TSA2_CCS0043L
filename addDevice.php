<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Device</title>
</head>
<body>
    <h1>Add New Device</h1>
    <form action="add_device.php" method="post">
        Name: <input type="text" name="name"><br>
        Description: <textarea name="description"></textarea><br>
        Price: <input type="number" name="price"><br>
        <input type="submit" name="add_device" value="Add Device">
    </form>
</body>
</html>
