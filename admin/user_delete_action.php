<?php
    session_start();
    include('../config/config.php');
    if (isset($_POST['user_delete'])){
        $user_id = $_POST['user_delete'];
        $sql = "Delete from users where UserId = '$user_id'";
        $result = mysqli_query($connection, $sql);
        $connection->close();
        if($result){
            $_SESSION['message'] = "Delete Successfully";
            header('Location: user_list.php');
            exit(0);
        } 
    }
   
?>