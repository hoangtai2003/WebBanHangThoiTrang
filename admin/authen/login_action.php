<?php
    session_start();
    require_once('../../config/config.php');

    if (isset($_POST['login_btn'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password_hash = md5($password);

        $sql = "select * from user where BINARY UserName = '".$name."' and UserPassword = '".$password_hash."'";
        $result = $connection->query($sql) or die ($connection->error);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $UserId = $row["UserId"];
            $_SESSION['UserId'] = $UserId;
            $username = $row['UserName'];
            $connection->close();
            $_SESSION['loggedin'] = true;//đăng nhập thành công
            $_SESSION['username'] = $username;//lưu tên người dùng
            
            header("Location: ../home/index.php"); // Chuyển hướng đến trang dashboard hoặc trang chính sau khi đăng nhập thành công
            exit();
        } else {
            $_SESSION['message'] = "Login Failed. Please check your username and password";
            header("Location: login.php"); // Chuyển hướng về trang đăng nhập nếu đăng nhập không thành công
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }

?>