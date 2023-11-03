<?php 
    session_start();
    require_once ('../../config/config.php');
    if (isset($_POST['register_btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $confirm_password = $_POST['cpassword'];
        $name = $_POST['name'];
        $email = test_input($_POST['email']);
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if (strpos($username, ' ') !== false || strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: ./register.php");
            exit();
        }
        else{
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if ($password === $confirm_password){
                    $sql = "SELECT CusUserName, CusEmail, CusPhone from Customer where CusUserName = '".$name."' or CusEmail = '".$email."' or CusPhone = '".$phone."'";
                    $result = $connection->query($sql) or die ($connection->error);
                    if ($result->num_rows > 0){
                        $_SESSION['message'] = "Tên đăng nhập hoặc Email hoặc Số điện thoại đã tồn tại!";
                        header("Location: ./register.php");
                        exit();
                    } else {
                        $user_query = "INSERT INTO Customer (CusUserName, CusEmail, CusPassword, CusName, CusPhone, CusAddress) values('".$username."','". $email."','" .$password_hash."', '".$name."', '".$phone."', '".$address."')";
                        $user_query_run = $connection->query($user_query);
                        $connection->close();
                        if ($user_query_run)
                        {
                            $_SESSION['message'] = "Đăng ký thành công";
                            header("Location: ./login.php");
                            exit();
                        } else {
                            $_SESSION['message'] = "Xảy ra lỗi!";
                            header( "Location: ./register.php");
                            exit();
                        }
                    }
                } else {
                    $_SESSION['message'] = 'Nhập lại mật khẩu chưa chính xác!';
                    header("Location: ./register.php");
                    exit();
                }
            }
            else{
                $_SESSION['message'] = 'Email không hợp lệ';
                header("Location: ./register.php");
                exit();
            }
        }
        $connection->close();
    } else {
        header("Location: ./register.php");
        exit();
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>