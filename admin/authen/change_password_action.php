<?php
    session_start();
    require_once('../../config/config.php');
    $name = $_SESSION['username'];
    if (isset($_POST['change_btn'])){
        $old_password = $_POST['old_password'];
        $old_password_hash = md5($old_password);
        $new_password = $_POST['new_password'];
        $new_password_hash = md5($new_password);
        $cnew_password = $_POST['cnew_password'];
        $cnew_password_hash = md5($cnew_password);

        if (strpos($new_password, ' ') !== false || strpos($cnew_password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: change_password.php");
            exit();
        }
        else{
            $sql = "select UserPassword from users where UserName = '".$name."'";
            $result = $connection->query($sql) or die ($connection->error);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $check_oldpassword = $row['UserPassword'];
                }
                if($old_password_hash == $check_oldpassword && $new_password == $cnew_password){
                    $sqlUpdate = "update users set UserPassword = '".$new_password_hash."' where UserName = '".$name."'";
                    $resultUpdate = $connection->query($sqlUpdate);
                    $_SESSION['message'] = "Đổi mật khẩu thành công!";
                    header('Location: change_password.php');
                    exit();
                }else{
                    $_SESSION['message'] = "Sai thông tin!";
                    header('Location: change_password.php');
                    exit();
                }
            }
            $connection->close();
        }
    }else{
        header('Location: change_password.php');
        exit();
    }
    
?>