<?php
    session_start();
    session_unset(); // Xóa tất cả các biến session
    session_destroy(); // Hủy phiên làm việc hiện tại
    header('Location: ../index/index.php');
    exit(0);
?>