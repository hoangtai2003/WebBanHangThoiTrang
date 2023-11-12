<?php
session_start();
require("../../config/config.php");
if (!isset($_SESSION["cus_loggedin"])) {
    header("Location: ../authen/login.php");
}

// unset($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Colo Shop Categories</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
    <link href="../assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/categories_styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/categories_responsive.css">
</head>

<body>

    <div class="super_container">

        <!-- Header -->
        <?php include_once("../includes/header.php") ?>

        <div class="fs_menu_overlay"></div>

        <!-- Hamburger Menu -->
        <?php include_once("../includes/hamburger_menu.php") ?>

        <div class="container product_section_container">
            <div class="row">
                <div class="col product_section clearfix">

                    <!-- Breadcrumbs -->

                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="../index/index.php">Home</a></li>
                            <li class="active"><a href="percharse_order.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Đơn mua</a></li>
                        </ul>
                    </div>
                    <?php include("../authen/message.php") ?>

                    <!-- Main Content -->
                    <?php
                    if (isset($_SESSION['cusid'])) {
                        $cusid = $_SESSION['cusid'];
                        //lấy thông tin bảng order
                        $sql_get_order = "SELECT * FROM orders WHERE CusId = '" . $cusid . "' ORDER BY OrderId DESC";
                        $result_get_order = $connection->query($sql_get_order);
                        if ($result_get_order->num_rows > 0) {
                            while ($row_get_order = $result_get_order->fetch_assoc()) {
                                $orderid = $row_get_order['OrderId'];
                                ?>

                                <div class="row">
                                    <div class="col-md-8" style="border-right: 1px solid black;">
                                        <h5><b style="color: brown;">Mã đơn hàng:</b> <?php echo "<b>" .$row_get_order['OrderCode'] ."</b>" ?></h5>
                                        <div class="d-flex align-items-center">
                                            <h5><b style="color: brown;">Trạng thái:</b>
                                                <?php
                                                    if($row_get_order['OrderStatus']==0){
                                                        echo '<b style="color: green;">Chờ xác nhận</b>';
                                                        ?>
                                                        <form action="./percharse_order_action.php?orderid=<?php echo $row_get_order['OrderId'] ?>" method="post" class="mt-3">
                                                        <input type="submit" onclick='return confirm("Bạn có chắc muốn hủy đơn hàng: <?php echo $row_get_order["OrderCode"] ?>")' name="huydonhang" value="Hủy đơn hàng" class="btn btn-sm btn-danger">
                                                        </form>
                                                        <?php
                                                    } else if ($row_get_order['OrderStatus']==1){
                                                        echo '<b style="color: green;">Đã được xác nhận</b>';
                                                    } else if ($row_get_order['OrderStatus']==2){
                                                        echo '<b style="color: green;">Đơn hàng đang được vận chuyển đến bạn</b>';
                                                    
                                                ?>
                                            </h5>
                                            <form action="./percharse_order_action.php?orderid=<?php echo $row_get_order['OrderId'] ?>" method="post" class="ml-auto">
                                                <input type="submit" name="danhanduochang" value="Đã nhận được hàng" class="btn btn-sm btn-primary">
                                            </form>
                                            <?php
                                                    } else if ($row_get_order['OrderStatus']== 3){
                                                        echo '<b style="color: green;">Hoàn thành! Đơn hàng đã được giao thành công</b>';
                                                    }
                                            ?>
                                        </div>
                                        
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Mã sản phẩm</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Hình ảnh</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //lấy thông tin chi tiết đơn hàng từ bảng orderdetail dựa trên orderid
                                                    $sql_get_order_detail = "SELECT * FROM orderdetail WHERE OrderId = '" . $orderid . "'";
                                                    $result_get_order_detail = $connection->query($sql_get_order_detail);

                                                    while ($row_get_order_detail = $result_get_order_detail->fetch_assoc()) {
                                                        //lấy thông tin sản phẩm từ bảng product dựa trên prodid
                                                        $prodid = $row_get_order_detail['ProdId'];
                                                        $quantity = $row_get_order_detail['OrdQuantity'];

                                                        $sql_get_product = "SELECT * FROM product WHERE ProdId = '" . $prodid . "'";
                                                        $result_get_product = $connection->query($sql_get_product);

                                                        if ($result_get_product->num_rows > 0) {
                                                            while ($row_get_product = $result_get_product->fetch_assoc()) {
                                                    ?>

                                                                <tr class="text-center">
                                                                    <td><?php echo $row_get_product['ProdId'] ?></td>
                                                                    <td><?php echo '<a href="../singleproduct/singleproduct.php?ProdId='.$row_get_product["ProdId"].'">'.$row_get_product['ProdName'].'</a>' ?></td>
                                                                    <td><img src="../../images/<?php echo $row_get_product['ProdImage'] ?>" width="60"></td>
                                                                    <td><?php echo number_format($row_get_order_detail['OrdPrice'], 0, ',', '.') ?></td>
                                                                    <td>
                                                                        <?php echo $row_get_order_detail['OrdQuantity'] ?>
                                                                    </td>
                                                                    <td><?php echo number_format($row_get_order_detail['OrdPrice'] * $row_get_order_detail['OrdQuantity'], 0, ',', '.') ?></td>
                                                                </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tbody>

                                                <tr>
                                                    <th colspan="5" class="text-right">Tổng tiền:</th>
                                                    <th class="text-center"><?php echo number_format($row_get_order['OrderTotalPrice'], 0, ',', '.') ?></th>
                                                </tr>


                                            </table>
                                            
                                
                                    </div>
                                    <?php
                                        $sql_get_trans = "SELECT * FROM ship WHERE ShipId = '".$row_get_order['ShipId']."'";
                                        $result_get_trans = $connection->query($sql_get_trans);
                                        while($row_get_trans = $result_get_trans->fetch_assoc()){
                                    ?>
                                    <div class="col-md-4">
                                        <h5><b style="color: brown;">Thông tin vận chuyển</b></h5>
                                        <div class="form-group">
                                            <label>Tên người nhận</label>
                                            <p class="form-control"><?php echo $row_get_trans['ShipName'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <p class="form-control"><?php echo $row_get_trans['ShipPhone'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <p class="form-control"><?php echo $row_get_trans['ShipAddress'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <br>
                                            <hr style="background-color: black;">
                                            <br>
                                <?php

                            }
                        }else{
                            echo "<h3>Không có đơn mua hàng nào!</h3>";
                        }
                    }
                                ?>
                </div>
            </div>
        </div>

        <!-- Benefit -->
        <?php include_once("../includes/benefit.php") ?>

        <!-- Newsletter -->
        <?php include_once("../includes/newsletter.php") ?>

        <!-- Footer -->
        <?php include_once("../includes/footer.php") ?>

    </div>

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/styles/bootstrap4/popper.js"></script>
    <script src="../assets/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="../assets/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="../assets/plugins/easing/easing.js"></script>
    <script src="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="../assets/js/categories_custom.js"></script>
</body>

</html>