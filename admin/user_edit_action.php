<?php
    include('../config/config.php');
    if (isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $sql = "Update users set UserName = '$name', UserEmail = '$email', UserPassword = '$password_hash' where UserId = '$user_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);
        $connection->close();
        if ($result){
            $_SESSION['message'] = "Updated Successfully";
            header('Location: user_list.php');
            exit(0);
        }
    }
?>