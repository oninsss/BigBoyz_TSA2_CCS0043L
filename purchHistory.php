<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="Assets/Styles/nav-body.css">
    <link rel="stylesheet" href="Assets/Styles/purchHistory.css">
    <style>
        body {
            justify-content: start;
        }   
        .textBx {
            margin: 200px 0 10px 0;
        }

        .textBx h1 {
            color: #333;
        }

        table {
            width: 80%;
            max-width: 1000px;
            border-collapse: collapse;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }


        tr:hover {
            background-color: #ddd;
        }

        form {
            width: 80%;
            max-width: 1000px;
            margin-top: 20px;
        }

        button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d32f2f;
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
    <div class="textBx">
        <h1>Purchase History</h1>
    </div>
    <?php
    session_start();

    if(isset($_SESSION['purchase_history']) && !empty($_SESSION['purchase_history'])) {
        $purchaseHistory = $_SESSION['purchase_history'];
        usort($purchaseHistory, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        $totalPrice = 0;

        echo "<table>";
        echo "<tr><th>Date & Time</th><th>Device Name</th><th>Quantity</th><th>Total Price</th></tr>";
        foreach ($purchaseHistory as $purchase) {
            echo "<tr>";
            echo "<td>{$purchase['date']}</td>";
            echo "<td>{$purchase['name']}</td>";
            echo "<td>{$purchase['quantity']}</td>";
            $subTotal = $purchase['price'] * $purchase['quantity'];
            echo "<td>\${$subTotal}</td>"; 
            echo "</tr>";
            $totalPrice += $subTotal;
        }
        echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>\${$totalPrice}</strong></td></tr>";
        echo "</table>";

        echo "<form method='post'>";
        echo "<button type='submit' name='clear_purchases' onclick='return confirm(\"Are you sure you want to clear all purchases?\")'>Clear All Purchases</button>";
        echo "</form>";

        if(isset($_POST['clear_purchases'])) {
            unset($_SESSION['purchase_history']);
            header('Location: purchHistory.php');
            exit;
        }
    } else {
        echo "<p>No purchase history available.</p>";
    }
    ?>

    <script src="Assets/Script/script.js"></script>
</body>
</html>
