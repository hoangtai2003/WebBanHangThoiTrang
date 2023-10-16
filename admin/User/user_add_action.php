<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['add_user'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        if (strpos($name, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: user_add.php");
        } else {
            $sql = "SELECT UserName, UserEmail from users where  UserEmail = '$email' or UserName ='$name'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Already email Exists";
                header("Location: user_add.php");
            } else {
                $sql = "Insert into users(UserName, UserEmail, UserPassword) values ('$name', '$email', '$password_hash')";
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
        } 
    }

?>