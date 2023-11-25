<?php
session_start();
include('../../config/config.php');
include('../../helpers/function.php');
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
        $_SESSION['message_type'] = 'warning';
        header("Location: profile.php");
    } else {
        if (isset($_FILES['fimage']) && !empty($_FILES['fimage']['name'])) {
            $file_name = $_FILES['fimage']['name'];
            $file_path = $target_dir . $file_name;

            if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
                // Thay đổi tên tệp ảnh trong cơ sở dữ liệu
                if ($update_username && strlen($username) >= 10){
                    $update_sql = "UPDATE customer SET CusImage = '$file_name', ChangeUserName = 1, CusUserName = '$username', ChangeImage = 1,  CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
                    $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
                    if ($update_result) {
                        $_SESSION['message'] = "Cập nhật thành công";
                        $_SESSION['message_type'] = 'success';
                        header('Location: profile.php');
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Đã xảy ra sự cố";
                        $_SESSION['message_type'] = 'error';
                        header('Location: profile.php');
                        exit(0);
                    }
                }
                $update_sql = "UPDATE customer SET CusImage = '$file_name', ChangeImage = 1, CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
                $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
                if ($update_result) {
                    $_SESSION['message'] = "Cập nhật thành công";
                    $_SESSION['message_type'] = 'success';
                    header('Location: profile.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    $_SESSION['message_type'] = 'error';
                    header('Location: profile.php');
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Không thể tải lên tệp hình ảnh mới.";
                $_SESSION['message_type'] = 'error';
                header('Location: profile.php');
                exit(0);
            }
        }

        $result = mysqli_query($connection, "select * from customer where CusId = '$cus_id'");
        $row = mysqli_fetch_assoc($result);
        if ($row['ChangeUserName'] == 0){
            if ($update_username) {
                if (strlen($username) >= 10){
                    $update_sql = "UPDATE customer SET CusUserName = '$username', ChangeUserName = 1, CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
                    $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
                    if ($update_result) {
                        $_SESSION['message'] = "Cập nhật thành công";
                        $_SESSION['message_type'] = 'success';
                        header('Location: profile.php');
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "Tên đăng nhập phải có ít nhất 10 ký tự.";
                    $_SESSION['message_type'] = 'warning';
                    header('Location: profile.php');
                    exit(0);
                }
            } else {
                $update_sql = "UPDATE customer SET CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
                $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
                if ($update_result) {
                    $_SESSION['message'] = "Cập nhật thành công";
                    $_SESSION['message_type'] = 'success';
                    header('Location: profile.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    $_SESSION['message_type'] = 'error';
                    header('Location: profile.php');
                    exit(0);
                }
            }
            
        }
        $update_sql = "UPDATE customer SET CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday', CusGender = '$gender' WHERE CusId = '$cus_id'";
        $update_result = mysqli_query($connection, $update_sql) or die($connection->error);
        if ($update_result) {
            $_SESSION['message'] = "Cập nhật thành công";
            $_SESSION['message_type'] = 'success';
            header('Location: profile.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            $_SESSION['message_type'] = 'error';
            header('Location: profile.php');
            exit(0);
        }
    }
}

?>
