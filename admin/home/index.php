<?php
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Đã đăng nhập, bạn có thể truy cập thông tin người dùng
        $currentUser = $_SESSION['current_user'];
        // Tiếp tục xử lý dữ liệu hoặc hiển thị thông tin người dùng
    } else {
        header('Location: ../authen/login.php');
        exit(0);
    }

    include('../../config/config.php');
    include('../includes/header.php');
    include('../includes/footer.php');
?>
    

