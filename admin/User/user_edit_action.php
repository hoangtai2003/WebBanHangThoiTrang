<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $status = $_POST['rdstatus'];
        $sql = "Update user set UserStatus = '$status' where UserId = '$user_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);
        $connection->close();
        if ($result){
            $_SESSION['message'] = "Cập nhật thành công";
            $_SESSION['message_type'] = 'success';
            header('Location: user_list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            $_SESSION['message_type'] = 'error';
            header('Location: user_list.php');
            exit(0);
        }
    }
?>
