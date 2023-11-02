<?php 
    session_start();
    require_once ('../../config/config.php');
    function generateRandomUsername($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $username = '';
        for ($i = 0; $i < $length; $i++) {
            // Chọn ký tự ngẫu nhiên từ chuỗi $characters bằng cách sủ dụng hàm rand và sau đó nối ký tự này vào biến $username
            // strlen dùng để đo độ dài của một chuỗi
            $username .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $username;
    }
    if (isset($_POST['register_btn'])){
        $username = generateRandomUsername();
        $password = $_POST['password'];
        $password_hash = md5($password);
        $confirm_password = $_POST['cpassword'];
        $email = test_input($_POST['email']);
        $phone = $_POST['phone'];

        if ( strpos($email, ' ') !== false || strpos($password, ' ') !== false){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: ./register.php");
            exit();
        }
        else{
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if ($password === $confirm_password){
                    $sql = "SELECT CusEmail, CusPhone from Customer where  CusEmail = '".$email."' or CusPhone = '".$phone."'";
                    $result = $connection->query($sql) or die ($connection->error);
                    if ($result->num_rows > 0){
                        $_SESSION['message'] = "Email hoặc Số điện thoại đã tồn tại!";
                        header("Location: ./register.php");
                        exit();
                    } else {
                        $user_query = "INSERT INTO Customer (CusEmail, CusPassword, CusPhone) values('". $email."','" .$password_hash."', '".$phone."')";
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