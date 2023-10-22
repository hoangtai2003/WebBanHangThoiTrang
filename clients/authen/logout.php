<?php
    session_start();
    unset($_SESSION['cus_loggedin']);
    $_SESSION['message'] = 'Đăng xuất thành công';
    header('Location: ./login.php');
    exit(0);
?>