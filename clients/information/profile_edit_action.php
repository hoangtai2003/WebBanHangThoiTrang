<?php
session_start();
include('../../config/config.php');
$target_dir = "../upload/";
$uploadOk = true;
if (isset($_POST['update_customer'])){
    $cus_id = $_POST['CusId'];
    $username = $_POST['new_username'];
    $name = $_POST['CusName'];
    $phone = $_POST['CusPhone'];
    $email = $_POST['CusEmail'];
    $birthday = $_POST['CusBirthday'];
    $gender = $_POST['CusGender'];
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
            if (strlen($username) < 10 ){
                $_SESSION['message'] = 'Tên đăng nhập phải có ít nhất 10 ký tự';
                
                header("Location: profile.php");
                exit(0);
            } else {
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
                // Cho phép người dùng sửa tên đăng nhập và cập nhật has_changed_username thành 1
            }
        }
    }else {
        if (isset($_FILES['fimage']) && !empty($_FILES['fimage']['name'])) {
            $file_name = $_FILES['fimage']['name'];
            $file_path = $target_dir . $file_name;
            
            if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
                // Cập nhật cơ sở dữ liệu với tên tệp mới
                $sql = "UPDATE customer SET slname = '$name', sldescription = '$description', slimage = '$file_name' WHERE slid = '$slider_id'";
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
            } else {
                $_SESSION['message'] = "Không thể tải lên tệp hình ảnh mới.";
                
                $uploadOk = false;
                header("Location: profile.php");
            }
        }
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
