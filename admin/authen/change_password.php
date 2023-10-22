<?php
    session_start();
    if(!isset($_SESSION['message_change'])){
        $_SESSION['message_change'] = "";
    }
    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
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
        <title>Change Password</title>
        <link href="./../assets/css/styles.css" rel="stylesheet" />
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Password</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="change_password_action.php">
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" name="old_password"  type="password" placeholder="Old Password" />
                                                <label for="inputPassword">Old Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" name="new_password"  type="password" placeholder="New Password" />
                                                <label for="inputPassword">New Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" name="cnew_password"  type="password" placeholder="New Confirm Password" />
                                                <label for="inputPassword">New Confirm Password</label>
                                            </div>
                                            <font color=red><?php echo $_SESSION['message_change'];?></font>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary btn-block" name="change_btn">Save</button>
                                                <a href="../../admin/index.php" class="btn btn-primary">Home</a>
                                            </div>
                                        </form>
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
        <script src="./../assets/js/scripts.js"></script>
    </body>
</html>
<?php
    unset($_SESSION['message_change']);
?>