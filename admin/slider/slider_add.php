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
                    <h4>Thêm slider</h4>
                </div>
                <div class="card-body">
                    <form action="slider_add_action.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input hidden type="text" name="slider_id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" rows="5" cols="90" name="sldescription"> </textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="fimage">
                        </div>
                        <button name="add_slider" class="btn btn-primary mt-2">Gửi đi</button>
                        <a href="slider_list.php" class="btn btn-danger mt-2">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>