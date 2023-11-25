<?php 
    session_start();
    require_once ('../../config/config.php');
    include('../../helpers/function.php');
    if (isset($_POST['register_btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $hoten = $_POST['hoten'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $confirm_password =  $_POST['cpassword'];
        if ($password == $confirm_password){
            $sql = "SELECT UserName, UserEmail from user where  UserEmail = '$email' or UserName ='$name'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Tên hoặc Email đã tồn tại";
                $_SESSION['message_type'] = 'warning';
                header("Location: register.php");
            } else {
                $user_query = "INSERT INTO user (UserName,HoTen, UserEmail, UserPassword) values('$name', '$hoten', '$email', '$password_hash')";
                $user_query_run = mysqli_query($connection,$user_query);
                if ($user_query_run)
                {
                    $_SESSION['message'] = "Đăng ký thành công";
                    $_SESSION['message_type'] = 'success';
                    header("Location: login.php");
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    $_SESSION['message_type'] = 'error';
                    header("Location: register.php");
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = 'Password và ConfirmPasword không khớp';
            $_SESSION['message_type'] = 'error';
            header("Location: register.php");
        }
        $connection->close();
    } else {
        header("Location: register.php");
        exit();
    }
    
?>