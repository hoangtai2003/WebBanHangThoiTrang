<?php
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: ../home/index.php");
        exit();
    }
    include('../../helpers/function.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="../assets/css/login.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css/toastr.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <form method="post" action="login_action.php">
                <h1>Đăng nhập</h1>
                <div class="input-box">
                    <input required name="name" type="text" placeholder="Tên đăng nhập"/>
                    <i class="fas fa-user"></i>
                </div>
                <div class="input-box">
                    <input required name="password" type="password" placeholder="Mật khẩu"/>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Quên mật khẩu</a>
                </div>
                <button type="submit" class="btn" name="login_btn">Đăng nhập</button>
                <div class="register-link">
                    <p>Chưa có tài khoản?<a href="./register.php"> Đăng ký</a></p>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./../assets/js/scripts.js"></script>
        <script src="../assets/js/jquery-3.7.1.min.js"></script>
        <script src="../assets/js/toastr.min.js"></script>
        <script src="../assets/js/toastr.js"></script>
        <script>
            <?php if (isset($_SESSION['message'])) : ?>
                <?php
                    $message = flash('message');
                    $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
                ?>
                toastr.<?php echo $message_type; ?>("<?php echo $message; ?>");
            <?php endif; ?>
        </script>
    </body>
</html>