<?php 
    include ('../config/config.php');
    if (isset($_POST['register_btn'])){
        // Hàm mysqli_real_escape_string được sử dụng để tạo một chuỗi SQL hợp pháp có thể được sử dụng trong câu lệnh SQL
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($connection, $_POST['cpassword']);
        if ($password == $confirm_password){
            $sql = "SELECT email from users where email = '$email'";
            $result = mysqli_query($connection, $result);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Already email Exists";
                header("Location: register.php");
            } else {
                $user_query = "INSERT INTO users (UserName, UserEmail, UserPassword) values($name, $email, $password)";
                $user_query_run = mysqli_query($connection, $user_query);
                if ($user_query)
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
    } else {
        header("Location: register.php");
    }
?>