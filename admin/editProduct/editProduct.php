<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
$ProdId = $_REQUEST['ProdId'];
$sqlProd = "SELECT a.*, b.* FROM product a INNER JOIN category b ON a.CateId = b.CateId WHERE a.ProdId = ?";
$stmt = $connection->prepare($sqlProd);
$stmt->bind_param("i", $ProdId);
$stmt->execute();
$resultProd = $stmt->get_result();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="./editProduct.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

</head>

<body>

    <div class="container-new-product">
        <a href="../myProduct/myProduct.php" class="back-button">
            <i class="fas fa-home"></i>
        </a>
        <form class="form-create-product" action="../editProduct/editProductAction.php?ProdId=<?php echo $ProdId ?>" method="post" enctype="multipart/form-data">
            <span>
                <div class="form-container">
                    <h1>Chỉnh sửa sản phẩm</h1>

                    <label for="product_type_input">Loại hàng:</label>
                    <select name="slCid" id="slCid">
                        <?php
                        $sqlCate = "SELECT * from category";
                        $resultCate = $connection->query($sqlCate);
                        if ($resultCate) {
                            while ($row = $resultCate->fetch_assoc()) {
                                echo '<option value="' . $row["CateId"] . '">' . $row["CateName"] . '</option>';
                            }
                        } else {
                            echo 'Lỗi khi truy vấn dữ liệu loại hàng.';
                        }
                        ?>
                    </select>

                    <?php if ($resultProd->num_rows > 0) {
                        $ProdRow = $resultProd->fetch_assoc();
                    ?>
                        <script>
                            const selectCate = document.querySelectorAll("#slCid option");
                            const selectedCategoryId = <?= $ProdRow["CateId"] ?>;

                            selectCate.forEach(element => {
                                if (element.value == selectedCategoryId) {
                                    element.selected = true;
                                }
                            });
                        </script>
                        <input type="hidden" name="OldCateId" value="<?php echo $ProdRow['CateId']; ?>">
                        <label for="product_name">Tên sản phẩm:</label>
                        <input type="text" placeholder="Tên sản phẩm không quá 255 kí tự" value="<?php echo $ProdRow['ProdName'] ?>" id="product_name" name="ProdName">
                        <label for="product_quantity">Số lượng:</label>
                        <input type="number" value="<?php echo $ProdRow['ProdQuantity'] ?>" id="product_quantity" name="ProdQuantity">
                        <div class="price-container">
                            <div class="price-input">
                                <label for="product_price">Giá gốc:</label>
                                <input type="number" value="<?php echo $ProdRow['ProdPrice'] ?>" placeholder="Giá sản phẩm không vượt quá 1 tỷ đồng" id="product_price" name="ProdPrice">
                            </div>
                            <div class="price-input">
                                <label for="product_sale_price">Giá đã được giảm giá:</label>
                                <input type="number" value="<?php echo $ProdRow['ProdPriceSale'] ?>" placeholder="Giá sản phẩm không vượt quá 1 tỷ đồng" id="product_sale_price" name="ProdPriceSale">
                            </div>
                        </div>
                </div>
                <div class="upload-container">
                    <label for="input-img" class="preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Chọn tệp cho sản phẩm</span>
                                <input type="file" name="ProdImage" hidden id="input-img" />
                                <img alt="" class="img_preview" src="../../images/<?php echo $ProdRow['ProdImage'] ?>">
                    </label>
                </div>
            </span>
            <label for="product_desc">Mô tả:</label>
            <textarea id="product_desc" name="ProdDescription"><?php echo $ProdRow['ProdDescription'] ?></textarea>
            <?php } ?>

            <input type="submit" value="Sửa">
        </form>
    </div>
    <script>
        const inputImg = document.querySelector('#input-img')
        inputImg.addEventListener('input', (e) => {
            let file = e.target.files[0]
            if (!file) return
            document.querySelector(".img_preview").src = URL.createObjectURL(file)
            document.querySelector("#avt_link_img").value = inputImg.value.substring(inputImg.value.lastIndexOf('\\') + 1);
            document.querySelector('.preview').appendChild(img)
        })

        window.onload = function() {
            openModal();
        }
    </script>
    <?php include('../includes/footer.php');
    ?>
</body>

</html>