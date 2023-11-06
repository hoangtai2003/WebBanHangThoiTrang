<?php
session_start();
include('../../config/config.php');
$target_dir = "../upload/";
$uploadOk = true;
if (isset($_POST['update_customer'])) {
    $cus_id = $_POST['CusId'];
    $username = $_POST['new_username'];
    $name = $_POST['CusName'];
    $phone = $_POST['CusPhone'];
    $email = $_POST['CusEmail'];
    $birthday = $_POST['CusBirthday'];
    $gender = $_POST['CusGender'];

    $update_username = false; // Tạo biến để kiểm tra xem "username" đã thay đổi hay không

    // Kiểm tra xem "username" có thay đổi hay không
    $check_username_sql = "SELECT CusUserName FROM customer WHERE CusId = '$cus_id'";
    $check_username_result = mysqli_query($connection, $check_username_sql);
    $row = mysqli_fetch_assoc($check_username_result);
    $current_username = $row['CusUserName'];

    if ($username != $current_username) {
        $update_username = true; // "username" đã thay đổi
    }
    // Kiểm tra trong cơ sở dữ liệu xem "email" hoặc "username" đã tồn tại
    $sql = "SELECT CusEmail, CusUserName FROM customer WHERE (CusEmail = '$email' OR CusUserName = '$username') AND (CusId != '$cus_id')";

    $result = mysqli_query($connection, $sql) or die($connection->error);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Email hoặc tên đăng nhập đã tồn tại";
        header("Location: profile.php");
    } else {
        if ($update_username && strlen($username) >= 10) {
            $update_sql = "UPDATE customer SET CusUserName = '$username', ChangeUserName = 1,CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
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
        $update_sql = "UPDATE customer SET CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
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
}
?>
