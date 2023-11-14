<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_customer'])){
        $cus_id = $_POST['cus_id'];
        $status = $_POST['rdstatus'];
        $sql = "Update customer set CusStatus = '$status' where CusId = '$cus_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);
        $connection->close();
        if ($result){
            $_SESSION['message'] = "Cập nhật thành công";
            $_SESSION['message_type'] = 'success';
            header('Location: customer_list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            $_SESSION['message_type'] = 'error';
            header('Location: customer_list.php');
            exit(0);
        }
    }
?>
