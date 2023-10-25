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
                    <h4>Thêm thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <form action="customer_add_action.php" method="POST">
                        <div class="form-group">
                            <input hidden type="text" name="CusId" class="form-control" >
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Tên khách hàng</label>
                            <input required type="text" name="CusName" class="form-control">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Tên người dùng</label>
                            <input required type="text" class="form-control" name="CusUserName">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Phone number</label>
                            <input type="text" class="form-control" name="CusPhone">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Email khách hàng</label>
                            <input required type="email" class="form-control" name="CusEmail">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Địa chỉ khách hàng</label>
                            <input type="text" class="form-control" name="CusAddress">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" name="CusBirthday">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Giới tính</label>
                            <div class="form-check">
                                <input class="form-check-input"  type="radio" name="rdGender" id="rdGender1" value=1>
                                <label class="form-check-label" for="rdGender1">Nam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rdGender" id="rdGender0" value=0>
                                <label class="form-check-label" for="rdGender0">Nữ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rdGender" id="rdGender2" value=2>
                                <label class="form-check-label" for="rdGender2">Khác</label>
                            </div>
                        </div>
                        <button name="add_customer" class="btn btn-primary mt-2">Gửi đi</button>
                        <a href="customer_list.php" class="btn btn-danger mt-2">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>