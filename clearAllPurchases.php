<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clrAP"])) {
        $_SESSION['purchaseHistory'] = [];
        header("Location: purchHistory.php");
        exit();
    }
?>