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
            header("Location: user_edit.php?UserId=$user_id");
        }
        else{
            $sql = "SELECT UserName, UserEmail from users where  (UserEmail = '$email' or UserName ='$name') and UserId != '$user_id'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Email hoặc tên đã tồn tại";
                header("Location: user_edit.php?UserId=$user_id");
            } 
            else{
                $sql = "Update users set UserName = '$name', UserEmail = '$email', UserStatus = '$status' where UserId = '$user_id'";
                $result = mysqli_query($connection, $sql) or die($connection->error);
                $connection->close();
                if ($result){
                    $_SESSION['message'] = "Cập nhật thành công";
                    header('Location: user_list.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    header('Location: user_list.php');
                    exit(0);
                }
            }
        }
    }
?>
