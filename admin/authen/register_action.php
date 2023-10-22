<?php 
    session_start();
    require_once ('../../config/config.php');
    if (isset($_POST['register_btn'])){
        $name = $_POST['name'];
        $email = test_input($_POST['email']);
        $password = $_POST['password'];
        $password_hash = md5($password);
        $confirm_password = $_POST['cpassword'];

        if (strpos($name, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: register.php");
            exit();
        }
        else{
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if ($password === $confirm_password){
                    $sql = "SELECT UserName, UserEmail from user where UserName = '".$name."' or UserEmail = '".$email."'";
                    $result = $connection->query($sql) or die ($connection->error);
                    if ($result->num_rows > 0){
                        $_SESSION['message'] = "Already UserName or Email Exists";
                        header("Location: register.php");
                        exit();
                    } else {
                        $user_query = "INSERT INTO user (UserName, UserEmail, UserPassword) values('".$name."','". $email."','" .$password_hash."')";
                        $user_query_run = $connection->query($user_query);
                        $connection->close();
                        if ($user_query_run)
                        {
                            $_SESSION['message'] = "Regitered Successfully";
                            header("Location: login.php");
                            exit();
                        } else {
                            $_SESSION['message'] = "Something went wrong";
                            header( "Location: register.php");
                            exit();
                        }
                    }
                } else {
                    $_SESSION['message'] = 'Password and ConfirmPassword does not Match';
                    header("Location: register.php");
                    exit();
                }
            }
            else{
                $_SESSION['message'] = 'Email không hợp lệ';
                header("Location: register.php");
                exit();
            }
        }
        $connection->close();
    } else {
        header("Location: register.php");
        exit();
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>