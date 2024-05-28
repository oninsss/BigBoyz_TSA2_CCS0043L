<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clrAD"])) {
        $_SESSION['devices'] = [];
        header("Location: viewDevice.php");
        exit();
    }
?>
