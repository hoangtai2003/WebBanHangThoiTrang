<?php
session_start();

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./myProduct.css">
    <title>Document</title>
</head>
<body>
    <?php
         include('../../config/config.php');
         include('../includes/header.php'); 
         include_once('../includes/navbar_top.php');
         include_once('../includes/sidebar.php');
        require_once('../../config/config.php');
       
    ?>
    <!-- container-product -->
    <div class="container">
        <div class="box-product-home box-home">
            <?php
            if (count($_REQUEST) > 0 && $_REQUEST["UserId"] != $_SESSION["UserId"]) {
                echo '<div class="header">
                        <h4>Cửa hàng của ' . $products[0]['username'] . '</h4>
                      </div>
                        <br>

                        <a href="../chatBox/Inbox.php?userID='.$_REQUEST["user_id"].'">
                            <button class="new-product">
                            <i class="fa-brands fa-facebook-messenger"></i></i> Chat ngay
                            </button>
                        </a>';
            } else {
                echo '<div class="header">
                            <h4>Cửa hàng của tôi</h4>
                        </div>
                        <br>
                        <a href="../createProduct/createproduct.php">
                            <button class="new-product">
                                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                            </button>
                        </a>
                        ';
            };
            ?>


            <div class="col-content lts-product">

                <?php

                for ($i = count($products) - 1; $i >= 0; $i--) {
                ?>
                    <div class="item">
                        <?php if (count($_REQUEST) <= 0) { ?>
                            <i class="fa-solid fa-ellipsis-vertical menu_my_product"></i>
                            <div class="product">
                                <div class="product-options">
                                    <span><i class="fa-solid fa-wrench"></i><a href="../UpdateProduct/UpdateProduct.php?id_product=<?php echo $products[$i]["id_product"] ?>">Sửa sản phẩm</a></span>
                                    <span><i class="fa-sharp fa-solid fa-trash"></i><a href="../DeleteProduct/DeleteProductAction.php?id_product=<?php echo $products[$i]["id_product"] ?>">Xóa sản phẩm</a></span>
                                </div>
                            </div>
                        <?php } ?>
                        <a href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $products[$i]["id_product"] ?>">

                            <div class="img">

                                <img class="img_product" src="<?php echo   $products[$i]["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $products[$i]["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" alt="Ảnh sản phẩm">

                            </div>


                            <div class="info">
                                <a class="title"><?php echo $products[$i]['name_product']; ?></a>
                                <span class="price">
                                    <s><strong><?php echo number_format($products[$i]['price_root']); ?>₫</strong></s>
                                    <strong><?php echo number_format($products[$i]['price']); ?>₫</strong>
                                </span>
                            </div>

                            <div class="note">

                                <span class="bag">KM</span>
                                <label><?php echo $products[$i]['total_sold']; ?> đã bán</label>
                            </div>
                        </a>

                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
        
</body>
</html>