<?php
    session_start();
    include('../../config/config.php');
    $target_dir = "../upload/";
    $uploadOk = true;
    if (isset($_POST['update_user'])){
        $user_id = $_POST['UserId'];
        $username = $_POST['UserName'];
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $address = $_POST['Address'];
        $gender = $_POST['UserGender'];
        $phone = $_POST['Phone'];
        $birthday = $_POST['UserBirthday'];
        if (strpos($username, ' ') !== false || strpos($email, ' ')){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            $_SESSION['message_type'] = 'warning';
            header("Location: profile.php?UserId=$user_id");
        }
        else{
            $sql = "SELECT UserName, UserEmail from user where  (UserEmail = '$email' or UserName ='$username') and UserId != '$user_id'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Email hoặc tên đã tồn tại";
                $_SESSION['message_type'] = 'warning';
                header("Location: profile.php?UserId=$user_id");
            } 
            else{
                if (isset($_FILES['fimage']) && !empty($_FILES['fimage']['name'])) {
                    $file_name = $_FILES['fimage']['name'];
                    $file_path = $target_dir . $file_name;
        
                    if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
                        // Thay đổi tên tệp ảnh trong cơ sở dữ liệu
                        $sql = "Update user set UserImage = '$file_name', ChangeImage = 1, UserName = '$username', HoTen = '$name', UserEmail = '$email', UserPhone = '$phone',  UserAddress = '$address', UserGender = '$gender', UserBirthday = '$birthday' where UserId = '$user_id'";
                        $result = mysqli_query($connection, $sql) or die($connection->error);
                        $connection->close();
                        if ($result){
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
                } else {
                    $sql = "Update user set  UserName = '$username', HoTen = '$name', UserEmail = '$email', UserPhone = '$phone',  UserAddress = '$address', UserGender = '$gender', UserBirthday = '$birthday' where UserId = '$user_id'";
                    $update_result = mysqli_query($connection, $sql) or die($connection->error);
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
        }
    }
?>
