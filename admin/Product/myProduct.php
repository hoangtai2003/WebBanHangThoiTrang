<?php
session_start();
include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
?>
<!-- container-product -->
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Sản phẩm</li>
        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
    </ol>
    <div class="Prod">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách sản phẩm</h4>
                    <?php if (checkPrivilege('createProduct.php')) { ?>
                        <a href="./createProduct.php" class="btn btn-primary float-end">
                            <i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm sản phẩm
                        </a>
                    <?php } ?>
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
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Tình trạng sale</th>
                                <?php if (checkPrivilege('editProduct.php?ProdId=0')) { ?>
                                    <th scope="col">Sửa sản phẩm</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../OffsetPagination/offset.php");
                            // $sql = "Select a.*, b.CateName from product a inner join categories  b on a.CateId = b.CateId order by ProdId asc limit ".$item_per_page." offset ".$offset."";
                            $sql = "SELECT a.*, b.CateName, IFNULL(c.TotalOrders, 0) AS TotalOrders
                                FROM product a
                                INNER JOIN categories b ON a.CateId = b.CateId
                                LEFT JOIN (
                                    SELECT ProdId, sum(OrdQuantity) AS TotalOrders
                                    FROM orderdetail
                                    GROUP BY ProdId
                                ) c ON a.ProdId = c.ProdId
                                ORDER BY a.ProdId ASC
                                LIMIT $item_per_page OFFSET $offset;";
                            $result = mysqli_query($connection, $sql);

                            // $sqlProductSold = "SELECT ProdId, COUNT(*) AS TotalOrders
                            // FROM orderdetail
                            // GROUP BY ProdId";
                            // $totalSold = mysqli_query($connection, $sqlProductSold);
                            // $dataSold = mysqli_fetch_array($totalSold);
                            // var_dump($dataSold);

                            $totalRecords = mysqli_query($connection, "select * from product");
                            $totalRecords = $totalRecords->num_rows;
                            // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                            $totalPage = ceil($totalRecords / $item_per_page);
                            if (mysqli_fetch_array($result) > 0) {
                                foreach ($result as $Prod) {
                            ?>
                                    <tr>
                                        <td><?= $Prod['ProdId']; ?></td>
                                        <td><?= $Prod['ProdName']; ?></td>
                                        <td style="max-width: 150px"><img style="width: 100%;" src="../../images/<?= $Prod['ProdImage']; ?>" alt=""></td>
                                        <td><?= $Prod['ProdPrice']; ?></td>
                                        <td><?= $Prod['ProdPriceSale']; ?></td>
                                        <td><?= $Prod['ProdQuantity'] - $Prod["TotalOrders"] ?></td>
                                        <td><?= $Prod['TotalOrders'] ?></td>
                                        <td><?= $Prod['CateName']; ?></td>
                                        <td><?php
                                            if ($Prod['ProdStatus'] == 0) {
                                                echo "Dừng kinh doanh";
                                            } else if ($Prod['ProdStatus'] == 1) {
                                                echo "Đang bán";
                                            }
                                            ?></td>
                                        <td><?php
                                            if ($Prod['ProdIsSale'] == 0) {
                                                echo "Hết sale";
                                            } else if ($Prod['ProdIsSale'] == 1) {
                                                echo "Đang sale";
                                            }
                                            ?></td>
                                        <?php if (checkPrivilege('editProduct.php?ProdId=0')) { ?>
                                            <td>
                                                <a href="./editProduct.php?ProdId=<?= $Prod['ProdId'] ?>" class="btn btn-success">
                                                    <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php include("../../pagination/pagination.php") ?>
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