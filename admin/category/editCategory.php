<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
$CateId = $_REQUEST['CateId'];
$sql = "select * from categories where CateId = ".$CateId;
	$result = $connection->query($sql) or die($connection->error);
	if ($result->num_rows==0){

		header("Location:../myCategory/myCategory.php");
	} else {
		$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>DANH MỤC</title>
    <link rel="stylesheet" href="./editProduct.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

</head>

<body>

    <div class="container-new-product">
       
        <a href="./myCategory.php" class="back-button">
            <i class="fas fa-home"></i>
        </a>
        <form class="form-create-product" action="./editCategoryAction.php?CateId=<?php echo $CateId ?>" method="post" enctype="multipart/form-data" style="margin: 0 auto; text-align: center">
            <span>
                <div class="form-container" >
                    <h1>Chỉnh sửa danh mục</h1>
                        <input type="hidden" name="txtCateId" value="<?php echo $row['CateId']; ?>">
                        <label for="product_name">Tên danh mục:</label>
                        <input type="text" placeholder="Tên danh mục không quá 255 kí tự" value="<?php echo $row['CateName'] ?>" id="category_name" name="txtCateName">
                        
                        </div>
                <div class="upload-container" style="margin: 0 auto;">
                    <label for="input-img" class="preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Chọn tệp cho danh mục</span> <br>
                                <input type="file" name="txtCateimage" hidden id="input-img" />
                                <img alt="" class="img_preview" src="../../images/<?php echo $row['CateImage'] ?>">
                    </label>
                </div>
                
            </span>
            <label for="category_desc">Mô tả:</label>
            <textarea id="category_desc" name="taCatedesc"><?php echo $row['CateDescription'] ?></textarea>
            <?php } ?>
            <br>
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