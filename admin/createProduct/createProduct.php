<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sản Phẩm Mới</title>
   <link rel="stylesheet" href="./createProduct.css">
</head>

<body>
<div class="container-new-product">
        <form class="form-create-product" action="./createproductaction.php" method="post" enctype="multipart/form-data">
            <span>
                <div class="form-container">
                    <h1>Tạo sản phẩm mới</h1>
                    <label for="product_type_input">Loại hàng:</label>
                    <input type="text" id="product_type_input" placeholder="Sử dụng gợi ý sẽ dễ dang tiếp cận khách hàng hơn" name="product_type">
                    <select id="product_type_select" onchange="updateInput()">
                        <option value="">Gợi ý loại hàng</option>
                        <?php # for ($i = 0; $i < count($category); $i++) { ?>
                            <option value="Điện thoại thông minh">Điện thoại thông minh</option>
                            <option value="Laptop, Máy tính cá nhân">Laptop, Máy tính cá nhân</option>
                            <option value="Thiết bị gia dụng">Thiết bị gia dụng</option>
                            <option value="<?php # echo $category[$i]["category"] ?>"><?php # echo $category[$i]["category"] ?></option>
                        <?php # }   ?>
                    </select>

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
                        <input type="file" name="img_post" hidden id="input-img" />
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
            // let img = document.createElement('img')
            // img.className = "img_preview"
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