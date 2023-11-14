<?php
    session_start();
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
        <title>Đăng ký</title>
        <link href="../../admin/assets/css/styles.css" rel="stylesheet" />
        <link href="../../admin/assets/css/toastr.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Đăng ký</h3></div>
                                    <div class="card-body">
                                        <form action="./register_action.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" type="text" name="phone" placeholder="Số điện thoại" />
                                                <label>Số điện thoại</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input required class="form-control" type="password" name="password" placeholder="Mật khẩu" />
                                                        <label >Mật khẩu</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input required class="form-control" type="password" name="cpassword" placeholder="Nhập lại mật khẩu" />
                                                        <label>Nhập lại mật khẩu</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" type="email" name="email" placeholder="name@example.com" />
                                                <label>Email</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="register_btn">Đăng ký</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="./login.php">Bạn đã có tài khoản? Đăng nhập</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../admin/js/scripts.js"></script>
        <script src="../../admin/assets/js/jquery-3.7.1.min.js"></script>
        <script src="../../admin/assets/js/toastr.min.js"></script>
        <script src="../../admin/assets/js/toastr.js"></script>
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
