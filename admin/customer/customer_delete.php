<?php
    session_start();
    include('../../config/config.php');
        $cus_id = $_GET['CusId'];
        $sql = "Delete from customers where CusId = '$cus_id'";
        $result = mysqli_query($connection, $sql);
        $connection->close();
        if($result){
            $_SESSION['message'] = "Xóa thành công";
            header('Location: customer_list.php');
            exit(0);
        } 
   
?>