<?php
    session_start();
    require_once('../../config/config.php');

    if (isset($_POST['login_btn'])){
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "select UserName, UserPassword from users where UserName = '".$name."' and UserPassword = '".$password."'";
        $result = $connection->query($sql) or die ($connection->error);

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Login Successful";
            
            header("Location: ../../admin/index.php"); // Chuyển hướng đến trang dashboard hoặc trang chính sau khi đăng nhập thành công
        } else {
            $_SESSION['message'] = "Login Failed. Please check your username and password";
            header("Location: login.php"); // Chuyển hướng về trang đăng nhập nếu đăng nhập không thành công
        }
    } else {
        header("Location: login.php");
    }

?>