<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deviceId = $_POST['deviceId'];
    $quantity = intval($_POST['quantity']);

    $devices = $_SESSION['devices'] ?? [];
    foreach ($devices as &$device) {
        if ($device['id'] == $deviceId) {
            if ($device['quantity'] >= $quantity) {
                $device['quantity'] -= $quantity;

                $_SESSION['purchase_history'][] = [
                    'id' => $deviceId,
                    'name' => $device['name'],
                    'quantity' => $quantity,
                    'price' => $device['price'],
                    'total' => $quantity * $device['price'],
                    'date' => date('Y-m-d H:i:s')
                ];

                $_SESSION['devices'] = $devices;

                echo 'success';
                exit;
            } else {
                echo 'Not enough stock';
                exit;
            }
        }
    }
    echo 'Device not found';
}
?>
