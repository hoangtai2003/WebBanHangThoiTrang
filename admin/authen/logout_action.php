<?php
session_start();
if (isset($_POST['logout_btn'])){
    session_destroy();
    $_SESSION['message'] = 'Đăng xuất thành công';
    $_SESSION['message_type'] = 'success';
    header('Location: login.php');
    exit(0);
}
?>