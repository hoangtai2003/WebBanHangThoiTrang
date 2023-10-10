<?php
    session_start();
    require_once('../../config/config.php');
    $name = $_SESSION['username'];
    if (isset($_POST['change_btn'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $cnew_password = $_POST['cnew_password'];

        $sql = "select UserPassword from users where UserName = '".$name."'";
        $result = $connection->query($sql) or die ($connection->error);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $check_oldpassword = $row['UserPassword'];
            }
            if($old_password == $check_oldpassword && $new_password == $cnew_password){
                $sqlUpdate = "update users set UserPassword = '".$new_password."' where UserName = '".$name."'";
                $resultUpdate = $connection->query($sqlUpdate);
                $_SESSION['message_change'] = "Đổi mật khẩu thành công!";
                header('Location: change_password.php');
            }else{
                $_SESSION['message_change'] = "Sai thông tin!";
                header('Location: change_password.php');
            }
        }
        $connection->close();
    }else{
        header('Location: change_password.php');
    }
    
?>