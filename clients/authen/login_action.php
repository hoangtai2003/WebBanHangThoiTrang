<?php
    session_start();
    require_once('../../config/config.php');

    if (isset($_POST['login_btn'])){
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_hash = md5($password);

        $sql = "select * from Customer where BINARY CusPhone = '".$phone."' and CusPassword = '".$password_hash."'";
        $result = $connection->query($sql) or die ($connection->error);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cusid = $row["CusId"];
            $_SESSION['cusid'] = $cusid; //lưu id khách hàng
            $name = $row['CusName'];
            $_SESSION['name'] = $name;//lưu tên khách hàng
            $email = $row['CusEmail'];
            $_SESSION['email'] = $email;//lưu email
            $phone = $row['CusPhone'];
            $_SESSION['phone'] = $phone;//lưu số điện thoại
            $address = $row['CusAddress'];
            $_SESSION['address'] = $address;//lưu địa chỉ
            $connection->close();
            $_SESSION['cus_loggedin'] = true;//đăng nhập thành công
            header("Location: ../index/index.php"); // Chuyển hướng đến trang dashboard hoặc trang chính sau khi đăng nhập thành công
            exit();
        } else {
            $_SESSION['message'] = "Thông tin đăng nhập không chính xác!";
            header("Location: ./login.php"); // Chuyển hướng về trang đăng nhập nếu đăng nhập không thành công
            exit();
        }
    } else {
        header("Location: ./login.php");
        exit();
    }

?>