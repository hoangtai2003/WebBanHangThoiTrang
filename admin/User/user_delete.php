<?php
    session_start();
    include('../../config/config.php');
        $user_id = $_GET['UserId'];
        $sql = "Delete from users where UserId = '$user_id'";
        $result = mysqli_query($connection, $sql);
        $connection->close();
        if($result){
            $_SESSION['message'] = "Xóa thành công";
            header('Location: user_list.php');
            exit(0);
        } 
   
?>