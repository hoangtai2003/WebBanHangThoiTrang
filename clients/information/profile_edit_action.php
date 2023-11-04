<?php
session_start();
include('../../config/config.php');

if (isset($_POST['update_customer'])){
    $cus_id = $_POST['CusId'];
    $username = $_POST['new_username'];
    $name = $_POST['CusName'];
    $phone = $_POST['CusPhone'];
    $email = $_POST['CusEmail'];
    $birthday = $_POST['CusBirthday'];
    $gender = $_POST['CusGender'];
    if (strlen($username) < 10 ){
        $_SESSION['message'] = 'Tên đăng nhập phải có ít nhất 10 ký tự';
        header("Location: profile.php");
        exit(0);
    }
    // Kiểm tra trong cơ sở dữ liệu xem tên đăng nhập đã được sửa hay chưa
    $check_username_sql = "SELECT ChangeUserName FROM customer WHERE CusId = '$cus_id'";
    $check_username_result = mysqli_query($connection, $check_username_sql);
    $row = mysqli_fetch_assoc($check_username_result);

    if ($row['ChangeUserName'] == 0) {
        $sql = "SELECT CusEmail, CusUserName FROM customer WHERE (CusEmail = '$email' or CusUserName = '$username') AND (CusId != '$cus_id')";
        $result = mysqli_query($connection, $sql) or die ($connection->error);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "Email hoặc tên  đã tồn tại";
            header("Location: profile.php");
        } else {
            // Cho phép người dùng sửa tên đăng nhập và cập nhật has_changed_username thành 1
            $update_sql = "UPDATE customer SET CusUserName = '$username', ChangeUserName = 1 WHERE CusId = '$cus_id'";
            $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
        
            if ($update_result) {
                $_SESSION['message'] = "Cập nhật thành công";
                header('Location: profile.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Đã xảy ra sự cố";
                header('Location: profile.php');
                exit(0);
            }
        }
    }else {
        $sql = "UPDATE customer SET CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);

        if ($result) {
            $_SESSION['message'] = "Cập nhật thành công";
            header('Location: profile.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            header('Location: profile.php');
            exit(0);
        }
    }
}
?>
