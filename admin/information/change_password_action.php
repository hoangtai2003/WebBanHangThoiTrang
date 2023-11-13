<?php
    session_start();
    require_once('../../config/config.php');
    if (isset($_POST['change_btn'])){
        $userid = $_POST['UserId'];
        $old_password = $_POST['password_old'];
        $old_password_hash = md5($old_password);
        $new_password = $_POST['password_new'];
        $new_password_hash = md5($new_password);
        $cnew_password = $_POST['cpassword_new'];
        if (strpos($new_password, ' ') !== false || strpos($cnew_password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            $_SESSION['message_type'] = 'warning';
            header("Location: profile.php");
            exit();
        }
        else{
            $sql = "select UserPassword from user where UserId = '".$userid."'";
            $result = $connection->query($sql) or die ($connection->error);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $check_oldpassword = $row['UserPassword'];
                }
                if($old_password_hash == $check_oldpassword && $new_password == $cnew_password){
                    $sqlUpdate = "update user set UserPassword = '".$new_password_hash."' where UserId = '".$userid."'";
                    $resultUpdate = $connection->query($sqlUpdate);
                    $_SESSION['message'] = "Đổi mật khẩu thành công!";
                    $_SESSION['message_type'] = 'success';
                    header('Location: profile.php');
                    exit();
                }else{
                    $_SESSION['message'] = "Sai thông tin!";
                    $_SESSION['message_type'] = 'error';
                    header('Location: profile.php');
                    exit();
                }
            }
            $connection->close();
        }
    }else{
        header('Location: profile.php');
        exit();
    }
    
?>