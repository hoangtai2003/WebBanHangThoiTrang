<?php
    session_start();
    include('../../config/config.php');
    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "Select * from users where UserEmail = '$email' and UserPassword = '$password' LIMIT 1";
        $result =mysqli_query($connection,$sql) or die ($connection->error);
        if (mysqli_fetch_array($result)> 0){
            header('Location: ../../admin/index.php');
            exit(0);
        }else {
            $_SESSION['message'] = "Invalid Email or Password";
            header('Location: login.php');
            exit(0);
        }
    } else {
        header('Location: login.php');
        exit(0);
    }


?>