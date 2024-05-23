<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Device Details</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .cardBx {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            overflow: hidden;
            width: 300px;
        }

        .imgBx {
            height: 200px;
            background: #333;
        }

        .imgBx img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            padding: 20px;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            color: #666;
        }

        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>View Device Details</h1>
</div>
<div class="navigation">
    <a href="#">View Devices</a>
    <div class="sub-menu">
        <a href="#">Buy Devices</a>
        <a href="#">View Single Device</a>
        <a href="#">Edit Device</a>
        <div class="sub-menu">
            <a href="#">Update Device</a>
        </div>
        <a href="#">Delete Device</a>
        <div class="sub-menu">
            <a href="#">Confirm Delete</a>
        </div>
        <a href="#">Clear All Devices</a>
        <a href="#">Clear All Purchases</a>
    </div>
</div>
<div class="cardBx">
    <?php
    $devices = array(
        array(
            'name' => 'Device 1',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non feugiat libero, ac luctus quam.'
        ),
        array(
            'name' => 'Device 2',
            'description' => 'Vestibulum dapibus metus sed ex suscipit, vel aliquam velit fermentum. Ut sit amet felis sed.'
        ),
        array(
            'name' => 'Device 3',
            'description' => 'Suspendisse in felis in eros fermentum elementum. Nullam eu justo auctor, eleifend neque ut, semper purus.'
        )
    );

    foreach ($devices as $device) {
        ?>
        <div class="card">
            <div class="imgBx">
            </div>
            <div class="content">
                <h1><?php echo $device['name']; ?></h1>
                <p><?php echo $device['description']; ?></p>
                <button onclick="buy()">Buy Now!</button>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>
