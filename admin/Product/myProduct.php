<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./myProduct.css"> -->
    <title>Document</title>
</head>

<body>
    <?php
    include('../../config/config.php');
    include('../includes/header.php');
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');

    ?>
    <!-- container-product -->
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Product</li>
            <li class="breadcrumb-item active">My product</li>
        </ol>
        <div class="Prod">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Product</h4>
                        <a href="./createProduct.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Add product</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Giá khuyến mại</th>
                                    <th scope="col">Tồn kho</th>
                                    <th scope="col">Đã bán</th>
                                    <th scope="col">Loại danh mục</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "Select a.*, b.CateName from product a inner join categories b on a.CateId = b.CateId";
                                $result = mysqli_query($connection, $sql);
                                if (mysqli_fetch_array($result) > 0) {
                                    foreach ($result as $Prod) {
                                ?>
                                        <tr>
                                            <td><?= $Prod['ProdId']; ?></td>
                                            <td><?= $Prod['ProdName']; ?></td>
                                            <td style="max-width: 150px"><img style="width: 100%;" src="../../images/<?= $Prod['ProdImage']; ?>" alt=""></td>
                                            <td><?= $Prod['ProdPrice']; ?></td>
                                            <td><?= $Prod['ProdPriceSale']; ?></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td><?= $Prod['CateName']; ?></td>
                                            <td><a href="./editProduct.php?ProdId=<?= $Prod['ProdId'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Edit</a></td>
                                            <td>
                                                <form action="./deleteProductAction.php?ProdId=<?= $Prod['ProdId'] ?>" method="POST">
                                                    <button type="submit" onclick="return confirm('Are you sure delete <?= $Prod['ProdName']; ?>?');" name="product_delete" class="btn btn-danger" value="<?= $Prod['ProdId']; ?>"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once('../includes/footer.php')
    ?>
</body>

</html>