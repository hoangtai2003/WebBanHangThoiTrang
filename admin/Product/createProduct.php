<?php
session_start();
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
$sql = "select * from Categories";
$result = $connection->query($sql) or die($connection->connect_error);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Sản phẩm</li>
            <li class="breadcrumb-item active">Thêm sản phẩm</li>
        </ol>
        <div class="row">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Thêm sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form action="./createProductAction.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" name="product_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nhóm sản phẩm</label>
                                <br>
                                <select name="slCid" id="">
                                    <option value="">Chọn danh mục sản phẩm</option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["CateId"] . '">' . $row["CateName"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input required type="text" class="form-control" name="pname">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input required type="number" class="form-control" name="pquantity">
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input required type="number" class="form-control" name="pprice">
                            </div>
                            <div class="form-group">
                                <label>Giá đã được giảm giá</label>
                                <input required type="number" class="form-control" name="ppricesale">
                            </div>
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <br>
                                <input type="file" name="pimage">
                            </div>
                            <div class="form-group">
                                <label>Ảnh mô tả</label>
                                <br>
                                <input type="file" name="pimages[]" multiple>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea required type="password" class="form-control" name="pdesc"></textarea>
                            </div>
                            <input name="add_product" value="Gửi đi" type="submit" class="btn btn-primary mt-2">
                            <a href="myProduct.php" class="btn btn-danger mt-2">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../includes/footer.php');
    ?>
</body>

</html>