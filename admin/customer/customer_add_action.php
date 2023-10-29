<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['add_customer'])){
        $name = $_POST['CusName'];
        $username = $_POST['CusUserName'];
        $phone = $_POST['CusPhone'];
        $email = $_POST['CusEmail'];
        $address = $_POST['CusAddress'];
        $birthday = $_POST['CusBirthday'];
        $gender = $_POST['rdGender'];
        if (strpos($username, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: customer_add.php");
        } else {
            $sql = "SELECT CusUserName, CusEmail from customers where  CusEmail = '$email' or CusUserName ='$username'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Tên người dùng hoặc Email đã tồn tại";
                header("Location: customer_add.php");
            } else {
                $sql = "Insert into customers(CusName, CusUserName, CusPhone, CusEmail, CusAddress, CusBirthday, CusGender) values ('$name','$username', '$phone','$email', '$address','$birthday', '$gender')";
                $result = mysqli_query($connection, $sql);
                $connection->close();
                if ($result){
                    $_SESSION['message'] = 'Thêm khách hàng thành công';
                    header('Location: customer_list.php');
                    exit(0);
                }else {
                    $_SESSION['message'] = 'Đã xảy ra sự cố';
                    header('Location: customer_list.php');
                    exit(0);
                }
            }
        }
    } 

?>