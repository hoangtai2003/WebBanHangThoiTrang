<?php
    session_start();
    require_once('../../config/config.php');
    if(isset($_POST['forgot_password_btn'])){
        $name = $_POST['name'];
        $sql = "select * from users where UserName = '".$name."'";
        $result = $connection->query($sql) or die ($connection->error);
        if($result->num_rows>0){
            $newPassword = '123';
            $sqlUpdate = "update users set UserPassword = '".$newPassword."' where UserName = '".$name."'";
            $resultUpdate = $connection->query($sqlUpdate);
            $_SESSION['message'] = "Mật khẩu mới của bạn là: ". "<b>$newPassword</b>" ;
            header('Location: forgot_password.php');
        }
        $connection->close();
    }
?>
