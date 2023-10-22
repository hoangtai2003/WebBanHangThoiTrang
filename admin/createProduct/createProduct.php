<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
$sql = "select * from Category";
$result = $connection->query($sql) or die($connection->connect_error);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="./createProduct.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

</head>
<body>
    <div class="container-new-product">
        <a href="../myProduct/myProduct.php" class="back-button">
            <i class="fas fa-home"></i>
        </a>
        <form class="form-create-product" action="./createProductAction.php" method="post" enctype="multipart/form-data">
            <span>
                <div class="form-container">
                    <h1>Tạo sản phẩm mới</h1>
                    <label for="product_type_input">Loại hàng:</label>
                    <select name="slCid" id="">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["CateId"] . '">' . $row["CateName"] . '</option>';
                        }
                        ?>
                    </select>
                    <!-- <label for="product_sale_name">Tình trạng sale:</label>
                    <select id="product_sale_select">
                        <option value="">Chọn tình trạng sale</option>
                        <option value="1">Đang sale</option>
                        <option value="0">Hết sale</option>
                    </select>
                    <label for="product_hot_name">Tình trạng hot:</label>
                    <select id="product_hot_select">
                        <option value="">Chọn tình trạng hot</option>
                        <option value="1">Đang hot</option>
                        <option value="0">Hết hot</option>
                    </select>
                    <label for="product_status_name">Tình trạng status:</label>
                    <select id="product_status_select">
                        <option value="">Chọn tình trạng sản phẩm</option>
                        <option value="1">Đang bán</option>
                        <option value="0">Hết hàng</option>
                    </select> -->
                    <script>
                        const updateInput = () => {
                            var select = document.getElementById("product_type_select");
                            var inputCategory = document.getElementById("product_type_input");
                            inputCategory.value = select.value;
                        }
                    </script>

                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" placeholder="Tên sản phẩm không quá 255 kí tự" id="product_name" name="product_name">

                    <label for="product_quantity">Số lượng:</label>
                    <input type="number" id="product_quantity" name="product_quantity">
                    <div class="price-container">
                        <div class="price-input">
                            <label for="product_price">Giá gốc:</label>
                            <input type="number" placeholder="Giá sản phẩm không vượt quá 1 tỷ đồng" id="product_price" name="product_price">
                        </div>
                        <div class="price-input">
                            <label for="product_sale_price">Giá đã được giảm giá:</label>
                            <input type="number" placeholder="Giá sản phẩm không vượt quá 1 tỷ đồng" id="product_sale_price" name="product_sale_price">
                        </div>
                    </div>
                </div>
                <div class="upload-container">
                    <label for="input-img" class="preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Chọn tệp cho sản phẩm (<1MB JPEG/JPG/PNG)</span>
                                <input type="file" name="txtPimage" hidden id="input-img" />
                                <img alt="" class="img_preview">
                    </label>
                </div>
            </span>

            <label for="product_desc">Mô tả:</label>
            <textarea id="product_desc" name="product_desc"></textarea>
            <input type="submit" value="Thêm sản phẩm">
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