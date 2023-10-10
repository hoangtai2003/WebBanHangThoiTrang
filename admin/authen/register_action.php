<?php 
    session_start();
    require_once ('../../config/config.php');
    if (isset($_POST['register_btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['cpassword'];
        if ($password === $confirm_password){
            $sql = "SELECT UserName, UserEmail from users where UserName = '".$name."' or UserEmail = '".$email."'";
            $result = $connection->query($sql) or die ($connection->error);
            if ($result->num_rows > 0){
                $_SESSION['message'] = "Already UserName or Email Exists";
                header("Location: register.php");
            } else {
                $user_query = "INSERT INTO users (UserName, UserEmail, UserPassword) values('".$name."','". $email."','" .$password."')";
                $user_query_run = $connection->query($user_query);
                if ($user_query_run)
                {
                    $_SESSION['message'] = "Regitered Successfully";
                    header("Location: login.php");
                } else {
                    $_SESSION['message'] = "Something went wrong";
                    header( "Location: register.php");
                }
            }
        } else {
            $_SESSION['message'] = 'Password and ConfirmPassword does not Match';
            header("Location: register.php");
        }
    } else {
        header("Location: register.php");
    }
?>