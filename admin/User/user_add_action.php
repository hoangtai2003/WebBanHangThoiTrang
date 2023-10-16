<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['add_user'])){
        $name = $_POST['name'];
        $email = test_input($_POST['email']);
        $password = $_POST['password'];
        $password_hash = md5($password);
        if (strpos($name, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: user_add.php");
            exit();
        }
        else{
            $sql = "SELECT UserName, UserEmail from users where  UserEmail = '$email' or UserName ='$name'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Already Username or Email Exists";
                header("Location: user_add.php");
                exit();
            } else {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $sql = "Insert into users(UserName, UserEmail, UserPassword) values('$name', '$email', '$password_hash')";
                    $result = mysqli_query($connection, $sql);
                    $connection->close();
                    if ($result){
                        $_SESSION['message'] = 'Add successfully';
                        header('Location: user_list.php');
                        exit(0);
                    }else {
                        $_SESSION['message'] = 'Something went wrong';
                        header('Location: user_list.php');
                        exit(0);
                    }
                }
                else{
                    $_SESSION['message'] = 'Email is Invalid';
                    header('Location: user_add.php');
                    exit(0);
                }
            }
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>