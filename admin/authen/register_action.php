<?php 
    session_start();
    include ('../../config/config.php');
    if (isset($_POST['register_btn'])){
        $name =  $_POST['name'];
        $email =  $_POST['email'];
        $password =  $_POST['password'];
        $password_hash = md5($password);
        $confirm_password =  $_POST['cpassword'];
        if ($password == $confirm_password){
            $sql = "SELECT UserEmail from users where UserEmail = '$email'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Already email Exists";
                header("Location: register.php");
            } else {
                $user_query = "INSERT INTO users (UserName, UserEmail, UserPassword) values('$name', '$email', '$password')";
                $user_query_run = mysqli_query($connection,$user_query);
                if ($user_query_run)
                {
                    $_SESSION['message'] = "Regitered Successfully";
                    header("Location: login.php");
                } else {
                    $_SESSION['message'] = "Something went wrong";
                    header("Location: register.php");
                }
            }
        } else {
            $_SESSION['message'] = 'Password and ConfirmPassword does not Match';
            header("Location: register.php");
        }
        $connection->close();
    } else {
        header("Location: register.php");
    }
    
?>