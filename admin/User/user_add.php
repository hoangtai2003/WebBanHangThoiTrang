<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php')
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
    </ol>
    <div class="row">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Thêm nhân viên</h4>
                </div>
                <div class="card-body">
                    <form action="user_add_action.php" method="POST">
                        <div class="form-group">
                            <input hidden type="text" name="user_id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tên người dùng</label>
                            <input required type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input required type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" checked type="radio" name="rdstatus" id="rdstatus1" value=1>
                                <label class="form-check-label" for="rdstatus1">Hoạt động</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rdstatus" id="rdstatus0" value=0>
                                <label class="form-check-label" for="rdstatus0">Ngừng hoạt động</label>
                            </div>
                        </div>
                        <button name="add_user" class="btn btn-primary mt-2">Gửi đi</button>
                        <a href="user_list.php" class="btn btn-danger mt-2">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>