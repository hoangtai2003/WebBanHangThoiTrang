<?php
    session_start();
    require_once('../../config/config.php');
    require_once('../../mail/sendmail.php');
    if(isset($_POST['forgot_password_btn'])){
        $email = $_POST['email'];
        $sql = "select * from users where UserEmail = '".$email."'";
        $result = $connection->query($sql) or die ($connection->error);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $username = $row['UserName'];

            $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
            $newPassword_hash = md5($newPassword);
            $sqlUpdate = "update users set UserPassword = '".$newPassword_hash."' where UserEmail = '".$email."'";
            $resultUpdate = $connection->query($sqlUpdate);

            $title = "Cấp lại mật khẩu!";
            $content = "<p>Tài khoản: <b>".$username."</b></p>
                        <p>Mật khẩu mới của bạn là: <b>".$newPassword."</b></p>";
            $mail = new Mailer();
            $mail->forgot_password($title, $content, $email);
            $_SESSION['message'] = "Mật khẩu mới đã được gửi đến email của bạn! Vui lòng kiểm tra!" ;
            header('Location: forgot_password.php');
        }
        else{
            $_SESSION['message'] = "Email không tồn tại!" ;
            header('Location: forgot_password.php');
        }
        $connection->close();
    }else{
        header('Location: forgot_password.php');
    }
?>
