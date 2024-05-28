<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id'])) {
            $devices = $_SESSION['devices'];
            $deviceId = ($_POST['id']);
            echo "The device ID is: " . htmlspecialchars($deviceId);
            foreach ($devices as $key => $device) {
                if ($device['id'] == $deviceId) {
                    echo $device['id'];
                    unset($devices[$key]);
                    break;
                }
            }
            $_SESSION['devices'] = $devices;
            header("Location: viewDevice.php");
            exit();
        } else {
            echo "No ID was provided!";
        }
    } else {
        echo "Invalid request method.";
    }
?>