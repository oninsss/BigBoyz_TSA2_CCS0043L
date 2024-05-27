<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id'])) {
            $devices = $_SESSION['devices'];
            $deviceId = ($_POST['id']);
            echo "The device ID is: " . htmlspecialchars($deviceId);
            // Search for the device in the devices array and delete it
            foreach ($devices as $key => $device) {
                if ($device['id'] == $deviceId) {
                    echo $device['id'];
                    unset($devices[$key]);
                    break; // Exit the loop once the device is deleted
                }
            }
            // Update the session variable with the modified devices array
            $_SESSION['devices'] = $devices;
            // Redirect back to viewDevices.php or any other appropriate page after deleting
            header("Location: viewDevice.php");
            exit();
        } else {
            echo "No ID was provided!";
        }
    } else {
        echo "Invalid request method.";
    }
?>