<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_customer'])){
        $cus_id = $_POST['CusId'];
        $name = $_POST['CusName'];
        $username = $_POST['CusUserName'];
        $phone = $_POST['CusPhone'];
        $email = $_POST['CusEmail'];
        $address = $_POST['CusAddress'];
        $birthday = $_POST['CusBirthday'];
        $gender = $_POST['rdGender'];
        if (strpos($username, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: user_add.php");
        } else {
            $sql = "SELECT CusUserName, CusEmail from customers where  (CusEmail = '$email' or CusUserName ='$username') and CusId != '$cus_id'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Email hoặc tên đã tồn tại";
                header("Location: customer_edit.php?CusId=$cus_id");
            } 
            else{
                $sql = "Update customers set CusName = '$name',CusUserName = '$username', CusPhone = '$phone', CusEmail = '$email',CusAddress = '$address', CusBirthday = '$birthday',  CusGender = '$gender' where CusId = '$cus_id'";
                $result = mysqli_query($connection, $sql) or die($connection->error);
                $connection->close();
                if ($result){
                    $_SESSION['message'] = "Cập nhật thành công";
                    header('Location: customer_list.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    header('Location: customer_list.php');
                    exit(0);
                }
            }
        }
    }
?>
