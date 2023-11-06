<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['add_user'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = $_POST['rdstatus'];
        $password_hash = md5($password);
        // strpos: Tìm vị trí xuất hiện đầu tiên của chuỗi con trong chuỗi
        if (strpos($name, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            $_SESSION['message_type'] = 'warning';
            header("Location: user_add.php");
        } else {
            $sql = "SELECT UserName, UserEmail from user where  UserEmail = '$email' or UserName ='$name'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Tên hoặc Email đã tồn tại";
                $_SESSION['message_type'] = 'warning';
                header("Location: user_add.php");
            } else {
                $sql = "Insert into user(UserName, UserEmail, UserPassword, UserStatus) values ('$name', '$email', '$password_hash', '$status')";
                $result = mysqli_query($connection, $sql);
                $connection->close();
                if ($result){
                    $_SESSION['message'] = 'Thêm nhân viên thành công';
                    $_SESSION['message_type'] = 'success';
                    header('Location: user_list.php');
                    exit(0);
                }else {
                    $_SESSION['message'] = 'Đã xảy ra sự cố';
                    $_SESSION['message_type'] = 'error';
                    header('Location: user_list.php');
                    exit(0);
                }
            }
        } 
    }

?>