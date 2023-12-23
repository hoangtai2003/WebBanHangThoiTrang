<?php
session_start();
require_once('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');

$ProdId = $_REQUEST['ProdId'];

// Lấy thông tin sản phẩm
$sqlProd = "SELECT * FROM product where ProdId = $ProdId";
$product = mysqli_query($connection, $sqlProd);
$dataProduct = mysqli_fetch_assoc($product);


// lấy thông tin sanh mục
$sqlCate = "SELECT * FROM categories";
$category = mysqli_query($connection, $sqlCate);

// lấy ra ảnh mô tả sản phẩm
$sqlImgProd = "select * from productimage where ProdId = $ProdId";
$imgProd = mysqli_query($connection, $sqlImgProd);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="./editProduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>

<body>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Sản phẩm</li>
            <li class="breadcrumb-item active">Sửa sản phẩm</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Sửa sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form action="./editProductAction.php?ProdId=<?php echo $ProdId ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" name="product_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nhóm sản phẩm</label>
                                <br>
                                <select name="slCid" id="slCid">
                                    <?php
                                    foreach ($category as $key => $value) { ?>
                                        <option value="<?php echo $value['CateId'] ?>" <?php echo (($value['CateId'] == $dataProduct["CateId"]) ? 'selected' : '') ?>> <?php echo $value["CateName"] ?></option>
                                    <?php } ?>
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="OldCateId" value="<?php echo $dataProduct['CateId']; ?>">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input required type="text" class="form-control" value="<?php echo $dataProduct['ProdName'] ?>" name="pname">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" style="pointer-events: none; background-color: #ccc;" class="form-control" value="<?php echo $dataProduct['ProdQuantity'] ?>" name="pquantity">
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập thêm</label>
                                <input required type="number" min="0" oninput="validateInput(event)" class="form-control" value="<?php echo $dataProduct['ProdAddQuantity'] ?>" name="paddquantity">
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input required type="number" min="0" oninput="validateInput(event)" class="form-control" value="<?php echo $dataProduct['ProdPrice'] ?>" name="pprice">
                            </div>
                            <div class="form-group">
                                <label>Giá đã được giảm giá</label>
                                <input required type="number" min="0" oninput="validateInput(event)" class="form-control" value="<?php echo $dataProduct['ProdPriceSale'] ?>" name="ppricesale">
                            </div>
                            <div class="form-group">
                                <label>Tình trạng sản phẩm</label>
                                <br>
                                <input type="radio" <?php if ($dataProduct["ProdStatus"] == 1) echo "checked"; ?> name="rdProdStatus" value=1>Đang bán
                                <input type="radio" <?php if ($dataProduct["ProdStatus"] == 0) echo "checked"; ?> name=rdProdStatus value=0>Dừng kinh doanh
                            </div>
                            <div class="form-group">
                                <label>Tình trạng sale</label>
                                <br>
                                <input type="radio" <?php if ($dataProduct["ProdIsSale"] == 1) echo "checked"; ?> name="rdProdIsSale" value=1>Đang sale
                                <input type="radio" <?php if ($dataProduct["ProdIsSale"] == 0) echo "checked"; ?> name=rdProdIsSale value=0>Hết sale
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="pimage" id="input-img">
                                    <input type="hidden" name="current_image" value="<?= $dataProduct['ProdImage'] ?>">
                                    <img style="width: 100px;" src="../upload/<?= $dataProduct['ProdImage'] ?>" width="760" class="img_preview">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh mô tả</label>
                                <br>
                                <input type="file" name="pimages[]" multiple>
                                <br>
                                <div class="row">
                                    <?php foreach ($imgProd as $key => $value) {
                                        if (!empty($value["Image"])) { ?>
                                            <div class="col-md-4">
                                                <a href="">
                                                    <img src="../upload/<?php echo $value['Image'] ?>" alt="" style="min-height: 100px; height: 100px; width: 100px; margin-bottom: 10px; max-width: 100px; object-fit: cover;">
                                                </a>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea required type="password" class="form-control" name="pdesc"><?php echo $dataProduct['ProdDescription'] ?></textarea>
                            </div>
                            <input name="add_product" value="Cập nhật" type="submit" class="btn btn-primary mt-2">
                            <a href="myProduct.php" class="btn btn-danger mt-2">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../includes/footer.php');
    ?>
    <script src="../../admin/assets/js/validateInput.js">

    </script>
</body>

</html>