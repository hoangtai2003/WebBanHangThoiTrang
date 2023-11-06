<?php
    session_start();
    include('../../config/config.php');
        $slider_id = $_GET['slid'];
        $sql = "Delete from sliders where slid = '$slider_id'";
        $result = mysqli_query($connection, $sql);
        $connection->close();
        if($result){
            $_SESSION['message'] = "Xóa thành công";
            $_SESSION['message_type'] = 'success';
            header('Location: slider_list.php');
            exit(0);
        } 
   
?>