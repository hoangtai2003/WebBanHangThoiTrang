<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $status = $_POST['rdstatus'];
        if (strpos($name, ' ') !== false || strpos($email, ' ')){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            $_SESSION['message_type'] = 'warning';
            header("Location: user_edit.php?UserId=$user_id");
        }
        else{
            $sql = "SELECT UserName, UserEmail from user where  (UserEmail = '$email' or UserName ='$name') and UserId != '$user_id'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Email hoặc tên đã tồn tại";
                $_SESSION['message_type'] = 'warning';
                header("Location: user_edit.php?UserId=$user_id");
            } 
            else{
                $sql = "Update user set UserName = '$name', UserEmail = '$email', UserStatus = '$status' where UserId = '$user_id'";
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
        }
    }
?>
