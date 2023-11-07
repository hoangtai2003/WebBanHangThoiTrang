<?php
session_start();
if (isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true) {
    header("Location: ../index/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Đăng nhập</title>
    <link href="../../admin/assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Đăng nhập</h3>
                                </div>
                                <div class="card-body">
                                    <?php include('message.php') ?>
                                    <form method="post" action="./login_action.php">
                                        <div class="form-floating mb-3">
                                            <input required class="form-control" name="phone" type="text" placeholder="Số điện thoại" />
                                            <label for="inputEmail">Số điện thoại</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input required class="form-control" name="password" type="password" placeholder="Mật khẩu" />
                                            <label for="inputPassword">Mật khẩu</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="./forgot_password.php">Quên mật khẩu?</a>
                                            <button type="submit" class="btn btn-primary btn-block" name="login_btn">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="./register.php">Chưa có tài khoản? Đăng ký!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../admin/assets/js/scripts.js"></script>
</body>

</html>