<?php
    session_start();
    unset($_SESSION['cus_loggedin']);
    unset($_SESSION['cart_inserted']);
    unset($_SESSION['cart']);
    header('Location: ../index/index.php');
    exit(0);
?>