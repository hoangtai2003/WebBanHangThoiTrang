<?php
    session_start();
    include('../config/config.php');
    if (isset($_POST['add_user'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = md5($password);
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

?>