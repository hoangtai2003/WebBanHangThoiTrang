<?php
session_start();
unset($_SESSION["cart"]);
require("../../config/config.php");
if (!isset($_SESSION["cus_loggedin"])) {
    header("Location: ../authen/login.php");
}
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
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="./cart_view.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Giỏ hàng</a></li>
                            <li class="active"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Hình thức vận chuyển</a></li>
                        </ul>
                    </div>
                    <?php include("../authen/message.php") ?>

                    <!-- Main Content -->
                    <?php
                    $cusid = $_SESSION['cusid'];
                    $sql_get_trans = "SELECT * FROM ship WHERE CusId = '" . $cusid . "' ORDER BY ShipId DESC LIMIT 1";
                    $result_get_trans = $connection->query($sql_get_trans);
                    if ($result_get_trans->num_rows > 0) {
                        $row_get_trans = $result_get_trans->fetch_assoc();
                        $name = $row_get_trans['ShipName'];
                        $phone = $row_get_trans['ShipPhone'];
                        $address = $row_get_trans['ShipAddress'];
                        $note = $row_get_trans['ShipNote'];
                    } else {
                        $name = '';
                        $phone = '';
                        $address = '';
                        $note = '';
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Thông tin vận chuyển</h3>
                            <form action="transportation_action.php" method="post">
                                <div class="form-group">
                                    <label for="">Họ và tên</label>
                                    <input required type="text" name="txtname" class="form-control" value="<?php echo $name ?>" placeholder="Họ và tên">
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input required type="text" name="txtphone" class="form-control" value="<?php echo $phone ?>" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="">Địa chỉ</label>
                                    <input required type="text" name="txtaddress" class="form-control" value="<?php echo $address ?>" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="">Ghi chú</label>
                                    <input required type="text" name="txtnote" class="form-control" value="<?php echo $note ?>" placeholder="Ghi chú">
                                </div>
                                <button type="submit" name="cmd_add" class="btn btn-sm btn-primary">Lưu thông tin vận chuyển</button>
                                
                            </form>
                        </div>
                        <style type="text/css">
                            .col-md-4.payment .form-check{
                                margin: 18px;
                            }
                        </style>
                        <div class="col-md-4 payment">
                            <h3>Phương thức thanh toán</h3>
                            <form action="./order_action.php" method="post">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="tienmat" checked>
                                <img src="../../images/cod.jpg" height="32" width="50">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                            <input type="submit" value="Đặt hàng" name="redirect" class="btn btn-sm btn-primary">
                            </form>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Mã</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <?php
                                if (isset($_SESSION['cusid'])) {
                                    $cusid = $_SESSION['cusid'];
                                    //lấy thông tin bảng cart
                                    $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
                                    $result_get_cart = $connection->query($sql_get_cart);
                                    if ($result_get_cart->num_rows > 0) {
                                        $row_get_cart = $result_get_cart->fetch_assoc();
                                        $cartid = $row_get_cart['CartId'];

                                        //lấy thông tin chi tiết giỏ hàng từ bảng cartdetail dựa trên cartid
                                        $sql_get_cart_detail = "SELECT * FROM cartdetail WHERE CartId = '" . $cartid . "'";
                                        $result_get_cart_detail = $connection->query($sql_get_cart_detail);

                                        while ($row_get_cart_detail = $result_get_cart_detail->fetch_assoc()) {
                                            //lấy thông tin sản phẩm từ bảng product dựa trên prodid
                                            $prodid = $row_get_cart_detail['ProdId'];
                                            $quantity = $row_get_cart_detail['Quantity'];

                                            $sql_get_product = "SELECT * FROM product WHERE ProdId = '" . $prodid . "'";
                                            $result_get_product = $connection->query($sql_get_product);

                                            if ($result_get_product->num_rows > 0) {
                                                $row_get_product = $result_get_product->fetch_assoc();

                                                $_SESSION['cart'][] = array(
                                                    'id' => $row_get_product['ProdId'],
                                                    'name' => $row_get_product['ProdName'],
                                                    'image' => $row_get_product['ProdImage'],
                                                    'price' => $row_get_product['ProdPrice'],
                                                    'quantity' => $quantity
                                                );
                                            }
                                        }
                                    }
                                }
                                if (isset($_SESSION["cart"])) {
                                    $i = 0;
                                    $tongtien = 0;
                                    foreach ($_SESSION["cart"] as $cart_item) {
                                        $thanhtien = $cart_item['quantity'] * $cart_item['price'];
                                        $tongtien += $thanhtien;
                                        $i++;
                                ?>
                                        <tbody>
                                            <tr class="text-center">
                                                <th><?php echo $i ?></th>
                                                <td><?php echo $cart_item['id'] ?></td>
                                                <td><?php echo $cart_item['name'] ?></td>
                                                <td><img src="../../images/<?php echo $cart_item['image'] ?>" width="60"></td>
                                                <td><?php echo number_format($cart_item['price'], 0, ',', '.') ?></td>
                                                <td>
                                                    <?php echo $cart_item['quantity'] ?>
                                                </td>
                                                <td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
                                            </tr>
                                        </tbody>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <th colspan="6" class="text-right">Tổng tiền:</th>
                                        <th class="text-center"><?php echo number_format($tongtien, 0, ',', '.') ?></th>
                                    </tr>
                                    <!-- <tr>
										<th colspan="7"></th>	
										<th class="text-center"><a href="./order_action.php" class="btn btn-sm btn-success">Đặt hàng</a></th>
									</tr> -->
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
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