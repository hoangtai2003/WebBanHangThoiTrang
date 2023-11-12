<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
$sql = "select * from category";
$result = $connection->query($sql) or die($connection->connect_error);

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        margin: 0 auto; 
        text-align: center;
    </style>
    <title>Thêm Danh Mục Mới</title>
    <link rel="stylesheet" href="./createCategory.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

</head>
<body>
    <div class="container-new-product" style="margin: 0 auto; text-align: center">
        <a href="../myCategory/myCategory.php" class="back-button">
            <i class="fas fa-home"></i>
        </a>
        
        <form class="form-create-product" action="./createCategoryAction.php" method="post" enctype="multipart/form-data">
            <span>
                <div class="form-container" >
                <h3 style="margin-top: 10px ; margin-left: 10px ;">THÊM DANH MỤC</h3>
                    <br>
                    <label for="category_name">Tên danh mục:</label>
                    <input type="text" placeholder="Tên danh mục không quá 255 kí tự" id="category_name" name="txtCatename">

                   
                       
                    </div>
                </div>
                <div class="upload-container" style="margin: 0 auto;">
                
                    <label for="input-img" class="preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Chọn tệp cho danh mục (<1MB JPEG/JPG/PNG)</span>
                                <input type="file" name="txtCateimage" hidden id="input-img" />
                                <img alt="" class="img_preview">
                    </label>
                </div>
            </span>

            <label for="category_desc">Mô tả:</label>
            <textarea id="category_desc" name="taCatedesc"></textarea>
            <input type="submit" value="Thêm danh mục">
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
