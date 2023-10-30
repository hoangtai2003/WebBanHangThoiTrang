<?php
    session_start();
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
                                        <?php include('message.php') ?>
                                        <form action="./register_action.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" type="text" name="username" placeholder="Tên đăng nhập" />
                                                <label>Tên đăng nhập</label>
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
                                                <input required class="form-control" type="text" name="name" placeholder="Họ và tên" />
                                                <label>Họ và tên</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" type="email" name="email" placeholder="name@example.com" />
                                                <label>Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" type="text" name="phone" placeholder="Số điện thoại" />
                                                <label>Số điện thoại</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea required class="form-control" name="address" cols="30" rows="10" placeholder="Địa chỉ"></textarea>
                                                <label>Địa chỉ</label>
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
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../admin/js/scripts.js"></script>
    </body>
</html>