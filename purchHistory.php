<?php
session_start();

// Check if the purchase history exists in the session
if(isset($_SESSION['purchase_history']) && !empty($_SESSION['purchase_history'])) {
    $purchaseHistory = $_SESSION['purchase_history'];

    // Output the purchase history in a table format
    echo "<h1>Purchase History</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Device Name</th><th>Quantity</th><th>Total Price</th></tr>";
    foreach ($purchaseHistory as $purchase) {
        echo "<tr>";
        echo "<td>{$purchase['name']}</td>";
        echo "<td>{$purchase['quantity']}</td>";
        echo "<td>\${$purchase['total_price']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No purchase history available.</p>";
}
?>
