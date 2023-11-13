<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php')
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Danh mục</li>
        <li class="breadcrumb-item active">Thêm danh mục</li>
    </ol>
    <div class="row">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Thêm danh mục</h4>
                </div>
                <div class="card-body">
                    <form action="createCategoryAction.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input hidden type="text" name="category_id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" name="txtCatename" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" rows="5" cols="90" name="taCatedesc"> </textarea>
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
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="fimage" id="input-img">
                            <img style="margin-top: 10px;" class="img_preview" width="300px">
                        </div>
                        <button name="add_category" class="btn btn-primary mt-2">Gửi đi</button>
                        <a href="myCategory.php" class="btn btn-danger mt-2">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>
