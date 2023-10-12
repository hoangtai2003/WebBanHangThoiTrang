<?php
    session_start();
    include('../../config/config.php');
    if(isset($_POST['login_btn'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $sql = "Select * from users where UserName = '$name' and UserPassword = '$password_hash'  LIMIT 1";
        $result =mysqli_query($connection,$sql) or die ($connection->error);
        if (mysqli_fetch_array($result)> 0){
            $_SESSION['loggedin'] = true;//đăng nhập thành công
            $_SESSION['username'] = $name;//lưu tên người dùng
            header('Location: ../../admin/index.php');
            exit(0);
        }else {
            $_SESSION['message'] = "Invalid Email or Password";
            header('Location: login.php');
            exit(0);
          
        }
        $connection->close();
    } else {
        header('Location: login.php');
        exit(0);
    }


?>