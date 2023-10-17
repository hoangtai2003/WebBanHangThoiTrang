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
            <div class="header">
                <h4>Cửa hàng của tôi</h4>
            </div>
            <br>
            <a href="../createProduct/createproduct.php">
                <button class="new-product">
                    <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                </button>
            </a>
        </div>
    </div>

</body>

</html>