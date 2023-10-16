<?php
    session_start();
    // var_dump($_POST);
    include('../../config/config.php');
    if(isset($_POST['login_btn'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $sql = "Select * from user where UserName = '$name' and UserPassword = '$password'  LIMIT 1";
        $result = mysqli_query($connection,$sql) or die ($connection->error);
        $user = mysqli_fetch_array($result);
        if ($user) {
            $UserId = $user['UserId'];
            $_SESSION['UserId'] = $UserId;

            $_SESSION['loggedin'] = true; // Đăng nhập thành công
            $_SESSION['username'] = $name; // Lưu tên người dùng
            header('Location: ../home/index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Invalid Email or Password";
            header('Location: login.php');
            exit(0);
        }
    }


?>